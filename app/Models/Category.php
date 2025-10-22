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
}
