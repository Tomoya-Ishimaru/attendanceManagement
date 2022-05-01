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
        Schema::create('stamp_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daytimestamp_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->time('newPunchIn');
            $table->time('newPunchOut');
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
        Schema::dropIfExists('stamp_checks');
    }
};
