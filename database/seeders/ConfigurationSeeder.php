<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configurations = [
            'app_name' => 'ALLCONECTADO',
            'app_email' => 'allconectado@gmail.com',
            'app_author' => 'Allconectado Sistema WEB',
            'app_cep' => 'cep',
            'app_endereco' => 'Endereço',
            'app_numero' => 'Número',
            'app_bairro' => 'Bairro',
            'app_cidade' => 'Cidade',
            'app_estado' => 'Estado',
            'app_site' => 'Link do Blog',
            'app_phone' => '(11)0000-0000)',
            'app_whatsapp' => '(11)90000-0000)',
            'app_debug' => 1,
            'app_env' => 'local',
            'app_url' => 'http://127.0.0.1:8000',
            'app_description' => 'Sistema de gerenciamento de usuários',
            'session_lifetime' => 120,
            'session_expire_on_close' => 1,
            'session_encrypt' => 1,
            'app_enable_register' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        DB::table('configurations')->insert($configurations);
    }
}
