<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('noSyarikat')->nullable();
            $table->string('noPerniagaan')->nullable();
            $table->string('namaSyarikat')->nullable();
            $table->string('negara')->nullable();
            $table->string('alamat')->nullable();
            $table->string('bandar')->nullable();
            $table->string('poskod')->nullable();
            $table->string('negeri')->nullable();
            $table->string('noTelephone')->nullable();
            $table->string('noFax')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('statusPembekal')->nullable();
            $table->string('statusAktif')->nullable();
            $table->string('kategori')->nullable();
            // $table->string('ssm_doc')->nullable();
            // $table->string('pbt_doc')->nullable();
            $table->string('password')->nullable();
            $table->string('statusSemakan')->nullable();
            $table->string('kataLaluanText')->nullable();
            $table->string('pickUp_by')->nullable();
            $table->string('checked_by')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
