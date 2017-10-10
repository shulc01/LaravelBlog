<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('art-cat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 120);
            $table->text('descc');
            $table->string('email', 128)->unique();
            $table->string('author')->nullable();
            $table->tinyinteger('isAdmin');
            $table->integer('idcat');
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
        Schema::dropIfExists('art-cat');
    }
}
