<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Polymorphic pivot table linking materials to any craftable entity
     * (Weapon, Equipment). The craftable_type/craftable_id columns follow
     * Laravel's morphs convention and identify the craftable model.
     *
     * Columns are defined manually instead of using uuidMorphs() to avoid
     * a SQLite conflict between the auto-created index and the composite
     * unique constraint.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->foreignUuid('materialId')->constrained('materials')->cascadeOnDelete();
            $table->string('craftable_type');
            $table->uuid('craftable_id');
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();

            $table->unique(['materialId', 'craftable_type', 'craftable_id'], 'recipes_unique');
            $table->index(['craftable_type', 'craftable_id'], 'recipes_craftable_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
