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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number_ra');
            $table->char('number_ra_digit', 2);
            $table->char('uf_ra', 3);
            $table->date('date_birth');
            $table->string('email_microsoft');
            $table->string('email_google');
            $table->string('student_situation');
            $table->string('avatar')->nullable();
            $table->text('qrcode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
