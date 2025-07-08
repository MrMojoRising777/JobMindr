<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->renameColumn('description', 'properties');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->longText('properties')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->renameColumn('properties', 'description');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
        });
    }
};
