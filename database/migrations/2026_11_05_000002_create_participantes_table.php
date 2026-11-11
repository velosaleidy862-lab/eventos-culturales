<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->string('documento', 20)->unique();
            $table->string('nombres', 80);
            $table->string('apellidos', 80);
            $table->string('correo', 120);
            $table->string('telefono', 20);
            $table->foreignId('evento_id')->constrained('eventos')->restrictOnDelete();
            $table->date('fecha_inscripcion');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
};
