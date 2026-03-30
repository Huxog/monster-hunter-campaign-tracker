<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('campaignId')->constrained('campaigns')->cascadeOnDelete();
            $table->foreignUuid('monsterId')->constrained('monsters')->cascadeOnDelete();
            $table->string('outcome')->nullable();
            $table->timestamp('completedAt')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quests');
    }
};
