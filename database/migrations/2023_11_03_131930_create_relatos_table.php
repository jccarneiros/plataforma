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
        Schema::create('relatos', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->unsignedBigInteger('tutor_id')->unsigned()->index();
            $table->foreign('tutor_id')->references('id')->on('tutors')
                ->onDelete('CASCADE');
            $table->unsignedBigInteger('student_id')->unsigned()->index();
            $table->foreign('student_id')->references('id')->on('students')
                ->onDelete('CASCADE');
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatos');
    }
};
