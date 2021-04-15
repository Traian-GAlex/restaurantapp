<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeronsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("user_id")->unique();
            $table->string("image", 255)->nullable()->default('noimage.png');
            // first name , middle name, last name
            // date of birth, place of birth
            $table->string("first_name", 255)->nullable();
            $table->string("middle_name", 255)->nullable();
            $table->string("last_name", 255)->nullable();
            $table->date("date_of_birth", 255)->nullable();
            $table->string("place_of_birth", 255)->nullable();
            $table->timestamps();

            $table->foreign("user_id", "fk_user_person")
                ->references("id")
                ->on("users")
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("people", function (Blueprint $table){
            $table->dropForeign("fk_user_person");
        });
        Schema::dropIfExists('people');
    }
}
