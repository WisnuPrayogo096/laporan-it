<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PetugasIT extends Model
{
    protected $table = 'petugas_it';

    protected $fillable = [
        'id',
        'nomor_petugas',
        'nama_petugas_it',
        'jml_selesai',
        'jml_ditolak',
        'jml_diproses'
    ];

    public function detailLaporan(): HasMany
    {
        return $this->hasMany(DetailLaporan::class, 'id_petugas_it', 'nama_petugas_it');
    }
}