<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;

class DishController extends Controller
{
    public function index() {
    $data = Dish::all();
    // dd($data);
    return response()->json([
        'succes' => true,
        'response' => $data,
    ]);
}
}
