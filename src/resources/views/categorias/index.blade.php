@extends('layouts.app')

@section('title', 'Categorias')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Categorias</h1>
    <a href="{{ route('categorias.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
        + Nova Categoria
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Nome</th>
                <th class="px-4 py-3 text-left">SLA (horas)</th>
                <th class="px-4 py-3 text-left">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($categorias as $categoria)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-400">{{ $categoria->id }}</td>
                <td class="px-4 py-3 font-medium text-gray-800">{{ $categoria->nome }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $categoria->sla_horas }}h</td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('categorias.edit', $categoria) }}" class="text-yellow-600 hover:underline">Editar</a>
                    <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" onsubmit="return confirm('Remover categoria?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Remover</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-4 py-8 text-center text-gray-400">Nenhuma categoria cadastrada.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
