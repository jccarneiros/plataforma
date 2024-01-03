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
        Schema::create('disciplines', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->unsignedBigInteger('tipo_ensino_id')->unsigned()->index();
            $table->foreign('tipo_ensino_id')->references('id')->on('tipo_ensinos')
                ->onDelete('cascade');
            $table->unsignedBigInteger('serie_id')->unsigned()->index();
            $table->foreign('serie_id')->references('id')->on('series')
                ->onDelete('cascade');
            $table->unsignedBigInteger('room_id')->unsigned()->index();
            $table->foreign('room_id')->references('id')->on('rooms')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('name');
            $table->char('a_p_p_b', 5)->nullable();
            $table->char('a_d_p_b', 5)->nullable();
            $table->char('a_p_s_b', 5)->nullable();
            $table->char('a_d_s_b', 5)->nullable();
            $table->char('a_p_t_b', 5)->nullable();
            $table->char('a_d_t_b', 5)->nullable();
            $table->char('a_p_q_b', 5)->nullable();
            $table->char('a_d_q_b', 5)->nullable();
            $table->char('t_a_d_ano', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disciplines');
    }
};
