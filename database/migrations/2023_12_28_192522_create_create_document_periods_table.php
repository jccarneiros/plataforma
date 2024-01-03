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
        Schema::create('create_document_periods', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('area_conhecimento_id')->unsigned()->index();
            $table->foreign('area_conhecimento_id')->references('id')->on('area_conhecimentos')
                ->onDelete('cascade');

            $table->unsignedBigInteger('document_type_id')->unsigned()->index();
            $table->foreign('document_type_id')->references('id')->on('document_types')
                ->onDelete('cascade');

            $table->unsignedBigInteger('document_period_id')->unsigned()->index();
            $table->foreign('document_period_id')->references('id')->on('document_periods')
                ->onDelete('cascade');

            $table->unsignedBigInteger('tipo_ensino_id')->nullable()->unsigned()->index();
            $table->foreign('tipo_ensino_id')->references('id')->on('tipo_ensinos')
                ->onDelete('cascade');

            $table->unsignedBigInteger('serie_id')->nullable()->unsigned()->index();
            $table->foreign('serie_id')->references('id')->on('series')
                ->onDelete('cascade');

            $table->unsignedBigInteger('disciplina_id')->nullable()->unsigned()->index();
            $table->foreign('disciplina_id')->references('id')->on('disciplinas')
                ->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('name');
            $table->string('periodicidade');
            $table->string('referencia');
            $table->date('date_initial');
            $table->date('date_final');
            $table->date('date_limit');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_document_periods');
    }
};
