@extends('pages.layouts.app')
@section('other')
    active open
@endsection
@section('joueur')
    active
@endsection
@section('contenue')
    <div class="card">
        <h5 class="card-header">joueurs</h5>
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="table-responsive text-nowrap">
            <form action="/insertJoueur" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="table" value="clubs">
                <p><button type="submit" class="btn btn-dark">Importer</button></p>
                @if (Session::has('csvsuccess'))
                    <div class="alert alert-success">{{ Session::get('csvsuccess') }}</div>
                @endif
            </form>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Nationalité</th>
                        <th>Club</th>
                        <th>Photo</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data['joueur'] as $joueur)
                        <tr>
                            <td>{{ $joueur->nom}}</td>
                            <td>
                                @if ($joueur->nationalite)
                                    {{ $joueur->nationalite->code }}
                                @endif
                            </td>
                            <td>
                                @if ($joueur->club)
                                    {{ $joueur->club->code }}
                                @endif
                            </td>
                            <td>
                                <img src="{{ asset($joueur->photo) }}" alt="photo" />
                            </td>
                            {{-- <td><a href="/delete?table=joueurs&id={{ $joueur->id }}">Supprimer</a></td>
                            <td><a href="/modifjoueur/{{ $joueur->id }}">Modify</a></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
