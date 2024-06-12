<?php

namespace App\Http\Controllers;

use App\Models\Cicilan;
use Illuminate\Http\Request;

class cicilanController extends Controller
{
    public function index(Request $request){
        $cicilan = Cicilan::all();
        return view('Admin.Aturan.cicilan',with([
            'cicilan' => $cicilan
        ]));
    }

    public function doCreateCicilan(Request $request){
        $validatedData = $request->validate([
            'cicilan' => 'required|numeric',
        ]);

        $data = Cicilan::create([
            'cicilan' => $request->cicilan,
        ]);



        if ($data->save()) {
            return redirect()->back()->with("success", "Telah berhasil membuat aturan cicilan baru");
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }

    }

    public function doUpdateCicilan(Request $request){
        $validatedData = $request->validate([
            'cicilan' => 'required|numeric',
        ]);

        $data = Cicilan::where('id_cicilan',$request->idUserCicilan)
         ->update([
            'cicilan' => $request->cicilan,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil mengubah data cicilan!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function doDeleteCicilan(Request $request){
        $data = Cicilan::where('id_cicilan',$request->id)
         ->update([
            'status_cicilan' => 0,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil non-aktifkan cicilan!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function doAktifCicilan(Request $request){
        $data = Cicilan::where('id_cicilan',$request->id)
         ->update([
            'status_cicilan' => 1,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil aktifkan cicilan!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }
}
