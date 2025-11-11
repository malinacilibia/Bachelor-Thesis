<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRejectReasonToAdoptionStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adoption_stories', function (Blueprint $table) {
            $table->text('reject_reason')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('adoption_stories', function (Blueprint $table) {
            $table->dropColumn('reject_reason');
        });
    }
}

