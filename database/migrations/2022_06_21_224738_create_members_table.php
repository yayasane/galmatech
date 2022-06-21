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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 30);
            $table->string('title', 30);
            $table->string('title_en', 30);
            $table->string('description', 150);
            $table->string('description_en', 150);
            $table->string('picture', 255);
            $table->string('address', 150);
            $table->string('facebook', 50)->nullable();
            $table->string('instagram', 50)->nullable();
            $table->string('twiiter', 50)->nullable();
            $table->string('linkedin', 50)->nullable();
            $table->foreignId('app_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('created_by_user_id');
            $table->unsignedBigInteger('updated_by_user_id');
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
        Schema::dropIfExists('members');
    }
};
