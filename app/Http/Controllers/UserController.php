<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman_H;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $user = User::find(auth()->id());
        $info = $user->getInfo();
        // dd($info);
        return view('User.index',with([
            'user'=> $user,
            'info'=> $info,
        ]));
    }

    public function pinjaman($id)
    {
        $pinjaman = Pinjaman_H::findOrFail($id);
        return view('User.detailPinjaman', compact('pinjaman'));
    }
}
