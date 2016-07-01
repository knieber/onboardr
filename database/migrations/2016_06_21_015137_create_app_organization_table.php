<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_organization', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id');
            $table->integer('organization_id');
            $table->string('app_email');
            $table->string('app_password');
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
        Schema::drop('app_organization');
    }
}
