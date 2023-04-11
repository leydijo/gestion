<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Problema;

class Plataforma extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre','url','cliente_id','updated_at','created_at'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'id');
    }
    public function problemas()
    {
        return $this->hasMany(Problema::class);
    }
   
}
