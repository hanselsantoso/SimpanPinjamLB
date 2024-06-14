<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\simpanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index(Request $request) {
        $user = User::where('status',1)->where('role',1)->get();
        return view('Admin.dashboard',with([
            'user' => $user
    ]));
    }

    public function detailUser(Request $request, $id){
        $user = User::find($id);
        return view('Admin.detailUser',with([
            'user'=> $user,
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
}
