<?php

namespace App\Filament\Resources\WaliResource\Pages;

use App\Filament\Resources\WaliResource;
use App\Models\Wali;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateWali extends CreateRecord
{
    protected static string $resource = WaliResource::class;

    protected function handleRecordCreation(array $data) : Wali
    {
        // Buat user terlebih dahulu
        $user = User::create([
            'name' => $data['nama'],
            'no_hp' => $data['no_hp'],
            'password' => Hash::make('password'), // Default password, ubah kalau perlu
        ]);

        // Tambahkan user_id ke data wali
        $data['user_id'] = $user->id;

        // Simpan wali dengan user_id
        return Wali::create($data);
    }
}
