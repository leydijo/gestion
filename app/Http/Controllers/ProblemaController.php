<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Problema;
use App\Models\Cliente;
use App\Models\Plataforma;
use Carbon\Carbon;

class ProblemaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-problema|crear-problema|editar-problema|borrar-problema')->only('index');
        $this->middleware('permission:crear-problema', ['only' => ['create','store'.'update']]);
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
        
        $problems = Problema::with(['plataforma','cliente'])->paginate(10);
     

        // $topProblemas = Problema::select('problemas.id', 'problemas.descripcion', 'plataformas.nombre AS plataforma', 'clientes.nombre AS cliente', DB::raw('COUNT(problemas.id) AS total'))
        //                     ->join('plataformas', 'problemas.plataforma_id', '=', 'plataformas.id')
        //                     ->join('clientes', 'problemas.cliente_id', '=', 'clientes.id')
        //                     ->groupBy('problemas.id')
        //                     ->orderByDesc('total')
        //                     ->take(10)
        //                     ->get();
        // $descrip = $topProblemas->pluck('cliente')->toArray();
        // $data = $topProblemas->pluck('total')->toArray();
        


        return view('problemas.index', compact('problems'));




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
     {
        $clientes = Cliente::all();
        $plataformas = Plataforma::all();
        //$problema = Problema::with(['clientes','plataformas'])->get();
        //dd($clientes);
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
            'titulo' => 'required',
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
       
        $editProblems = Problema::find($id);
        return view('problemas.index',compact('editProblems'));
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
        $this->validate($request, [
            'solucion' => 'required'
        ]);

        $problema = Problema::findOrFail($id);
        
        $data = $request->only(['solucion', 'solucionado_por','fecha_solucion','titulo','descripcion']);
    
        $problema->update($data);
        return redirect()->route('problemas.index');
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

    //GRaficos
    public function topProblemas()
    {
        $topProblemas = Problema::select('problemas.id', 'problemas.descripcion', 'plataformas.nombre AS plataforma', 'clientes.nombre AS cliente', DB::raw('COUNT(problemas.id) AS total'))
                            ->join('plataformas', 'problemas.plataforma_id', '=', 'plataformas.id')
                            ->join('clientes', 'problemas.cliente_id', '=', 'clientes.id')
                            ->groupBy('problemas.id')
                            ->orderByDesc('total')
                            ->take(10)
                            ->get();
        $descrip = $topProblemas->pluck('descripcion')->toArray();
        dd($descrip);
        $data = $topProblemas->pluck('total')->toArray();
        
        return view('problemas.index', compact('descrip', 'data'));
    }

}
