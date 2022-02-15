<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');

            $table->date('appointment_date');
            $table->string('meridian', 10);
            $table->string('inmate', 100);
            $table->tinyInteger('is_approved')->default(0);
            $table->tinyInteger('is_cancel')->default(0);
            $table->string('inmate_relationship')->nullable();
            $table->string('purpose')->nullable();
            $table->tinyInteger('is_scanned')->default(0);
            $table->text('frisking_items')->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
