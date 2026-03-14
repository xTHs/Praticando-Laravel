<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use App\Models\Tecnico;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ChamadoController extends Controller
{
    public function index(Request $request)
    {
        $query = Chamado::with(['tecnico', 'categoria'])
            ->orderByRaw("FIELD(prioridade, 'alta', 'media', 'baixa')")
            ->orderBy('data_abertura', 'asc');

        if ($request->filled('prioridade')) {
            $query->where('prioridade', $request->prioridade);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('data_de')) {
            $query->whereDate('data_abertura', '>=', $request->data_de);
        }

        if ($request->filled('data_ate')) {
            $query->whereDate('data_abertura', '<=', $request->data_ate);
        }

        $chamados = $query->get();

        return view('chamados.index', compact('chamados'));
    }

    public function create()
    {
        $tecnicos   = Tecnico::orderBy('nome')->get();
        $categorias = Categoria::orderBy('nome')->get();
        return view('chamados.create', compact('tecnicos', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'       => ['required', 'string', 'max:150'],
            'descricao'    => ['required', 'string'],
            'prioridade'   => ['required', 'in:baixa,media,alta'],
            'tecnico_id'   => ['nullable', 'exists:tecnicos,id'],
            'categoria_id' => ['nullable', 'exists:categorias,id'],
        ]);

        Chamado::create(array_merge(
            $request->only('titulo', 'descricao', 'prioridade', 'tecnico_id', 'categoria_id'),
            ['status' => 'aberto', 'data_abertura' => now()]
        ));

        return redirect()->route('chamados.index')->with('ok', 'Chamado aberto!');
    }

    public function show(Chamado $chamado)
    {
        return view('chamados.show', compact('chamado'));
    }

    public function edit(Chamado $chamado)
    {
        $tecnicos   = Tecnico::orderBy('nome')->get();
        $categorias = Categoria::orderBy('nome')->get();
        return view('chamados.edit', compact('chamado', 'tecnicos', 'categorias'));
    }

    public function update(Request $request, Chamado $chamado)
    {
        $request->validate([
            'titulo'       => ['required', 'string', 'max:150'],
            'descricao'    => ['required', 'string'],
            'prioridade'   => ['required', 'in:baixa,media,alta'],
            'status'       => ['required', 'in:aberto,em_atendimento,resolvido,fechado'],
            'tecnico_id'   => ['nullable', 'exists:tecnicos,id'],
            'categoria_id' => ['nullable', 'exists:categorias,id'],
        ]);

        if ($request->status === 'fechado' && $chamado->status !== 'resolvido') {
            return back()->withErrors(['status' => 'O chamado só pode ser fechado se estiver resolvido.']);
        }

        $chamado->update($request->only('titulo', 'descricao', 'prioridade', 'status', 'tecnico_id', 'categoria_id'));

        return redirect()->route('chamados.index')->with('ok', 'Chamado atualizado!');
    }

    public function destroy(Chamado $chamado)
    {
        $chamado->delete();
        return redirect()->route('chamados.index')->with('ok', 'Chamado removido!');
    }
}
