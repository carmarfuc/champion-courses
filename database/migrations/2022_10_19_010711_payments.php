<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Payments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->date('expiration_date');
            $table->date('payment_date')->nullable();
            $table->set('status', ['pending', 'paid']);
            $table->unsignedDecimal('amount', $precision = 8, $scale = 2);
            $table->unsignedDecimal('teacher_remuneration', $precision = 8, $scale = 2);

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
