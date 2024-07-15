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
        Schema::create('loan_amount_adjustments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lender_id');
            $table->integer('loan_amount_low');
            $table->integer('loan_amount_high');
            $table->text('adjustment');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lender_id')->references('id')->on('lenders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_amount_adjustments');
    }
};
