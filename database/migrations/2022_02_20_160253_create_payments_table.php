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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sponserform_id')->unsigned();
            $table->foreign('sponserform_id')->references('id')->on ('sponserforms')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('orphan_id')->unsigned();
            $table->foreign('orphan_id')->references('id')->on ('orphans')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('guardian_id')->unsigned();
            $table->foreign('guardian_id')->references('id')->on ('guardians')->onUpdate('cascade')->onDelete('cascade');
            
            $table->string('stauts')->nullable();
            $table->string('images')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
