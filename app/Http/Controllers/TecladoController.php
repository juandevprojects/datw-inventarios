<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Teclado;
use App\Marca;
use App\Ubicacion;

use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;


class TecladoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teclados = DB::table('teclados')
            ->select('teclados.id', 'teclados.numero', 'marcas.nombre as marca', 'teclados.modelo', 'ubicacions.nombre as ubicacion') // Selecciono las columnas que quiero ver de cada marca
            ->join('marcas', 'teclados.idmarca', '=', 'marcas.id') // uno la tabla marcas con la tabla teclados con un valor de busqueda
            ->join('ubicacions', 'teclados.idubicacion', '=', 'ubicacions.id') // uno la tabla ubicacions con la tabla teclado que anteriormente está unido con la tabla marcas
            ->orderBy('id', 'ASC')
            ->paginate(8);
        return view('teclado.index', ['teclados' => $teclados]);
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
        return View('teclado.create', compact('marcas', 'ubicaciones'));
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
            'tptec' => 'max:20',
            'numserie' => 'max:25',
        ], [
            'numero.max' => 'El número no puede tener más de 20 caracteres.',
            'idmarca.required' => 'Introduce la marca por favor.',
            'modelo.required' => 'Introduce el modelo por favor.',
            'modelo.max' => 'El modelo no puede tener más de 20 caracteres.',
            'idubicacion.required' => 'Introduce la ubicación por favor.',
            'tptec.max' => 'El tipo no puede tener más de 20 caracteres.',
            'numserie.max' => 'El número de serie no puede tener más de 25 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect('teclados/create')
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        $paginacion = Teclado::paginate();

        // Para establecer la última página que es donde se va a guardar el registro más reciente
        if (($paginacion->total() % $paginacion->lastPage()   == 0) && ($paginacion->total() == $paginacion->lastPage() *  $paginacion->perPage())) {
            // dd('La última página es: ' . ($paginacion->lastPage() + 1));
            $lastpage = $paginacion->lastPage() + 1;
        } else {
            // dd('La última página es: ' . $paginacion->lastPage());
            $lastpage = $paginacion->lastPage();
        }

        $data = Teclado::create($request->all());
        Session::flash('success', 'Teclado insertado');
        // return redirect()->route('teclados.index');
        return redirect()->route('teclados.index', ['page' => $lastpage, 'id' => $data->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teclado  $teclado
     * @return \Illuminate\Http\Response
     */
    public function show(Teclado $teclado)
    {
        $tipo = 'show';
        $marca = Marca::findOrFail($teclado->idmarca)->nombre;
        $ubicacion = Ubicacion::findOrFail($teclado->idubicacion)->nombre;
        return View('teclado.show', compact('teclado', 'tipo', 'marca', 'ubicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teclado  $teclado
     * @return \Illuminate\Http\Response
     */
    public function edit(Teclado $teclado)
    {
        $marcas = Marca::orderBy('nombre')->pluck('nombre', 'id');
        $ubicaciones = Ubicacion::orderBy('nombre')->pluck('nombre', 'id');
        return View('teclado.edit', compact('marcas', 'ubicaciones', 'teclado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teclado  $teclado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teclado $teclado)
    {
        $validator = Validator::make($request->all(), [
            'numero' => 'max:20',
            'idmarca' => 'required',
            'modelo' => 'required|max:20',
            'idubicacion' => 'required',
            'tptec' => 'max:20',
            'numserie' => 'max:25',
        ], [
            'numero.max' => 'El número no puede tener más de 20 caracteres.',
            'idmarca.required' => 'Introduce la marca por favor.',
            'modelo.required' => 'Introduce el modelo por favor.',
            'modelo.max' => 'El modelo no puede tener más de 20 caracteres.',
            'idubicacion.required' => 'Introduce la ubicación por favor.',
            'tptec.max' => 'El tipo no puede tener más de 20 caracteres.',
            'numserie.max' => 'El número de serie no puede tener más de 25 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('teclados.edit', $teclado->id)
                            ->withErrors($validator)
                            ->withInput();
        }

        // **** Arreglo de página
        // Calculo del indice de una fila en una tabla usando una determinada primary key
        $filas = DB::table(DB::raw('(SELECT ROW_NUMBER() OVER(ORDER BY id ASC) AS fila, id, numero FROM teclados) con_filas'))
            ->select('fila', 'numero')
            ->where('id', '=', $teclado->id)
            // ->groupBy('status')
            ->get();

        $paginacion = Teclado::paginate();
        $fila = $filas->pluck('fila')[0];
        $paginas = $paginacion->perPage();
        $pagina = ceil($fila / $paginas);


        $input = $request->all();
        $teclado->fill($input)->save();
        Session::flash('success', 'Teclado "' . $teclado->id . '" actualizado');
        // return redirect()->route('teclados.index');
        return redirect()->route('teclados.index', ['page' => $pagina, 'id' => $teclado->id]);

    }

    public function showdelete($id)
    {
        $tipo = 'delete';
        $teclado = Teclado::findOrFail($id);
        $marca = Marca::findOrFail($teclado->idmarca)->nombre;
        $ubicacion = Ubicacion::findOrFail($teclado->idubicacion)->nombre;
        return View('teclado.show', compact('teclado', 'tipo', 'marca', 'ubicacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teclado  $teclado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teclado $teclado)
    {
        $teclado->delete();
        Session::flash('success', 'Teclado "' . $teclado->id . '" eliminado');
        return redirect()->route('teclados.index');
    }
}
