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
            $table->unsignedInteger('category_id')->nullable();
            $table->string('name', 200);
            $table->integer('type')->default(1)->comment('1:đơn,2:có biến thể');
            $table->string('slug', 200);
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('image', 500)->nullable();
            $table->integer('status')->default(0)->comment('0:nháp,1:chưa công khai,2:công khai,3:tạm ngưng');
            $table->dateTime('deleted_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
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
