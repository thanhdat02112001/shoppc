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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId("category_id")->references("id")->on("categories");
            $table->foreignId('brand_id')->references('id')->on("brands");
        });
        Schema::table("comment",function(Blueprint $table){
            
            $table->foreignId("comment_user_id")->references("id")->on("users");
            $table->foreignId("comment_product_id")->references("id")->on("products");

        });
        Schema::table("orders",function(Blueprint $table){
            $table->foreignId("order_shipping_id")->references("id")->on("shipping");
        });

        Schema::table("rates", function(Blueprint $table){
            $table->foreignId("rate_user_id")->references("id")->on("users");
            $table->foreignId("rate_product_id")->references("id")->on("products");
        });

        Schema::table("shipping", function(Blueprint $table){
            $table->foreignId("shipping_user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('categories_category_id_foreign');
            $table->dropColumn('category_id');
            $table->dropForeign('brands_brand_id_foreign');
            $table->dropColumn('brand_id');

        });
        Schema::table("comment",function(Blueprint $table){
        
            $table->dropForeign("users_comment_user_id_foreign");
            $table->dropColumn("comment_user_id");
            $table->dropForeign("products_comment_product_id_foreign");
            $table->dropColumn("comment_product_id");
        });
        Schema::table("orders",function(Blueprint $table){
            $table->dropForeign("shipping_order_shipping_id_foreign");
            $table->dropColumn("order_shipping_id");
        });
        Schema::table("rates", function(Blueprint $table){
            $table->dropForeign("users_rate_user_id_foreign");
            $table->dropColumn("rate_user_id");
            $table->dropForeign("products_rate_product_id_foreign");
            $table->dropColumn("rate_product_id");
        });

        Schema::table("shipping", function(Blueprint $table){;
            $table->dropForeign("users_shipping_user_id_foreign");
            $table->dropColumn("shipping_user_id");
        });
    }
};
