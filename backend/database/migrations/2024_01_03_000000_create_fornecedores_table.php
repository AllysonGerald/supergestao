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
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cnpj', 18)->unique();
            $table->string('razao_social');
            $table->string('email')->unique();
            $table->string('telefone', 20);
            $table->string('celular', 20)->nullable();
            $table->string('cep', 9);
            $table->string('endereco');
            $table->string('numero', 10);
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado', 2);
            $table->string('contato_nome')->nullable();
            $table->text('observacoes')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedores');
    }
};

