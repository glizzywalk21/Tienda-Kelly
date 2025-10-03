<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Muestra el contenido actual del carrito de compras.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene el carrito de la sesión. Si no existe, devuelve un array vacío.
        $cart = Session::get('cart', []);

        // Calcula el total sumando el precio * cantidad de cada ítem en el carrito.
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Añade un producto al carrito o incrementa su cantidad si ya existe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Product $product)
    {
        // Obtiene el carrito actual de la sesión.
        $cart = Session::get('cart', []);

        $productId = $product->id;
        // Obtiene la cantidad del request, por defecto es 1.
        $quantity = $request->input('quantity', 1);

        // Verifica si el producto ya está en el carrito.
        if (isset($cart[$productId])) {
            // Si existe, incrementa la cantidad.
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Si no existe, lo añade con los detalles básicos.
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image_path,
            ];
        }

        // Vuelve a guardar el carrito en la sesión.
        Session::put('cart', $cart);

        return redirect()->back()->with('success', '¡Producto añadido al carrito!');
    }

    /**
     * Actualiza la cantidad de un producto específico en el carrito.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $productId)
    {
        $cart = Session::get('cart');

        if ($cart && isset($cart[$productId])) {
            $newQuantity = $request->input('quantity');

            // Asegura que la nueva cantidad sea un número positivo.
            if ($newQuantity && is_numeric($newQuantity) && $newQuantity > 0) {
                $cart[$productId]['quantity'] = $newQuantity;
                Session::put('cart', $cart);
                return redirect()->back()->with('success', 'Cantidad del producto actualizada.');
            }
        }

        return redirect()->back()->with('error', 'No se pudo actualizar la cantidad.');
    }

    /**
     * Elimina un producto específico del carrito.
     *
     * @param  int  $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($productId)
    {
        $cart = Session::get('cart');

        // Verifica que el producto exista en el carrito y lo elimina.
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Producto eliminado del carrito.');
        }

        return redirect()->back()->with('error', 'El producto no se encontró en el carrito.');
    }

    /**
     * Vacía completamente el carrito de compras.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear()
    {
        Session::forget('cart');
        return redirect()->route('cart.index')->with('success', 'El carrito ha sido vaciado.');
    }
}