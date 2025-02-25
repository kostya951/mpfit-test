<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->nullable(false);
            $table->foreignId('order_id')->nullable(false);
            $table->foreignId('product_id')->nullable(false);
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->unique(['order_id','product_id']);
        });

        DB::table('products_orders')->insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'quantity' => 1
            ],
            [
                'order_id' => 1,
                'product_id' => 2,
                'quantity' => 2
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints(true);
        Schema::dropIfExists('products_orders');
    }
};
