<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class BookController extends Controller
{
    public function get($id = NULL){
        if(!is_null($id)){
            //return specific

        }else{
            //return all
        }
    }
}
