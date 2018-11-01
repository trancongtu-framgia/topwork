<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCandidateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('avatar_url')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->longText('description')->nullable()->change();
            $table->longText('experience')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('avatar_url')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->longText('description')->nullable(false)->change();
            $table->longText('experience')->nullable(false)->change();
        });
    }
}
