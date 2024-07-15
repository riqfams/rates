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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lender_id');
            $table->float('rate');
            $table->float('days15');
            $table->float('days30');
            $table->float('days45');
            $table->float('margin');
            $table->float('total_rate');
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
        Schema::dropIfExists('rates');
    }
};
