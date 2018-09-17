<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UploadController extends Controller
{     

    public function upload(Request $request){
        //print_r($request->all()); exit;

        $nomeImg = $request->id.'.'.$request->img->extension();
        $upload = $request->img->storeAs('img', $nomeImg);
        return "http://localhost:8080/public/api/storage/".$nomeImg;

    }


}
