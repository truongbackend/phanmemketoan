<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->text('note');
            $table->decimal('price', 10, 2); // Dùng decimal để lưu giá trị tiền tệ
            $table->decimal('discould', 5, 2); // Dùng decimal cho giảm giá (nếu có)
            $table->boolean('status')->default(1); // Trạng thái mặc định = 1
            $table->string('expiration_time');
            $table->string('user_create');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package');
    }
};
