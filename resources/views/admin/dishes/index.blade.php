@extends('layouts.dashboard')

@section('admin.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col 12">
            <h1>lista piatti del ristorante</h1>
            <a href="{{ route('admin.dishes.create') }}">
                <button type="button" class="btn btn-info">Aggiungi nuovo piatto</button>
            </a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Actions</th>
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
                                    <button class="btn btn-primary">Show</button>
                                </a>
                                <button class="btn btn-info">Modify</button>
                                <button class="btn btn-danger" type="submit">Delete</button>
                                {{-- <a href="{{ route('admin.post.edit', ['post'=>$post->id ]) }}">
                                </a>
                                <form class="d-inline"
                                action="{{ route('admin.post.destroy', ['post'=>$post->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
