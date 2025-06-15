<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mustahiq extends Model
{
    /** @use HasFactory<\Database\Factories\MustahiqFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama',
        'kelas',
        'ttd_url'
    ];

    public function santris()
    {
        return $this->hasMany(Santri::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
