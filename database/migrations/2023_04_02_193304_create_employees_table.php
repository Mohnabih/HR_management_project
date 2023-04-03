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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manager_id')->nullable()->constrained('employees')->cascadeOnDelete();
            $table->foreignId('founder_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('age')->nullable();
            $table->boolean('gender')->default(0); //0=male, 1=female
            $table->string('email')->nullable()->unique();
            $table->integer('salary')->nullable();
            $table->string('job_title')->nullable();
            $table->tinyInteger('category')->default(0); //0=employee, 1=manager && employee,
            $table->timestamp('hired_date')->nullable();
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
        Schema::dropIfExists('employees');
    }
};
