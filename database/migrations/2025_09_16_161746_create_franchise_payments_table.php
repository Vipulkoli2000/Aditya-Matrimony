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
        Schema::create('franchise_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('franchise_id');
            $table->foreign('franchise_id')->references('id')->on('franchises')->onDelete('cascade');
            $table->year('year');
            $table->boolean('january')->default(false);
            $table->boolean('february')->default(false);
            $table->boolean('march')->default(false);
            $table->boolean('april')->default(false);
            $table->boolean('may')->default(false);
            $table->boolean('june')->default(false);
            $table->boolean('july')->default(false);
            $table->boolean('august')->default(false);
            $table->boolean('september')->default(false);
            $table->boolean('october')->default(false);
            $table->boolean('november')->default(false);
            $table->boolean('december')->default(false);
            $table->timestamps();
            
            $table->unique(['franchise_id', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('franchise_payments');
    }
};
