<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DentalProfessional;

class ProfessionalSeeder extends Seeder
{
    public function run()
    {
        $professionals = [
            [
                'first_name' => 'Juan',
                'last_name' => 'Pérez',
                'rut' => '12345678-9',
                'email' => 'juan.perez@dentalclinic.cl',
                'phone' => '+56912121212',
                'specialty' => 'Odontólogo General',
                'license_number' => 'ODO-001',
                'is_available' => true,
            ],
            [
                'first_name' => 'Laura',
                'last_name' => 'Martínez',
                'rut' => '98765432-1',
                'email' => 'laura.martinez@dentalclinic.cl',
                'phone' => '+56913131313',
                'specialty' => 'Ortodoncista',
                'license_number' => 'ORT-001',
                'is_available' => true,
            ],
            [
                'first_name' => 'Roberto',
                'last_name' => 'Soto',
                'rut' => '11222333-4',
                'email' => 'roberto.soto@dentalclinic.cl',
                'phone' => '+56914141414',
                'specialty' => 'Endodoncista',
                'license_number' => 'END-001',
                'is_available' => true,
            ],
        ];

        foreach ($professionals as $professional) {
            DentalProfessional::create($professional);
        }
    }
}