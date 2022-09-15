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
        Schema::create('installer_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('access_token');
            $table->text('scope');
            $table->integer('user_id');
            $table->string('username');
            $table->string('user_email');
            $table->string('context');
            $table->string('account_uuid');
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
        Schema::dropIfExists('installer_sessions');
    }
};
