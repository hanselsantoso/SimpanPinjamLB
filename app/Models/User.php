<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'nik',
        'telp',
        'password',
        'status',
        'total_simpanan',
        'total_pinjaman',
        'minimal_bayar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin(){
        return $this->role === 1;
    }

    public function isUser(){
        return $this->role === 2;
    }

    public function simpanan()
    {
        return $this->hasOne(Simpanan_H::class, 'id_user');
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman_H::class, 'id_user');
    }

    public function countTotalPinjaman()
    {
        return $this->pinjaman->where('status_pinjaman_h', 1)->sum('total_pinjaman');
    }

    public function countAllPinjamanTerbayar()
    {
        return $this->pinjaman->where('status_pinjaman_h', 1)->sum(function ($pinjaman_h) {
            return $pinjaman_h->pinjamans->sum('pinjaman') ? $pinjaman_h->pinjamans->sum('pinjaman') : 0;
        });
    }

    public function getInfo()
    {
        $totalSimpanan = $this->simpanan->total_simpanan ?? 0;

        // Cari aturan yang sesuai dengan total simpanan pengguna
        $aturan = Aturan::where('minimal_tabungan', '<=', $totalSimpanan)
                        ->where('maximal_tabungan', '>=', $totalSimpanan)
                        ->where('status', 1)
                        ->first();

        if (!$aturan || !$aturan->bunga) {

            return null;
        }

        $interestRate = $aturan->bunga->bunga;
        $jumlahBunga = $totalSimpanan * ($interestRate / 100);

        $aturanPinjam = $aturan->pinjaman->pinjaman;
        $jumlahPinjaman = $totalSimpanan * ($aturanPinjam / 100);


        $bungaPinjaman = $aturan->bungaPinjaman->bunga_pinjaman;

        $totalCicilan = $aturan->cicilan->cicilan;
        return [
            'totalSimpanan' => $totalSimpanan,
            'interestRate' => $interestRate,
            'jumlahBunga' => $jumlahBunga,
            'aturanPinjam' => $aturanPinjam,
            'bungaPinjaman' => $bungaPinjaman,
            'jumlahPinjaman' => $jumlahPinjaman,
            'totalCicilan' => $totalCicilan,
        ];
    }

    // make countTotalSimpanan method

    public function countTotalBungaPinjaman()
    {
        $totalBunga = 0;

        // Ambil total simpanan user
        $totalSimpanan = $this->simpanan()->whereHas('user', function ($query) {
            $query->where('role', 1);
        })->sum('total_simpanan');

        // Cari aturan yang sesuai dengan total simpanan pengguna
        $aturan = Aturan::where('minimal_tabungan', '<=', $totalSimpanan)
                        ->where('maximal_tabungan', '>=', $totalSimpanan)
                        ->where('status', 1)
                        ->first();

        $totalPinjaman = $this->pinjaman()->whereHas('user', function ($query) {
            $query->where('role', 1);
        })->sum('total_pinjaman');
        if ($aturan && $aturan->bunga) {
            // Hitung bunga berdasarkan aturan
            $bunga = $aturan->bungaPinjaman->bunga_pinjaman;
            $totalBunga = $totalPinjaman * ($bunga / 100);
        }

        return $totalBunga;
    }

    public function countTotalBungaSimpanan()
    {
        $totalBunga = 0;

        // Ambil total simpanan user
        $totalSimpanan = $this->simpanan->total_simpanan;

        // Cari aturan yang sesuai dengan total simpanan pengguna
        $aturan = Aturan::where('minimal_tabungan', '<=', $totalSimpanan)
                        ->where('maximal_tabungan', '>=', $totalSimpanan)
                        ->where('status', 1)
                        ->first();

        if ($aturan && $aturan->bunga) {
            // Hitung bunga berdasarkan aturan
            $bunga = $aturan->bunga->bunga;
            $totalBunga = $totalSimpanan * ($bunga / 100);
        }

        return $totalBunga;
    }

    public function sumAllPinjamanAktif()
    {
        $this->pinjaman->sum(function($pinjaman) {
            return $pinjaman->total_pinjaman * ($pinjaman->bunga_pinjaman / 100);
        });
    }

    public function sumAllBungaSimpanan()
    {
        return $this->simpanan->simpanans->where('status', 2)->sum('nominal') ?? 0;
    }
}
