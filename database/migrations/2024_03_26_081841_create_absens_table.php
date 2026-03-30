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

        Schema::create('absens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staf_id')->constrained()->onDelete('cascade');
            $table->foreignId('tapel_id')->constrained()->onDelete('cascade');
            $table->enum('status', ["h","i","s","a"]);
            $table->enum('type', ["masuk","pulang"]);
            $table->date('tanggal');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absens');
    }
};
