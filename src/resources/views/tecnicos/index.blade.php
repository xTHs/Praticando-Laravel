@extends('layouts.app')

@section('title', 'Técnicos')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Técnicos</h1>
    <a href="{{ route('tecnicos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
        + Novo Técnico
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Nome</th>
                <th class="px-4 py-3 text-left">Email</th>
                <th class="px-4 py-3 text-left">Especialidade</th>
                <th class="px-4 py-3 text-left">Chamados</th>
                <th class="px-4 py-3 text-left">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($tecnicos as $tecnico)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-400">{{ $tecnico->id }}</td>
                <td class="px-4 py-3 font-medium text-gray-800">{{ $tecnico->nome }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $tecnico->email }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $tecnico->especialidade }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $tecnico->chamados_count ?? $tecnico->chamados->count() }}</td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('tecnicos.edit', $tecnico) }}" class="text-yellow-600 hover:underline">Editar</a>
                    <form method="POST" action="{{ route('tecnicos.destroy', $tecnico) }}" onsubmit="return confirm('Remover técnico?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Remover</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-8 text-center text-gray-400">Nenhum técnico cadastrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
