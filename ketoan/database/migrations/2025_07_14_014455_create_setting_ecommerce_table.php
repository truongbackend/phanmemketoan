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
        Schema::create('setting_account_ecommerce', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('interpretation')->nullable();
            $table->string('added_tax_vat')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('account_capital_price')->nullable();
            $table->string('account_warehouse')->nullable();
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_ecommerce');
    }
};
