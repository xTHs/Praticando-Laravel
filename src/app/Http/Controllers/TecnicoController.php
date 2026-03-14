<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use Illuminate\Http\Request;

class TecnicoController extends Controller
{
    public function index()
    {
        $tecnicos = Tecnico::latest()->get();
        return view('tecnicos.index', compact('tecnicos'));
    }

    public function create()
    {
        return view('tecnicos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'         => ['required', 'string', 'max:100'],
            'email'        => ['required', 'email', 'unique:tecnicos'],
            'especialidade'=> ['required', 'string', 'max:100'],
        ]);

        Tecnico::create($request->only('nome', 'email', 'especialidade'));

        return redirect()->route('tecnicos.index')->with('ok', 'Técnico cadastrado!');
    }

    public function show(Tecnico $tecnico)
    {
        return view('tecnicos.show', compact('tecnico'));
    }

    public function edit(Tecnico $tecnico)
    {
        return view('tecnicos.edit', compact('tecnico'));
    }

    public function update(Request $request, Tecnico $tecnico)
    {
        $request->validate([
            'nome'         => ['required', 'string', 'max:100'],
            'email'        => ['required', 'email', 'unique:tecnicos,email,' . $tecnico->id],
            'especialidade'=> ['required', 'string', 'max:100'],
        ]);

        $tecnico->update($request->only('nome', 'email', 'especialidade'));

        return redirect()->route('tecnicos.index')->with('ok', 'Técnico atualizado!');
    }

    public function destroy(Tecnico $tecnico)
    {
        $tecnico->delete();
        return redirect()->route('tecnicos.index')->with('ok', 'Técnico removido!');
    }
}
