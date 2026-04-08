<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::create('foods', function (Blueprint $table) {
        $table->id();
        $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
        $table->string('name');
        $table->text('description')->nullable();
        $table->decimal('original_price', 10, 2);
        $table->decimal('discount_price', 10, 2);
        $table->integer('stock');
        $table->time('pickup_time_start');
        $table->time('pickup_time_end');
        $table->enum('status', ['available', 'sold_out'])->default('available');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
