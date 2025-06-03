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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_category_id')->constrained('listing_categories');
            $table->string('business_name');
            $table->text('description');
            $table->string('contact_person');
            $table->string('address');
            $table->string('email');
            $table->string('mobile');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('photo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
