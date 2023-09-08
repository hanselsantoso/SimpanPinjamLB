<?php

namespace App\Http\Controllers;

use App\Models\simpanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class simpananController extends Controller
{
    public function doCreate(Request $request){
        // dd($request);
        $count = simpanan::where('id_user',$request->idUser)
        ->where('status',0)
        ->count();
        // dd($count);
        $data = null;
        $user = User::find($request->idUser);
        $simpanan = simpanan::
        where('id_user',$request->idUser)
        ->where('status',1)
        ->orWhere('status',0)
        ->get();
        // dd(Carbon::createFromFormat('d-m-Y', $request->tgl)->format('d-m-Y'));
        if ($count < 1) {
            $data = simpanan::create([
                'id_user' => $request->idUser,
                'id_admin' => Auth::id(),
                'tanggal' => Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d'),
                'nominal' => $request->nominal,
                'status' => 0,
            ]);
        }
        else{
            $data = simpanan::create([
                'id_user' => $request->idUser,
                'id_admin' => Auth::id(),
                'tanggal' => Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d'),
                'nominal' => $request->nominal,
                'status' => 1,
            ]);
        }
        if ($data->save()) {
            // return redirect()->back()->with('success', 'Berhasil menyimpan data simpanan!');
            return view('Admin.detailUser',with([
                'user'=>$user,
                'simpanan'=>$simpanan,
                'success' => 'Berhasil menyimpan data simpanan!'
            ]));

        }else{
            // return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
            return view('Admin.detailUser',with([
                'user'=>$user,
                'simpanan'=>$simpanan,
                'errors' => 'Terjadi kesalahan, coba ulangi lagi'
            ]));
        }


    }

    public function aturan(Request $request){
        return view('Admin.Aturan.simpanan');
    }
}
