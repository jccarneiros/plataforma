<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DocumentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentType::create([
            'area_conhecimento_id' => 1,
            'name' => 'Plano de Ação',
            'slug' => Str::slug('Plano de Ação', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Agenda
        DocumentType::create([
            'area_conhecimento_id' => 1,
            'name' => 'Agenda',
            'slug' => Str::slug('Agenda', '-'),
            'periodicidade' => 'Mensal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 2,
            'name' => 'Agenda',
            'slug' => Str::slug('Agenda', '-'),
            'periodicidade' => 'Mensal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 3,
            'name' => 'Agenda',
            'slug' => Str::slug('Agenda', '-'),
            'periodicidade' => 'Mensal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 4,
            'name' => 'Agenda',
            'slug' => Str::slug('Agenda', '-'),
            'periodicidade' => 'Mensal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 5,
            'name' => 'Agenda',
            'slug' => Str::slug('Agenda', '-'),
            'periodicidade' => 'Mensal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 6,
            'name' => 'Agenda',
            'slug' => Str::slug('Agenda', '-'),
            'periodicidade' => 'Mensal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // PROGRAMA DE AÇÃO
        DocumentType::create([
            'area_conhecimento_id' => 1,
            'name' => 'Programa de ação',
            'slug' => Str::slug('Programa de ação', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 2,
            'name' => 'Programa de ação',
            'slug' => Str::slug('Programa de ação', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 3,
            'name' => 'Programa de ação',
            'slug' => Str::slug('Programa de ação', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 4,
            'name' => 'Programa de ação',
            'slug' => Str::slug('Programa de ação', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 5,
            'name' => 'Programa de ação',
            'slug' => Str::slug('Programa de ação', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 6,
            'name' => 'Programa de ação',
            'slug' => Str::slug('Programa de ação', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // PROGRAMA DE AÇÃO

        // PLANO DE ENSINO
        DocumentType::create([
            'area_conhecimento_id' => 4,
            'name' => 'Plano de Ensino',
            'slug' => Str::slug('Plano de Ensino', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 5,
            'name' => 'Plano de Ensino',
            'slug' => Str::slug('Plano de Ensino', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 6,
            'name' => 'Plano de Ensino',
            'slug' => Str::slug('Plano de Ensino', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // PLANO DE ENSINO

        // PIAF
        DocumentType::create([
            'area_conhecimento_id' => 1,
            'name' => 'PIAF',
            'slug' => Str::slug('PIAF', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 2,
            'name' => 'PIAF',
            'slug' => Str::slug('PIAF', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 3,
            'name' => 'PIAF',
            'slug' => Str::slug('PIAF', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 4,
            'name' => 'PIAF',
            'slug' => Str::slug('PIAF', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 5,
            'name' => 'PIAF',
            'slug' => Str::slug('PIAF', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 6,
            'name' => 'PIAF',
            'slug' => Str::slug('PIAF', '-'),
            'periodicidade' => 'Anual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // PIAF

        // GUIA DE APRENDIZAGEM
        DocumentType::create([
            'area_conhecimento_id' => 4,
            'name' => 'Guia de Aprendizagem',
            'slug' => Str::slug('Guia de Aprendizagem', '-'),
            'periodicidade' => 'Semestral',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 5,
            'name' => 'Guia de Aprendizagem',
            'slug' => Str::slug('Guia de Aprendizagem', '-'),
            'periodicidade' => 'Semestral',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 6,
            'name' => 'Guia de Aprendizagem',
            'slug' => Str::slug('Guia de Aprendizagem', '-'),
            'periodicidade' => 'Semestral',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 7,
            'name' => 'Guia de Aprendizagem',
            'slug' => Str::slug('Guia de Aprendizagem', '-'),
            'periodicidade' => 'Semestral',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // GUIA DE APRENDIZAGEM

        // PLANO DE NIVELAMENTO
        DocumentType::create([
            'area_conhecimento_id' => 4,
            'name' => 'Plano de Nivelamento',
            'slug' => Str::slug('Plano de Nivelamento', '-'),
            'periodicidade' => 'Quinzenal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 5,
            'name' => 'Plano de Nivelamento',
            'slug' => Str::slug('Plano de Nivelamento', '-'),
            'periodicidade' => 'Quinzenal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 6,
            'name' => 'Plano de Nivelamento',
            'slug' => Str::slug('Plano de Nivelamento', '-'),
            'periodicidade' => 'Quinzenal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // PLANO DE NIVELAMENTO

        // PLANO DE AULA
        DocumentType::create([
            'area_conhecimento_id' => 4,
            'name' => 'Plano de Aula',
            'slug' => Str::slug('Plano de Aula', '-'),
            'periodicidade' => 'Quinzenal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 5,
            'name' => 'Plano de Aula',
            'slug' => Str::slug('Plano de Aula', '-'),
            'periodicidade' => 'Quinzenal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 6,
            'name' => 'Plano de Aula',
            'slug' => Str::slug('Plano de Aula', '-'),
            'periodicidade' => 'Quinzenal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 7,
            'name' => 'Plano de Aula',
            'slug' => Str::slug('Plano de Aula', '-'),
            'periodicidade' => 'Quinzenal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DocumentType::create([
            'area_conhecimento_id' => 8,
            'name' => 'Plano de Aula',
            'slug' => Str::slug('Plano de Aula', '-'),
            'periodicidade' => 'Quinzenal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // PLANO DE AULA

        // PLANO DE ELETIVA COMPLETO
        DocumentType::create([
            'area_conhecimento_id' => 8,
            'name' => 'Plano de Eletiva Completo',
            'slug' => Str::slug('Plano de Eletiva Completo', '-'),
            'periodicidade' => 'Semestral',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // PLANO DE ELETIVA COMPLETO

        // PLANO DE ORIENTAÇÕES DE ESTUDOS
        DocumentType::create([
            'area_conhecimento_id' => 9,
            'name' => 'Plano de Orientação de Estudo',
            'slug' => Str::slug('Plano de Orientação de Estudo', '-'),
            'periodicidade' => 'Quinzenal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // PLANO DE ORIENTAÇÕES DE ESTUDOS

        // PLANO DE PRÁTICAS EXPERIMENTAIS
        DocumentType::create([
            'area_conhecimento_id' => 9,
            'name' => 'Plano de Prática Experimental',
            'slug' => Str::slug('Plano de Prática Experimental', '-'),
            'periodicidade' => 'Quinzenal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // PLANO DE PRÁTICAS EXPERIMENTAIS

        // PLANO DE PROJETO DE VIDA
        DocumentType::create([
            'area_conhecimento_id' => 9,
            'name' => 'Plano de Projeto de Vida',
            'slug' => Str::slug('Plano de Projeto de Vida', '-'),
            'periodicidade' => 'Quinzenal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // PLANO DE PROJETO DE VIDA

        // PLANO DE PROTAGONISMO JUVENIL
        DocumentType::create([
            'area_conhecimento_id' => 9,
            'name' => 'Plano de Protagonismo Juvenil',
            'slug' => Str::slug('Plano de Protagonismo Juvenil', '-'),
            'periodicidade' => 'Quinzenal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // PLANO DE PROTAGONISMO JUVENIL

        // PLANO DE TECNOLOGIA
        DocumentType::create([
            'area_conhecimento_id' => 9,
            'name' => 'Plano de Tecnologia',
            'slug' => Str::slug('Plano de Tecnologia', '-'),
            'periodicidade' => 'Quinzenal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // PLANO DE TECNOLOGIA
    }
}
