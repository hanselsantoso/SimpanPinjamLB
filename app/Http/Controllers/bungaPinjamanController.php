<?php

namespace App\Http\Controllers;

use App\Models\BungaPinjaman;
use Illuminate\Http\Request;

class bungaPinjamanController extends Controller
{
    public function index(Request $request){
        $bunga = BungaPinjaman::all();
        return view('Admin.Aturan.bungaPinjaman',with([
            'bunga' => $bunga
        ]));
    }

    public function doCreateBunga(Request $request){
        // dd($request->bunga);
        $data = BungaPinjaman::create([
            'bunga_pinjaman' => $request->bunga,
            'status' => 1,
        ]);
        if ($data->save()) {
            return redirect()->back()->with("success, Telah berhasil membuat aturan bunga baru");

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function doUpdateBunga(Request $request){
        $data = BungaPinjaman::where('id',$request->idUserBunga)
         ->update([
            'bunga_pinjaman' => $request->bunga,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil mengubah data bunga!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function doDeleteBunga(Request $request){
        $data = BungaPinjaman::where('id',$request->id)
         ->update([
            'status' => 0,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil non-aktifkan bunga!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function doAktifBunga(Request $request){
        $data = BungaPinjaman::where('id',$request->id)
         ->update([
            'status' => 1,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil aktifkan bunga!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }
}
