<?php

namespace App\Http\Controllers;

use App\Models\LogShu;
use App\Models\PemegangSHU;
use App\Models\SHU;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function hitungshu(Request $request)
    {
        // Dapatkan semua pengguna
        $users = User::where('role', 1)->get();
        $totalKeuntungan = 0;

        // Hitung total keuntungan berdasarkan selisih bunga simpanan dan bunga pinjaman
        foreach ($users as $user) {

            $TotalBungaSimpanan = $user->sumAllBungaSimpanan();
            $TotalPinjaman = $user->countTotalBungaPinjaman();
            $selisihBunga = $TotalPinjaman - $TotalBungaSimpanan;
            $totalKeuntungan += $selisihBunga;
        }
        $pemegangSHU = PemegangSHU::where('status_pemegang_shu', 1)->get();
        foreach ($pemegangSHU as $key => $value) {
            $persentase = $value->persentase_pemegang_shu;
            $totalSHU = $totalKeuntungan * ($persentase / 100);
            $value->shu()->create([
                'id_pemegang_shu' => $value->id_pemegang_shu,
                'shu' => $totalSHU,
                'tanggal' => Carbon::today()->format('Y-m-d'),
            ]);
        }
        $pemegangSHU = PemegangSHU::where('id_pemegang_shu', 3)->first();
        $persentase = $pemegangSHU->persentase_pemegang_shu;
        $listUser = User::where('role', 1)->get();
        $shu = $totalKeuntungan * ($persentase / 100) / count($listUser);
        foreach ($listUser as $key => $value) {
            $value->simpanan->simpanans()->create([
                'id_simpanan_h' => $value->simpanan->id_simpanan_h,
                'id_admin' => Auth::id(),
                'nominal' => $shu,
                'tanggal' => Carbon::today()->format('Y-m-d'),
                'status' => 3,
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil menghitung SHU!');

    }


}
