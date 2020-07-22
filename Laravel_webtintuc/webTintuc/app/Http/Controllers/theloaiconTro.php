<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\theloai;
class theloaiconTro extends Controller
{

   public function getdanhsach(){
      	$theloai = theloai::all();
     return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }

     public function getsua($id){
    	$theloai = theloai::find($id);
    	return view('admin.theloai.sua',['theloai'=>$theloai]);
    }

     public function postsua(Request $request,$id){
    	$theloai = theloai::find($id);

          $this->validate($request,
        [
           'Ten' => 'required|unique:theloai,Ten|min:3|max:100'
        ],
        [
           'Ten.required' => 'Ten khong duoc de trong',
           'Ten.unique'   =>  'The loai nay da ton tai',
           'Ten.min'      =>  'Ten phai nhieu hon 3 ky tu',
           'Ten.max'      =>  'Ten khong duoc qua 100 ky tu'
        ]
    	);

          $theloai->Ten = $request->Ten;
          $theloai->TenKhongDau = changeTitle($request->Ten);
          $theloai->save();

          return redirect('admin/theloai/sua/'.$id)->with('thongbao','sua thanh cong');

    }

     public function getthem(){
    	return view('admin.theloai.them');
    }

    public function postthem(Request $request){
    	$this->validate($request,
        [
           'Ten' => 'required|min:3|max:100|unique:theloai,Ten'
        ],
        [
           'Ten.required' => 'Ten khong duoc de trong',
           'Ten.min'      =>  'Ten phai nhieu hon 3 ky tu',
           'Ten.max'      =>  'Ten khong duoc qua 100 ky tu',
            'Ten.unique'   =>  'The loai nay da ton tai',
        ]
    	);

    $theloai = new theloai();
    $theloai->Ten = $request->Ten;
    $theloai->TenKhongDau = changeTitle($request->Ten);
    $theloai->save();
   
   return redirect('admin/theloai/them')->with('thongbao','them thanh cong');
    }




     public function getxoa($id){
    	$theloai = theloai::find($id);
    	$theloai->delete();
    	return redirect('admin/theloai/danhsach')->with('thongbao','Da xoa thanh cong');

}
}


   







