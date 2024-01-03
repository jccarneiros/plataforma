<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\SupportTypeEnsino;
use App\Models\Disciplina;
use App\Models\Serie;
use Illuminate\Database\Seeder;

/**
 *DisciplinaSeeder
 */
class DisciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Fundamental Regular - Linguagens
        Disciplina::create([
            'area_conhecimento_id' => 5,
            'name' => 'Artes',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Disciplina::create([
            'area_conhecimento_id' => 5,
            'name' => 'Educação Física',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Disciplina::create([
            'area_conhecimento_id' => 5,
            'name' => 'Português',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Disciplina::create([
            'area_conhecimento_id' => 5,
            'name' => 'Inglês',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //Fundamental Regular - Linguagens

        //Fundamental Regular - Matemática e Ciências da Natureza

        //Fundamental Regular - Matemática e Ciências da Natureza

        //Médio Regular - Humanas
        Disciplina::create([
            'area_conhecimento_id' => 4,
            'name' => 'Filosofia',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Disciplina::create([
            'area_conhecimento_id' => 4,
            'name' => 'Geografia',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Disciplina::create([
            'area_conhecimento_id' => 4,
            'name' => 'História',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Disciplina::create([
            'area_conhecimento_id' => 4,
            'name' => 'Sociologia',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //Médio Regular - Humanas

        //Médio Regular - Matemática e Ciências da Natureza
        Disciplina::create([
            'area_conhecimento_id' => 6,
            'name' => 'Ciências',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Disciplina::create([
            'area_conhecimento_id' => 6,
            'name' => 'Matemática',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Disciplina::create([
            'area_conhecimento_id' => 6,
            'name' => 'Biologia',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Disciplina::create([
            'area_conhecimento_id' => 6,
            'name' => 'Física',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Disciplina::create([
            'area_conhecimento_id' => 6,
            'name' => 'Química',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //Médio Regular - Matemática e Ciências da Natureza

        //Médio Regular - Diversificadas

        Disciplina::create([
            'area_conhecimento_id' => 9,
            'name' => 'Orientação de Estudos',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Disciplina::create([
            'area_conhecimento_id' => 9,
            'name' => 'Práticas Experimentais',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Disciplina::create([
            'area_conhecimento_id' => 9,
            'name' => 'Projeto de Vida',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Disciplina::create([
            'area_conhecimento_id' => 9,
            'name' => 'Protagonismo Juvenil',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Disciplina::create([
            'area_conhecimento_id' => 9,
            'name' => 'Tecnologia',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //Médio Regular - Diversificadas

    }
}
