<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('app_name');
            $table->string('app_email');
            $table->string('app_cep');
            $table->string('app_endereco');
            $table->string('app_numero');
            $table->string('app_bairro');
            $table->string('app_cidade');
            $table->string('app_estado');
            $table->string('app_site')->nullable();
            $table->string('app_phone');
            $table->string('app_whatsapp')->nullable();
            $table->string('app_author');
            $table->string('app_url');
            $table->string('app_debug');
            $table->string('app_env');
            $table->string('app_description');
            $table->string('session_lifetime');
            $table->string('session_expire_on_close');
            $table->string('session_encrypt');
            $table->boolean('app_enable_register')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
