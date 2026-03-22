@extends('layouts.app')

@section('content')
    <div class="card shadow-sm border-danger">
        <div class="card-body">
            <h1 class="h4 text-danger">Confirmer la suppression</h1>
            <p>Voulez-vous vraiment supprimer la commande #{{ $commande->id }} du client <strong>{{ $commande->client->nom }}</strong> ?</p>
            <form method="post" action="{{ route('commandes.destroy', $commande) }}" class="d-flex gap-2">
                @csrf
                @method('delete')
                <a href="{{ route('commandes.index') }}" class="btn btn-secondary">Annuler</a>
                <button class="btn btn-danger" type="submit">Confirmer la suppression</button>
            </form>
        </div>
    </div>
@endsection
