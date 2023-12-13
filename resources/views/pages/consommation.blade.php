@extends('pages.layouts.app')
@section('consommations')
    active
@endsection
@section('contenue')
    <div class="card mb-4">
        <h5 class="card-header">Data</h5>
        <div class="table-responsive text-nowrap">
            @if (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <form action="/insert" method="post">
                @csrf
                <input type="hidden" name="table" value="consommations">
                <p>Nombre étudiants : <input type="number" class="form-control" name="nb_pers"></p>
                <p>Puissance moyenne : <input type="number" class="form-control" name="puissance_moy"></p>
                <p>Consommation fixe : <input type="number" class="form-control" name="consommation_fix"></p>
                <p>Taux personne heure creuse : <input type="number" class="form-control" name="taux_pers_h_creuse"></p>
                <p><button type="submit" class="btn btn-dark">Inserer</button></p>
            </form>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Nombre étudiant</th>
                        <th>Puissance moyenne</th>
                        <th>Consommation fixe</th>
                        <th>Taux personne heure creuse</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data['data'] as $consommation)
                        <tr>
                            <td>{{ $consommation->nb_pers }}</td>
                            <td>{{ $consommation->puissance_moy }}</td>
                            <td>{{ $consommation->consommation_fix }}</td>
                            <td>{{ $consommation->taux_pers_h_creuse }}</td>
                            {{-- <td><a href="/modiftabledata/{{ $tabledata->idtabledatas }}">Modifier</a></td> --}}
                            <td><a href="/delete?table=consommations&id={{ $consommation->id }}">Supprimer</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
