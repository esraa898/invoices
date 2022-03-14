<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoicesdetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_invoice');
            $table->foreign('id_invoice')->references('id')->on('invoices')->onDelete('CASCADE');
            $table->string('product',50);
            $table->integer('invoice_number');
            $table->string('section',999);
            $table->string('status',50);
            $table->integer('value_status');
            $table->date('payment_date')->nullable();
            $table->text('note')->nullable();
            $table->string('user',300);
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
        Schema::dropIfExists('invoicesdetails');
    }
}
