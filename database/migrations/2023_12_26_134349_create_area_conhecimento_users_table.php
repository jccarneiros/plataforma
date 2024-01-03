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
        Schema::create('area_conhecimento_users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('area_conhecimento_id')->unsigned()->index();
            $table->foreign('area_conhecimento_id')->references('id')->on('area_conhecimentos')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_conhecimento_users');
    }
};
