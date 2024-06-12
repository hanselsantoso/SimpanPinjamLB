<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\AturanPinjaman;
use App\Models\Bunga;
use App\Models\Cicilan;
use App\Models\Iuran;
use App\Models\MapAturanCicilan;
use Illuminate\Http\Request;

class aturanController extends Controller
{
    public function aturan(Request $request){
        $aturan = Aturan::all();
        $cicilan = Cicilan::all();
        $bunga = Bunga::all();
        $iuran = Iuran::all();
        $pinjaman = AturanPinjaman::all();
        return view('Admin.Aturan.aturan',with([
            'aturan' => $aturan,
            'cicilan' => $cicilan,
            'bunga' => $bunga,
            'iuran' => $iuran,
            'pinjaman' => $pinjaman,
        ]));
    }

    public function doCreateAturan(Request $request){
        $data = Aturan::create([
            'minimal_tabungan' => $request->minimalSimpanan,
            'maximal_tabungan' => $request->maximalSimpanan,
            'id_bunga' => $request->bunga,
            'id_pinjaman' => $request->pinjaman,
            'id_iuran' => $request->iuran,
            'status' => 1,
        ]);



        if ($data->save()) {
            $map_aturan_cicilan = [];
            foreach ($request->cicilan as $item) {
                $map_aturan_cicilan[] = [
                    'id_aturan' => $data->id,
                    'id_cicilan' => $item,
                ];
            }
            MapAturanCicilan::insert($map_aturan_cicilan);
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
            'iuran_wajib' => $request->iuranWajib,
         ]);



         if ($data) {
            return redirect()->back()->with('success', 'Berhasil menyimpan data simpanan!');

        }else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }
}
