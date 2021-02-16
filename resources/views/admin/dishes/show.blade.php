@extends('layouts.dashboard')

@section('admin.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col 12">
            @if ($dish->visible == 1)
                 <div class="card">
                     <h1>Dish: {{ $dish->name }}</h1>
                     <img src="{{ $dish->cover }}" alt="{{ $dish->name }}">
                     <p>Description: {{ $dish->description }}</p>
                     <p>Price {{ $dish->price }}€</p>
                 </div>
            @else
                <p>Prodotto non visualizzabile</p>
            @endif

        </div>
    </div>
</div>
@endsection
