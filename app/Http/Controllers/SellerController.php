<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    //
    public function index(){
        $data['user'] = User::all()->where('role','seller');

        return view('seller.index',$data);
    }
}
