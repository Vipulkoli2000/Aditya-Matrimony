<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profile_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("profile_id")->nullable();  // Assuming you have a users table
            $table->unsignedBigInteger("package_id")->nullable();  // Link to packages
            $table->string('order_id')->nullable();
            $table->string('payment_ref_id')->nullable();
            $table->boolean('status')->default(false);
            $table->integer('tokens_received')->default(0);
            $table->integer('tokens_used')->default(0);
            $table->timestamp('starts_at')->nullable();  // When the package was bought
            $table->timestamp('expires_at')->nullable();  // When the package will expire
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_packages');
    }
};