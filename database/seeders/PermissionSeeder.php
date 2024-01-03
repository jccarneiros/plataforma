<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissão de tipo_ensinos ////////////////////////////////////////////////////////////

        Permission::create([
            'name' => 'Listar Tipos Ensino',
            'slug' => 'tipo_ensinos.index',
        ]);
        Permission::create([
            'name' => 'Criar Tipos Ensino',
            'slug' => 'tipo_ensinos.create',
        ]);
        Permission::create([
            'name' => 'Editar Tipos Ensino',
            'slug' => 'tipo_ensinos.edit',
        ]);
        Permission::create([
            'name' => 'Excluir  Tipos Ensino',
            'slug' => 'tipo_ensinos.delete',
        ]);
        // Permissão de tipo_ensinos ////////////////////////////////////////////////////////////

        // Permissão de series ////////////////////////////////////////////////////////////

        Permission::create([
            'name' => 'Listar Séries',
            'slug' => 'series.index',
        ]);
        Permission::create([
            'name' => 'Criar Séries',
            'slug' => 'series.create',
        ]);
        Permission::create([
            'name' => 'Editar Séries',
            'slug' => 'series.edit',
        ]);
        Permission::create([
            'name' => 'Excluir  Séries',
            'slug' => 'series.delete',
        ]);
        // Permissão de series ////////////////////////////////////////////////////////////

        // Permissão de rooms ////////////////////////////////////////////////////////////

        Permission::create([
            'name' => 'Listar Turmas',
            'slug' => 'rooms.index',
        ]);
        Permission::create([
            'name' => 'Criar Turmas',
            'slug' => 'rooms.create',
        ]);
        Permission::create([
            'name' => 'Editar Turmas',
            'slug' => 'rooms.edit',
        ]);
        Permission::create([
            'name' => 'Excluir  Turmas',
            'slug' => 'rooms.delete',
        ]);
        // Permissão de rooms ////////////////////////////////////////////////////////////

        // Permissão de student ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Listar Alunos',
            'slug' => 'students.index',
        ]);
        Permission::create([
            'name' => 'Criar Alunos',
            'slug' => 'students.create',
        ]);
        Permission::create([
            'name' => 'Editar Alunos',
            'slug' => 'students.edit',
        ]);
        Permission::create([
            'name' => 'Excluir Alunos',
            'slug' => 'students.delete',
        ]);
        // Permissão de student ////////////////////////////////////////////////////////////


        // Permissão de backups ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Listar Backups',
            'slug' => 'backups.index',
        ]);
        Permission::create([
            'name' => 'Criar Backups',
            'slug' => 'backups.create',
        ]);
        Permission::create([
            'name' => 'Baixar Backups',
            'slug' => 'backups.download',
        ]);
        Permission::create([
            'name' => 'Excluir Backups',
            'slug' => 'backups.delete',
        ]);
        // Permissão de backups ////////////////////////////////////////////////////////////


        // Permissão de users ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Listar Usuários',
            'slug' => 'users.index',
        ]);
        Permission::create([
            'name' => 'Editar Usuários',
            'slug' => 'users.edit',
        ]);
        Permission::create([
            'name' => 'Inativar Usuários',
            'slug' => 'users.delete',
        ]);
        Permission::create([
            'name' => 'Listar Inativos',
            'slug' => 'users.onlyTrashed',
        ]);
        Permission::create([
            'name' => 'Ativar Inativos',
            'slug' => 'users.restore',
        ]);
        Permission::create([
            'name' => 'Excluir Inativos',
            'slug' => 'users.forceDelete',
        ]);
        // Permissão de users ////////////////////////////////////////////////////////////

        // Permissão de conselho de escola ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Listar Conselho',
            'slug' => 'conselhos.index',
        ]);
        // Permissão de conselho de escola ////////////////////////////////////////////////////////////

        // Permissão de conselho de escola ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Fazer Conselho',
            'slug' => 'conselhos.index',
        ]);
        // Permissão de conselho de escola ////////////////////////////////////////////////////////////

        // Permissão de gerenciar salas ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Listar Salas',
            'slug' => 'salas.index',
        ]);
        Permission::create([
            'name' => 'Criar Salas',
            'slug' => 'salas.create',
        ]);
        Permission::create([
            'name' => 'Editar Salas',
            'slug' => 'salas.edit',
        ]);
        Permission::create([
            'name' => 'Exluir Salas',
            'slug' => 'salas.delete',
        ]);
        // Permissão de gerenciar salas ////////////////////////////////////////////////////////////


        // Permissão de tutores ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Listar tutores',
            'slug' => 'tutors.index',
        ]);
        Permission::create([
            'name' => 'Criar tutores',
            'slug' => 'tutors.create',
        ]);
        Permission::create([
            'name' => 'Editar tutores',
            'slug' => 'tutors.edit',
        ]);
        Permission::create([
            'name' => 'Excluir tutores',
            'slug' => 'tutors.delete',
        ]);
        // Permissão de tutores ////////////////////////////////////////////////////////////


        // Permissão de tutorados ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Listar tutorados',
            'slug' => 'tutorados.index',
        ]);
        Permission::create([
            'name' => 'Criar tutorados',
            'slug' => 'tutorados.create',
        ]);
        Permission::create([
            'name' => 'Editar tutorados',
            'slug' => 'tutorados.edit',
        ]);
        Permission::create([
            'name' => 'Excluir tutorados',
            'slug' => 'tutorados.delete',
        ]);
        // Permissão de tutorados ////////////////////////////////////////////////////////////

        // Permissão de presidentes de clube ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Listar presidentes',
            'slug' => 'presidents.index',
        ]);
        Permission::create([
            'name' => 'Criar presidentes',
            'slug' => 'presidents.create',
        ]);
        Permission::create([
            'name' => 'Editar presidentes',
            'slug' => 'presidents.edit',
        ]);
        Permission::create([
            'name' => 'Excluir presidentes',
            'slug' => 'presidents.delete',
        ]);
        // Permissão de presidentes de clube ////////////////////////////////////////////////////////////


        // Permissão de clubes ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Listar clubes',
            'slug' => 'clubes.index',
        ]);
        Permission::create([
            'name' => 'Criar clubes',
            'slug' => 'clubes.create',
        ]);
        Permission::create([
            'name' => 'Editar clubes',
            'slug' => 'clubes.edit',
        ]);
        Permission::create([
            'name' => 'Excluir clubes',
            'slug' => 'clubes.delete',
        ]);
        // Permissão de clubes ////////////////////////////////////////////////////////////

        // Permissão de professor de eletiva ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Listar professores',
            'slug' => 'professors.index',
        ]);
        Permission::create([
            'name' => 'Criar professores',
            'slug' => 'professors.create',
        ]);
        Permission::create([
            'name' => 'Editar professores',
            'slug' => 'professors.edit',
        ]);
        Permission::create([
            'name' => 'Excluir professores',
            'slug' => 'professors.delete',
        ]);
        // Permissão de professor de eletiva ////////////////////////////////////////////////////////////


        // Permissão de eletivas ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Listar eletivas',
            'slug' => 'eletivas.index',
        ]);
        Permission::create([
            'name' => 'Criar eletivas',
            'slug' => 'eletivas.create',
        ]);
        Permission::create([
            'name' => 'Editar eletivas',
            'slug' => 'eletivas.edit',
        ]);
        Permission::create([
            'name' => 'Excluir eletivas',
            'slug' => 'eletivas.delete',
        ]);
        // Permissão de eletivas ////////////////////////////////////////////////////////////


        // Permissão de area de conhecimentos ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Listar area de conhecimentos',
            'slug' => 'areaconhecimentos.index',
        ]);
        Permission::create([
            'name' => 'Criar area de conhecimentos',
            'slug' => 'areaconhecimentos.create',
        ]);
        Permission::create([
            'name' => 'Editar area de conhecimentos',
            'slug' => 'areaconhecimentos.edit',
        ]);
        Permission::create([
            'name' => 'Excluir area de conhecimentos',
            'slug' => 'areaconhecimentos.delete',
        ]);
        // Permissão de area de conhecimentos ////////////////////////////////////////////////////////////


        // Permissão de area disciplinas ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Listar disciplinas',
            'slug' => 'disciplinas.index',
        ]);
        Permission::create([
            'name' => 'Criar disciplinas',
            'slug' => 'disciplinas.create',
        ]);
        Permission::create([
            'name' => 'Editar disciplinas',
            'slug' => 'disciplinas.edit',
        ]);
        Permission::create([
            'name' => 'Excluir disciplinas',
            'slug' => 'disciplinas.delete',
        ]);
        // Permissão de area de conhecimentos ////////////////////////////////////////////////////////////


        // Permissão de documentos ////////////////////////////////////////////////////////////
        Permission::create([
            'name' => 'Listar documentos',
            'slug' => 'documents.index',
        ]);
        Permission::create([
            'name' => 'Criar documentos',
            'slug' => 'documents.create',
        ]);
        Permission::create([
            'name' => 'Editar documentos',
            'slug' => 'documents.edit',
        ]);
        Permission::create([
            'name' => 'Excluir documentos',
            'slug' => 'documents.delete',
        ]);
        // Permissão de documentos ////////////////////////////////////////////////////////////

    }
}
