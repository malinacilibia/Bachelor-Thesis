<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('home_type');
            $table->boolean('own_home');
            $table->boolean('rental_pet_permission')->nullable();
            $table->boolean('safe_space');
            $table->boolean('allergic_to_cats');
            $table->boolean('past_pets');
            $table->text('past_pets_details')->nullable();
            $table->boolean('has_other_pets');
            $table->json('other_pets')->nullable();
            $table->text('motivation');
            $table->boolean('aware_of_costs');
            $table->boolean('previous_adoption');
            $table->string('vacation_care');
            $table->boolean('vet_costs');
            $table->boolean('behavior_training');
            $table->boolean('post_adoption_visits');
            $table->boolean('agree_terms');
            $table->text('additional_notes')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
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
        Schema::dropIfExists('adoptions');
    }
}
