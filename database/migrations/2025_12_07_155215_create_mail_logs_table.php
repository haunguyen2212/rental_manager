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
        Schema::create('mail_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->dateTime('send_date');
            $table->string('from_email', 200);
            $table->string('from_name', 200)->nullable();
            $table->string('to_email', 200);
            $table->string('to_name', 200)->nullable();
            $table->string('subject')->nullable();
            $table->text('body')->nullable();
            $table->integer('status')->nullable();
            $table->text('error_message')->nullable();
            $table->string('template')->nullable();
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
        Schema::dropIfExists('mail_logs');
    }
};
