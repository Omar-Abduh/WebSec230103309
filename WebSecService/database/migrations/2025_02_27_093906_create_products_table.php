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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 64)->unique(); // 'code' column with a maximum length of 64 characters
            $table->string('name', 256); // 'name' column with a maximum length of 256 characters
            $table->unsignedBigInteger('price'); // 'price' column as an unsigned big integer
            $table->unsignedBigInteger('amount'); // 'price' column as an unsigned big integer
            $table->string('model', 128); // 'model' column with a maximum length of 128 characters
            $table->text('description')->nullable(); // 'description' column that can store longer text and can be null
            $table->string('photo', 128)->nullable(); // 'photo' column with a maximum length of 128 characters and can be null
            $table->timestamps();
            $table->softDeletes(); // This will create a 'deleted_at' column for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
