@extends('pages.layouts.app')
@section('other')
    active open
@endsection
@section('club')
    active
@endsection
@section('contenue')
    <div class="card">
        <h5 class="card-header">Clubs</h5>
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="table-responsive text-nowrap">
            <form action="/insert" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="table" value="clubs">
                <p>Nom : <input type="text" class="form-control" name="club"></p>
                <p><input type="submit" value="Insert"></p>
            </form>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data['club'] as $club)
                        <tr>
                            <td>{{ $club->club }}</td>
                            <td><a href="/delete?table=clubs&id={{ $club->id }}">Supprimer</a></td>
                            <td><a href="/modifClub/{{ $club->id }}">Modify</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
