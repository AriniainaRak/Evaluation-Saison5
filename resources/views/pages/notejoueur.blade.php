@extends('pages.layouts.app')
@section('other')
    active open
@endsection
@section('note_joueur')
    active
@endsection
@section('contenue')
    <div class="card">
        <h5 class="card-header"> Note Joueurs</h5>
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="table-responsive text-nowrap">
            <form action="/insert" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="table" value="note_joueurs">
                <p>Joueur : <select name="idjoueur" id="defaultSelect" class="form-select">
                    @foreach ($data['joueur'] as $joueur)
                        <option value="{{ $joueur->id }}">{{ $joueur->nom }}</option>
                    @endforeach
                </select>
                </p>
                <p>Caractéristique : <select name="idcaracteristique" id="defaultSelect" class="form-select">
                    @foreach ($data['caracteristique'] as $caracteristique)
                        <option value="{{ $caracteristique->id }}">{{ $caracteristique->code }}</option>
                    @endforeach
                </select>
                </p>
                <p>Valeur : <input type="number" class="form-control" name="valeur"></p>
                <p><input type="submit" class="btn btn-dark" value="Insert"></p>
            </form>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Joueur</th>
                        <th>Caracteristique</th>
                        <th>Valeur</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data['note_joueur'] as $note_joueur)
                        <tr>
                            <td>
                                @if ($note_joueur->joueur)
                                    {{ $note_joueur->joueur->nom }}
                                @endif
                            </td>
                            <td>
                                @if ($note_joueur->cacteristique)
                                    {{ $note_joueur->cacteristique->cacteristique }}
                                @endif
                            </td>
                            <td>{{note_joueur->valeur}}</td>
                            {{-- <td><a href="/delete?table=joueurs&id={{ $joueur->id }}">Supprimer</a></td>
                            <td><a href="/modifjoueur/{{ $joueur->id }}">Modify</a></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
