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
        Schema::create('fico_adjustments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lender_id');
            $table->integer('fico_range_low');
            $table->integer('fico_range_high');
            $table->text('adjustment');

            $table->foreign('lender_id')->references('id')->on('lenders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fico_adjustments');
    }
};
