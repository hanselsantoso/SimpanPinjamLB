<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Simpanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class simpananController extends Controller
{
    public function doCreate(Request $request){
        // dd($request);
        $count = Simpanan::where('id_user',$request->idUser)
        ->where('status',0)
        ->count();
        // dd($count);
        $data = null;
        $user = User::find($request->idUser);
        $simpanan = Simpanan::
        where('id_user',$request->idUser)
        ->where('status',1)
        ->orWhere('status',0)
        ->get();
        // dd(Carbon::createFromFormat('d-m-Y', $request->tgl)->format('d-m-Y'));
        if ($count < 1) {
            $data = Simpanan::create([
                'id_user' => $request->idUser,
                'id_admin' => Auth::id(),
                'tanggal' => Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d'),
                'nominal' => $request->nominal,
                'status' => 0,
            ]);
        }
        else{
            $data = Simpanan::create([
                'id_user' => $request->idUser,
                'id_admin' => Auth::id(),
                'tanggal' => Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d'),
                'nominal' => $request->nominal,
                'status' => 1,
            ]);
        }
        if ($data->save()) {
            return redirect()->back()->with('success', 'Berhasil menyimpan data simpanan!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function doUpdate(Request $request){
        $data = Simpanan::where('id',$request->idSimpanan)
        ->where('id_user',$request->idUser)
         ->update([
            'tanggal' => Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d'),
            'nominal' => $request->nominal,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil menyimpan data simpanan!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function aturan(Request $request){
        $aturan = Aturan::all();
        return view('Admin.Aturan.simpanan',with([
            'aturan' => $aturan
        ]));
    }

    public function doCreateAturan(Request $request){
        $data = Aturan::create([
            'minimal_tabungan' => $request->minimalSimpanan,
            'pinjaman' => $request->pinjaman,
            'status' => 1,
        ]);
        if ($data->save()) {
            return redirect()->back()->with("success, Telah berhasil membuat aturan baru");

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function doUpdateAturan(Request $request){
        $data = Aturan::where('id',$request->idUserSimpanan)
         ->update([
            'minimal_tabungan' => $request->minimalSimpanan,
            'pinjaman' => $request->pinjaman,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil menyimpan data simpanan!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }


}
