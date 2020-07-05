<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;



class Car extends Model
{
    //se realiza la llamada a la tabla en la base de datos
    protected $table = 'carrito';

    public $timestamps = false;

    protected $fillable = ['producto', 'nombre_producto', 'precio_unitario', 'cantidad', 'total'];

}
