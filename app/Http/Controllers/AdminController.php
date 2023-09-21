<?php

namespace App\Http\Controllers;

use App\Models\simpanan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(Request $request) {
        $user = User::where('status',1)->where('role',1)->get();
        return view('Admin.dashboard',with([
            'user' => $user
    ]));
    }

    public function detailUser(Request $request, $id){
        $user = User::find($id);
        $simpanan = simpanan::
        where('id_user',$request->id)
        ->where('status',1)
        ->orWhere('status',0)
        ->get();
        return view('Admin.detailUser',with([
            'user'=>$user,
            'simpanan'=>$simpanan
        ]));
    }
}
