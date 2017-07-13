<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsToVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(255);
        Schema::create('parts_to_vendor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('part_id')->nullable();
            $table->string('vendor_id')->nullable();
            $table->decimal('vendor_last_price', 12, 2)->nullable();
            $table->timestamp('vendor_last_price_date');
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
        Schema::dropIfExists('parts_to_vendor');
    }
}
