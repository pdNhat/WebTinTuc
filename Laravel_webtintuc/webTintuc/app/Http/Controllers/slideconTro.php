<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\slide;

class slideconTro extends Controller
{
    //
 
  
   public function getdanhsach(){
      	$slide = slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);
    }

     public function getsua($id){
     $slide = slide::find($id);
     return view('admin.slide.sua',['slide'=>$slide]);
    
    }

     public function postsua(Request $request,$id){
     $this->validate($request,
        [
        'Ten'=>'required',
        'NoiDung'=>'required'
        ]
        ,
        [
        'Ten.required'=>'Ban chua nhap ten',
         'NoiDung.required'=>'Ban chua nhap noi dung'
        ]);
      $slide = slide::find($id);
      $slide->Ten = $request->Ten;
      $slide->NoiDung = $request->NoiDung;
      if($request->has('link'))
      {
        $slide->link = $request->link;
      }
       if($request->hasFile('Hinh'))
    {
       $file = $request->Hinh;
       $duoi = $file->getClientOriginalExtension();
       if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' )
       {
             return redirect('admin/slide/them')->with('loi','Ban phai nhap file anh');
 
       }
       $name = $file->getClientOriginalName();
       $Hinh =Str::random(4).'_'.$name;
       while(file_exists('upload/slide/'.$Hinh))
       {
           $Hinh = Str::random(4).'_'.$name;
       }
       unlink('upload/slide/'.$slide->Hinh);
       $file->move('upload/slide/',$Hinh);
       $slide->Hinh = $Hinh;
    }
   
    $slide->save();
    return redirect('admin/slide/sua/'.$id)->with('thongbao','Sua thanh cong');

    }

     public function getthem(){
      return view('admin.slide.them');
    }

    public function postthem(Request $request){
    	$this->validate($request,
        [
        'Ten'=>'required',
        'NoiDung'=>'required'
        ]
        ,
        [
        'Ten.required'=>'Ban chua nhap ten',
         'NoiDung.required'=>'Ban chua nhap noi dung'
        ]);
      $slide = new slide;
      $slide->Ten = $request->Ten;
      $slide->NoiDung = $request->NoiDung;
      if($request->has('link'))
      {
        $slide->link = $request->link;
      }
       if($request->hasFile('Hinh'))
    {
       $file = $request->Hinh;
       $duoi = $file->getClientOriginalExtension();
       if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' )
       {
             return redirect('admin/slide/them')->with('loi','Ban phai nhap file anh');
 
       }
       $name = $file->getClientOriginalName();
       $Hinh =Str::random(4).'_'.$name;
       while(file_exists('upload/slide/'.$Hinh))
       {
           $Hinh = Str::random(4).'_'.$name;
       }
       
       $file->move('upload/slide/',$Hinh);
       $slide->Hinh = $Hinh;
    }
    else
    {
       $slide->Hinh = '';

    }
    $slide->save();
    return redirect('admin/slide/them')->with('thongbao','Them thanh cong');
    
}
  public function getxoa($id){
    $slide = slide::find($id);
    $slide->delete();
    return redirect('admin/slide/danhsach')->with('thongbao','Ban da xoa thanh cong');

}
}
