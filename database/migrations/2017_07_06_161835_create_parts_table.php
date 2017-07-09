<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(255);
        Schema::create('parts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('avg_price', 12, 2);
            $table->text('description');
            $table->integer('created_id');
            $table->integer('modified_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parts');
    }
}
