<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario administrador
        User::create([
            //'name' => 'Admin Dental Clinic',
            'username' => 'admin',
            'email' => 'admin@dentalclinic.cl',
            'password' => Hash::make('admin123'),
            'role' => User::ROLE_ADMIN,
        ]);

        // Ejecutar otros seeders
        $this->call([
            TreatmentSeeder::class,
            ProfessionalSeeder::class,
        ]);
    }
}