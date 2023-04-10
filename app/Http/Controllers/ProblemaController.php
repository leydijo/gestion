<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problema;
use App\Models\Cliente;
use App\Models\Plataforma;

class ProblemaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-problm|crear-problm|editar-problm|borrar-problm')->only('index');
        $this->middleware('permission:crear-problm', ['only' => ['create','store']]);
        $this->middleware('permission:editar-problm', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-problm', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $problemas = Problema::paginate(5);
        return view('problemas.index',compact('problemas'));
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
        
        return view('problemas.crear', compact('clientes','plataformas'));
       
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
            'descripcion' => 'required'
           
        ]);
    
        Problema::create($request->all());
    
        return redirect()->route('problemas.index');
    
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
    public function destroy(Problema $problema)
    {
        $problema->delete();
    
        return redirect()->route('problemas.index');
    }
}
