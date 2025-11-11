<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptionRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adoption_requests', function (Blueprint $table) {
            $table->id(); //id unic pt fiecare cerere

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('post_id')->constrained('posts');

            //date personale
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('city_state');
            $table->string('occupation');

            //info despre locuinta
            $table->enum('housing_type', ['Apartament', 'Casă', 'Altceva']);
            $table->boolean('is_owner');
            $table->boolean('rental_pet_permission')->nullable();
            $table->boolean('secure_space');
            $table->boolean('household_allergy');
            $table->enum('home_presence', ['Tot timpul', 'În majoritatea timpului', 'Doar seara', 'Aproape niciodată']);


            //experienta cu animalele
            $table->boolean('had_pets_before');
            $table->text('past_pets_details')->nullable();
            $table->boolean('has_other_pets');
            $table->json('other_pets')->nullable();

            //motivatia adoptiei
            $table->text('adoption_reason');
            $table->boolean('understands_costs');
            $table->boolean('previous_adoption');
            $table->text('previous_adoption_details')->nullable();

            //responsabilitati si angajamente
            $table->string('vacation_care');
            $table->text('surrender_plan');
            $table->boolean('covers_vet_expenses');
            $table->boolean('willing_to_train');

            //consimtamant si semnatura
            $table->boolean('agrees_home_visits');
            $table->boolean('understands_commitment');
            $table->boolean('accepts_terms');
            $table->text('additional_info')->nullable();

            //metadata
            $table->enum('application_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adoption_request');
    }
}
