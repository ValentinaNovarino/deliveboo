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
            <form method="POST" action="{{ route('admin.dishes.store') }}">
                @csrf
                <div class="form-group">
                    <label for="dishName">Dishes name</label>
                    <input type="text" id="dishName" class="form-control" placeholder="Enter dish name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Lorem ipsum dolor sit amet.</small>
                </div>
                <div class="form-group">
                  <label for="dishDescription">Dish Description</label>
                  <textarea class="form-control" id="dishDescription" rows="3" cols="8" placeholder="Enter Ingredients And Description" name="description"></textarea>
                  @error('description')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                    <p>Select tags</p>
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input name="categories[]" id="categoriesCheck" class="form-check-input" type="checkbox" value="{{ $category->id }}"
                            {{ in_array($category->id, old('categories', [])) ? 'checked=checked' : '' }}>
                            <label class="form-check-label" for="categoriesCheck">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                    @error('')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="dishPrice">Dish Price</label>
                    <input type="number" id="dishPrice" min="1" step="0.01" placeholder="€" name="price" value="{{ old('price') }}"/>
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Visible ?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="visibleYes" value="1">
                        <label class="form-check-label" for="visibleYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="visibleNo" value="2">
                        <label class="form-check-label" for="visibleNo">No</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
