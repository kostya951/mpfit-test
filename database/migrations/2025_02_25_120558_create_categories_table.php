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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable(false);
        });

        DB::table('categories')->insert([
            [
                'name' => 'Лёгкий'
            ],
            [
                'name' => 'Хрупкий'
            ],
            [
                'name' => 'Тяжёлый'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints(true);
        Schema::dropIfExists('categories');
    }
};
