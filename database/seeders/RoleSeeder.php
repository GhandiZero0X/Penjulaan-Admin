<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Isi dengan data yang sesuai untuk tabel 'role'
        Role::create([
            'nama_role' => 'Admin',
        ]);

        Role::create([
            'nama_role' => 'User',
        ]);

    }
}
