<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Polymorphic pivot table linking hunters to any owned gear (Weapon, Equipment).
     *
     * The inventoryable_type/inventoryable_id columns follow Laravel's morphs
     * convention and identify the gear model. Columns are defined manually
     * instead of using uuidMorphs() to avoid a SQLite conflict between the
     * auto-created index and the composite unique constraint.
     */
    public function up(): void
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->foreignUuid('hunterId')->constrained('hunters')->cascadeOnDelete();
            $table->string('inventoryable_type');
            $table->uuid('inventoryable_id');
            $table->timestamps();

            $table->unique(['hunterId', 'inventoryable_type', 'inventoryable_id'], 'inventory_unique');
            $table->index(['inventoryable_type', 'inventoryable_id'], 'inventory_inventoryable_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
