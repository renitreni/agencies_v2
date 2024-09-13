<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate:refresh --path=database/migrations/2020_12_27_095959_create_reports_table.php && php artisan migrate
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('reportable_id', 200)->nullable();
            $table->string('reportable_type', 200)->nullable();
            $table->string('created_by', 200)->nullable();
            $table->string('salary_received', 200)->nullable();
            $table->date('salary_date')->nullable();
            $table->text('remarks')->nullable();
            $table->string('priority_level', 200)->nullable();
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
        Schema::dropIfExists('reports');
    }
}
