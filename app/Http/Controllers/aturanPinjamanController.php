<?php

namespace App\Http\Controllers;

use App\Models\AturanPinjaman;
use Illuminate\Http\Request;

class aturanPinjamanController extends Controller
{
    public function index(Request $request){
        $pinjaman = AturanPinjaman::all();
        return view('Admin.Aturan.pinjaman',with([
            'pinjaman' => $pinjaman
        ]));
    }

    public function doCreatePinjaman(Request $request){
        $validatedData = $request->validate([
            'pinjaman' => 'required|numeric',
        ]);

        $data = AturanPinjaman::create([
            'pinjaman' => $request->pinjaman,
        ]);



        if ($data->save()) {
            return redirect()->back()->with("success", "Telah berhasil membuat aturan pinjaman baru");
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }

    }

    public function doUpdatePinjaman(Request $request){
        $validatedData = $request->validate([
            'pinjaman' => 'required|numeric',
        ]);

        $data = AturanPinjaman::where('id_pinjaman',$request->idUserPinjaman)
         ->update([
            'pinjaman' => $request->pinjaman,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil mengubah data pinjaman!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function doDeletePinjaman(Request $request){
        $data = AturanPinjaman::where('id_pinjaman',$request->id)
         ->update([
            'status_pinjaman' => 0,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil non-aktifkan pinjaman!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function doAktifPinjaman(Request $request){
        $data = AturanPinjaman::where('id_iuran',$request->id)
         ->update([
            'status_iuran' => 1,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil aktifkan iuran!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }
}
