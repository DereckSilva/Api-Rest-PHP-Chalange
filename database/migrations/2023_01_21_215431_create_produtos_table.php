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
        Schema::create('produtos', function (Blueprint $table) {
            $table->string('code')->primary();
            $table->dateTime('imported_t');
            $table->enum('status', ['draft', 'trash', 'published']);
            $table->string('url', 155);
            $table->string('creator');
            $table->string('created_t');
            $table->string('last_modified_t');
            $table->string('product_name');
            $table->string('quantity')->nullable();
            $table->string('brands')->nullable();
            $table->string('categories')->nullable();
            $table->string('labels')->nullable();
            $table->string('cities')->nullable();
            $table->string('purchase_places')->nullable();
            $table->string('stores')->nullable();
            $table->text('ingredients_text')->nullable();
            $table->text('traces')->nullable();
            $table->string('serving_size')->nullable();
            $table->integer('serving_quantity')->default(0.00)->nullable();
            $table->integer('nutriscore_score')->default(0)->nullable();
            $table->char('nutriscore_grade')->nullable();
            $table->string('main_category')->nullable();
            $table->string('image_url', 100);
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
        Schema::dropIfExists('produtos');
    }
};
