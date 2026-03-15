<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
        <input type="text" name="nome" value="{{ old('nome', $categoria->nome ?? '') }}"
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">SLA (horas)</label>
        <input type="number" name="sla_horas" value="{{ old('sla_horas', $categoria->sla_horas ?? '') }}" min="1"
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
</div>
