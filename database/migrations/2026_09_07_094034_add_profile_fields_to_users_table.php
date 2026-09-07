<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('users', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable()->after('gender');
            }
            if (!Schema::hasColumn('users', 'height')) {
                $table->integer('height')->nullable()->after('date_of_birth');
            }
            if (!Schema::hasColumn('users', 'weight')) {
                $table->integer('weight')->nullable()->after('height');
            }
            if (!Schema::hasColumn('users', 'fitness_goal')) {
                $table->string('fitness_goal')->nullable()->after('weight');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('user')->after('fitness_goal');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'gender',
                'date_of_birth',
                'height',
                'weight',
                'fitness_goal',
                'role',
            ]);
        });
    }
};