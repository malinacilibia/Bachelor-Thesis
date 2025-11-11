<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // adăugăm ID-ul utilizatorului
            $table->decimal('amount', 8, 2);       // suma donației
            $table->string('stripe_session_id');    // ID-ul sesiunii Stripe
            $table->string('status');               // statusul plății
            $table->timestamps();                  // datele de creare/actualizare
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
