<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Gestion Commandes' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('commandes.index') }}">{{ config('app.name') }}</a>
        @auth
            <div class="d-flex gap-3 align-items-center text-white">
                <span>{{ auth()->user()->name }}</span>
                <a class="btn btn-sm btn-outline-light" href="{{ route('commandes.stats') }}">Statistiques</a>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-warning" type="submit">Deconnexion</button>
                </form>
            </div>
        @endauth
    </div>
</nav>

<main class="container pb-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
