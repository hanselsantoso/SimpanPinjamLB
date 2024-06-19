<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman_D;
use App\Models\Pinjaman_H;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pinjamanController extends Controller
{
    public function index($id)
    {
        $pinjaman = Pinjaman_H::findOrFail($id);
        return view('admin.detailUserPinjaman', compact('pinjaman'));
    }
    function doCreatePinjaman(Request $request) {
        $pinjamanH = new Pinjaman_H();
        $pinjamanH->tanggal_pinjaman = Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d');
        $pinjamanH->jatuh_tempo = Carbon::createFromFormat('d-m-Y', $request->tgl)->addMonths($request->totalCicilan)->format('Y-m-d');
        $pinjamanH->id_user = $request->idUser;
        $pinjamanH->total_pinjaman = $request->nominal;
        $pinjamanH->total_cicilan = $request->totalCicilan;
        $pinjamanH->save();

        if ($pinjamanH) {
            $remainingPrincipal = $request->nominal;
            $monthlyInstallment = $request->nominal / $request->totalCicilan;
            $interestRate = $request->bungaPinjaman / 100;

            for ($i = 0; $i < $request->totalCicilan; $i++) {
                $interest = $remainingPrincipal * $interestRate / 12; // Assuming monthly interest rate
                $principal = $monthlyInstallment;
                $totalMonthlyPayment = $principal + $interest;

                $pinjamanD = new Pinjaman_D();
                $pinjamanD->id_pinjaman_h = $pinjamanH->id_pinjaman_h;
                $pinjamanD->id_admin = Auth::id();
                $pinjamanD->tanggal = Carbon::createFromFormat('d-m-Y', $request->tgl)->addMonths($i+1)->format('Y-m-d');
                $pinjamanD->pinjaman = $totalMonthlyPayment;
                $pinjamanD->status_pinjaman_d = 0; // Assuming initial status
                $pinjamanD->save();

                // Reduce remaining principal by the amount of principal paid
                $remainingPrincipal -= $principal;
            }
        }

        return redirect()->route('detailUser', ['id' => $pinjamanH->id_user])->with('success', 'Berhasil menyimpan data pinjaman!');
    }

    public function bayarPinjaman(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:0',
        ]);

        // Ambil detail pinjaman berdasarkan ID
        $pinjamanD = Pinjaman_D::findOrFail($id);

        // Ambil pinjaman header terkait
        $pinjamanH = $pinjamanD->pinjamanH;

        // Nominal pembayaran
        $payment = $request->nominal;

        // Proses pembayaran
        if ($payment >= $pinjamanD->pinjaman) {
            // Pembayaran cukup untuk melunasi cicilan ini
            // $payment -= $pinjamanD->pinjaman;
            // $pinjamanD->pinjaman = 0;
            $pinjamanD->status_pinjaman_d = 1;
        } else {
            // Pembayaran sebagian cicilan ini
            $pinjamanD->pinjaman -= $payment;
            $payment = 0;
        }

        $pinjamanD->save();

        // Perbarui total cicilan di header
        $pinjamanH->total_cicilan -= 1;

        // Perbarui status pinjaman header jika semua cicilan lunas
        if ($pinjamanH->pinjamans()->where('status_pinjaman_d', 'Belum Lunas')->count() == 0) {
            $pinjamanH->status_pinjaman_h = 1;
            $pinjamanH->total_cicilan = 0;
        }

        $pinjamanH->save();

        return redirect()->route('pinjaman', ['id' => $pinjamanH->id_pinjaman_h])->with('success', 'Pembayaran pinjaman berhasil.');
    }

    public function batalkanPembayaran(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:0',
        ]);

        // Ambil detail pinjaman berdasarkan ID
        $pinjamanD = Pinjaman_D::findOrFail($id);

        // Ambil pinjaman header terkait
        $pinjamanH = $pinjamanD->pinjamanH;

        // Nominal pembatalan
        $cancellationAmount = $request->nominal;

        // Proses pembatalan pembayaran
        if ($pinjamanD->status_pinjaman_d == 1) {
            // Pembatalan penuh, kembalikan nominal penuh ke pinjaman
            // $pinjamanD->pinjaman = $cancellationAmount;
            $pinjamanD->status_pinjaman_d = 0;
        } else {
            // Pembatalan sebagian cicilan ini
            $pinjamanD->pinjaman += $cancellationAmount;
        }

        $pinjamanD->save();

        // Perbarui total cicilan di header
        $pinjamanH->total_cicilan += 1;

        // Perbarui status pinjaman header jika ada cicilan yang belum lunas
        $pinjamanH->status_pinjaman_h = 0;

        $pinjamanH->save();

        return redirect()->route('pinjaman', ['id' => $pinjamanH->id_pinjaman_h])->with('success', 'Pembatalan pembayaran pinjaman berhasil.');
    }


    public function hapusPinjaman($id)
    {
        // Ambil pinjaman header berdasarkan ID
        $pinjamanH = Pinjaman_H::findOrFail($id);

        // Hapus semua detail pinjaman (pinjaman_d)
        $pinjamanH->pinjamans()->delete();

        // Hapus header pinjaman (pinjaman_h)
        $pinjamanH->delete();

        return redirect()->back()->with('success', 'Pinjaman dan detailnya berhasil dihapus.');
    }
}
