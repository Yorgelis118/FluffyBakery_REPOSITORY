<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id_category';
    public $timestamps = true; // si tu tabla tiene created_at y updated_at
    protected $keyType = 'int';

    protected $fillable = ['name'];

    // Relación con productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_category', 'id_category');
    }

    /**
     * Obtener el icono de Font Awesome según el nombre de la categoría
     */
    public function getIconAttribute()
    {
        $iconMap = [
            'Pasteles' => 'fa-birthday-cake',
            'Cupcakes' => 'fa-ice-cream',
            'Galletas' => 'fa-cookie-bite',
            'Rellenos' => 'fa-cheese',
            'Brownies' => 'fa-square',
            'Alfajores' => 'fa-cookie',
        ];

        return $iconMap[$this->name] ?? 'fa-tag'; // Icono por defecto si no hay coincidencia
    }

    /**
     * Obtener el slug de la categoría (nombre en minúsculas)
     */
    public function getSlugAttribute()
    {
        return strtolower($this->name);
    }
}
