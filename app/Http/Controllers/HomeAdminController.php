<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    public function Home(){
        return view('admins/dashboard');
    }
}
