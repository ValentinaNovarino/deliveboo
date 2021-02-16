@extends('layouts.dashboard')

@section('admin.content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="header-card-restaurants d-flex justify-content-between">
                <h1>Tutti i tuoi ristoranti</h1>
                <a href="{{ route('admin.restaurants.create') }}">
                    <button type="button" class="btn btn-info">Aggiungi nuovo ristorante</button>
                </a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-container">
                @foreach ($restaurants as $restaurant)
                    <div class="card card-restaurants w-100 flex-row">
                        <div class="card-body">
                            <h5 class="card-title">{{$restaurant->name}}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$restaurant->city}}</li>
                            <li class="list-group-item">{{$restaurant->address}}</li>
                            <li class="list-group-item">Categoria Ristorante</li>
                        </ul>
                        <div class="card-body">
                            <a href="#" class="card-link">Menu ristorante</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
