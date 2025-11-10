<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Treatment;

class TreatmentSeeder extends Seeder
{
    public function run()
    {
        $treatments = [
            [
                'name' => 'Limpieza dental',
                'description' => 'Limpieza profesional completa',
                'duration_minutes' => 30,
                'price' => 25000,
                'category' => 'Preventivo',
            ],
            [
                'name' => 'Blanqueamiento',
                'description' => 'Blanqueamiento dental profesional',
                'duration_minutes' => 60,
                'price' => 80000,
                'category' => 'Estético',
            ],
            [
                'name' => 'Extracción',
                'description' => 'Extracción dental simple',
                'duration_minutes' => 45,
                'price' => 35000,
                'category' => 'Cirugía',
                'requires_anesthesia' => true,
            ],
            [
                'name' => 'Ortodoncia',
                'description' => 'Consulta y control de ortodoncia',
                'duration_minutes' => 30,
                'price' => 120000,
                'category' => 'Ortodoncia',
            ],
            [
                'name' => 'Endodoncia',
                'description' => 'Tratamiento de conducto',
                'duration_minutes' => 90,
                'price' => 150000,
                'category' => 'Endodoncia',
                'requires_anesthesia' => true,
            ],
        ];

        foreach ($treatments as $treatment) {
            Treatment::create($treatment);
        }
    }
}