@extends('layouts.dashboard')

@section('admin.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col 12">
            <div class="card">
                <h1>Dish: {{ $dish->name }}</h1>
                <img src="{{ $dish->cover }}" alt="{{ $dish->name }}">
                <p>Description: {{ $dish->description }}</p>
                <p>Visible: {{ $dish->visible == 1 ? 'Yes' : 'No' }}</p>
                <p>Price {{ $dish->price }}€</p>
            </div>
            <div class="back-to-dishes-arrow d-block">
                <a href="{{ route('admin.dishes.index') }}" class="d-block">
                    <i class="fas fa-arrow-left"></i>
                    All Dishes
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
