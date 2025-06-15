<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    /** @use HasFactory<\Database\Factories\WaliFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama',
        'alamat',
        'image_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function santris()
    {
        return $this->hasMany(Santri::class);
    }

    protected $casts = [
        'image_url' => 'json',
    ];
}
