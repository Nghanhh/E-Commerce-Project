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
        Schema::create('history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user');
            $table->text('name');
            $table->decimal('price', 10, 5);
            $table->unsignedBigInteger('id_category');
            $table->unsignedBigInteger('id_brand');
            $table->integer('status')->default(1);
            $table->integer('sale')->default(0)->comment('Sale percentage (0-100)');
            $table->string('company');
            $table->text('images');
            $table->text('detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
