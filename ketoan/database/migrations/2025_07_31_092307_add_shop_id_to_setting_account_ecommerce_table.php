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
        Schema::table('setting_account_ecommerce', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->nullable()->after('user_id');

            // Nếu bạn muốn tạo ràng buộc foreign key:
            $table->foreign('shop_id')
                  ->references('id')
                  ->on('lazada_shop_tokens')
                  ->onDelete('set null');
            $table->string('type')->default('lazada')->after('shop_id');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting_account_ecommerce', function (Blueprint $table) {
            $table->dropForeign(['shop_id']);
            $table->dropColumn('shop_id');
        });
    }
};
