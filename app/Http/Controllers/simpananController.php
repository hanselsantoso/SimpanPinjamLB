<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\AturanPinjaman;
use App\Models\Bunga;
use App\Models\Cicilan;
use App\Models\Iuran;
use App\Models\Simpanan;
use App\Models\Simpanan_H;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class simpananController extends Controller
{
    public function doCreate(Request $request){
        $userId = $request->idUser;

        // Check if the user already has a Simpanan_H
        $hasSimpananH = Simpanan_H::where('id_user', $userId)->exists();



        try {
            if (!$hasSimpananH) {
                $simpananH = new Simpanan_H;
                $simpananH->tanggal_simpanan = Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d');
                $simpananH->id_user = $request->idUser;
                $simpananH->total_simpanan = $request->nominal;
                $simpananH->save();


                if ($simpananH) {
                    $simpanan = new Simpanan;
                    $simpanan->id_simpanan_h = $simpananH->id_simpanan_h;
                    $simpanan->id_admin = Auth::id();
                    $simpanan->tanggal = Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d');
                    $simpanan->nominal = $request->nominal;
                    $simpanan->status = $request->status;
                    $simpanan->save();
                }

                return redirect()->back()->with('success', 'Berhasil menyimpan data simpanan!');
            } else {
                $simpananH = Simpanan_H::where('id_user', $userId)->first();
                $simpananH->total_simpanan += $request->nominal;
                $simpananH->tanggal_simpanan = Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d');
                $simpananH->save();
                if ($simpananH) {
                    $simpanan = new Simpanan;
                    $simpanan->id_simpanan_h = $simpananH->id_simpanan_h;
                    $simpanan->id_admin = Auth::id();
                    $simpanan->tanggal = Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d');
                    $simpanan->nominal = $request->nominal;
                    $simpanan->status = $request->status;
                    $simpanan->save();
                }

                return redirect()->back()->with('success', 'Berhasil menyimpan data simpanan!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }



    }

    public function doUpdate(Request $request){
        $data = Simpanan::find($request->idSimpanan);

        if ($data) {
            $data->tanggal = Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d');
            $data->nominal = $request->nominal;
            $data->status = $request->status;
            $data->save();

            $simpananH = Simpanan_H::find($data->id_simpanan_h);
            $simpananH->total_simpanan = Simpanan::where('id_simpanan_h', $data->id_simpanan_h)->sum('nominal');
            $simpananH->save();

            if ($simpananH) {
            $idSimpananH = $simpananH->id_simpanan_h;
            return redirect()->back()->with('success', 'Berhasil menyimpan data simpanan!')->with('idSimpananH', $idSimpananH);
            }
        }
        else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }

    public function doDelete(Request $request){
        $data = Simpanan::find($request->idSimpanan);

        if ($data) {
            $data->delete();

            $simpananH = Simpanan_H::find($data->id_simpanan_h);
            $simpananH->total_simpanan = Simpanan::where('id_simpanan_h', $data->id_simpanan_h)->sum('nominal');
            $simpananH->save();

            if ($simpananH) {
            $idSimpananH = $simpananH->id_simpanan_h;
            return redirect()->back()->with('success', 'Berhasil menghapus data simpanan!')->with('idSimpananH', $idSimpananH);
            }
        }
        else{
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba ulangi lagi');
        }
    }





}
