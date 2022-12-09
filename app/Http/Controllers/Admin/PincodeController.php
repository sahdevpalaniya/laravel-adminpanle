<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Contry;
use App\Models\State;
use Illuminate\Http\Request;

class PincodeController extends Controller
{
    public function index()
    {
        $data = [];
        $data['page_title'] = 'Pincode List';
        $data['back_page_title'] = 'Dashboard';
        $data['back_page_route'] = 'admin-dashboard';
        return view('admin.pincode.index', $data);
    }

    public function create()
    {
        $data = [];
        $data['page_title'] = 'Add Pincode';
        $data['back_page_title'] = 'Pincode List';
        $data['back_page_route'] = 'pincode.index';
        $data['contries'] = Contry::get(["name", "id"]);
        // dd($data['contries']);
        return view('admin.pincode.create', $data);
    }

    public function state(Request $request){
        $contry_id=$request->contry_id;
        $data['states']=state::where("country_id",$contry_id)->get(["name", "id"]);
        return response()->json($data);
    } 

    public function city(Request $request){
        $state_id=$request->state_id;
        $data['citys']=City::where("state_id",$state_id)->get(["name", "id"]);
        return response()->json($data);
    } 
}
