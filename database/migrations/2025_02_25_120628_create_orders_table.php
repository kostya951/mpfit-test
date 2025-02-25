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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('fio')->nullable(false);
            $table->dateTime('date')->nullable(false);
            $table->foreignId('status_id')->nullable(false)->default(1);
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses');
        });

        DB::table('statuses')->insert([
            ['name'=>'Новый'],
            ['name'=>'Выполнен']
        ]);

        DB::table('orders')->insert([
            [
                'id'=>1,
                'fio'=>'Бронштейн Константин Павлович',
                'date' => (new DateTime())->format('Y-m-d h:i:s'),
                'status_id' => 1
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints(true);
        Schema::dropIfExists('orders');
        Schema::dropIfExists('statuses');
    }
};
