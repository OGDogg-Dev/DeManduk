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
        if (! Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role', 32)
                    ->default('contributor')
                    ->after('password');
            });
        }

        if (! Schema::hasColumn('users', 'requires_approval')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('requires_approval')
                    ->default(false)
                    ->after('role');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'requires_approval')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('requires_approval');
            });
        }

        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
};

