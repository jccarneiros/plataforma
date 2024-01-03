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
        Schema::create('register_entrances_students', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id')->index();
            $table->foreign('student_id')->references('id')->on('students')
                ->onDelete('cascade');

            $table->string('ra_student');

            $table->unsignedBigInteger('tipo_ensino_id')->index();
            $table->foreign('tipo_ensino_id')->references('id')->on('tipo_ensinos')
                ->onDelete('cascade');

            $table->unsignedBigInteger('serie_id')->index();
            $table->foreign('serie_id')->references('id')->on('series')
                ->onDelete('cascade');

            $table->unsignedBigInteger('room_id')->index();
            $table->foreign('room_id')->references('id')->on('rooms')
                ->onDelete('cascade');

            $table->string('month_name');
            $table->date('month_start');
            $table->date('month_end');
            $table->time('day_1')->nullable();
            $table->time('day_2')->nullable();
            $table->time('day_3')->nullable();
            $table->time('day_4')->nullable();
            $table->time('day_5')->nullable();
            $table->time('day_6')->nullable();
            $table->time('day_7')->nullable();
            $table->time('day_8')->nullable();
            $table->time('day_9')->nullable();
            $table->time('day_10')->nullable();
            $table->time('day_11')->nullable();
            $table->time('day_12')->nullable();
            $table->time('day_13')->nullable();
            $table->time('day_14')->nullable();
            $table->time('day_15')->nullable();
            $table->time('day_16')->nullable();
            $table->time('day_17')->nullable();
            $table->time('day_18')->nullable();
            $table->time('day_19')->nullable();
            $table->time('day_20')->nullable();
            $table->time('day_21')->nullable();
            $table->time('day_22')->nullable();
            $table->time('day_23')->nullable();
            $table->time('day_24')->nullable();
            $table->time('day_25')->nullable();
            $table->time('day_26')->nullable();
            $table->time('day_27')->nullable();
            $table->time('day_28')->nullable();
            $table->time('day_29')->nullable();
            $table->time('day_30')->nullable();
            $table->time('day_31')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_entrances_students');
    }
};
