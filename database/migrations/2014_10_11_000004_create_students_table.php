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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tipo_ensino_id')->unsigned()->index();
            $table->foreign('tipo_ensino_id')->references('id')->on('tipo_ensinos')
                ->onDelete('cascade');

            $table->unsignedBigInteger('serie_id')->unsigned()->index();
            $table->foreign('serie_id')->references('id')->on('series')
                ->onDelete('cascade');

            $table->unsignedBigInteger('room_id')->unsigned()->index();
            $table->foreign('room_id')->references('id')->on('rooms')
                ->onDelete('cascade');

            $table->string('code')->unique();
            $table->boolean('active')->default(1);
            $table->char('number', 3);
            $table->string('name');
            $table->string('number_ra');
            $table->char('number_ra_digit', 2);
            $table->char('uf_ra', 3);
            $table->date('date_birth');
            $table->string('email_microsoft');
            $table->string('email_google');
            $table->string('student_situation');
            $table->enum('type', array_column(SupportTypeEnsino::cases(), 'value'));
            $table->string('slug');
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
