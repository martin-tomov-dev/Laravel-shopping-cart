<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $data = Cart::getData();
        return view('welcome', [
          'data' => $data,
      ]);
    }
}