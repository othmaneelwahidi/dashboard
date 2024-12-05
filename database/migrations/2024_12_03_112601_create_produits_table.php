<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('catégorie');
            $table->string('sous_catégorie')->unique();
            $table->string('nom');
            $table->text('description');
            $table->string('sku');
            $table->string('code_barre');
            $table->decimal('prix', 10, 2);
            $table->integer('quantité_minimale');
            $table->integer('quantité_maximale');
            $table->string('fournisseur');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
