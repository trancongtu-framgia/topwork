<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersAdminsCompaniesCandidatesTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name');
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->string('name');
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->string('name');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->string('name');
        });
    }
}
