<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('sold_details', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('guest_name');
            $table->string('book_number');
            $table->string('book_name');
            $table->string('author_name');
            $table->decimal('price', 10, 2)->default(0); // Default price set to 0
            $table->string('img')->nullable();
            $table->integer('quantity');
            $table->string('payment_mode');
            $table->integer('discount')->default(0); // Default discount set to 0
            $table->decimal('total', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sold_details');
    }
}
