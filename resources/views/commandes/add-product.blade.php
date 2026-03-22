@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Ajouter un produit a la commande #{{ $commande->id }}</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="post" action="{{ route('commandes.add-product', $commande) }}" class="row g-3">
                @csrf
                <div class="col-md-8">
                    <label class="form-label">Produit</label>
                    <select name="produit_id" class="form-select @error('produit_id') is-invalid @enderror" required>
                        <option value="">Choisir un produit</option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}">{{ $produit->nom }} ({{ number_format($produit->prix, 2, ',', ' ') }} DH)</option>
                        @endforeach
                    </select>
                    @error('produit_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Quantite</label>
                    <input type="number" min="1" name="quantite" class="form-control @error('quantite') is-invalid @enderror" value="{{ old('quantite', 1) }}" required>
                    @error('quantite')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Ajouter</button>
                    <a class="btn btn-secondary" href="{{ route('commandes.show', $commande) }}">Retour</a>
                </div>
            </form>
        </div>
    </div>
@endsection
