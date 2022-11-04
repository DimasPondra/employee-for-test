<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_furloughs', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('last_date');
            $table->text('reason')->nullable();
            $table->date('submission_date');
            $table->string('status');
            $table->date('approve_date')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('furlough_type');
            $table->string('employee_occupation');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submission_furloughs');
    }
};
