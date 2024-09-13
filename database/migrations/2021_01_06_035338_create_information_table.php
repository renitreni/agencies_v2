<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 200)->nullable();
            $table->string('national_id', 200)->nullable();
            $table->string('name', 200);
            $table->string('tin', 200)->nullable();
            $table->text('address_line_1')->nullable();
            $table->text('address_line_2')->nullable();
            $table->string('city', 200)->nullable();
            $table->string('zip_code', 200)->nullable();
            $table->string('contact_name', 200)->nullable();
            $table->string('phone', 200)->nullable();
            $table->string('fax', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('status', 200)->nullable();
            $table->string('type', 200)->nullable();
            $table->string('poea', 200)->nullable();
            $table->string('created_by', 200)->nullable();
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
        Schema::dropIfExists('information');
    }
}
