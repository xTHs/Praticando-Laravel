@extends('layouts.app')

@section('title', 'Novo Chamado')

@section('content')

<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Novo Chamado</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('chamados.store') }}">
            @csrf
            @include('chamados._form')
            <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded transition">
                    Abrir Chamado
                </button>
                <a href="{{ route('chamados.index') }}" class="text-gray-500 hover:underline py-2">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection
