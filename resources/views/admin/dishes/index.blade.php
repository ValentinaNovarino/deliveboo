@extends('layouts.dashboard')

@section('admin.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col 12">
            <h1>lista piatti del ristorante</h1>
            <a href="{{ route('admin.dishes.create') }}">
                <button type="button" class="btn btn-info">Aggiungi nuovo piatto</button>
            </a>
        </div>
    </div>
</div>
@endsection
