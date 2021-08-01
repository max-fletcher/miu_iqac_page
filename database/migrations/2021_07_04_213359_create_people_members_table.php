<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('people_id');
            // $table->foreign('people_id')->references('id')->on('people')->onDelete('cascade');
            $table->string('name');
            $table->string('designation');
            $table->string('cell_number');
            $table->string('email');
            $table->string('member_image')->nullable();
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
        Schema::dropIfExists('people_members');
    }
}
