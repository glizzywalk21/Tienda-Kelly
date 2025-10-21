<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;      // si lo usas en la lógica
use App\Models\Product;   // si lo usas
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Ejemplo mínimo (ajusta a tu vista real)
        // $items = Cart::with('product')->where('fk_user', Auth::id())->get();
        // return view('cart.index', compact('items'));
        return response('Cart index', 200);
    }

    public function add($product)
    {
        // Tu lógica para agregar al carrito
        // Cart::create([...]);
        return back()->with('success', 'Producto agregado al carrito.');
    }

    public function remove($product)
    {
        // Tu lógica para eliminar del carrito
        return back()->with('success', 'Producto eliminado del carrito.');
    }

    public function checkout(Request $request)
    {
        // Tu lógica de checkout
        return back()->with('success', 'Checkout procesado.');
    }
}
