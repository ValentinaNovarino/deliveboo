<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index() {

    $categories = Category::all();
    $prova = Category::with('restaurants')->get();
    $data = [
        'categories' => $categories,
        'prova' => $prova
    ];
    return response()->json([
        'succes' => true,
        'response' => $data,
    ]);
}
}
