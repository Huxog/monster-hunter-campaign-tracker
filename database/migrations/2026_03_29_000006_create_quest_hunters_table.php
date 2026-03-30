<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quest_hunters', function (Blueprint $table) {
            $table->foreignUuid('questId')->constrained('quests')->cascadeOnDelete();
            $table->foreignUuid('hunterId')->constrained('hunters')->cascadeOnDelete();
            $table->primary(['questId', 'hunterId']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quest_hunters');
    }
};
