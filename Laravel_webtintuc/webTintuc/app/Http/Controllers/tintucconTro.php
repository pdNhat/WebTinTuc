<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\comment;
use App\tintuc;
use App\loaitin;
use App\theloai;
class tintucconTro extends Controller
{
    //
 
  
   public function getdanhsach(){
   
      	$tintuc = tintuc::orderBy('id','DESC')->get();
     return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

     public function getsua($id){
       $theloai = theloai::all();
      $loaitin = loaitin::all();
       $tintuc = tintuc::find($id);
       return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    
    }

     public function postsua(Request $request,$id){
    $tintuc = tintuc::find($id);
      $this->validate($request,
    [
      'LoaiTin'=>'required',
      'TieuDe'=>'required|min:3|max:100|unique:tintuc,TieuDe',
      'TomTat'=>'required',
      'NoiDung'=>'required'
    ],
    [

    'LoaiTin.required'=>'khong duoc de trong LoaiTin',
    'TieuDe.required'=>'khong duoc de trong Tieu De ',
    'TieuDe.min'=>'Tieu De khong duoi 3 ky tu',
    'TieuDe.unique'=>'tieu de da da ton tai',
    'TieuDe.max'=>'Tieu De khong tren 100 ky tu',
    'TomTat.required'=>'khong duoc de trong TomTat',
    'NoiDung.required'=>'khong duoc de trong NoiDung'
        ]);
       $tintuc->idLoaiTin = $request->LoaiTin;
    $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
    $tintuc->TieuDe  = $request->TieuDe;
    $tintuc->TomTat  = $request->TomTat;
    $tintuc->NoiDung = $request->NoiDung;

    if($request->hasFile('Hinh'))
    {
       $file = $request->Hinh;
       $duoi = $file->getClientOriginalExtension();
       if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' )
       {
             return redirect('admin/tintuc/sua')->with('loi','Ban phai nhap file anh');
 
       }
       $name = $file->getClientOriginalName();
       $Hinh =Str::random(4).'_'.$name;
       while(file_exists('upload/tintuc/'.$Hinh))
       {
           $Hinh =Str::random(4).'_'.$name;
       }
      
       $file->move('upload/tintuc/',$Hinh);
       unlink('upload/tintuc/'.$tintuc->Hinh);
       $tintuc->Hinh = $Hinh;
    }
    
    $tintuc->save();
               return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Ban da sua thanh cong');
    }

     public function getthem(){
      $theloai = theloai::all();
      $loaitin = loaitin::all();
      return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postthem(Request $request){
   $this->validate($request,
    [
      'LoaiTin'=>'required',
      'TieuDe'=>'required|min:3|max:100|unique:tintuc,TieuDe',
      'TomTat'=>'required',
      'NoiDung'=>'required'
    ],
    [

    'LoaiTin.required'=>'khong duoc de trong LoaiTin',
    'TieuDe.required'=>'khong duoc de trong Tieu De ',
    'TieuDe.min'=>'Tieu De khong duoi 3 ky tu',
    'TieuDe.unique'=>'tieu de da da ton tai',
    'TieuDe.max'=>'Tieu De khong tren 100 ky tu',
    'TomTat.required'=>'khong duoc de trong TomTat',
    'NoiDung.required'=>'khong duoc de trong NoiDung'
        ]);
       
    $tintuc = new tintuc;
    $tintuc->idLoaiTin = $request->LoaiTin;
    $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
    $tintuc->TieuDe  = $request->TieuDe;
    $tintuc->TomTat  = $request->TomTat;
    $tintuc->NoiDung = $request->NoiDung;

    if($request->hasFile('Hinh'))
    {
       $file = $request->Hinh;
       $duoi = $file->getClientOriginalExtension();
       if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' )
       {
             return redirect('admin/tintuc/them')->with('loi','Ban phai nhap file anh');
 
       }
       $name = $file->getClientOriginalName();
       $Hinh =Str::random(4).'_'.$name;
       while(file_exists('upload/tintuc/'.$Hinh))
       {
           $Hinh =Str::random(4).'_'.$name;
       }
      
       $file->move('upload/tintuc/',$Hinh);
       $tintuc->Hinh = $Hinh;
    }
    else
    {
       $tintuc->Hinh = '';

    }
    $tintuc->save();


   return redirect('admin/tintuc/them')->with('thongbao','da them thanh cong');












}
  public function getxoa($id){
   $tintuc = tintuc::find($id);
   $tintuc->delete();
  return redirect('admin/tintuc/danhsach')->with('thongbao','Da xoa thanh cong');
}
}
