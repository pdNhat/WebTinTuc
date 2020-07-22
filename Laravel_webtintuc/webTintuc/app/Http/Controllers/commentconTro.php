<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;  
use App\comment;
use App\tintuc;
class commentconTro extends Controller
{

   


     public function getxoa($id,$idtt){
    	$comment = comment::find($id);
    	$comment->delete();
    	return redirect('admin/tintuc/sua/'.$idtt);

}
public function comment($id,Request $request)
{
  $this->validate($request,
    [
      'NoiDung'=>'required'
    ],
    [
      'NoiDung.required'=>'Comment cua ban trong'
    ]);
  $tintuc = tintuc::find($id);
 $idTinTuc = $id;
 $comment = new comment;
 $comment->idTinTuc = $idTinTuc;
 $comment->idUser = Auth::user()->id;
 $comment->NoiDung = $request->NoiDung;
 $comment->save();
 return redirect("pages/tintuc/$id/". $tintuc->TieuDeKhongDau .".html"); 
}
}
