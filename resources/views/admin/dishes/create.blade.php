@extends('layouts.dashboard')

@section('admin.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col 12">
            <h1>crea un nuovo piatto</h1>
            <form>
                <div class="form-group">
                    <label for="dishName">Dishes name</label>
                    <input type="text" id="dishName" class="form-control" placeholder="Enter dish name">
                    <small class="form-text text-muted">Lorem ipsum dolor sit amet.</small>
                </div>
                <div class="form-group">
                    <label for="dishIngredients">Dish Ingredients</label>
                    <input type="text" id="dishIngredients" class="form-control" placeholder="Enter Ingredients">
                </div>
                <div class="form-group">
                  <label for="dishDescription">Dish Description</label>
                  <textarea class="form-control" id="dishDescription" rows="3" cols="8" placeholder="Enter Description"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Select Dish Categories</label>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                        <label class="form-check-label" for="">Check me out</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                        <label class="form-check-label" for="">Check me out</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                        <label class="form-check-label" for="">Check me out</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dishPrice">Dish Price</label>
                    <input type="number" id="dishPrice" min="1" step="0.01" />
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
