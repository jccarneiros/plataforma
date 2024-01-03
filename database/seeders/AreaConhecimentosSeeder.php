<?php

namespace Database\Seeders;

use App\Models\AreaConhecimento;
use Illuminate\Database\Seeder;

class AreaConhecimentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AreaConhecimento::create([
            'id' => 1,
            'name' => 'Gestão',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        AreaConhecimento::create([
            'id' => 2,
            'name' => 'Secretaria',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        AreaConhecimento::create([
            'id' => 3,
            'name' => 'Coordenação',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        AreaConhecimento::create([
            'id' => 4,
            'name' => 'Ciências Humanas',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        AreaConhecimento::create([
            'id' => 5,
            'name' => 'Linguagens e Códigos',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        AreaConhecimento::create([
            'id' => 6,
            'name' => 'Matemática e Ciências da Natureza',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        AreaConhecimento::create([
            'id' => 7,
            'name' => 'Itinerário Formativo',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        AreaConhecimento::create([
            'id' => 8,
            'name' => 'Eletivas',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        AreaConhecimento::create([
            'id' => 9,
            'name' => 'Diversificadas',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
