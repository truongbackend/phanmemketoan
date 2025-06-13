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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('market_code');
            $table->string('accounting_system_code');
            $table->string('product_name');
            $table->string('unit');
            $table->decimal('tax_rate', 5, 2);
            $table->string('combo_detail_code')->nullable();
            $table->string('combo_name')->nullable();
            $table->string('combo_unit')->nullable();
            $table->float('quantity')->default(1);
            $table->string('user_id');
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
        Schema::dropIfExists('product');
    }
};
