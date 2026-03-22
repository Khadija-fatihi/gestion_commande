@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Modifier commande #{{ $commande->id }}</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="post" action="{{ route('commandes.update', $commande) }}">
                @method('put')
                @include('commandes._form', ['submitLabel' => 'Mettre a jour'])
            </form>
        </div>
    </div>
@endsection
