<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeValueAdoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adoptions', function (Blueprint $table) {
            $table->string('own_home')->change();
            $table->string('rental_pet_permission')->change();
            $table->string('safe_space')->change();
            $table->string('allergic_to_cats')->change();
            $table->string('aware_of_costs')->change();
            $table->string('previous_adoption')->change();
            $table->string('vet_costs')->change();
            $table->string('behavior_training')->change();
            $table->string('post_adoption_visits')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adoptions', function (Blueprint $table) {
            $table->boolean('own_home')->change();
            $table->boolean('rental_pet_permission')->change();
            $table->boolean('safe_space')->change();
            $table->boolean('allergic_to_cats')->change();
            $table->boolean('aware_of_costs')->change();
            $table->boolean('previous_adoption')->change();
            $table->boolean('vet_costs')->change();
            $table->boolean('behavior_training')->change();
            $table->boolean('post_adoption_visits')->change();
        });
    }
}
