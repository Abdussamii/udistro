<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->enum('status', ['0', '1', '2'])->comment('0: Inactive, 1: Active, 2: Deleted')->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
	        $table->enum('status', ['0', '1', '2'])->comment('0: Inactive, 1: Active, 2: Deleted')->after('remember_token');
	    });
    }
}
