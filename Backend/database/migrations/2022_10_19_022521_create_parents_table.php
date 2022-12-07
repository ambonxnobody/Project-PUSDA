<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('auhtor')->unsigned();
            $table->string('certificate_number')->unique();
            $table->date('certificate_date');
            $table->string('item_name');
            $table->string('address');
            $table->string('large');
            $table->integer('asset_value');
            $table->timestamps();
            $table->foreign('auhtor')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parents');
    }
}
