<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultInterfacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_interfaces', function (Blueprint $table) {
            $table->id();
            $table->string('homepage_title');
            $table->string('homepage_subtitle')->nullable();
            $table->string('homepage_details')->nullable();
            $table->string('homepage_logo')->nullable();
            $table->string('homepage_background_image')->nullable();
            $table->string('homepage_text_color')->nullable();
            $table->string('homepage_background_color_1')->nullable();
            $table->string('homepage_background_color_2')->nullable();
            $table->string('homepage_background_color_3')->nullable();
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
        Schema::dropIfExists('default_interfaces');
    }
}
