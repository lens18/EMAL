<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('kategori')->nullable();
            $table->string('subKategori')->nullable();
            $table->string('namaBahan')->nullable();
            $table->string('jenama')->nullable();
            $table->string('namaPengilang')->nullable();
            $table->string('alamatPengilang')->nullable();
            $table->string('negaraPengilang')->nullable();
            $table->string('model')->nullable();
            $table->string('ratedVoltage')->nullable();
            $table->string('size')->nullable();
            $table->string('coreNo')->nullable();
            $table->string('perakuan')->nullable();
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
        Schema::dropIfExists('material');
    }
}
