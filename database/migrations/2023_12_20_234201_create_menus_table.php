<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('menus', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('description');
        $table->string('images');
        $table->unsignedBigInteger('categorie_id');
        $table->foreign('categorie_id')
        ->references('id')
        ->on('categories')
        ->onDelete('restrict')
        ->onUpdate('restrict');
        $table->decimal('price', 8, 2);
        $table->boolean('availability')->default(true);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
