<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operaciones sobre tabla clientes
            'ver-cliente',
            'crear-cliente',
            'editar-cliente',
            'borrar-cliente',

             //Operaciones sobre tabla problema
             'ver-problema',
             'crear-problema',
             'editar-problema',
             'borrar-problema',

             //Operaciones sobre tabla estado
             'ver-estado',
             'crear-estado',
             'editar-estado',
             'borrar-estado',

             //Operaciones sobre tabla plataforma
             'ver-plataforma',
             'crear-plataforma',
             'editar-plataforma',
             'borrar-plataforma',
             

            
        ];

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
