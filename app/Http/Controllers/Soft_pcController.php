<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Soft_pc;
use App\Ordenador;
use App\Software;
use App\Marca;
use App\Ubicacion;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;

class Soft_pcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // num.PC, Marca, Ubicación, Software, Tipo, Fecha Inst
    public function index()
    {
        $soft_pces = DB::table('soft_pcs')
            ->select('soft_pcs.id as id', 'soft_pcs.fechainst as fecha_instalacion',
                     'softwares.descripcion as descripcion', 'softwares.tpsoft as tipo',
                     'ordenadors.numero as numPC',
                     'marcas.nombre as marca',
                     'ubicacions.nombre as ubicacion')
            ->join('ordenadors', 'soft_pcs.idpc', '=', 'ordenadors.id')
            ->join('softwares', 'soft_pcs.idsoft', '=', 'softwares.id')
            ->join('marcas', 'ordenadors.idmarca', '=', 'marcas.id') // Si deseo mostrar la marca del software sino coloco softwares.idmarca
            ->join('ubicacions', 'ordenadors.idubicacion', '=', 'ubicacions.id')
            ->orderBy('id', 'ASC')
            ->paginate(8);
        return view('soft_pc.index', ['soft_pcs' => $soft_pces]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ordenadors = Ordenador::orderBy('numero')->pluck( 'numero', 'id');
        $softwares = Software::orderBy('descripcion')->pluck('descripcion', 'id');
        return view('soft_pc.create', compact( 'ordenadors', 'softwares'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Soft_pc  $soft_pc
     * @return \Illuminate\Http\Response
     */
    public function show(Soft_pc $soft_pc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Soft_pc  $soft_pc
     * @return \Illuminate\Http\Response
     */
    public function edit(Soft_pc $soft_pc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Soft_pc  $soft_pc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Soft_pc $soft_pc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Soft_pc  $soft_pc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soft_pc $soft_pc)
    {
        //
    }
}
