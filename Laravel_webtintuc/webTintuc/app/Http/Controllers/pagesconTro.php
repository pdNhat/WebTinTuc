<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\theloai;
use App\loaitin;
use App\tintuc;
use App\User;
class pagesconTro extends Controller
{
    //
    
public function gettrangchu()

{
	
return view('pages.trangchu');
}

   
	

public function getloaitin($id)
{
	$loaitin = loaitin::find($id);
	$tintuc = tintuc::where('idLoaiTin',$id)->paginate(5);
	return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
}

public function gettintuc($id)
{
	$tintuc = tintuc::find($id);
	$tinnoibat = tintuc::where('NoiBat',1)->take(4)->get();
	$tinlienquan = tintuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
	return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
}
public function getdangnhap()
{
	return view('pages.dangnhap');
}

public function postdangnhap(Request $request)
{
	$this->validate($request,
    [
     'email'=>'required',
     'password'=>'required|min:6|max:32',
    ]
    ,
    [
      'email.required'=>'Ban chua nhap email',
      'password.required'=>'Ban chua nhap password',
      'password.min'=>'Password phai tu 6 den 32 ky tu',
      'password.max'=>'Password phai tu 6 den 32 ky tu'
    ]
  );
  if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
  {
   
    return redirect('pages/trangchu');
   
  }
  else
  {
    return redirect('dangnhap')->with('thongbao','Dang nhap khong thanh cong');
  }
}

public function getdangxuat()
{
  Auth::logout();
  return redirect('pages/trangchu');
}
public function getnguoidung()
{
  $user = Auth::user();
  return view('pages.taikhoan',['user'=>$user]);
}
public function postnguoidung(Request $request)
{
 $this->validate($request,
      [
          'name'=>'required|min:3',
         
      ]
      ,
      [
        'name.required'=>'Ban chua nhap ten',
        'name.min'=>'ten phai lon hon 3 ky tu',
       
      ]);
      $user = Auth::user();
      $user->name = $request->name;
      
     
      if($request->changePassword == 'on')
      {
        $this->validate($request,
      [
         
          'password'=>'required|min:6|max:32',
          'passwordAgain'=>'required|same:password'
      ]
      ,
      [
       
        'password.required'=>'password khong duoc de trong',
        'password.min'=>'password phai lon hon 3 ky tu',
        'password.max'=>'password phai nho hon 32 ky tu',
        'passwordAgain.required'=>'passwordAgain khong duoc de trong',
        'passwordAgain.same'=>'passwordAgain khong khop voi password'
      ]);
          $user->password = bcrypt($request->password);
      }
     
     
      $user->save();

      
return redirect('nguoidung')->with('thongbao','Ban da sua thanh cong');


}

public function getdangky()
{
  return view('pages.dangky');
}
public function postdangky(Request $request)
{
    $this->validate($request,
        [
          'name'=>'required|min:3',
          'email'=>'required|unique:users,email',
          'password'=>'required|min:6|max:32',
          'passwordAgain'=>'required|same:password'
      ]
      ,
      [
        'name.required'=>'Ban chua nhap ten',
        'name.min'=>'ten phai lon hon 3 ky tu',
        'email.required'=>'Ban chua nhap email',
        'email.unique'=>'Email cua ban da ton tai',
        'password.required'=>'password khong duoc de trong',
        'password.min'=>'password phai lon hon 3 ky tu',
        'password.max'=>'password phai nho hon 32 ky tu',
        'passwordAgain.required'=>'passwordAgain khong duoc de trong',
        'passwordAgain.same'=>'passwordAgain khong khop voi password'
      ]);
      $user = new User;
      $user->name = $request->name;
      $user->email= $request->email;
      $user->password = bcrypt($request->password);
      $user->quyen = 0; 
      $user->save();

      
return redirect('dangnhap')->with('thongbao','Ban da dang ky thanh cong');
}

public function timkiem(Request $request)
{
      $tukhoa = $request->TimKiem;
      $tintuc = tintuc::where('TieuDe','like',"%$tukhoa%")->orwhere('TomTat','like',"%$tukhoa%")->orwhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(5);
      return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
}
public function lienhe()
{
  return view('pages.lienhe');
}

}




