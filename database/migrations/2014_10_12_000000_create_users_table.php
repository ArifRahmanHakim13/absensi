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
            $table->string('name');
            $table->enum('jk', ['laki-laki', 'perempuan']);
            $table->string('telepon')->nullable();
            $table->string('alamat')->nullable();
            $table->enum('role', ['admin', 'kapus', 'staf'])->default('staf');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('idt');
            $table->text('foto')->default('profile.jpg');
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
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
