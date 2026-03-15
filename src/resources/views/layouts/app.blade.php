<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Chamados') — Sistema de Chamados</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-gray-900 text-white px-6 py-4 flex items-center gap-6">
        <span class="font-bold text-lg tracking-wide">🎫 Chamados</span>
        <a href="{{ route('chamados.index') }}" class="hover:text-blue-400 transition">Chamados</a>
        <a href="{{ route('tecnicos.index') }}" class="hover:text-blue-400 transition">Técnicos</a>
        <a href="{{ route('categorias.index') }}" class="hover:text-blue-400 transition">Categorias</a>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">

        @if(session('ok'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                {{ session('ok') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
