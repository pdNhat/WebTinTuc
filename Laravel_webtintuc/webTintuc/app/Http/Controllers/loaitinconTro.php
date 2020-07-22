<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loaitin;
use App\theloai;
class loaitinconTro extends Controller
{
    //
 
  
   public function getdanhsach(){
      	$loaitin = loaitin::all();
     return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }

     public function getsua($id){
     	$theloai = theloai::all();
     	$loaitin = loaitin::find($id);
     	return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    
    }

     public function postsua(Request $request,$id){
     	$this->validate($request,
          [
           'Ten'=>'min:3|max:100|required|unique:loaitin,Ten',
           'TheLoai'=>'required'
          ]
          ,
          [
           'Ten.min'=>'Ten loai tin phai tren 3 ky tu',
           'Ten.max'=>'Ten loai tin phai duoi 100 ky tu',
           'Ten.required'=>'Ten loai tin khong duoc trong',
           'Ten.unique'=>'Ten loai tin khong duoc trung lap',
           'TheLoai.required'=>'The Loai khong duoc trong'
          ]
    	);
    	$loaitin = loaitin::find($id);
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->idTheLoai = $request->TheLoai;
    	$loaitin->save();

    	return redirect('admin/loaitin/sua/'.$id)->with('thongbao','da sua thanh cong');

    }

     public function getthem(){
     	$theloai = theloai::all();
    	return view('admin.loaitin.them',['theloai'=>$theloai]);
    }

    public function postthem(Request $request){
    	$this->validate($request,
          [
           'Ten'=>'min:3|max:100|required|unique:loaitin,Ten',
           'TheLoai'=>'required'
          ]
          ,
          [
           'Ten.min'=>'Ten loai tin phai tren 3 ky tu',
           'Ten.max'=>'Ten loai tin phai duoi 100 ky tu',
           'Ten.required'=>'Ten loai tin khong duoc trong',
           'Ten.unique'=>'Ten loai tin khong duoc trung lap',
           'TheLoai.required'=>'The Loai khong duoc trong'
          ]
    	);

    	$loaitin = new loaitin;
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->idTheLoai = $request->TheLoai;
    	$loaitin->save();

    	return redirect('admin/loaitin/them')->with('thongbao','da them thanh cong');
    
}
  public function getxoa($id){
    	$loaitin = loaitin::find($id);
    	$loaitin->delete();
    	return redirect('admin/loaitin/danhsach')->with('thongbao','Da xoa thanh cong');

}
}
