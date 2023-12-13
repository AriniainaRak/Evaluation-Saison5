@extends('pages.layouts.userapp')
@section('contenue')
    <div class="card">
        <div class="section-header">
            <h3>Calendrier</h3>
        </div>

        <div class="form">
            @if (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            <form action="/recherche" method="get" class="php-email-form">
                @csrf
                <div class="form-group">
                    <label for="type">Sport</label>
                    <select name="sport" class="form-control">
                        <option value="">Discipline</option>
                        @foreach ($data['sport'] as $sport)
                            <option value="{{ $sport->idsport }}">{{ $sport->sport }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="daty">Date</label>
                    <input type="date" class="form-control" id="daty" name="date">
                </div>
                <div class="text-center"><button type="submit" class="btn btn-dark">Rechercher</button></div>
            </form>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Site</th>
                        <th>Sport</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data['calendrier'] as $calendrier)
                        <tr>
                            <td>{{ $calendrier->sites }}</td>
                            <td>{{ $calendrier->sport }}</td>
                            <td>{{ $calendrier->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
