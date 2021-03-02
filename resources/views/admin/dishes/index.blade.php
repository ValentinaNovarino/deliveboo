@extends('layouts.dashboard')

@section('admin.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col 12">
            <div class="add-dish d-flex flex-column justify-content-center align-items-center">
            <a href="{{ url('/') }}">
                <img class="logo-admin-dish" src="{{asset('../img/logo.png')}}" alt="">
            </a>
                <h1>Componi il menù del tuo ristorante</h1>
                <a href="{{ route('admin.dishes.create') }}">
                    <button class="button9" type="button" class="btn btn-deliveroo new-dish">Aggiungi nuovo piatto
                        <i class="fas fa-utensils"></i>
                    </button>
                </a>
            </div>
            @if (count($dishes) == 0)
                <h2 class="back-dish-title">Non hai nessun piatto al momento</h2>
            @endif
            @if (count($dishes) > 0)
                <table class="table_price">
                    <thead>
                        <tr>
                            {{-- <th scope="col">ID</th> --}}
                            <th scope="col">Immagine</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Prezzo</th>
                            <th scope="col">Operazioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dishes as $dish)
                            <tr>
                                {{-- <td>{{ $dish->id }}</td> --}}
                                <td class="td-dish-9"><img src="{{ asset('storage/' . $dish->cover) }}" alt="Cover piatto" ></td>
                                <td class="capitalize">{{ $dish->name }}</td>
                                <td>{{ $dish->price }} €</td>
                                <td>
                                    <a href="{{ route('admin.dishes.show', ['dish'=> $dish->slug ]) }}">
                                        <button class="btn show-btn-deliveroo">Mostra</button>
                                        <button class="btn show show-btn-deliveroo"><i class="fas fa-eye"></i></button>
                                    </a>
                                    <a href="{{ route('admin.dishes.edit', ['dish'=>$dish->slug ]) }}">
                                        <button class="btn modify-btn-deliveroo">Modifica</button>
                                        <button class="btn modify modify-btn-deliveroo"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <form class="d-inline"
                                    action="{{ route('admin.dishes.destroy', ['dish'=>$dish->slug]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                        <button class="btn btn-danger danger-deliveroo" type="submit">Cancella</button>
                                        <button class="btn btn-danger danger danger-deliveroo"><i class="fas fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="container no-dishes d-flex flex-column justify-content-center align-items-center">
                    <h1 class="info-alert text-center">Non hai piatti registrati nel tuo ristorante</h1>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
