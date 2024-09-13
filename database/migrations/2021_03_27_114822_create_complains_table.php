<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplainsTable extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate:reset --path=database/migrations/2021_03_27_114822_create_complains_table.php && php artisan migrate
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->string('agency', 200)->nullable();
            $table->integer('agency_id')->nullable();

            $table->string('foreign_agency', 200)->nullable();
            $table->integer('foreign_agency_id')->nullable();

            $table->string('company', 200)->nullable();
            $table->integer('company_id')->nullable();

            $table->string('full_name', 200)->nullable();
            $table->string('gender', 200)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('contact_person', 200)->nullable();

            $table->string('national_id', 200)->nullable();
            $table->string('passport', 200)->nullable();

            $table->string('occupation', 200)->nullable();
            $table->string('email_address', 200)->nullable();
            $table->string('contact_number', 200)->nullable();
            $table->string('contact_number2', 200)->nullable();

            $table->string('address_abroad', 200)->nullable();
            $table->string('employer_contact', 200)->nullable();
            $table->text('complaint')->nullable();

            $table->string('image1', 200)->nullable();
            $table->string('image2', 200)->nullable();
            $table->string('image3', 200)->nullable();

            $table->string('actual_latitude', 200)->nullable();
            $table->string('actual_longitude', 200)->nullable();

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
        Schema::dropIfExists('complains');
    }
}
