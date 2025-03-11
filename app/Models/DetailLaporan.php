<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailLaporan extends Model
{
    protected $table = 'detail_laporan';

    protected $fillable = [
        'nmr_laporan',
        'waktu_dihubungi',
        'ruangan_unit',
        'petugas_pelapor',
        'jenis_kerusakan',
        'permasalahan',
        'tindakan',
        'waktu_selesai',
        'kriteria',
        'waktu_pengerjaan',
        'numerator',
        'denominator',
        'id_petugas_it',
        'nomor_pelapor',
        'status_laporan'
    ];

    protected $casts = [
        'waktu_dihubungi' => 'datetime',
        'waktu_selesai' => 'datetime',
        'waktu_pengerjaan' => 'datetime',
    ];

    public function petugasIT(): BelongsTo
    {
        return $this->belongsTo(PetugasIT::class, 'id_petugas_it', 'id');
    }
}