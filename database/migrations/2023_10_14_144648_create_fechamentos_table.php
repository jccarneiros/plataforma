<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fechamentos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tipo_ensino_id')->index();
            $table->foreign('tipo_ensino_id')->references('id')->on('tipo_ensinos')
                ->onDelete('cascade');

            $table->unsignedBigInteger('serie_id')->index();
            $table->foreign('serie_id')->references('id')->on('series')
                ->onDelete('cascade');

            $table->unsignedBigInteger('room_id')->index();
            $table->foreign('room_id')->references('id')->on('rooms')
                ->onDelete('cascade');

            $table->unsignedBigInteger('discipline_id')->index();
            $table->foreign('discipline_id')->references('id')->on('disciplines')
                ->onDelete('cascade');

            $table->unsignedBigInteger('student_id')->index();
            $table->foreign('student_id')->references('id')->on('students')
                ->onDelete('cascade');

            $table->string('number_ra');
            $table->char('student_number', 3);
            $table->string('student_name');
            $table->string('student_situation');
            $table->char('n_p_b', 5)->nullable();
            $table->char('f_p_b', 5)->nullable();
            $table->char('f_c_p_b', 5)->nullable();
            $table->char('a_p_p_b', 5)->nullable();
            $table->char('a_d_p_b', 5)->nullable();

            $table->char('n_s_b', 5)->nullable();
            $table->char('f_s_b', 5)->nullable();
            $table->char('f_c_s_b', 5)->nullable();
            $table->char('a_p_s_b', 5)->nullable();
            $table->char('a_d_s_b', 5)->nullable();

            $table->char('n_t_b', 5)->nullable();
            $table->char('f_t_b', 5)->nullable();
            $table->char('f_c_t_b', 5)->nullable();
            $table->char('a_p_t_b', 5)->nullable();
            $table->char('a_d_t_b', 5)->nullable();

            $table->char('n_q_b', 5)->nullable();
            $table->char('f_q_b', 5)->nullable();
            $table->char('f_c_q_b', 5)->nullable();
            $table->char('a_p_q_b', 5)->nullable();
            $table->char('a_d_q_b', 5)->nullable();

            $table->char('n_q_c', 5)->nullable();

            $table->char('t_f_bs', 5)->nullable()->default(0);
            $table->char('t_f_comp', 5)->nullable()->default(0);

            $table->char('t_f_ano', 5)->nullable()->default(0);
            $table->char('t_a_d_ano', 5)->nullable()->default(1);
            $table->char('t_f_porcentagem_ano')->nullable()->default(0);
            $table->string('resultado_final_student')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fechamentos');
    }
};
