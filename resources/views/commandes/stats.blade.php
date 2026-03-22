@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Statistiques des commandes</h1>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5">Nombre de commandes par client</h2>
                    <ul class="list-group">
                        @forelse($nbCommandesParClient as $stat)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $stat->client_nom }}</span>
                                <strong>{{ $stat->total_commandes }}</strong>
                            </li>
                        @empty
                            <li class="list-group-item">Aucune donnee</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5">Chiffre d'affaires par produit</h2>
                    <ul class="list-group">
                        @forelse($chiffreAffairesParProduit as $stat)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $stat->produit_nom }}</span>
                                <strong>{{ number_format($stat->chiffre_affaires, 2, ',', ' ') }} DH</strong>
                            </li>
                        @empty
                            <li class="list-group-item">Aucune donnee</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
