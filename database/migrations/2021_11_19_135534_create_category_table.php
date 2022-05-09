<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('sub_category', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('material_category', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sub_category_id');
            $table->string('name')->nullable();
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
        Schema::dropIfExists('category');
        Schema::dropIfExists('sub_category');
        Schema::dropIfExists('material_category');
    }
}
