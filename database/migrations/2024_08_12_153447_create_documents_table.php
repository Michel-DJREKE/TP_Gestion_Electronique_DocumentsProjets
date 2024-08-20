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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('chemin');
            $table->date('date_creation');
            $table->string('auteur');
            $table->date('date_derniere_modification')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('dernier_utilisateur_modification')->nullable();
            $table->text('historique_actions')->nullable();
            $table->timestamps();


            $table->foreign('dernier_utilisateur_modification')
            ->references('id')->on('users')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
