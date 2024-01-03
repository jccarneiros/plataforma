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
        Schema::create('professors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sala_id')->unsigned()->nullable();
            $table->foreign('sala_id')->references('id')->on('salas')
                ->onDelete('CASCADE');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('CASCADE');
            $table->string('code')->unique();
            $table->string('name_eletiva')->unique();
            $table->boolean('status_eletiva')->default(0);
            $table->integer('limit_eletiva_students');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professors');
    }
};
