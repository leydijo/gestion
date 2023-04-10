<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Problema extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion','img_error','plataforma_id',
        'cliente_id','updated_at','created_at'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->fecha_creacion = Carbon::now();
        });

        static::updating(function ($model) {
            $model->fecha_creacion = Carbon::now();
        });
    }   
}
