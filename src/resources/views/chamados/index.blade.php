@extends('layouts.app')

@section('title', 'Chamados')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Chamados</h1>
    <a href="{{ route('chamados.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
        + Novo Chamado
    </a>
</div>

<form method="GET" action="{{ route('chamados.index') }}" class="bg-white rounded-lg shadow p-4 mb-6 flex flex-wrap gap-4 items-end">
    <div>
        <label class="block text-sm text-gray-600 mb-1">Prioridade</label>
        <select name="prioridade" class="border rounded px-3 py-2 text-sm">
            <option value="">Todas</option>
            <option value="alta"  {{ request('prioridade') === 'alta'  ? 'selected' : '' }}>Alta</option>
            <option value="media" {{ request('prioridade') === 'media' ? 'selected' : '' }}>Média</option>
            <option value="baixa" {{ request('prioridade') === 'baixa' ? 'selected' : '' }}>Baixa</option>
        </select>
    </div>
    <div>
        <label class="block text-sm text-gray-600 mb-1">Status</label>
        <select name="status" class="border rounded px-3 py-2 text-sm">
            <option value="">Todos</option>
            <option value="aberto"         {{ request('status') === 'aberto'         ? 'selected' : '' }}>Aberto</option>
            <option value="em_atendimento" {{ request('status') === 'em_atendimento' ? 'selected' : '' }}>Em Atendimento</option>
            <option value="resolvido"      {{ request('status') === 'resolvido'      ? 'selected' : '' }}>Resolvido</option>
            <option value="fechado"        {{ request('status') === 'fechado'        ? 'selected' : '' }}>Fechado</option>
        </select>
    </div>
    <div>
        <label class="block text-sm text-gray-600 mb-1">Abertura de</label>
        <input type="date" name="data_de" value="{{ request('data_de') }}" class="border rounded px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm text-gray-600 mb-1">Abertura até</label>
        <input type="date" name="data_ate" value="{{ request('data_ate') }}" class="border rounded px-3 py-2 text-sm">
    </div>
    <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded text-sm transition">Filtrar</button>
    <a href="{{ route('chamados.index') }}" class="text-sm text-gray-500 hover:underline py-2">Limpar</a>
</form>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Título</th>
                <th class="px-4 py-3 text-left">Prioridade</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Categoria</th>
                <th class="px-4 py-3 text-left">Técnico</th>
                <th class="px-4 py-3 text-left">Abertura</th>
                <th class="px-4 py-3 text-left">SLA</th>
                <th class="px-4 py-3 text-left">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($chamados as $chamado)
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
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-400">{{ $chamado->id }}</td>
                <td class="px-4 py-3 font-medium text-gray-800">{{ $chamado->titulo }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $prioridadeClasses[$chamado->prioridade] }}">
                        {{ ucfirst($chamado->prioridade === 'media' ? 'Média' : $chamado->prioridade) }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusClasses[$chamado->status] }}">
                        {{ ucfirst(str_replace('_', ' ', $chamado->status)) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-gray-600">{{ $chamado->categoria?->nome ?? '—' }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $chamado->tecnico?->nome ?? '—' }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $chamado->data_abertura->format('d/m/Y H:i') }}</td>
                <td class="px-4 py-3">
                    @if($chamado->isSlaEstourado())
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Estourado</span>
                    @else
                        <span class="text-gray-400 text-xs">OK</span>
                    @endif
                </td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('chamados.show', $chamado) }}" class="text-blue-600 hover:underline">Ver</a>
                    <a href="{{ route('chamados.edit', $chamado) }}" class="text-yellow-600 hover:underline">Editar</a>
                    <form method="POST" action="{{ route('chamados.destroy', $chamado) }}" onsubmit="return confirm('Remover chamado?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Remover</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="px-4 py-8 text-center text-gray-400">Nenhum chamado encontrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
