@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3">Commande #{{ $commande->id }}</h1>
        <div class="d-flex gap-2">
            <a class="btn btn-success" href="{{ route('commandes.add-product-form', $commande) }}">Ajouter produit</a>
            <a class="btn btn-warning" href="{{ route('commandes.edit', $commande) }}">Modifier</a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="mb-1"><strong>Client:</strong> {{ $commande->client->nom }}</p>
                    <p class="mb-1"><strong>Date:</strong> {{ $commande->date_commande->format('d/m/Y') }}</p>
                    <p class="mb-1"><strong>Statut:</strong> {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}</p>
                    <p class="mb-0"><strong>Total:</strong> {{ number_format($commande->total, 2, ',', ' ') }} DH</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5">Historique</h2>
                    @forelse($commande->historiques as $historique)
                        <div class="small mb-1">
                            {{ $historique->created_at->format('d/m/Y H:i') }} -
                            {{ $historique->action }} -
                            {{ $historique->user?->name ?? 'Systeme' }}
                        </div>
                    @empty
                        <p class="small text-muted mb-0">Aucun historique.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <h2 class="h5">Produits</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>Produit</th>
                    <th>Qte</th>
                    <th>PU</th>
                    <th>Sous-total</th>
                </tr>
                </thead>
                <tbody>
                @forelse($commande->details as $detail)
                    <tr>
                        <td>{{ $detail->produit->nom }}</td>
                        <td>{{ $detail->quantite }}</td>
                        <td>{{ number_format($detail->prix_unitaire, 2, ',', ' ') }} DH</td>
                        <td>{{ number_format($detail->sous_total, 2, ',', ' ') }} DH</td>
                    </tr>
                @empty
                    <tr><td colspan="4">Aucun produit</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
