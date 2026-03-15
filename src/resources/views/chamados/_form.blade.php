@php $editando = isset($chamado); @endphp

<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
        <input type="text" name="titulo" value="{{ old('titulo', $chamado->titulo ?? '') }}"
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
        <textarea name="descricao" rows="4"
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('descricao', $chamado->descricao ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Prioridade</label>
            <select name="prioridade" class="w-full border rounded px-3 py-2">
                @foreach(['baixa' => 'Baixa', 'media' => 'Média', 'alta' => 'Alta'] as $val => $label)
                    <option value="{{ $val }}" {{ old('prioridade', $chamado->prioridade ?? '') === $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        @if($editando)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                @foreach(['aberto' => 'Aberto', 'em_atendimento' => 'Em Atendimento', 'resolvido' => 'Resolvido', 'fechado' => 'Fechado'] as $val => $label)
                    <option value="{{ $val }}" {{ old('status', $chamado->status) === $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
        @endif
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Técnico</label>
            <select name="tecnico_id" class="w-full border rounded px-3 py-2">
                <option value="">— Sem técnico —</option>
                @foreach($tecnicos as $tecnico)
                    <option value="{{ $tecnico->id }}" {{ old('tecnico_id', $chamado->tecnico_id ?? '') == $tecnico->id ? 'selected' : '' }}>
                        {{ $tecnico->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
            <select name="categoria_id" class="w-full border rounded px-3 py-2">
                <option value="">— Sem categoria —</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_id', $chamado->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nome }} (SLA: {{ $categoria->sla_horas }}h)
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
