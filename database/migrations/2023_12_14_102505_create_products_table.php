<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12);
            $table->string('category', 40);
            $table->string('name', 100);
            $table->string('description')->nullable();
            $table->decimal('selling_price', 13, 2);
            $table->decimal('special_price', 13, 2)->nullable();
            $table->boolean('status')->default(1)->comment("1=Draft|2=Published|3=Out of Stock");
            $table->boolean('is_delivery_available')->default(1)->comment("1=yes;2=no");
            $table->string('image_path', 100);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
