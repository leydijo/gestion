<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plataforma;
use App\Models\Cliente;

class PlataformaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-plataforma|crear-plataforma|editar-plataforma|borrar-plataforma')->only('index');
        $this->middleware('permission:crear-plataforma', ['only' => ['create','store']]);
        $this->middleware('permission:editar-plataforma', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-plataforma', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plataformas = Plataforma::with('cliente')->paginate(5);
        $envios = Plataforma::all();
        $data=[];

        foreach ($envios as $envio) {
            $data['label'][] = $envio->nombre;
            $data['data'][] = $envio->id;
        }
        $data_json =json_encode($data);

        return view('plataforma.index',compact('plataformas','data_json'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all()->pluck('nombre', 'id');
        return view('plataforma.crear', compact('clientes'));
        
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
            'nombre' => 'required',
            'url' => 'required',
            'cliente_id'=>'required'
           
        ]);
    
        Plataforma::create($request->all());
    
        return redirect()->route('plataformas.index');
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
    public function destroy( Plataforma $plataforma)
    {
        $plataforma->delete();
    
        return redirect()->route('plataformas.index');
    }
}
