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
        Schema::disableForeignKeyConstraints();

        Schema::create('tapels', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->enum('semester', ["1","2"]);
            $table->date('mulai');
            $table->date('selesai');
            $table->boolean('is_aktif')->default(false);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tapels');
    }
};
