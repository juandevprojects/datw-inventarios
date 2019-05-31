<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Dispred;
use App\Marca;
use App\Ubicacion;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;

class DispredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dispredes = DB::table('dispreds')
            ->select('dispreds.id', 'dispreds.numero', 'marcas.nombre as marca', 'dispreds.modelo', 'ubicacions.nombre as ubicacion')
            ->join('marcas', 'dispreds.idmarca', '=', 'marcas.id')
            ->join('ubicacions', 'dispreds.idubicacion', '=', 'ubicacions.id')
            ->orderBy('id', 'ASC')
            ->paginate(8);
        return view('dispred.index', ['dispreds' => $dispredes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::orderBy('nombre')->pluck('nombre', 'id');
        $ubicaciones = Ubicacion::orderBy('nombre')->pluck('nombre', 'id');
        return View('dispred.create', compact('marcas', 'ubicaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'numero' => 'max:20',
            'idmarca' => 'required',
            'modelo' => 'required|max:20',
            'idubicacion' => 'required',
            'tpdisp' => 'max:20',
            'numserie' => 'max:25',
            'red' => 'max:20',
            'maclan' => 'max:17',
            'iplan' => 'ip|max:15',
        ], [
            'numero.max' => 'El número no puede tener más de 20 caracteres.',
            'idmarca.required' => 'Introduce la marca por favor.',
            'modelo.required' => 'Introduce el modelo por favor.',
            'modelo.max' => 'El modelo no puede tener más de 20 caracteres.',
            'idubicacion.required' => 'Introduce la ubicación por favor.',
            'tpdisp.max' => 'El tipo no puede tener más de 20 caracteres.',
            'numserie.max' => 'El número de serie no puede tener más de 25 caracteres.',
            'red.max' => 'El número de serie no puede tener más de 20 caracteres.',
            'maclan.max' => 'La dirección MAC no puede tener más de 17 caracteres.',
            'iplan.max' => 'La ip no puede tener más de 15 caracteres.',
            'iplan.ip' => 'Introduzca una dirección ip valida',
        ]);

        if ($validator->fails()) {
            return redirect('dispreds/create')
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        $paginacion = Dispred::paginate();

        // Para establecer la última página que es donde se va a guardar el registro más reciente
        if (($paginacion->total() % $paginacion->lastPage()   == 0) && ($paginacion->total() == $paginacion->lastPage() *  $paginacion->perPage())) {
            // dd('La última página es: ' . ($paginacion->lastPage() + 1));
            $lastpage = $paginacion->lastPage() + 1;
        } else {
            // dd('La última página es: ' . $paginacion->lastPage());
            $lastpage = $paginacion->lastPage();
        }

        $data = Dispred::create($request->all());
        Session::flash('success', 'Dispred insertado');
        // return redirect()->route('dispreds.index');
        return redirect()->route('dispreds.index', ['page' => $lastpage, 'id' => $data->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dispred  $dispred
     * @return \Illuminate\Http\Response
     */
    public function show(Dispred $dispred)
    {
        $tipo = 'show';
        $marca = Marca::findOrFail($dispred->idmarca)->nombre;
        $ubicacion = Ubicacion::findOrFail($dispred->idubicacion)->nombre;
        return View('dispred.show', compact('dispred', 'tipo', 'marca', 'ubicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dispred  $dispred
     * @return \Illuminate\Http\Response
     */
    public function edit(Dispred $dispred)
    {
        $marcas = Marca::orderBy('nombre')->pluck('nombre', 'id');
        $ubicaciones = Ubicacion::orderBy('nombre')->pluck('nombre', 'id');
        return View('dispred.edit', compact('marcas', 'ubicaciones', 'dispred'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dispred  $dispred
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dispred $dispred)
    {
        $validator = Validator::make($request->all(), [
            'numero' => 'max:20',
            'idmarca' => 'required',
            'modelo' => 'required|max:20',
            'idubicacion' => 'required',
            'tpdisp' => 'max:20',
            'numserie' => 'max:25',
            'red' => 'max:20',
            'maclan' => 'max:17',
            'iplan' => 'max:15',
            'macwifi' => 'max:17',
            'ipwifi' => 'max:15',
            'hd1' => 'max:50',
            'hd2' => 'max:50',
        ], [
            'numero.max' => 'El número no puede tener más de 20 caracteres.',
            'idmarca.required' => 'Introduce la marca por favor.',
            'modelo.required' => 'Introduce el modelo por favor.',
            'modelo.max' => 'El modelo no puede tener más de 20 caracteres.',
            'idubicacion.required' => 'Introduce la ubicación por favor.',
            'tpdisp.max' => 'El tipo no puede tener más de 20 caracteres.',
            'numserie.max' => 'El número de serie no puede tener más de 25 caracteres.',
            'red.max' => 'El número de serie no puede tener más de 20 caracteres.',
            'maclan.max' => 'El número de serie no puede tener más de 17 caracteres.',
            'iplan.max' => 'El número de serie no puede tener más de 15 caracteres.',
            'macwifi.max' => 'El número de serie no puede tener más de 17 caracteres.',
            'ipwifi.max' => 'El número de serie no puede tener más de 15 caracteres.',
            'hd1.max' => 'El número de serie no puede tener más de 50 caracteres.',
            'hd2.max' => 'El número de serie no puede tener más de 50 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dispreds.edit', $dispred->id)
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        // Calculo del indice de una fila en una tabla usando una determinada primary key
        $filas = DB::table(DB::raw('(SELECT ROW_NUMBER() OVER(ORDER BY id ASC) AS fila, id, numero FROM dispreds) con_filas'))
            ->select('fila', 'numero')
            ->where('id', '=', $dispred->id)
            // ->groupBy('status')
            ->get();

        $paginacion = Dispred::paginate();
        $fila = $filas->pluck('fila')[0];
        $paginas = $paginacion->perPage();
        $pagina = ceil($fila / $paginas);


        $input = $request->all();
        $dispred->fill($input)->save();
        Session::flash('success', 'Dispred "' . $dispred->id . '" actualizado');
        // return redirect()->route('dispreds.index');
        return redirect()->route('dispreds.index', ['page' => $pagina, 'id' => $dispred->id]);
    }

    public function showdelete($id)
    {
        $tipo = 'delete';
        $dispred = Dispred::findOrFail($id);
        $marca = Marca::findOrFail($dispred->idmarca)->nombre;
        $ubicacion = Ubicacion::findOrFail($dispred->idubicacion)->nombre;
        return View('dispred.show', compact('dispred', 'tipo', 'marca', 'ubicacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dispred  $dispred
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dispred $dispred)
    {
        $dispred->delete();
        Session::flash('success', 'Dispred "' . $dispred->id . '" eliminado');
        return redirect()->route('dispreds.index');
    }
}
