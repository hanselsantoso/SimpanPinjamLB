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
        try {
            if ($count < 1) {
                $data = simpanan::create([
                    'id_user' => $request->idUser,
                    'id_admin' => Auth::id(),
                    'tanggal' => Carbon::parse($request->tgl),
                    'nominal' => $request->nominal,
                    'status' => 0,
                ]);
            }
            else{
                $data = simpanan::create([
                    'id_user' => $request->idUser,
                    'id_admin' => Auth::id(),
                    'tanggal' => Carbon::parse($request->tgl),
                    'nominal' => $request->nominal,
                    'status' => 1,
                ]);
            }
            if ($data->save()) {
                // return redirect()->back()->with('success', 'Berhasil menyimpan data simpanan!');
                return view('Admin.detailUser',with([
                    'user'=>$user,
                    'success' => 'Berhasil menyimpan data simpanan!'
                ]));

            }else{
                // return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
                return view('Admin.detailUser',with([
                    'user'=>$user,
                    'errors' => 'Terjadi kesalahan, coba ulangi lagi'
                ]));
            }
        } catch (\Exception $e) {
            // return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            return view('Admin.detailUser',with([
                'user'=>$user,
                'success' => 'An error occurred: ' . $e->getMessage()
            ]));
        }


    }
}
