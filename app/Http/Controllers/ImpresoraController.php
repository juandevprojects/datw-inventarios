<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Impresora;
use App\Marca;
use App\Ubicacion;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;

class ImpresoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $impresoras = DB::table('impresoras')
            ->select('impresoras.id', 'impresoras.numero', 'marcas.nombre as marca', 'impresoras.modelo', 'ubicacions.nombre as ubicacion')
            ->join('marcas', 'impresoras.idmarca', '=', 'marcas.id')
            ->join('ubicacions', 'impresoras.idubicacion', '=', 'ubicacions.id')
            ->orderBy('id', 'ASC')
            ->paginate(8);
        return view('impresora.index', ['impresoras' => $impresoras]);
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
        return View('impresora.create', compact('marcas', 'ubicaciones'));
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
            'tpimpresora' => 'max:20',
            'numserie' => 'max:25',
            'memoria' => 'numeric',
        ], [
            'numero.max' => 'El número no puede tener más de 20 caracteres.',
            'idmarca.required' => 'Introduce la marca por favor.',
            'modelo.required' => 'Introduce el modelo por favor.',
            'modelo.max' => 'El modelo no puede tener más de 20 caracteres.',
            'idubicacion.required' => 'Introduce la ubicación por favor.',
            'tpimpresora.max' => 'El tipo no puede tener más de 20 caracteres.',
            'numserie.max' => 'El número de serie no puede tener más de 25 caracteres.',
            'memoria.numeric' => 'La memoria debe ser un número entero en Megabytes',
        ]);

        if ($validator->fails()) {
            return redirect('impresoras/create')
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        $paginacion = Impresora::paginate();

        // Para establecer la última página que es donde se va a guardar el registro más reciente
        if (($paginacion->total() % $paginacion->lastPage()   == 0) && ($paginacion->total() == $paginacion->lastPage() *  $paginacion->perPage())) {
            // dd('La última página es: ' . ($paginacion->lastPage() + 1));
            $lastpage = $paginacion->lastPage() + 1;
        } else {
            // dd('La última página es: ' . $paginacion->lastPage());
            $lastpage = $paginacion->lastPage();
        }

        $data = Impresora::create($request->all());
        Session::flash('success', 'Impresora insertado');
        // return redirect()->route('impresoras.index');
        return redirect()->route('impresoras.index', ['page' => $lastpage, 'id' => $data->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Impresora  $impresora
     * @return \Illuminate\Http\Response
     */
    public function show(Impresora $impresora)
    {
        $tipo = 'show';
        $marca = Marca::findOrFail($impresora->idmarca)->nombre;
        $ubicacion = Ubicacion::findOrFail($impresora->idubicacion)->nombre;
        return View('impresora.show', compact('impresora', 'tipo', 'marca', 'ubicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Impresora  $impresora
     * @return \Illuminate\Http\Response
     */
    public function edit(Impresora $impresora)
    {
        $marcas = Marca::orderBy('nombre')->pluck('nombre', 'id');
        $ubicaciones = Ubicacion::orderBy('nombre')->pluck('nombre', 'id');
        return View('impresora.edit', compact('marcas', 'ubicaciones', 'impresora'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Impresora  $impresora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Impresora $impresora)
    {
        $validator = Validator::make($request->all(), [
            'numero' => 'max:20',
            'idmarca' => 'required',
            'modelo' => 'required|max:20',
            'idubicacion' => 'required',
            'tpimpresora' => 'max:20',
            'numserie' => 'max:25',
            'memoria' => 'numeric',
        ], [
            'numero.max' => 'El número no puede tener más de 20 caracteres.',
            'idmarca.required' => 'Introduce la marca por favor.',
            'modelo.required' => 'Introduce el modelo por favor.',
            'modelo.max' => 'El modelo no puede tener más de 20 caracteres.',
            'idubicacion.required' => 'Introduce la ubicación por favor.',
            'tpimpresora.max' => 'El tipo no puede tener más de 20 caracteres.',
            'numserie.max' => 'El número de serie no puede tener más de 25 caracteres.',
            'memoria.numeric' => 'La memoria debe ser un número entero en Megabytes',
        ]);

        if ($validator->fails()) {
            return redirect()->route('impresoras.edit', $impresora->id)
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        // Calculo del indice de una fila en una tabla usando una determinada primary key
        $filas = DB::table(DB::raw('(SELECT ROW_NUMBER() OVER(ORDER BY id ASC) AS fila, id, numero FROM impresoras) con_filas'))
            ->select('fila', 'numero')
            ->where('id', '=', $impresora->id)
            // ->groupBy('status')
            ->get();

        $paginacion = Impresora::paginate();
        $fila = $filas->pluck('fila')[0];
        $paginas = $paginacion->perPage();
        $pagina = ceil($fila / $paginas);


        $input = $request->all();
        $impresora->fill($input)->save();
        Session::flash('success', 'Impresora "' . $impresora->id . '" actualizado');
        // return redirect()->route('impresoras.index');
        return redirect()->route('impresoras.index', ['page' => $pagina, 'id' => $impresora->id]);
    }

    public function showdelete($id)
    {
        $tipo = 'delete';
        $impresora = Impresora::findOrFail($id);
        $marca = Marca::findOrFail($impresora->idmarca)->nombre;
        $ubicacion = Ubicacion::findOrFail($impresora->idubicacion)->nombre;
        return View('impresora.show', compact('impresora', 'tipo', 'marca', 'ubicacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Impresora  $impresora
     * @return \Illuminate\Http\Response
     */
    public function destroy(Impresora $impresora)
    {
        $impresora->delete();
        Session::flash('success', 'Impresora "' . $impresora->id . '" eliminado');
        return redirect()->route('impresoras.index');
    }
}
