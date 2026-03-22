<?php

namespace App\Http\Controllers;

use App\Events\CommandeUpdated;
use App\Models\Client;
use App\Models\Commande;
use App\Models\DetailCommande;
use App\Models\Produit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CommandeController extends Controller
{
    public function index(): View
    {
        $commandes = Commande::with(['client', 'details.produit'])
            ->latest()
            ->paginate(10);

        return view('commandes.index', compact('commandes'));
    }

    public function create(): View
    {
        return view('commandes.create', [
            'clients' => Client::orderBy('nom')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'client_id' => ['required', 'exists:clients,id'],
            'date_commande' => ['required', 'date'],
            'statut' => ['required', 'in:en_attente,validee,expediee,livree,annulee'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $commande = Commande::create($validated);
        event(new CommandeUpdated($commande, 'creation', null, $commande->toArray()));

        return redirect()->route('commandes.show', $commande)->with('success', 'Commande creee avec succes.');
    }

    public function show(Commande $commande): View
    {
        $commande->load(['client', 'details.produit', 'historiques.user']);

        return view('commandes.show', compact('commande'));
    }

    public function edit(Commande $commande): View
    {
        return view('commandes.edit', [
            'commande' => $commande,
            'clients' => Client::orderBy('nom')->get(),
        ]);
    }

    public function update(Request $request, Commande $commande): RedirectResponse
    {
        $validated = $request->validate([
            'client_id' => ['required', 'exists:clients,id'],
            'date_commande' => ['required', 'date'],
            'statut' => ['required', 'in:en_attente,validee,expediee,livree,annulee'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $ancienneValeur = $commande->toArray();
        $commande->update($validated);
        event(new CommandeUpdated($commande, 'modification', $ancienneValeur, $commande->fresh()->toArray()));

        return redirect()->route('commandes.show', $commande)->with('success', 'Commande mise a jour.');
    }

    public function confirmDelete(Commande $commande): View
    {
        return view('commandes.confirm-delete', compact('commande'));
    }

    public function destroy(Commande $commande): RedirectResponse
    {
        $ancienneValeur = $commande->toArray();
        event(new CommandeUpdated($commande, 'suppression', $ancienneValeur, null));
        $commande->delete();

        return redirect()->route('commandes.index')->with('success', 'Commande supprimee.');
    }

    public function addProductForm(Commande $commande): View
    {
        $commande->load('details.produit');

        return view('commandes.add-product', [
            'commande' => $commande,
            'produits' => Produit::orderBy('nom')->get(),
        ]);
    }

    public function addProduct(Request $request, Commande $commande): RedirectResponse
    {
        $validated = $request->validate([
            'produit_id' => ['required', 'exists:produits,id'],
            'quantite' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($validated, $commande) {
            $produit = Produit::findOrFail($validated['produit_id']);
            $detail = DetailCommande::firstOrNew([
                'commande_id' => $commande->id,
                'produit_id' => $produit->id,
            ]);

            $detail->quantite = ($detail->exists ? $detail->quantite : 0) + $validated['quantite'];
            $detail->prix_unitaire = $produit->prix;
            $detail->sous_total = $detail->quantite * $produit->prix;
            $detail->save();

            $this->recalculateTotal($commande);
        });

        event(new CommandeUpdated($commande->fresh(), 'ajout_produit', null, $commande->fresh()->toArray()));

        return redirect()->route('commandes.show', $commande)->with('success', 'Produit ajoute a la commande.');
    }

    public function stats(): View
    {
        $nbCommandesParClient = Commande::query()
            ->join('clients', 'clients.id', '=', 'commandes.client_id')
            ->select('clients.nom as client_nom', DB::raw('count(commandes.id) as total_commandes'))
            ->groupBy('clients.nom')
            ->orderByDesc('total_commandes')
            ->get();

        $chiffreAffairesParProduit = DetailCommande::query()
            ->join('produits', 'produits.id', '=', 'detail_commandes.produit_id')
            ->select('produits.nom as produit_nom', DB::raw('sum(detail_commandes.sous_total) as chiffre_affaires'))
            ->groupBy('produits.nom')
            ->orderByDesc('chiffre_affaires')
            ->get();

        return view('commandes.stats', compact('nbCommandesParClient', 'chiffreAffairesParProduit'));
    }

    private function recalculateTotal(Commande $commande): void
    {
        $total = (float) $commande->details()->sum('sous_total');
        $commande->update(['total' => $total]);
    }
}
