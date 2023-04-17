<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plataforma;
use App\Models\Problema;
use App\Models\Cliente;
use App\Models\EstadoPlataforma;
use App\Models\Estado;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $topClientes = Problema::select('cliente_id', DB::raw('COUNT(*) as totalRegistros'))
        ->groupBy('cliente_id')
        ->orderByDesc('totalRegistros')
        ->take(10)
        ->get();
        
        $data = [];
        
        foreach ($topClientes as $cliente) {
            $nombreCliente = Cliente::find($cliente->cliente_id)->nombre;
            $data['label'][] = $nombreCliente;
            $data['data'][] = $cliente->totalRegistros;
        }
        
        $data_json = json_encode($data);

        $topClientes = Problema::select('creado_por', DB::raw('COUNT(*) as totalRegistros'))
        ->groupBy('creado_por')
        ->orderByDesc('totalRegistros')
        ->take(10)
        ->get();

        $data = [];

        foreach ($topClientes as $cliente) {
        $data['label'][] = $cliente->creado_por;
        $data['data'][] = $cliente->totalRegistros;
        }

        $data_json2 = json_encode($data);
        
        $fecha = Carbon::yesterday()->toDateString();

        $resultados = DB::table('estado_plataformas as ep')
        ->select('clientes.nombre as nombreCliente', 'plataformas.nombre as nombrePlataforma', DB::raw("(SELECT estados.nombre FROM estado_plataformas as e WHERE e.plataforma_id = ep.plataforma_id ORDER BY e.fecha_creacion DESC LIMIT 1) as estado"))
        ->join('plataformas', 'ep.plataforma_id', '=', 'plataformas.id')
        ->join('clientes', 'ep.cliente_id', '=', 'clientes.id')
        ->join('estados', 'ep.estado_id', '=', 'estados.id')
        ->where(function($query){
            $query->where(DB::raw("(SELECT estados.nombre FROM estado_plataformas as e WHERE e.plataforma_id = ep.plataforma_id ORDER BY e.fecha_creacion DESC LIMIT 1)"), '=', 'caido')
            ->orWhereNotExists(function($query){
                $query->select(DB::raw(1))
                      ->from('estado_plataformas as e2')
                      ->whereRaw('e2.plataforma_id = ep.plataforma_id');
            });
        })
        ->where('ep.fecha_creacion', '>', now()->subDays(2)) // Agregamos la condición para los últimos dos días
        ->orderBy('ep.fecha_creacion', 'desc')
        ->get();

            return view('home', [
                'data_json' => $data_json,
                'data_json2' => $data_json2,
                'resultados' => $resultados, // Agregamos los resultados de la consulta a la vista
                'topClientes' => $topClientes,
            ]);
    
    
    }
    // public function Grafica()
    // {
        
    //     $envios = Plataforma::all();
    //     $data=[];

    //     foreach ($envios as $envio) {
    //         $data['label'][] = $envio->nombre;
    //         $data['data'][] = $envio->id;
    //     }
    //     $data_json =json_encode($data);
    //     return view('home',compact('data_json'));
       
    // }
}
