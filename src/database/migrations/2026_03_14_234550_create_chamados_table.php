<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->enum('prioridade', ['baixa', 'media', 'alta'])->default('baixa');
            $table->enum('status', ['aberto', 'em_atendimento', 'resolvido', 'fechado'])->default('aberto');
            $table->timestamp('data_abertura')->useCurrent();
            $table->foreignId('tecnico_id')->nullable()->constrained('tecnicos')->nullOnDelete();
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chamados');
    }
};
