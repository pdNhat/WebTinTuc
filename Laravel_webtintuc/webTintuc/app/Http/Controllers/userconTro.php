<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\User;

class userconTro extends Controller
{
    //
 
  
   public function getdanhsach(){
      $user = User::all();
      return view('admin.users.danhsach',['user'=>$user]);
    }

     public function getsua($id){
    $user = User::find($id);
    return view('admin.users.sua',['user'=>$user]);
    }

     public function postsua(Request $request,$id){
     $this->validate($request,
      [
          'name'=>'required|min:3',
         
      ]
      ,
      [
        'name.required'=>'Ban chua nhap ten',
        'name.min'=>'ten phai lon hon 3 ky tu',
       
      ]);
      $user = User::find($id);
      $user->name = $request->name;
      $user->email= $request->email;
      $user->quyen= $request->quyen;
      if($request->changePassword == 'on')
      {
        $this->validate($request,
      [
         
          'password'=>'required|min:4|max:32',
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

      
return redirect('admin/users/sua/'.$id)->with('thongbao','Ban da sua thanh cong');



    

    }

     public function getthem(){
   return view('admin.users.them');
    }

    public function postthem(Request $request){
    	$this->validate($request,
        [
          'name'=>'required|min:3',
          'email'=>'required|unique:users,email',
          'password'=>'required|min:4|max:32',
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
      $user->quyen = $request->quyen; 
      $user->save();

      
return redirect('admin/users/them')->with('thongbao','Ban da them thanh cong');



    
}
  public function getxoa($id){
   $user = User::find($id);
   $user->delete();
return redirect('admin/users/danhsach')->with('thongbao','Da xoa thanh cong');
}


public function getdangnhap()
{
  return view('admin.login');
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
   
    return redirect('admin/loaitin/danhsach');
   
  }
  else
  {
    return redirect('admin/dangnhap')->with('thongbao','Dang nhap khong thanh cong');
  }
}



 public function getlogout()
 {
  Auth::logout();
  return redirect('admin/dangnhap');
 }






}
