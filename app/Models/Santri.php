<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    /** @use HasFactory<\Database\Factories\SantriFactory> */
    use HasFactory;
    protected $fillable = [
        'mustahiq_id',
        'wali_id',
        'nama',
        'kelas',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nis',
        'alamat',
    ];
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function mustahiq()
    {
        return $this->belongsTo(Mustahiq::class);
    }

    public function wali()
    {
        return $this->belongsTo(Wali::class);
    }

    public function ijins()
    {
        return $this->hasMany(Ijin::class);
    }
    public function getJenisKelaminAttribute($value)
    {
        return $value === 'L' ? 'Laki-laki' : 'Perempuan';
    }
}
