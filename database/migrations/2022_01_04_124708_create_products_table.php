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
            $table->id();
            $table->string('city_id');
            $table->string('district_id');
            $table->string('ward_id');
            $table->integer('room_count')->nullable();
            $table->integer('is_invalid')->nullable();
            $table->integer('floor_count')->nullable();
            $table->integer('area')->nullable();
            $table->bigInteger('project_id')->unsigned()->index()->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->bigInteger('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->bigInteger('manager_id')->unsigned()->index();
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('description');
            $table->integer('room_price');
            $table->integer('water_price')->nullable();
            $table->integer('electricity_price')->nullable();
            $table->integer('status')->default(1);
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
