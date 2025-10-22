<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    /**
     * Mostrar carrito
     */
    public function index()
    {
        // Traer carrito de sesión
        $carrito = session()->get('carrito', []);
        return view('users.carrito', compact('carrito'));
    }

    /**
     * Agregar producto al carrito
     */
    public function agregar(Request $request, $id)
    {
        // Buscar producto por su primary key (product_code)
        $producto = Producto::where('product_code', $id)->firstOrFail();

        // Obtenemos carrito de sesión
        $carrito = session()->get('carrito', []);

        // Si ya existe en carrito, aumentar cantidad
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            // Si no existe, lo agregamos
            $carrito[$id] = [
                "id"           => $producto->product_code,
                "product_name" => $producto->product_name,
                "price"        => $producto->price,
                "image"        => $producto->image,
                "cantidad"     => 1,
            ];
        }

        // Guardamos en sesión
        session()->put('carrito', $carrito);

        return redirect()->back()->with('agregado', 'Producto agregado al carrito.');
    }

    /**
     * Actualizar cantidad de un producto
     */
    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] = $request->cantidad;
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('success', 'Carrito actualizado.');
    }

    /**
     * Eliminar producto del carrito
     */
    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    /**
     * Vaciar todo el carrito
     */
    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->back()->with('success', 'Carrito vaciado.');
    }
}
