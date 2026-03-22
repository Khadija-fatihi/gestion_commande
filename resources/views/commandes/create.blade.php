@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Ajouter une commande</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="post" action="{{ route('commandes.store') }}">
                @include('commandes._form', ['submitLabel' => 'Enregistrer'])
            </form>
        </div>
    </div>
@endsection
