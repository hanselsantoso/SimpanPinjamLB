<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use Illuminate\Http\Request;

class iuranController extends Controller
{
    public function index(Request $request){
        $iuran = Iuran::all();
        return view('Admin.Aturan.iuran',with([
            'iuran' => $iuran
        ]));
    }

    public function doCreateIuran(Request $request){
        $validatedData = $request->validate([
            'iuran' => 'required|numeric',
        ]);

        $data = Iuran::create([
            'iuran' => $request->iuran,
        ]);



        if ($data->save()) {
            return redirect()->back()->with("success", "Telah berhasil membuat aturan iuran baru");
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }

    }

    public function doUpdateIuran(Request $request){
        $validatedData = $request->validate([
            'iuran' => 'required|numeric',
        ]);

        $data = Iuran::where('id_iuran',$request->idUserIuran)
         ->update([
            'iuran' => $request->iuran,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil mengubah data iuran!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function doDeleteIuran(Request $request){
        $data = Iuran::where('id_iuran',$request->id)
         ->update([
            'status_iuran' => 0,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil non-aktifkan iuran!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function doAktifIuran(Request $request){
        $data = Iuran::where('id_iuran',$request->id)
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
