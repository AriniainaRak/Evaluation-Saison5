@extends('pages.layouts.gestion')
@section('other')
active open
@endsection
@section('fiche')
active
@endsection
@section('contenue')
{{-- {{var_dump($data['joueur'])}} --}}
    <div class="card">
        <h5 class="card-header">Fiche Joueurs</h5>
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="row mb-5">
            <div class="col-md-6 col-lg-4">
              <div class="card mb-3">
                <div class="card-body">
                  <h5 class="card-title">Fiche</h5>
                  <tr>
                    
                  </tr>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                {{-- <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Taille</th>
                        <th>Nationalite</th>
                        <th>Club</th>
                    </tr>
                </thead> --}}
                <tbody class="table-border-bottom-0">
                    {{-- {{ dd($joueur) }} --}}
                    @foreach ($joueur as $joueur)
                    {{-- <h1>Détails du joueur</h1> --}}
                        <ul>
                            <li><strong>Nom:</strong> {{ $joueur->nom }}</li>
                            <li><strong>Prénom:</strong> {{ $joueur->prenom }}</li>
                            <li><strong>Taille:</strong> {{ $joueur->taille }}</li>
                            <li><strong>Nationalité:</strong> {{ $joueur->nationalite->intitule }}</li>
                            <li><strong>Club:</strong> {{ $joueur->club->code }}</li>
                            {{-- <li><a href="/joueur?table=joueurs&id={{ $joueur->id }}">C</li> --}}
                            <!-- Ajoutez d'autres informations spécifiques du joueur ici -->
                        </ul>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
