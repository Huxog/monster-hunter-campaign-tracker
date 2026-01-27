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
        Schema::table('hunters', function (Blueprint $table) {
            $table->foreignUuid('weaponId')->nullable()->after('trousersId')->references('id')->on('weapons');
            $table->string('class')->nullable()->after('weaponId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hunters', function (Blueprint $table) {
            $table->dropForeign(['weaponId']);
            $table->dropColumn(['weaponId', 'class']);
        });
    }
};
