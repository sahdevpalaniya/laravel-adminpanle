<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data=[];
        $data['page_title']='Admin Dashboard';
        return view('admin.dashboard',$data);
    }
}
