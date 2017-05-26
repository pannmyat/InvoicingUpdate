<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvoiceHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Invoice_Headers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');            
            $table->string('invoice_name', 255);
            $table->integer('total_qty');
            $table->float('subtotal', 8, 2);
            $table->integer('tax');
            $table->float('total', 8, 2);
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
        Schema::dropIfExists('Invoice_Headers');
    }
}
