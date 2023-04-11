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
        $this->middleware('permission:ver-problema|crear-problema|editar-problema|borrar-problema')->only('index');
        $this->middleware('permission:crear-problema', ['only' => ['create','store']]);
        $this->middleware('permission:editar-problema', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-problema', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $problemas = Problema::with('cliente')->paginate(5);
        $plataformas = Problema::with('plataforma')->paginate(5);
    
        return view('problemas.index',compact('problemas','plataformas'));
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
        $datos = $request->except('_token');
        if ($request->hasFile('img_error')) {
            $datos['img_error'] = $request->file('img_error')->store('uploads','public');
        }
        
       $data= Problema::create($datos);
        

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
