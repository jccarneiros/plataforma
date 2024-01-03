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
        Schema::create('document_periods', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('area_conhecimento_id')->unsigned()->index();
            $table->foreign('area_conhecimento_id')->references('id')->on('area_conhecimentos')
                ->onDelete('cascade');

            $table->unsignedBigInteger('document_type_id')->unsigned()->index();
            $table->foreign('document_type_id')->references('id')->on('document_types')
                ->onDelete('cascade');

            $table->boolean('tipo_ensino')->default(0);
            $table->boolean('serie')->default(0);
            $table->boolean('disciplina')->default(0);
            $table->string('name');
            $table->string('periodicidade');
            $table->string('referencia');
            $table->date('date_initial');
            $table->date('date_final');
            $table->date('date_limit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_periods');
    }
};
