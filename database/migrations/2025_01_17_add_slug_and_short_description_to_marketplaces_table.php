<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('marketplaces', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
            $table->string('short_description')->nullable()->after('description');
        });
    }

    public function down()
    {
        Schema::table('marketplace_adds', function (Blueprint $table) {
            $table->dropColumn(['slug', 'short_description']);
        });
    }
}; 