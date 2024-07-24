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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id')->nullable(true)->default(null);
            $table->string('username')->unique();
            $table->string('fullname')->default('');
            $table->string('password')->default('');
            $table->boolean('active')->default(false);
            $table->string('remember_token')->default('');
            $table->unsignedTinyInteger('role')->default(0);

            $table->datetime('created_datetime')->nullable()->default(null);
            $table->datetime('updated_datetime')->nullable()->default(null);
            $table->unsignedBigInteger('created_by_uid')->nullable()->default(null);
            $table->unsignedBigInteger('updated_by_uid')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
