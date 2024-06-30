<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\simpanan;
use App\Models\Simpanan_H;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index(Request $request) {
        $user = User::where('role',1)->get();
        return view('Admin.dashboard',with([
            'user' => $user
    ]));
    }

    public function detailUser(Request $request, $id){
        $user = User::find($id);
        $info = $user->getInfo();
        // dd($info);
        return view('Admin.detailUser',with([
            'user'=> $user,
            'info'=> $info,
        ]));
    }


    public function calculateMonthlyInterest()
    {
        // Ambil total simpanan untuk setiap pengguna yang statusnya aktif
        $userDeposits = Simpanan::select('id_user', DB::raw('SUM(nominal) as total_nominal'))
                                // ->where('status', 'aktif')
                                ->groupBy('id_user')
                                ->get();

        foreach ($userDeposits as $deposit) {
            // Cari aturan yang sesuai dengan total simpanan pengguna
            $aturan = Aturan::where('minimal_tabungan', '<=', $deposit->total_nominal)
                            ->where('maximal_tabungan', '>=', $deposit->total_nominal)
                            ->where('status', 1)
                            ->first();

            if ($aturan && $aturan->bunga) {
                $interestRate = $aturan->bunga->bunga;
                $interest = $deposit->total_nominal * ($interestRate / 100);

                // Tambahkan bunga sebagai row baru di tabel simpanan
                Simpanan::create([
                    'id_user' => $deposit->id_user,
                    'id_admin' => 1,
                    'tanggal' => Carbon::now(),
                    'nominal' => $interest,
                    'status' => '2'
                ]);
            }
        }
    }

    public function hitungDanSimpanBunga()
    {
        // Ambil semua user yang memiliki simpanan
        $users = User::has('simpanan')->get();

        foreach ($users as $user) {
            // Hitung total bunga simpanan user
            $totalBunga = $user->countTotalBungaSimpanan();

            // Buat entri baru di tabel Simpanan
            $simpanan = new Simpanan();
            $simpanan->id_admin = Auth::id();
            $simpanan->id_simpanan_h = $user->simpanan->id_simpanan_h;
            $simpanan->tanggal = Carbon::now()->format('Y-m-d');
            $simpanan->nominal = $totalBunga;
            $simpanan->status = 2; // Atur status sesuai kebutuhan
            $simpanan->save();

            // Update atau buat entri baru di tabel Simpanan_H
            $simpananH = $user->simpanan; // Ambil data Simpanan_H dari relasi
            if (!$simpananH) {
                $simpananH = new Simpanan_H();
                $simpananH->id_user = $user->id;
            }
            $simpananH->total_simpanan += $totalBunga; // Tambahkan total bunga ke total simpanan
            $simpananH->save();
        }

        return redirect()->back()->with('success', 'Perhitungan dan penyimpanan bunga berhasil.');
    }


    public function tambahNasabah(Request $request)
    {
        // Create a new User with role 1
        $user = new User();
        $user->name = $request->input('name');
        $user->nik = $request->input('nik');
        $user->tempat_lahir = $request->input('tempatLahir');
        $user->tanggal_lahir = $request->input('tglLahir');
        $user->telp = $request->input('telp');
        $user->email = $request->input('email');
        $user->password = bcrypt('abcde12345');
        $user->status = 1;
        $user->role = 1;
        $user->save();

        return redirect()->back()->with('success', 'Nasabah berhasil ditambahkan.');
    }

    public function ubahNasabah(Request $request)
    {   
        // Update user data
        $user = User::find($request->input('idUser'));
        $user->name = $request->input('name');
        $user->nik = $request->input('nik');
        $user->alamat = $request->input('alamat');
        $user->tempat_lahir = $request->input('tempatLahir');
        $user->tanggal_lahir = Carbon::createFromFormat('d-m-Y', $request->tglLahirUpdate)->format('Y-m-d');
        $user->telp = $request->input('telp');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->back()->with('success', 'Nasabah berhasil diperbarui.');
    }

    public function suspendUser(Request $request, $id)
    {
        // Suspend user
        $user = User::find($id);
        $user->status = 0;
        $user->save();

        return redirect()->back()->with('success', 'Nasabah berhasil di-suspend.');
    }

    public function aktifUser(Request $request, $id)
    {
        // Activate user
        $user = User::find($id);
        $user->status = 1;
        $user->save();

        return redirect()->back()->with('success', 'Nasabah berhasil di-aktifkan.');
    }
}
