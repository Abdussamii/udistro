<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('page_name', 50);
            $table->text('page_content');
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
        Schema::dropIfExists('cms_contents');
    }
}
