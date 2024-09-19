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
        Schema::create('iklan_dalams', function (Blueprint $table) {
            $table->id();
            $table->string('foto');
            $table->string('video');
            $table->string('link');
            $table->string('link2');
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->unsignedBigInteger('program_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iklan_dalams');
    }
};
