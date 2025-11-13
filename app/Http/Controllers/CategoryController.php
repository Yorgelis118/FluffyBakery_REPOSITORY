<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Guardar nueva categoría.
     */
    public function store(Request $request)
    {
        // Normalizar el nombre antes de validar
        $normalizedName = ucfirst(strtolower(trim($request->input('name', ''))));
        
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($normalizedName) {
                    // Verificar si ya existe una categoría con el mismo nombre (case-insensitive)
                    $exists = \App\Models\Category::whereRaw('LOWER(name) = ?', [strtolower($normalizedName)])->exists();
                    if ($exists) {
                        $fail('Ya existe una categoría con ese nombre.');
                    }
                },
            ],
        ];

        $messages = [
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.max' => 'El nombre no puede superar 255 caracteres.',
        ];

        $data = $request->validate($rules, $messages);
        
        // Usar el nombre normalizado
        $data['name'] = $normalizedName;

        Category::create($data);

        return redirect()->route('productos.index')->with('success', 'Categoría creada correctamente.');
    }
}

