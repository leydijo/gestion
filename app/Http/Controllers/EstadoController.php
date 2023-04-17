<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Problema;
use App\Models\Cliente;
use App\Models\Plataforma;
use App\Models\EstadoPlataforma;
use App\Models\Estado;


class EstadoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-estado|crear-estado|editar-estado|borrar-estado')->only('index');
        $this->middleware('permission:crear-estado', ['only' => ['create','store']]);
        $this->middleware('permission:editar-estado', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-estado', ['only' => ['destroy']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $plataformas = EstadoPlataforma::with('plataforma','cliente','estado')
                ->orderByDesc('fecha_creacion')
                ->paginate(50);
        $estados = Estado::all();
        return view('estado.index', compact('plataformas', 'estados'));
                
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all()->pluck('nombre', 'id');
        $plataformas = Plataforma::all();
        $estados = Estado::all()->pluck('nombre', 'id');
       
        return view('estado.crear', compact('clientes','plataformas','estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = Auth::user();
        
        request()->validate([
            'cliente_id' => 'required',
            'plataforma_id' => 'required',
            'estado_id' => 'required'
        ]);
    
        $estadoPlataforma = new EstadoPlataforma([
            'cliente_id' => $request->get('cliente_id'),
            'plataforma_id' => $request->get('plataforma_id'),
            'estado_id' => $request->get('estado_id'),
            'creado_por' => $usuario->name // o $usuario->email, dependiendo de cómo tengas configurado el modelo User
        ]);
        $estadoPlataforma->save();
    
        return redirect()->route('estados.index');
    }
    
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $plataforma = Plataforma::findOrFail($id);
        $plataforma->estado_id = $request->input('estado');
        $plataforma->save();

        return back()->with('success', 'Estado actualizado correctamente.');
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    

}
