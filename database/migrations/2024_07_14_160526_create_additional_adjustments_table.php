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
        Schema::create('additional_adjustments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lender_id');
            $table->string('options');
            $table->string('operand');
            $table->text('value');
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
        Schema::dropIfExists('additional_adjustments');
    }
};
