<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index(['user_name', 'id', 'email', 'name']);
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->index(['id']);
        });
        Schema::table('jobs', function (Blueprint $table) {
            $table->index(['user_id', 'id', 'title', 'job_type_id', 'location_id']);
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->index(['id']);
        });
        Schema::table('skills', function (Blueprint $table) {
            $table->index(['id']);
        });
        Schema::table('locations', function (Blueprint $table) {
            $table->index(['id']);
        });
        Schema::table('applications', function (Blueprint $table) {
            $table->index(['id', 'user_id', 'job_id']);
        });
        Schema::table('job_types', function (Blueprint $table) {
            $table->index(['id']);
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
            $table->dropIndex(['user_name', 'id', 'email', 'name']);
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->dropIndex(['id']);
        });
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'id', 'title', 'job_type_id', 'location_id']);
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['id']);
        });
        Schema::table('skills', function (Blueprint $table) {
            $table->dropIndex(['id']);
        });
        Schema::table('locations', function (Blueprint $table) {
            $table->dropIndex(['id']);
        });
        Schema::table('applications', function (Blueprint $table) {
            $table->dropIndex(['id', 'user_id', 'job_id']);
        });
        Schema::table('job_types', function (Blueprint $table) {
            $table->dropIndex(['id']);
        });
    }
}
