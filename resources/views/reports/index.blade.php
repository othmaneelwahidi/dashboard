@extends('layouts.navigation')

@section('content')
<div class="container">
    <h1>Créer un rapport personnalisé des mouvements de stock</h1>
    <form method="POST" action="{{ route('reports.export') }}">
        @csrf
        <div class="form-group">
            <label for="category_id">Catégorie</label>
            <select id="category_id" name="category_id" class="form-control">
                <option value="">Toutes</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->nom }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="movement_type">Type de Mouvement</label>
            <select id="movement_type" name="movement_type" class="form-control">
                <option value="">Tous</option>
                <option value="entry">Entrée</option>
                <option value="exit">Sortie</option>
                <option value="ajustment">Ajustement</option>
            </select>
        </div>

        <div class="form-group">
            <label for="date_from">Date d'action</label>
            <input type="date" id="date_action" name="date_from" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="format">Format d'exportation</label>
            <select id="format" name="format" class="form-control">
                <option value="" selected disabled>choisir la format de votre rapport</option>
                <option value="pdf">PDF</option>
                <option value="excel">Excel</option>
                <option value="csv">CSV</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Exporter</button>
    </form>
</div>
@endsection
