<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Plataforma;
use App\Models\Cliente;

class Problema extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion','img_error','plataforma_id','fecha_creacion',
        'cliente_id','updated_at','created_at'
    ];
   public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function plataforma()
    {
        return $this->belongsTo(Plataforma::class);
    }
}
