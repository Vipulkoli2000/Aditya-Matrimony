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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('franchise_code', 50)->nullable()->index();
            $table->string('first_name', 100)->nullable();
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->enum('role', ['bride', 'groom'])->nullable();
            $table->string('mother_tongue', 100)->nullable();
            $table->string('native_place', 100)->nullable();
            $table->string('gender', 50)->nullable();
            $table->string('marital_status', 50)->nullable();
            $table->string('living_with', 100)->nullable();
            $table->integer('available_tokens')->default(0);
            $table->unsignedBigInteger('profile_package_id')->nullable();
           
            // health info
            $table->string('blood_group', 10)->nullable();
            $table->string('height', 10)->nullable();
            $table->string('weight', 10)->nullable();
            $table->string('body_type', 50)->nullable();
            $table->string('complexion', 50)->nullable();
            $table->boolean('physical_abnormality')->default(0);
            $table->boolean('spectacles')->default(0);
            $table->boolean('lens')->default(0);
            // food habits
            $table->string('eating_habits', 100)->nullable();
            $table->string('drinking_habits', 100)->nullable();
            $table->string('smoking_habits', 100)->nullable();
            // about self
            $table->text('about_self')->nullable();
            $table->string('img_1', 255)->nullable();
            $table->string('img_2', 255)->nullable();
            $table->string('img_3', 255)->nullable();
            // Religious Information
            $table->string('religion', 100)->nullable();
            $table->integer('caste')->nullable();
            $table->integer('sub_caste')->nullable();
            // Custom caste fields for "Other" selections
            $table->string('custom_caste', 100)->nullable();
            $table->string('custom_sub_caste', 100)->nullable();
            $table->string('gotra', 100)->nullable();
            // family details
            $table->boolean('father_is_alive')->nullable();
            $table->string('father_name', 100)->nullable();
            $table->string('father_occupation', 100)->nullable();
            $table->string('father_organization', 100)->nullable();
            $table->string('father_job_type', 100)->nullable();
            $table->string('father_mobile', 100)->nullable();
            $table->string('father_address')->nullable();
            $table->boolean('mother_is_alive')->nullable();
            $table->string('mother_name', 100)->nullable();
            $table->string('mother_occupation', 100)->nullable();
            $table->string('mother_organization', 100)->nullable();
            $table->string('mother_job_type', 100)->nullable();
            $table->string('mother_native_place', 100)->nullable();
            $table->string('mother_mobile', 100)->nullable();
            $table->string('mother_address')->nullable();
            $table->string('mother_name_before_marriage', 100)->nullable();

            $table->integer('number_of_brothers_married')->nullable();
            $table->integer('number_of_brothers_unmarried')->nullable();
            $table->string('brother_resident_place', 100)->nullable();
            $table->integer('number_of_sisters_married')->nullable();
            $table->integer('number_of_sisters_unmarried')->nullable();
            $table->string('sister_resident_place', 100)->nullable();
            $table->text('about_parents')->nullable();
            // birth Information
            $table->date('date_of_birth')->nullable();
            $table->time('birth_time')->nullable();
            $table->string('birth_place', 100)->nullable();
            // educational Information
            $table->string('highest_education', 100)->nullable();
            $table->string('other_education', 255)->nullable();
            $table->text('education_in_detail')->nullable();
            $table->string('additional_degree', 100)->nullable();
            // occupational Information
            $table->string('occupation', 100)->nullable();
            $table->string('organization', 100)->nullable();
            $table->string('designation', 100)->nullable();
            $table->string('job_location', 100)->nullable();
            // experience/income Information
            $table->string('job_experience', 100)->nullable();
            $table->decimal('income', 10, 2)->nullable();
            $table->string('currency', 50)->nullable();
            // contact details
            $table->string('country', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('city', 100)->nullable();
            // address information
            $table->text('address_line_1')->nullable();
            $table->text('address_line_2')->nullable();
            $table->string('landmark', 100)->nullable();
            $table->string('pincode', 20)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('landline', 15)->nullable();
            $table->string('email', 100)->nullable();
            // about life partner
            $table->integer('partner_min_age')->nullable();
            $table->integer('partner_max_age')->nullable();
            $table->string('partner_min_height', 50)->nullable();
            $table->string('partner_max_height', 50)->nullable();
            // expected information about partners
            $table->decimal('partner_income', 10, 2)->nullable();
            $table->string('partner_currency', 50)->nullable();
            $table->string('want_to_see_patrika', 100)->nullable();
            $table->string('partner_sub_cast', 100)->nullable();
            $table->string('partner_eating_habbit', 100)->nullable();
            $table->string('partner_city_preference', 100)->nullable();
            $table->string('partner_education', 100)->nullable();
            $table->string('partner_education_specialization', 100)->nullable();
            $table->string('partner_job', 100)->nullable();
            $table->string('partner_business', 100)->nullable();
            $table->string('partner_foreign_resident', 100)->nullable();
            // astronomy
            $table->boolean('when_meet')->default(0);
            $table->string('rashee', 50)->nullable();
            $table->string('nakshatra', 50)->nullable();
            $table->string('mangal', 50)->nullable();
            $table->string('charan', 50)->nullable();
            $table->string('gana', 50)->nullable();
            $table->string('nadi', 50)->nullable();
            $table->string('chart', 50)->nullable();
            $table->text('more_about_patrika')->nullable();
            $table->string('img_patrika', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};