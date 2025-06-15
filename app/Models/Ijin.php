<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ijin extends Model
{
    /** @use HasFactory<\Database\Factories\IjinFactory> */
    use HasFactory;
    protected $fillable = [
        'santri_id',
        'alasan',
        'tanggal_jemput',
        'tanggal_kembali',
        'tanggal_telat',
        'status', // 'pending', 'approved', 'rejected'
        'lampiran',
        'catatan',
    ];
    protected $casts = [
        'tanggal_jemput' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_telat' => 'date',
    ];
    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }
    public function getStatusAttribute($value)
    {
        return match ($value) {
            'pending' => 'Menunggu Persetujuan',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'picked_up' => 'Sudah Dijemput',
            'returned' => 'Sudah Kembali',
            default => 'Tidak Diketahui',
        };
    }
}
