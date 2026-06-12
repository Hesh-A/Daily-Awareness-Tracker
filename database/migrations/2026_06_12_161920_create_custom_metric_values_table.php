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
        Schema::create('custom_metric_values', function (Blueprint $table) {
         $table->id();
         $table->foreignId('daily_entry_id')->constrained()->onDelete('cascade');
         $table->foreignId('custom_metric_id')->constrained()->onDelete('cascade');
         $table->integer('value'); // e.g. 3 times angry
         $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_metric_values');
    }
};
