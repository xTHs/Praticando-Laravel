@extends('layouts.app')

@section('title', 'Chamado #' . $chamado->id)

@section('content')

@php
    $prioridadeClasses = [
        'alta'  => 'bg-red-100 text-red-700',
        'media' => 'bg-yellow-100 text-yellow-700',
        'baixa' => 'bg-green-100 text-green-700',
    ];
    $statusClasses = [
        'aberto'         => 'bg-blue-100 text-blue-700',
        'em_atendimento' => 'bg-orange-100 text-orange-700',
        'resolvido'      => 'bg-green-100 text-green-700',
        'fechado'        => 'bg-gray-100 text-gray-600',
    ];
@endphp

<div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Chamado #{{ $chamado->id }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('chamados.edit', $chamado) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded transition text-sm">
                Editar
            </a>
            <a href="{{ route('chamados.index') }}" class="text-gray-500 hover:underline text-sm py-2">Voltar</a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <div>
            <p class="text-xs text-gray-400 uppercase mb-1">Título</p>
            <p class="text-gray-800 font-medium text-lg">{{ $chamado->titulo }}</p>
        </div>

        <div>
            <p class="text-xs text-gray-400 uppercase mb-1">Descrição</p>
            <p class="text-gray-700 whitespace-pre-line">{{ $chamado->descricao }}</p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-xs text-gray-400 uppercase mb-1">Prioridade</p>
                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $prioridadeClasses[$chamado->prioridade] }}">
                    {{ ucfirst($chamado->prioridade === 'media' ? 'Média' : $chamado->prioridade) }}
                </span>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase mb-1">Status</p>
                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusClasses[$chamado->status] }}">
                    {{ ucfirst(str_replace('_', ' ', $chamado->status)) }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-xs text-gray-400 uppercase mb-1">Técnico</p>
                <p class="text-gray-700">{{ $chamado->tecnico?->nome ?? '—' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase mb-1">Categoria</p>
                <p class="text-gray-700">{{ $chamado->categoria?->nome ?? '—' }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-xs text-gray-400 uppercase mb-1">Data de Abertura</p>
                <p class="text-gray-700">{{ $chamado->data_abertura->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase mb-1">Última Atualização</p>
                <p class="text-gray-700">{{ $chamado->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        @if($chamado->isSlaEstourado())
        <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded">
            SLA estourado! Prazo era de {{ $chamado->categoria->sla_horas }}h após a abertura.
        </div>
        @endif
    </div>
</div>

@endsection
