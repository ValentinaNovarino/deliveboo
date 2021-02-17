@extends('layouts.dashboard')

@section('admin.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col 12">
            <div class="add-dish">
                <h1>Menù del tuo ristorante</h1>
                <a href="{{ route('admin.dishes.create') }}">
                    <button type="button" class="btn btn-deliveroo">Aggiungi nuovo piatto</button>
                    <button type="button" class="btn add btn-deliveroo"><i class="fas fa-plus"></i></button>
                </a>
            </div>
            @if (count($dishes) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Operazioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dishes as $dish)
                            <tr>
                                <td>{{ $dish->id }}</td>
                                <td>{{ $dish->name }}</td>
                                <td>{{ $dish->slug }}</td>
                                <td>
                                    <a href="{{ route('admin.dishes.show', ['dish'=> $dish->slug ]) }}">
                                        <button class="btn show-btn-deliveroo">Show</button>
                                        <button class="btn show show-btn-deliveroo"><i class="fas fa-eye"></i></button>
                                    </a>
                                    <a href="{{ route('admin.dishes.edit', ['dish'=>$dish->slug ]) }}">
                                        <button class="btn modify-btn-deliveroo">Modify</button>
                                        <button class="btn modify modify-btn-deliveroo"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <form class="d-inline"
                                    action="{{ route('admin.dishes.destroy', ['dish'=>$dish->slug]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger danger-deliveroo" type="submit">Delete</button>
                                    <button class="btn btn-danger danger danger-deliveroo"><i class="fas fa-times"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection

{{-- <a href="{{ route('admin.dishes.show', ['dish'=> $dish->slug ]) }}">
    <button class="btn btn-primary">Show</button>
</a>
<a href="{{ route('admin.dishes.edit', ['dish'=>$dish->slug ]) }}">
    <button class="btn btn-info">Modify</button>
</a>
<form class="d-inline"
action="{{ route('admin.dishes.destroy', ['dish'=>$dish->slug]) }}" method="POST">
@csrf
@method('DELETE')
<button class="btn btn-danger" type="submit">Delete</button>
</form> --}}
