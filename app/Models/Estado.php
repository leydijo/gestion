<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EstadoPlataforma;

class Estado extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre','updated_at','created_at'
    ];

    public function estadoPlataformas()
    {
        return $this->hasMany(EstadoPlataforma::class, 'estado_id');
    }
}
