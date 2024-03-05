@extends('pages.layouts.app')
@section('other')
    active open
@endsection
@section('formation')
    active
@endsection
@section('contenue')
    <div class="card">
        <h5 class="card-header">formations</h5>
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="table-responsive text-nowrap">
            <form action="/insert" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="table" value="formations">
                <p>Nom : <input type="text" class="form-control" name="nom"></p>
                <p>Attaquant : <input type="number" class="form-control" name="attaquant"></p>
                <p>Milieu : <input type="number" class="form-control" name="milieu"></p>
                <p>Défense : <input type="number" class="form-control" name="defense"></p>
                <p><input type="submit" value="Insert"></p>
            </form>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Attaquant</th>
                        <th>Milieu</th>
                        <th>Défense</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data['formation'] as $formation)
                        <tr>
                            <td>{{ $formation->nom }}</td>
                             <td>{{ $formation->attaquant}}</td>
                             <td>{{ $formation->milieu}}</td>
                             <td>{{ $formation->defense}}</td>
                            {{-- <td><a href="/delete?table=formations&id={{ $formation->id }}">Supprimer</a></td>
                            <td><a href="/modifformation/{{ $formation->id }}">Modify</a></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
