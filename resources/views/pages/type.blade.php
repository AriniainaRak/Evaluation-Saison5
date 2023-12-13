@extends('pages.layouts.app')
@section('typedatas')
    active
@endsection
@section('contenue')
    <div class="card mb-4">
        <h5 class="card-header">Type data</h5>
        <div class="table-responsive text-nowrap">
            @if (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <form action="/insert" method="post">
                @csrf
                <input type="hidden" name="table" value="type_datas">
                <p>Code : <input type="text" class="form-control" name="code"></p>
                <p>Nom : <input type="text" class="form-control" name="nom"></p>
                <p><button type="submit" class="btn btn-dark">Inserer</button></p>
            </form>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>id</th>
                        <th>Code</th>
                        <th>Nom</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data['table'] as $typedata)
                        <tr>
                            <td>{{ $typedata->id }}</td>
                            <td>{{ $typedata->code }}</td>
                            <td>{{ $typedata->nom }}</td>
                            {{-- <td><a href="/modiftypedata/{{ $typedata->idtypedatas }}">Modifier</a></td> --}}
                            <td><a href="/delete?table=type_datas&id={{ $typedata->id }}">Supprimer</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
