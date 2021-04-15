<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name", 255)->unique();
            $table->text("description")->nullable();
            $table->boolean("prevent_deletion")->default(true);
            $table->boolean("visible2all")->default(false);
            $table->boolean("show2owner")->default(true);
            $table->timestamps();
        });

        // pass through table
        Schema::create("user_roles", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("role_id")->unsigned();
            $table->timestamps();
        });

        Schema::table("user_roles", function (Blueprint $table) {
            $table->foreign("user_id", "fk_users_user_roles")
                ->on("users")
                ->references("id")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("role_id", "fk_roles_user_roles")
                ->on("roles")
                ->references("id")
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
        Schema::table("user_roles", function (Blueprint $table) {
            $table->dropForeign("fk_users_user_roles");
            $table->dropForeign("fk_roles_user_roles");
        });
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('roles');
    }
}
