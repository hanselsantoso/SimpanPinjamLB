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
        $pinjamanH->jatuh_tempo = Carbon::createFromFormat('d-m-Y', $request->tgl)->addMonth()->format('Y-m-d');
        $pinjamanH->id_user = $request->idUser;
        $pinjamanH->total_pinjaman = $request->nominal + ($request->nominal * ($request->bungaPinjaman / 100)) ;
        $pinjamanH->total_cicilan = $request->totalCicilan ;
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

    function bayarPinjaman(Request $request){
        $pinjamanD = new Pinjaman_D();
        $pinjamanD->id_pinjaman_h = $request->idByarPinjaman;
        $pinjamanD->id_admin = Auth::id();
        $pinjamanD->tanggal = Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d');
        $pinjamanD->pinjaman = $request->nominal;
        $pinjamanD->status_pinjaman_d = 1;
        $pinjamanD->save();

        if ($pinjamanD) {
            $pinjamanH = Pinjaman_H::find($request->idByarPinjaman);
            if ($request->nominal >= $pinjamanH->total_pinjaman){
                $pinjamanH->total_pinjaman = $pinjamanH->total_pinjaman - $request->nominal;
                $pinjamanH->total_cicilan = 0;
                $pinjamanH->status_pinjaman_h = 0;
            }else{
                $pinjamanH->total_pinjaman = $pinjamanH->total_pinjaman - $request->nominal;
                $pinjamanH->total_cicilan = $pinjamanH->total_cicilan - 1;
                $pinjamanH->jatuh_tempo = Carbon::createFromFormat('Y-m-d', $pinjamanH->jatuh_tempo)->addMonth()->format('Y-m-d');
            }
            
        }
        $pinjamanH->save();
        
        return redirect()->back()->with('success', 'Berhasil membayar cicilan!');
    }

}
