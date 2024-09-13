<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate:reset --path='database/migrations/2022_10_21_042500_create_voucher_expenses_table.php' --force
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('header_name')->nullable();
            $table->integer('voucher_id');
            $table->date('expense_date')->nullable();
            $table->string('expense')->nullable();
            $table->float('amount')->nullable();
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
        Schema::dropIfExists('voucher_expenses');
    }
};
