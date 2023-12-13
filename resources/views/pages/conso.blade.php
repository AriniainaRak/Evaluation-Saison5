@extends('pages.layouts.app')
@section('conso')
    active
@endsection
@section('contenue')
    <div class="card mb-4">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Heure</th>
                        <th>Production</th>
                        <th>Consommation</th>
                    </tr>
                </thead>
                <tbody>
                    @for ( $i = 0;$i<count($data['heure']);$i++)
                    <tr>
                        <td>{{ $data['heure'][$i] }}</td>
                        <td>{{ $data['prod']->ret[$i] }}</td>
                        <td>{{ $data['conso'][$i] }}</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection
