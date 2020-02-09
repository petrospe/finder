<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('attribute_id')->nullable();
            $table->bigInteger('parent_id');
            $table->unsignedInteger('display_order')->nullable();
            $table->text('row_value');
            $table->unsignedbigInteger('status_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('entities', function(Blueprint $table) {
            $table->foreign('attribute_id')->references('id')->on('attributes');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entities');
    }
}
