<?php

use App\Enums\SupportTypeEnsino;
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->boolean('status_p_b')->default(0);
            $table->boolean('status_s_b')->default(0);
            $table->boolean('status_t_b')->default(0);
            $table->boolean('status_q_b')->default(0);
            $table->boolean('status_q_c')->default(0);

            $table->unsignedBigInteger('tipo_ensino_id')->unsigned()->index();
            $table->foreign('tipo_ensino_id')->references('id')->on('tipo_ensinos')
                ->onDelete('cascade');

            $table->unsignedBigInteger('serie_id')->unsigned()->index();
            $table->foreign('serie_id')->references('id')->on('series')
                ->onDelete('cascade');

            $table->string('code')->unique();
            $table->string('name');
            $table->enum('type', array_column(SupportTypeEnsino::cases(), 'value'));
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
