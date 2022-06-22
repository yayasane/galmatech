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
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slogan', 150);
            $table->string('slogan_en', 150);
            $table->text('whoweare');
            $table->text('whoweare_en');
            $table->string('logo', 255);
            $table->string('email', 150);
            $table->string('address', 150);
            $table->string('phone_number', 20);
            $table->string('phone_number_two', 20);
            $table->string('facebook', 50);
            $table->string('website', 50);
            $table->string('instagram', 50);
            $table->string('twitter', 50)->nullable();
            $table->string('linkedin', 50)->nullable();
            $table->string('youtube', 50)->nullable();
            $table->text('email_sign')->nullable();
            $table->text('email_sign_en')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('app_infos');
    }
};
