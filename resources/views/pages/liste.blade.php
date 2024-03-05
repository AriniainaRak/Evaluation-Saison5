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
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Résultats de la Recherche</div>

        <div class="card-body">
            @if ($joueurs->isEmpty())
                <p>Aucun joueur trouvé.</p>
            @else
                <ul>
                    @foreach ($joueurs as $player)
                        <li>{{ $player->nom }} - {{ $player->club->club }} - {{ $player->nationalite->nationalite }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
            </form>
        </div>
    </div>
@endsection
