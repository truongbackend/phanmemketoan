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
            Schema::create('notification_user', function (Blueprint $table) {
                $table->id();
                $table->foreignId('notification_id')
                    ->constrained('custom_notifications')
                    ->cascadeOnDelete();
                $table->foreignId('user_id')
                    ->constrained()
                    ->cascadeOnDelete();
                $table->timestamp('read_at')->nullable();
                $table->timestamps();

                $table->unique(['notification_id','user_id']);
            });
        }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_user');
    }
};
