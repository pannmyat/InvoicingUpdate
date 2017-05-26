<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvoiceDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Invoice_Details', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('invoice_header_id')->unsigned();
            $table->foreign('invoice_header_id')->references('id')->on('Invoice_Headers');        
            $table->string('item', 255);
            $table->float('price', 8, 2);
            $table->integer('quantity');
            $table->float('amount', 8, 2);
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
        Schema::dropIfExists('Invoice_Details');
    }
}
