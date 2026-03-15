@extends('layouts.app')

@section('title', 'Editar Chamado')

@section('content')

<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Chamado #{{ $chamado->id }}</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('chamados.update', $chamado) }}">
            @csrf @method('PUT')
            @include('chamados._form')
            <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded transition">
                    Salvar Alterações
                </button>
                <a href="{{ route('chamados.index') }}" class="text-gray-500 hover:underline py-2">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection
