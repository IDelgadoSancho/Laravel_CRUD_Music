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
        Schema::create('concerts', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->dateTime('data_hora');
            $table->integer('aforament');
            $table->integer('entrades_disponibles');
            $table->timestamps();

            // foreig key festival
            $table->foreignId('festival_id')->constrained()->onDelete('cascade');  // Clave foránea con 'constrained'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concerts');
    }
};
