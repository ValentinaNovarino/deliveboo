@extends('layouts.dashboard')

@section('admin.content')
<div class="container h-100 d-flex flex-column">
    <div class="row">
        <div class="col-md-12">
            <div class="header-card-restaurants d-flex justify-content-between align-items-center">
                <h1>Tutti i tuoi ristoranti</h1>
                @if (is_null($restaurant))
                    <a href="{{ route('admin.restaurants.create') }}">
                        <button type="button" class="btn btn-deliveroo">Aggiungi nuovo ristorante</button>
                    </a>
                @endif
                <a href="{{ route('admin.restaurants.create') }}">
                    <button type="button" class="btn btn-deliveroo">Aggiungi nuovo ristorante</button>
                    <button type="button" class="btn add btn-deliveroo"><i class="fas fa-plus"></i></button>
                </a>
            </div>
        </div>
    </div>
    @if (!is_null($restaurant))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-container">
                @foreach ($restaurants as $restaurant)
                    <div class="card card-restaurants w-100 flex-row">
                        <div class="card-body">
                            <h5 class="card-title restaurant-info">{{$restaurant->name}}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item restaurant-info">{{$restaurant->city}}</li>
                            <li class="list-group-item restaurant-info">{{$restaurant->address}}</li>
                            @foreach ($categories as $category)
                                <li class="list-group-item">{{$category->name}}</li>
                            @endforeach
                        </ul>
                        <div class="card-body text-center">
                            <a href="#" class="card-link restaurant-menu secondary-btn-deliveroo">Menu ristorante</a>
                            <a href="#" class="card-link menu secondary-btn-deliveroo">Menu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container no-restaurant align-self-center m-auto">
            <h1 class="text-center">Non hai ristoranti</h1>
        </div>
    @endif
</div>
@endsection
