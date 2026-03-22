@csrf
<div class="mb-3">
    <label class="form-label">Client</label>
    <select name="client_id" class="form-select @error('client_id') is-invalid @enderror" required>
        <option value="">Selectionnez un client</option>
        @foreach($clients as $client)
            <option value="{{ $client->id }}" @selected(old('client_id', $commande->client_id ?? '') == $client->id)>{{ $client->nom }}</option>
        @endforeach
    </select>
    @error('client_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Date commande</label>
        <input type="date" name="date_commande" class="form-control @error('date_commande') is-invalid @enderror" value="{{ old('date_commande', isset($commande) ? $commande->date_commande->format('Y-m-d') : now()->toDateString()) }}" required>
        @error('date_commande')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Statut</label>
        <select name="statut" class="form-select @error('statut') is-invalid @enderror" required>
            @foreach(['en_attente', 'validee', 'expediee', 'livree', 'annulee'] as $statut)
                <option value="{{ $statut }}" @selected(old('statut', $commande->statut ?? 'en_attente') === $statut)>{{ ucfirst(str_replace('_', ' ', $statut)) }}</option>
            @endforeach
        </select>
        @error('statut')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Notes</label>
    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $commande->notes ?? '') }}</textarea>
    @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<button class="btn btn-primary" type="submit">{{ $submitLabel }}</button>
