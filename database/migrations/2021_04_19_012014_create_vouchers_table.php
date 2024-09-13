<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate:reset --path="./database/migrations/2021_04_19_012014_create_vouchers_table.php"
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('agency_id', 200)->nullable();
            $table->text('name')->nullable();
            $table->string('status', 200)->nullable();
            $table->text('source')->nullable();
            $table->text('requirements')->nullable();
            $table->text('passporting_allowance')->nullable();
            $table->string('ticket')->nullable();
            $table->text('tesda_allowance')->nullable();
            $table->text('nbi_renewal')->nullable();
            $table->text('pdos')->nullable();
            $table->text('info_sheet')->nullable();
            $table->string('medical_allowance')->nullable();
            $table->string('owwa_allowance')->nullable();
            $table->string('office_allowance')->nullable();
            $table->string('travel_allowance')->nullable();
            $table->string('weekly_allowance')->nullable();
            $table->string('medical_follow_up')->nullable();
            $table->string('nbi_refund')->nullable();
            $table->string('psa_refund')->nullable();
            $table->string('passport_refund')->nullable();
            $table->string('fare_refund')->nullable();
            $table->string('red_rebon_nbi')->nullable();
            $table->string('fit_to_work')->nullable();
            $table->string('repat')->nullable();
            $table->string('stamping')->nullable();
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
        Schema::dropIfExists('vouchers');
    }
}
