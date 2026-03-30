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
            $table->foreignUuid('helmetId')->nullable()->after('campaignId')->references('id')->on('equipment');
            $table->foreignUuid('vestId')->nullable()->after('helmetId')->references('id')->on('equipment');
            $table->foreignUuid('trousersId')->nullable()->after('vestId')->references('id')->on('equipment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hunters', function (Blueprint $table) {
            $table->dropForeign(['helmetId']);
            $table->dropForeign(['vestId']);
            $table->dropForeign(['trousersId']);
            $table->dropColumn(['helmetId', 'vestId', 'trousersId']);
        });
    }
};
