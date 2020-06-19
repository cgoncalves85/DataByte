<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dato extends Model
{
    protected $fillable = ['user_id', 'nombre', 'apellido', 'email', 'telefono', 'imagen', 'descripcion'];
}
