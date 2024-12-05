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
        Schema::create('historique_movement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produit_id');
            $table->enum('type', ['entree', 'sortie', 'ajustement']);
            $table->integer('quantite');
            $table->string('utilisateur');
            $table->timestamp('date_mouvement')->nullable(); // Explicitly define date_mouvement
            $table->boolean('valide')->default(false);
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_movement');
    }
};
