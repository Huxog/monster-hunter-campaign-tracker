<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drops', function (Blueprint $table) {
            $table->foreignUuid('monsterId')->constrained('monsters')->cascadeOnDelete();
            $table->foreignUuid('materialId')->constrained('materials')->cascadeOnDelete();
            $table->primary(['monsterId', 'materialId']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drops');
    }
};
