<?php

namespace App\Http\Controllers;
use App\loaitin;
use App\theloai;

use Illuminate\Http\Request;

class ajaxconTro extends Controller
{
    //
    public function getajaxlt($idTheLoai){
       $loaitin = loaitin::where('idTheLoai',$idTheLoai)->get();
       foreach($loaitin as $lt)
       {
        echo '<option value="'.$lt->id.'">'.$lt->Ten.'</option>';
       }
    }
}
