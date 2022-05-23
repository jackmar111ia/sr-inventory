<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->string('pic_thumb',250)->nullable();
            $table->string('pic_large',250)->nullable();
            $table->string('product_name',250);
            $table->text('description');
            $table->string('sku',250);
            $table->string('certification',250)->nullable();
            $table->string('case_qty',250)->nullable();
            $table->smallInteger('product_type_id')->comment("simple,variable");
            $table->float('regular_price')->unsigned()->nullable();
            $table->float('ontario_price')->unsigned()->nullable();
            $table->float('canada_price')->unsigned()->nullable();
            $table->float('wb_price')->unsigned()->nullable();
            $table->text('variable_product_price')->nullable();
            $table->string('product_add_type',15)->nullable()->comment("manual,from_sr");
            $table->bigInteger('product_sr_id')->unsigned()->nullable();
            $table->text('supplier_sku')->nullable();
            $table->text('supplier_description')->nullable();
            $table->integer('inhouse_qty')->unsigned()->nullable();
            $table->integer('sold_qty')->unsigned()->nullable();
            $table->integer('aviable_qty')->unsigned()->nullable();
            $table->integer('added_by')->unsigned()->nullable();
            $table->integer('modified_by')->unsigned()->nullable();
            $table->text('modified_history')->nullable();
            $table->string('indication_color',250)->nullable();
            $table->smallInteger('indication_row_qty')->nullable();
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
        Schema::dropIfExists('products');
    }
}
