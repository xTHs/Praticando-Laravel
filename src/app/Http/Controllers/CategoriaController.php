<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::latest()->get();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'      => ['required', 'string', 'max:100'],
            'sla_horas' => ['required', 'integer', 'min:1'],
        ]);

        Categoria::create($request->only('nome', 'sla_horas'));

        return redirect()->route('categorias.index')->with('ok', 'Categoria cadastrada!');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome'      => ['required', 'string', 'max:100'],
            'sla_horas' => ['required', 'integer', 'min:1'],
        ]);

        $categoria->update($request->only('nome', 'sla_horas'));

        return redirect()->route('categorias.index')->with('ok', 'Categoria atualizada!');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')->with('ok', 'Categoria removida!');
    }
}
