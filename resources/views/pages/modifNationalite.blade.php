@extends('pages.layouts.app')
@section('other')
    active open
@endsection
@section('nationalite')
    active
@endsection
@section('contenue')
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card h-100">
            @for ($i = 0; $i < count($detail); $i++)
                <div class="card-body">
                    <form action="/update" method="get">
                        <input type="hidden" name="table" value="nationalites">
                        <input type="hidden" name="id" value="{{ $detail[$i]['id'] }}">
                        <input type="hidden" name="image" value="{{ $detail[$i]['image'] }}">
                        @csrf
                        <h5 class="card-title">Nom : <input type="text" name="nom" value="{{ $detail[$i]['nom'] }}">
                        </h5>
                </div>
                <img class="img-fluid" src="{{ asset('storage/' . $detail[$i]['image']) }}" alt="Card image cap" />
                <div class="card-body">
                    </p>
                    <button type="submit" class="btn btn-primary">Modify</button>
                    </form>
                </div>
            @endfor
        </div>
    @endsection
