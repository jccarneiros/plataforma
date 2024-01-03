<?php

namespace Database\Seeders;

use App\Enums\SupportTypeEnsino;
use App\Models\Serie;
use Illuminate\Database\Seeder;

class SerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Serie::create([
            'id' => 1,
            'code' => uniqid('', false),
            'tipo_ensino_id' => 1,
            'name' => '6º Ano',
            'type' => SupportTypeEnsino::RE,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Serie::create([
            'id' => 2,
            'code' => uniqid('', false),
            'tipo_ensino_id' => 1,
            'name' => '7º Ano',
            'type' => SupportTypeEnsino::RE,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Serie::create([
            'id' => 3,
            'code' => uniqid('', false),
            'tipo_ensino_id' => 1,
            'name' => '8º Ano',
            'type' => SupportTypeEnsino::RE,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Serie::create([
            'id' => 4,
            'code' => uniqid('', false),
            'tipo_ensino_id' => 1,
            'name' => '9º Ano',
            'type' => SupportTypeEnsino::RE,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Serie::create([
            'id' => 5,
            'code' => uniqid('', false),
            'tipo_ensino_id' => 2,
            'name' => '1ª Série',
            'type' => SupportTypeEnsino::RE,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Serie::create([
            'id' => 6,
            'code' => uniqid('', false),
            'tipo_ensino_id' => 2,
            'name' => '2ª Série',
            'type' => SupportTypeEnsino::RE,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Serie::create([
            'id' => 7,
            'code' => uniqid('', false),
            'tipo_ensino_id' => 2,
            'name' => '3ª Série',
            'type' => SupportTypeEnsino::RE,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Serie::create([
            'id' => 8,
            'code' => uniqid('', false),
            'tipo_ensino_id' => 3,
            'name' => 'Eletiva',
            'type' => SupportTypeEnsino::EL,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Serie::create([
            'id' => 9,
            'code' => uniqid('', false),
            'tipo_ensino_id' => 4,
            'name' => '2ª Série',
            'type' => SupportTypeEnsino::IT,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Serie::create([
            'id' => 10,
            'code' => uniqid('', false),
            'tipo_ensino_id' => 4,
            'name' => '3ª Série',
            'type' => SupportTypeEnsino::IT,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
