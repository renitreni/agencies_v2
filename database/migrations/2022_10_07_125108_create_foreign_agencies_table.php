<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate:reset --path='database/migrations/2022_10_07_125108_create_foreign_agencies_table.php' --force
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foreign_agencies', function (Blueprint $table) {
            $table->id();
            $table->integer('agency_id');
            $table->string('agency_name');
            $table->text('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('foreign_agencies');
    }
};
