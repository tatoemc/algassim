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
        Schema::create('sponserforms', function (Blueprint $table) {
            $table->id();
            
            $table->string('kafal_type');
            $table->string('payment_type');
            $table->double('amount');
            $table->text('note')->nullable();

            $table->unsignedBigInteger('orphan_id')->unsigned();
            $table->foreign('orphan_id')->references('id')->on ('orphans')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('guardian_id')->unsigned();
            $table->foreign('guardian_id')->references('id')->on ('guardians')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on ('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('sponserforms');
    }
};
