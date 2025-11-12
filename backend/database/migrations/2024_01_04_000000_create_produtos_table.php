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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('codigo_sku')->unique();
            $table->text('descricao')->nullable();
            $table->foreignId('fornecedor_id')->nullable()->constrained('fornecedores')->nullOnDelete();
            $table->decimal('preco_custo', 10, 2);
            $table->decimal('preco_venda', 10, 2);
            $table->integer('estoque_minimo')->default(0);
            $table->integer('estoque_atual')->default(0);
            $table->string('unidade_medida', 10)->default('UN');
            $table->string('categoria')->nullable();
            $table->string('imagem')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};

