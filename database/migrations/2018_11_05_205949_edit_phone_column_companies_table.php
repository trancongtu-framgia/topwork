<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPhoneColumnCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->longText('description')->nullable()->change();
            $table->string('phone')->nullable()->change();
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->date('dob')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->longText('description')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->date('dob')->nullable(false)->change();
        });
    }
}
