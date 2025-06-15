<?php

namespace App\Filament\Resources\MustahiqResource\Pages;

use App\Filament\Resources\MustahiqResource;
use App\Models\Mustahiq;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateMustahiq extends CreateRecord
{
    protected static string $resource = MustahiqResource::class;

    protected function handleRecordCreation(array $data): Mustahiq
    {
        // Buat user terlebih dahulu
        $user = User::create([
            'name' => $data['nama'],
            'no_hp' => $data['no_hp'],
            'password' => Hash::make('password'), // Default password, ubah kalau perlu
        ]);

        // Tambahkan user_id ke data mustahiq
        $data['user_id'] = $user->id;

        // Simpan mustahiq dengan user_id
        return Mustahiq::create($data);
    }
}
