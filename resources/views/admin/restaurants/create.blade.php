@extends('layouts.dashboard')

@section('admin.content')
<div class="container border-form p-5">
    <div class="row justify-content-center">
        <div class="col 12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <h1>Inserisci i dati del tuo Ristorante</h1>
            <form method="POST" action="{{ route('admin.restaurants.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="restaurantName">Nome</label>
                    <input type="text" id="restaurantName" class="form-control-deliveroo" placeholder="Inserisci il nome del tuo ristorante" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="restaurantCity">Città</label>
                    <input type="text" id="restaurantCity" class="form-control-deliveroo" placeholder="Inserisci la città del tuo ristorante" name="city" value="{{ old('city') }}" required>
                    @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="addressName">Indirizzo</label>
                    <input type="text" id="addressName" class="form-control-deliveroo" placeholder="Inserisci l'indirizzo del tuo ristorante" name="address" value="{{ old('address') }}" required>
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-deliveroo">Invio</button>
            </form>
        </div>
    </div>
</div>
@endsection
