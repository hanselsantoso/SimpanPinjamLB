<?php

namespace App\Http\Controllers;

use App\Models\PemegangSHU;
use App\Models\SHU;
use Illuminate\Http\Request;

class SHUController extends Controller
{
    public function index(Request $request){
        $shu = PemegangSHU::all();
        return view('Admin.Aturan.shu',with([
            'shu' => $shu
        ]));
    }

    public function doUpdateSHU(Request $request){
        $validatedData = $request->validate([
            'persentase' => 'required|numeric',
        ]);

        $data = PemegangSHU::where('id_pemegang_shu',$request->idUserSHU)
         ->update([
            'persentase_pemegang_shu' => $request->persentase,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil mengubah data pemegang SHU!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function doDeleteSHU(Request $request){
        $data = PemegangSHU::where('id_pemegang_shu',$request->id)
         ->update([
            'status_pemegang_shu' => 0,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil non-aktifkan SHU!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function doAktifSHU(Request $request){
        $data = PemegangSHU::where('id_pemegang_shu',$request->id)
         ->update([
            'status_pemegang_shu' => 1,
         ]);

         if ($data) {
            return redirect()->back()->with('success', 'Berhasil aktifkan SHU!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }
}
