<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate:reset --path='database/migrations/2021_01_06_094258_create_candidates_table.php' --force
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->integer('agency_id')->nullable();
            $table->integer('voucher_id')->nullable();

            $table->string('position_1', 200)->nullable();
            $table->string('position_2', 200)->nullable();
            $table->string('position_3', 200)->nullable();
            $table->text('skills')->nullable();

            $table->string('status', 200)->nullable();
            $table->string('salary', 200)->nullable();
            $table->string('position_selected', 200)->nullable();
            $table->date('date_hired')->nullable();
            $table->string('passport', 200)->nullable();
            $table->string('place_issue', 200)->nullable();
            $table->string('dos', 200)->nullable();
            $table->string('doe', 200)->nullable();

            $table->string('remarks', 200)->nullable();

            $table->string('kin', 200)->nullable();
            $table->string('kin_relationship', 200)->nullable();
            $table->string('kin_contact', 200)->nullable();
            $table->text('kin_address')->nullable();

            $table->string('applied_using', 200)->nullable();
            $table->text('picfull')->nullable();
            $table->string('code', 200)->nullable();
            $table->string('iqama', 200)->nullable();
            $table->string('photo_url', 200)->nullable();
            $table->string('first_name', 200)->nullable();
            $table->string('last_name', 200)->nullable();
            $table->string('middle_name', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('fb_account', 200)->nullable();

            $table->string('contact_1', 200)->nullable();
            $table->string('contact_2', 200)->nullable();

            $table->text('address')->nullable();
            $table->date('birth_date')->nullable();

            $table->string('birth_place', 200)->nullable();
            $table->string('civil_status', 200)->nullable();
            $table->string('gender', 200)->nullable();
            $table->string('blood_type', 200)->nullable();
            $table->string('height', 200)->nullable();
            $table->string('weight', 200)->nullable();
            $table->string('religion', 200)->nullable();
            $table->string('language', 200)->nullable();
            $table->string('education', 200)->nullable();

            $table->string('spouse', 200)->nullable();
            $table->string('mother_name', 200)->nullable();
            $table->string('father_name', 200)->nullable();

            $table->string('agreed', 200)->nullable();
            $table->string('travel_status', 200)->nullable();
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
        Schema::dropIfExists('candidates');
    }
}
