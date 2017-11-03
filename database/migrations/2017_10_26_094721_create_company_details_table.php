<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('company_name', 100);
            $table->text('address');
            $table->enum('status', ['0', '1', '2'])->comment('0: Inactive, 1: Active, 2: Deleted');
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
        Schema::dropIfExists('company_details');
    }
}
