@extends('layouts.dashboard')

@section('admin.content')
<div class="container border-form p-5">
    <div class="row justify-content-center">
        <div class="col 12">
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif --}}
            <h1>Inserisci i dati del tuo Ristorante</h1>
            <form name="myRestaurantForm" method="POST" action="{{ route('admin.restaurants.store') }}" enctype="multipart/form-data" onsubmit="return validateRestaurantForm()">
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
                    <label for="restaurantAddress">Indirizzo</label>
                    <input type="text" id="restaurantAddress" class="form-control-deliveroo" placeholder="Inserisci l'indirizzo del tuo ristorante" name="address" value="{{ old('address') }}" required>
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <p>Seleziona le categorie:</p>
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input name="categories[]" class="form-check-input" type="checkbox" value="{{ $category->id }}"
                            {{ in_array($category->id, old('categories', [])) ? 'checked=checked' : '' }}>
                            <label class="form-check-label">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                    @error('categories')
                       <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
                </div>
                <button type="submit" class="btn btn-deliveroo">Invio</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function validateRestaurantForm() {
        var name = document.forms["myRestaurantForm"]["name"].value;
        var city = document.forms["myRestaurantForm"]["city"].value;
        var address = document.forms["myRestaurantForm"]["address"].value;
        var checked = document.forms["myRestaurantForm"]["categories[]"].checked;

        // controllo sul nome del ristorante
        if (name == "" || name.length > 100 || name == "undefined") {
            alert ("Non hai inseto il nome del tuo ristorante o la lunghezza supera i 100 caratteri");
            return false;
        };

        // controllo sulla citta
        if (city == "" || city.length > 100 || city == "undefined") {
            alert ("Non hai inseto il nome della città o la lunghezza supera i 100 caratteri");
            return false;
        };

        // controllo sull'indirizzo del ristorante
        if (address == "" || address.length > 100 || address == "undefined" ) {
            alert ("Non hai inseto l'indirizzo del tuo ristorante o la lunghezza supera i 100 caratteri");
            return false;
        };

        // controllo sulle checkbox delle categorie
        if (!checked) {
            alert("Nessuna CheckBox spuntata. Spuntane almeno una");
            return false;
        };
    }
</script>
@endsection
