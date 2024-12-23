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
        Schema::create('rute_stasiun', function (Blueprint $table) {
            $table->foreignId('rute_id')->constrained('rute')->references('rute_id')->onDelete('cascade');
            $table->foreignId('point_id')->constrained('point')->references('point_id')->onDelete('cascade');
            $table->integer('sequence');
            $table->timestamps();

            $table->primary(['rute_id', 'point_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rute_stasiun');
    }
};
