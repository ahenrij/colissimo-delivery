<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date');
            $table->integer('order_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('restrict');
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
        Schema::table('histories', function(Blueprint $table) {
            $table->dropForeign('histories_order_id_foreign');
            $table->dropForeign('histories_status_id_foreign');
        });
        Schema::dropIfExists('histories');
    }
}
