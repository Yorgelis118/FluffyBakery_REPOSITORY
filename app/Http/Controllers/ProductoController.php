<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Mostrar listado de productos (admin).
     */
    public function index(Request $request)
    {
        $category = $request->get('category');
        $searchQuery = $request->get('q');

        $query = Producto::with('category');

        if ($category && $category !== 'todos') {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }

        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('product_name', 'LIKE', "%{$searchQuery}%")
                  ->orWhere('description', 'LIKE', "%{$searchQuery}%")
                  ->orWhere('ingredients', 'LIKE', "%{$searchQuery}%");
            });
        }

        $productos = $query->orderBy('display_order')->orderBy('product_name')->get();

        return view('admin.productos.index', compact('productos', 'category', 'searchQuery'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        $categoryOptions = Category::orderBy('name')->pluck('name', 'id_category');
        return view('admin.productos.create', compact('categoryOptions'));
    }

    /**
     * Guardar nuevo producto.
     */
    public function store(Request $request)
    {
        $rules = [
            'product_name'    => 'required|string|max:255',
            'id_category'     => 'required|exists:categories,id_category',
            'price'           => 'required|numeric|min:0',
            'discount'        => 'nullable|numeric|min:0|max:100',
            'available_unity' => 'required|integer|min:0',
            'minimum_stock'   => 'nullable|integer|min:0',
            'maximum_stock'   => 'nullable|integer|min:0',
            'status'          => 'required|boolean',
            'display_order'   => 'nullable|integer|min:0',
            'description'     => 'nullable|string|max:2000',
            'ingredients'     => 'nullable|string|max:2000',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        $messages = [
            'product_name.required'    => 'El nombre del producto es obligatorio.',
            'product_name.max'         => 'El nombre no puede superar 255 caracteres.',
            'id_category.required'     => 'Selecciona una categoría.',
            'id_category.exists'       => 'La categoría seleccionada no es válida.',
            'price.required'           => 'El precio es obligatorio.',
            'price.numeric'            => 'El precio debe ser numérico.',
            'price.min'                => 'El precio no puede ser negativo.',
            'discount.numeric'         => 'El descuento debe ser numérico.',
            'discount.min'             => 'El descuento no puede ser negativo.',
            'discount.max'             => 'El descuento no puede superar 100%.',
            'available_unity.required' => 'Las unidades disponibles son obligatorias.',
            'available_unity.integer'  => 'Las unidades disponibles deben ser enteras.',
            'available_unity.min'      => 'Las unidades disponibles no pueden ser negativas.',
            'minimum_stock.integer'    => 'El stock mínimo debe ser entero.',
            'minimum_stock.min'        => 'El stock mínimo no puede ser negativo.',
            'maximum_stock.integer'    => 'El stock máximo debe ser entero.',
            'maximum_stock.min'        => 'El stock máximo no puede ser negativo.',
            'status.required'          => 'El estado es obligatorio.',
            'status.boolean'           => 'El estado no es válido.',
            'display_order.integer'    => 'El orden de visualización debe ser entero.',
            'display_order.min'        => 'El orden de visualización no puede ser negativo.',
            'description.max'          => 'La descripción no puede superar 2000 caracteres.',
            'ingredients.max'          => 'Los ingredientes no pueden superar 2000 caracteres.',
            'image.image'              => 'El archivo debe ser una imagen.',
            'image.mimes'              => 'La imagen debe ser JPG o PNG.',
            'image.max'                => 'La imagen no debe superar 2 MB.',
        ];

        $data = $request->validate($rules, $messages);

        // Validación adicional: mínimo no mayor que máximo
        if (!is_null($data['minimum_stock'] ?? null) && !is_null($data['maximum_stock'] ?? null) && $data['minimum_stock'] > $data['maximum_stock']) {
            return back()
                ->withErrors(['minimum_stock' => 'El stock mínimo no puede ser mayor que el stock máximo.'])
                ->withInput();
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Producto::create($data);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categoryOptions = Category::orderBy('name')->pluck('name', 'id_category');

        return view('admin.productos.edit', compact('producto', 'categoryOptions'));
    }

    /**
     * Actualizar producto.
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $rules = [
            'product_name'    => 'required|string|max:255',
            'id_category'     => 'required|exists:categories,id_category',
            'price'           => 'required|numeric|min:0',
            'discount'        => 'nullable|numeric|min:0|max:100',
            'available_unity' => 'required|integer|min:0',
            'minimum_stock'   => 'nullable|integer|min:0',
            'maximum_stock'   => 'nullable|integer|min:0',
            'status'          => 'required|boolean',
            'display_order'   => 'nullable|integer|min:0',
            'description'     => 'nullable|string|max:2000',
            'ingredients'     => 'nullable|string|max:2000',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        $messages = [
            'product_name.required'    => 'El nombre del producto es obligatorio.',
            'product_name.max'         => 'El nombre no puede superar 255 caracteres.',
            'id_category.required'     => 'Selecciona una categoría.',
            'id_category.exists'       => 'La categoría seleccionada no es válida.',
            'price.required'           => 'El precio es obligatorio.',
            'price.numeric'            => 'El precio debe ser numérico.',
            'price.min'                => 'El precio no puede ser negativo.',
            'discount.numeric'         => 'El descuento debe ser numérico.',
            'discount.min'             => 'El descuento no puede ser negativo.',
            'discount.max'             => 'El descuento no puede superar 100%.',
            'available_unity.required' => 'Las unidades disponibles son obligatorias.',
            'available_unity.integer'  => 'Las unidades disponibles deben ser enteras.',
            'available_unity.min'      => 'Las unidades disponibles no pueden ser negativas.',
            'minimum_stock.integer'    => 'El stock mínimo debe ser entero.',
            'minimum_stock.min'        => 'El stock mínimo no puede ser negativo.',
            'maximum_stock.integer'    => 'El stock máximo debe ser entero.',
            'maximum_stock.min'        => 'El stock máximo no puede ser negativo.',
            'status.required'          => 'El estado es obligatorio.',
            'status.boolean'           => 'El estado no es válido.',
            'display_order.integer'    => 'El orden de visualización debe ser entero.',
            'display_order.min'        => 'El orden de visualización no puede ser negativo.',
            'description.max'          => 'La descripción no puede superar 2000 caracteres.',
            'ingredients.max'          => 'Los ingredientes no pueden superar 2000 caracteres.',
            'image.image'              => 'El archivo debe ser una imagen.',
            'image.mimes'              => 'La imagen debe ser JPG o PNG.',
            'image.max'                => 'La imagen no debe superar 2 MB.',
        ];

        $data = $request->validate($rules, $messages);

        if (!is_null($data['minimum_stock'] ?? null) && !is_null($data['maximum_stock'] ?? null) && $data['minimum_stock'] > $data['maximum_stock']) {
            return back()
                ->withErrors(['minimum_stock' => 'El stock mínimo no puede ser mayor que el stock máximo.'])
                ->withInput();
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $producto->update($data);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Eliminar producto.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }

    /**
     * Mostrar productos al cliente.
     */
    public function shop(Request $request)
    {
        $category = $request->get('category');

        $query = Producto::with('category')->where('status', 1); // solo activos

        if ($category && $category !== 'todos') {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }

        $productos = $query->get();

        return view('users.productos', compact('productos', 'category'));
    }
}
