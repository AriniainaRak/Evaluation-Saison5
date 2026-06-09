@extends('pages.layouts.gestion')
@section('other')
    active open
@endsection
@section('nationalite')
    active
@endsection
@section('contenue')
    <div class="card">
        <h5 class="card-header">Liste joueurs</h5>
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <form action="/insertJoueur" method="post" enctype="multipart/form-data">
            <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input
                type="text"
                class="form-control border-0 shadow-none"
                placeholder="Search..."
                aria-label="Search..."
            />
            </div>
        </div>

  <!-- /Search -->
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <h1>Liste des joueurs</h1>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Taille</th>
                                <th>Nationalité</th>
                                <th>Club</th>
                                <!-- Ajoutez d'autres en-têtes de colonnes si nécessaire -->
                            </tr>
                        </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($joueurs as $joueur)
                    <tr>
                        <td>{{ $joueur->nom }}</td>
                        <td>{{ $joueur->prenom }}</td>
                        <td>{{ $joueur->taille }}</td>
                        <td>{{ $joueur->nationalite->intitule }}</td>
                        <td>{{ $joueur->club->code }}</td>
                        <td><a href="/fiche?table=joueurs&id={{ $joueur->id }}">Fiche</a></td>
                        <!-- Ajoutez d'autres colonnes si nécessaire -->
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>

{{--
        <div class="card-body">
            @if ($joueurs->isEmpty())
                <p>Aucun joueur trouvé.</p>
            @else
                <ul>
                    @foreach ($joueurs as $player)
                        <li>{{ $player->nom }}
                            {{ $player->club->club }}
                            {{ $player->nationalite->nationalite }}</li>
                        {{-- <tr>
                            <td>{{ $player->nom }}</td>
                            <td>{{ $player->club->club }}</td>
                            <td>{{ $player->nationalite->nationalite }}</td>
                        </tr> --}}
                    {{-- @endforeach
                </ul> --}}
            {{-- @endif --}}
        </div>
    </div>
</div>
            </form>
        </div>
    </div>
@endsection
