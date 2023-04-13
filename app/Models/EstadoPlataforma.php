<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estado;
use App\Models\Cliente;
use App\Models\Plataforma;

class EstadoPlataforma extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'estado_id','plataforma_id',
        'cliente_id','updated_at','created_at'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function plataforma()
    {
        return $this->belongsTo(Plataforma::class);
    }
}
