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
        Schema::create('orphans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('gender'); 
            $table->date('b_date');
            $table->string('schoolLevel');
            $table->string('add');
            $table->string('ssn');
            $table->string('helth_state');
            $table->date('father_deth'); 
            $table->string('brother_count'); 
            $table->text('death_certif')->nullable();
            $table->text('note')->nullable();
            $table->string('stauts')->default('0');
            $table->text('images')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('orphans');
    }
};
