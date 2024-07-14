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
        Schema::create('credit_and_ltvs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lender_id');
            $table->string('credit_range');
            $table->float('ltv_0_50')->nullable();
            $table->float('ltv_50_55')->nullable();
            $table->float('ltv_55_60')->nullable();
            $table->float('ltv_60_65')->nullable();
            $table->float('ltv_65_70')->nullable();
            $table->float('ltv_70_75')->nullable();
            $table->float('ltv_75_80')->nullable();
            $table->float('ltv_80_85')->nullable();
            $table->float('ltv_85_90')->nullable();
            $table->float('ltv_90_95')->nullable();
            $table->float('ltv_95_100')->nullable();

            $table->foreign('lender_id')->references('id')->on('lenders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_and_ltvs');
    }
};
