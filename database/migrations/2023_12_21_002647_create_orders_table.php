<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
 * Run the migrations.
 */
public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('menu_id')->constrained(); // Assuming you have a 'menus' table
        $table->string('payref');
        $table->decimal('amount', 8, 2); // Similar to the 'price' column in the 'menus' table
        $table->date('delivery_date');
        $table->boolean('availability')->default(true); // You may want to adjust this based on your requirements
        $table->string('actions'); // You may want to change the data type based on your requirements
        $table->timestamps();
    });


    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
