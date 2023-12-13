@extends('pages.layouts.app')
@section('datas')
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
                <input type="hidden" name="table" value="table_datas">
                <p>Type : <select name="idtype" id="">
                    @foreach ($data['type'] as $type)
                        <option value="{{ $type->id }}">{{ $type->code }}</option>
                    @endforeach
                </select></p>
                <p>Valeur : <input type="number" class="form-control" name="valeur"></p>
                <p><button type="submit" class="btn btn-dark">Inserer</button></p>
            </form>
        </div>
        <div class="card">
            {{-- <h5 class="card-header">Importer CSV</h5> --}}
            <form action="/import" method="post" enctype="multipart/form-data">
                @csrf
                <p><input type="file" name="csv_file" id="data">CSV</p>
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
                        <th>ID</th>
                        <th>Type</th>
                        <th>Code</th>
                        <th>Valeur</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data['data'] as $tabledata)
                        <tr>
                            <td>{{ $tabledata->id}}</td>
                            <td>{{ $tabledata->type_datum->code}}</td>
                            <td>{{ $tabledata->valeur }}</td>
                            <td><a href="/delete?table=table_datas&id={{ $tabledata->id }}">Supprimer</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
