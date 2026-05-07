<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $petugas = User::create([
            'name' => 'Petugas Reskrim',
            'email' => 'petugas@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'petugas',
            'no_telepon' => '081298765432',
            'alamat' => 'Polres Metro Jakarta',
            'no_identitas' => '3175020101900001',
            'nip' => '197501012005011001',
            'pangkat' => 'Iptu',
            'jabatan' => 'Kanit Reskrim',
        ]);

        $pelapor = User::create([
            'name' => 'Masyarakat',
            'email' => 'pelapor@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'pelapor',
            'no_telepon' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta',
            'no_identitas' => '3175010101900001',
        ]);
    }
}
