<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problema;
use App\Models\Cliente;
use App\Models\Plataforma;
use App\Models\EstadoPlataforma;
use App\Models\Estado;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = EstadoPlataforma::with('cliente')->paginate(5);
        $plataformas = EstadoPlataforma::with('plataforma','cliente','estado')->get();
        
        //dd($plataformas);
        return view('estado.index',compact('cliente','plataformas'));
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
        request()->validate([
            'cliente_id' => 'required',
            'plataforma_id' => 'required',
            'estado_id' => 'required'
           
        ]);
        //dd($request->all());
        EstadoPlataforma::create($request->all());
    
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
