<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToDefaultInterfaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('default_interfaces', function (Blueprint $table) {
            $table->string('status')->nullable();
            $table->enum('type',['systemPages','organizationPages','errorPages'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('default_interfaces', function (Blueprint $table) {
            //
        });
    }
}
