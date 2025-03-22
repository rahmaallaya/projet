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
        Schema::create('prestataires', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['super_admin', 'individu', 'entreprise']);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('id_categorie')->nullable();
            $table->enum('isConfirmed', ['active', 'desactive'])->default('desactive');
            $table->timestamps();
            $table->string('image')->nullable();
            $table->text('description');
            $table->foreign('id_categorie')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestataires');
    }
};
