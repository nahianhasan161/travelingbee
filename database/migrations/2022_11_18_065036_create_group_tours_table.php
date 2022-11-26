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
        Schema::create('group_tours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('division');
            $table->string('district');
            $table->string('area');
            $table->string('place');
            $table->string('feature_image')->nullable();
            $table->integer('day');
            $table->integer('person');
            $table->integer('price');
            $table->integer('rating');
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
        Schema::dropIfExists('group_tours');
    }
};
