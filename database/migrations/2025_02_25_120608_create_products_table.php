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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable(false);
            $table->text('description');
            $table->decimal('price',16,2)->nullable(false);
            $table->foreignId('category_id')->nullable(true);
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });

        DB::table('products')->insert([
            [
                'name' => 'Тестовый продукт 1',
                'description' => 'Описание',
                'price' => 20.01,
                'category_id' => 1,
            ],
            [
                'name' => 'Тестовый продукт 2',
                'description' => 'Описание',
                'price' => 20.01,
                'category_id' => 2,
            ],
            [
                'name' => 'Тестовый продукт 3',
                'description' => 'Описание',
                'price' => 20.01,
                'category_id' => 3,
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints(true);
        Schema::dropIfExists('products');
    }
};
