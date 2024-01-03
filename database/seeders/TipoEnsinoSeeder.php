<?php

namespace Database\Seeders;

use App\Models\TipoEnsino;
use Illuminate\Database\Seeder;

class TipoEnsinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoEnsino::create([
            'id' => 1,
            'code' => '63a61933f1ab7',
            'name' => 'Ensino Fundamental',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        TipoEnsino::create([
            'id' => 2,
            'code' => '63a61933f31a5',
            'name' => 'Ensino Médio',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        TipoEnsino::create([
            'id' => 3,
            'code' => '63a6193487b39',
            'name' => 'Eletiva',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        TipoEnsino::create([
            'id' => 4,
            'code' => '63a61937593e5',
            'name' => 'Itinerário Formativo',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
