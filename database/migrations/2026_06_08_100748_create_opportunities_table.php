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
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('secteur')->nullable();
            $table->string('type')->nullable();
            $table->string('niveau')->nullable();
            $table->string('profil_requis')->nullable();
            $table->string('ville')->nullable();
            foreignId('secteur_id')->nullable()->constrained('secteurs')->onDelete('set null');
            foreignId('type_id')->nullable()->constrained('types')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
