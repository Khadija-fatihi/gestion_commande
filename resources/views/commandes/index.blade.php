@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Liste des commandes</h1>
        <a class="btn btn-primary" href="{{ route('commandes.create') }}">Nouvelle commande</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Total</th>
                    <th>Details</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($commandes as $commande)
                    <tr>
                        <td>{{ $commande->id }}</td>
                        <td>{{ $commande->client->nom }}</td>
                        <td>{{ $commande->date_commande->format('d/m/Y') }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $commande->statut)) }}</span></td>
                        <td>{{ number_format($commande->total, 2, ',', ' ') }} DH</td>
                        <td>
                            @foreach($commande->details as $detail)
                                <div class="small">{{ $detail->produit->nom }} x {{ $detail->quantite }}</div>
                            @endforeach
                        </td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-info" href="{{ route('commandes.show', $commande) }}">Voir</a>
                            <a class="btn btn-sm btn-warning" href="{{ route('commandes.edit', $commande) }}">Modifier</a>
                            <a class="btn btn-sm btn-danger" href="{{ route('commandes.confirm-delete', $commande) }}">Supprimer</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-4">Aucune commande.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $commandes->links() }}
    </div>
@endsection
