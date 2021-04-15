<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationsForOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // orders users order_details menus order_payments order_tables

        // Schema::table('orders', function(Blueprint $table){
        //    // cannot have relation on users because the user id is not mandatory
        // });

        Schema::table('order_details', function(Blueprint $table){
            $table->foreign('order_id', 'fk_orders_order_details')
                ->references('id')
                ->on('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('item_id', 'fk_menus_order_details')
                ->references('id')
                ->on('menus')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::table('order_tables', function(Blueprint $table){
            $table->foreign('order_id', 'fk_orders_order_tables')
                ->references('id')
                ->on('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('table_id', 'fk_menus_order_tables')
                ->references('id')
                ->on('tables')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::table('order_payments', function(Blueprint $table){
            $table->foreign('order_id', 'fk_orders_order_payments')
                ->references('id')
                ->on('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('order_payments', function(Blueprint $table){
            // fk_orders_order_payments
            $table->dropForeign('fk_orders_order_payments');
        });

        Schema::table('order_tables', function(Blueprint $table){
            // fk_menus_order_tables
            $table->dropForeign('fk_menus_order_tables');
            // fk_orders_order_tables
            $table->dropForeign('fk_orders_order_tables');
        });

        Schema::table('order_details', function(Blueprint $table){
            // fk_menus_order_details
            $table->dropForeign('fk_menus_order_details');
            // fk_orders_order_details
            $table->dropForeign('fk_orders_order_details');
        });

            // Schema::table('orders', function(Blueprint $table){});
    }
}
