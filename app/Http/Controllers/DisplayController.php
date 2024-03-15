<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    function show(){
        $data=User::all();
        return view('admindashboard', ['data'=>$data]);
    }
}
