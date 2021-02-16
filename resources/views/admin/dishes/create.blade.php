@extends('layouts.dashboard')

@section('admin.content')
<div class="container">
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
            <h1>crea un nuovo piatto</h1>
            <form method="POST" action="{{ route('admin.dishes.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="dishName">Dishes name</label>
                    <input type="text" id="dishName" class="form-control" placeholder="Enter dish name" name="name" value="{{ old('name') }}" required maxlength="100">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Lorem ipsum dolor sit amet.</small>
                </div>
                <div class="form-group">
                    <label for="dishImage">Enter Dish image</label>
                    <input id="dishImage" type="file" name="image" class="form-control-file @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="dishDescription">Dish Description</label>
                  <textarea class="form-control" id="dishDescription" rows="3" cols="8" placeholder="Enter Ingredients And Description" name="description" required>{{ old('description') }}</textarea>
                  @error('description')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                    <label for="dishPrice">Dish Price</label>
                    <input type="number" id="dishPrice" min="1" step="0.01" placeholder="€" name="price" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Visible ?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="visible" id="visibleYes" value="1" required>
                        <label class="form-check-label" for="visibleYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="visible" id="visibleNo" value="0" required>
                        <label class="form-check-label" for="visibleNo">No</label>
                    </div>
                    @error('visible')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
