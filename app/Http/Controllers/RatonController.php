<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Raton;
use App\Marca;
use App\Ubicacion;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;

class RatonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ratones = DB::table('ratons')
            ->select('ratons.id', 'ratons.numero', 'marcas.nombre as marca', 'ratons.modelo', 'ubicacions.nombre as ubicacion')
            ->join('marcas', 'ratons.idmarca', '=', 'marcas.id')
            ->join('ubicacions', 'ratons.idubicacion', '=', 'ubicacions.id')
            ->orderBy('id', 'ASC')
            ->paginate(8);
        return view('raton.index', ['ratons' => $ratones]);
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
        return View('raton.create', compact('marcas', 'ubicaciones'));
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
            'tpraton' => 'max:20',
            'numserie' => 'max:25',
            'tamano' => 'max:20',
        ], [
            'numero.max' => 'El número no puede tener más de 20 caracteres.',
            'idmarca.required' => 'Introduce la marca por favor.',
            'modelo.required' => 'Introduce el modelo por favor.',
            'modelo.max' => 'El modelo no puede tener más de 20 caracteres.',
            'idubicacion.required' => 'Introduce la ubicación por favor.',
            'tpraton.max' => 'El tipo no puede tener más de 20 caracteres.',
            'numserie.max' => 'El número de serie no puede tener más de 25 caracteres.',
            'tamano.max' => 'El número de serie no puede tener más de 20 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect('ratons/create')
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        $paginacion = Raton::paginate();

        // Para establecer la última página que es donde se va a guardar el registro más reciente
        if (($paginacion->total() % $paginacion->lastPage()   == 0) && ($paginacion->total() == $paginacion->lastPage() *  $paginacion->perPage())) {
            // dd('La última página es: ' . ($paginacion->lastPage() + 1));
            $lastpage = $paginacion->lastPage() + 1;
        } else {
            // dd('La última página es: ' . $paginacion->lastPage());
            $lastpage = $paginacion->lastPage();
        }

        $data = Raton::create($request->all());
        Session::flash('success', 'Raton insertado');
        // return redirect()->route('ratons.index');
        return redirect()->route('ratons.index', ['page' => $lastpage, 'id' => $data->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Raton  $raton
     * @return \Illuminate\Http\Response
     */
    public function show(Raton $raton)
    {
        $tipo = 'show';
        $marca = Marca::findOrFail($raton->idmarca)->nombre;
        $ubicacion = Ubicacion::findOrFail($raton->idubicacion)->nombre;
        return View('raton.show', compact('raton', 'tipo', 'marca', 'ubicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Raton  $raton
     * @return \Illuminate\Http\Response
     */
    public function edit(Raton $raton)
    {
        $marcas = Marca::orderBy('nombre')->pluck('nombre', 'id');
        $ubicaciones = Ubicacion::orderBy('nombre')->pluck('nombre', 'id');
        return View('raton.edit', compact('marcas', 'ubicaciones', 'raton'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Raton  $raton
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Raton $raton)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'numero' => 'max:20',
            'idmarca' => 'required',
            'modelo' => 'required|max:20',
            'idubicacion' => 'required',
            'tpraton' => 'max:20',
            'numserie' => 'max:25',
            'tamano' => 'max:20',
        ], [
            'numero.max' => 'El número no puede tener más de 20 caracteres.',
            'idmarca.required' => 'Introduce la marca por favor.',
            'modelo.required' => 'Introduce el modelo por favor.',
            'modelo.max' => 'El modelo no puede tener más de 20 caracteres.',
            'idubicacion.required' => 'Introduce la ubicación por favor.',
            'tpraton.max' => 'El tipo no puede tener más de 20 caracteres.',
            'numserie.max' => 'El número de serie no puede tener más de 25 caracteres.',
            'tamano.max' => 'El número de serie no puede tener más de 20 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('ratons.edit', $raton->id)
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        // Calculo del indice de una fila en una tabla usando una determinada primary key
        $filas = DB::table(DB::raw('(SELECT ROW_NUMBER() OVER(ORDER BY id ASC) AS fila, id, numero FROM ratons) con_filas'))
            ->select('fila', 'numero')
            ->where('id', '=', $raton->id)
            // ->groupBy('status')
            ->get();

        $paginacion = Raton::paginate();
        $fila = $filas->pluck('fila')[0];
        $paginas = $paginacion->perPage();
        $pagina = ceil($fila / $paginas);


        $input = $request->all();
        $raton->fill($input)->save();
        Session::flash('success', 'Raton "' . $raton->id . '" actualizado');
        // return redirect()->route('ratons.index');
        return redirect()->route('ratons.index', ['page' => $pagina, 'id' => $raton->id]);
    }

    public function showdelete($id)
    {
        $tipo = 'delete';
        $raton = Raton::findOrFail($id);
        $marca = Marca::findOrFail($raton->idmarca)->nombre;
        $ubicacion = Ubicacion::findOrFail($raton->idubicacion)->nombre;
        return View('raton.show', compact('raton', 'tipo', 'marca', 'ubicacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Raton  $raton
     * @return \Illuminate\Http\Response
     */
    public function destroy(Raton $raton)
    {
        $raton->delete();
        Session::flash('success', 'Raton "' . $raton->id . '" eliminado');
        return redirect()->route('ratons.index');
    }
}
