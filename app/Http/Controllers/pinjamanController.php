<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman_D;
use App\Models\Pinjaman_H;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pinjamanController extends Controller
{
    function doCreatePinjaman(Request $request) {
        $pinjamanH = new Pinjaman_H();
        $pinjamanH->tanggal_pinjaman = Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d');
        $pinjamanH->id_user = $request->idUser;
        $pinjamanH->total_pinjaman = $request->nominal + ($request->nominal * ($request->bungaPinjaman / 100)) ;
        $pinjamanH->save();


        // if ($pinjamanH) {
        //     $pinjaman = new Pinjaman_D();
        //     $pinjaman->id_pinjaman_h = $pinjamanH->id_pinjaman_h;
        //     $pinjaman->id_admin = Auth::id();
        //     $pinjaman->tanggal = Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d');
        //     $pinjaman->nominal = $request->nominal;
        //     $pinjaman->status = $request->status;
        //     $pinjaman->save();
        // }
        return redirect()->back()->with('success', 'Berhasil menyimpan data pinjaman!');
    }



}
