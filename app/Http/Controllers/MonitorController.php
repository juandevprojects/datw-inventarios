<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Monitor;
use App\Marca;
use App\Ubicacion;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monitores = DB::table('monitors')
            ->select('monitors.id', 'monitors.numero', 'marcas.nombre as marca', 'monitors.modelo', 'ubicacions.nombre as ubicacion')
            ->join('marcas', 'monitors.idmarca', '=', 'marcas.id')
            ->join('ubicacions', 'monitors.idubicacion', '=', 'ubicacions.id')
            ->orderBy('id', 'ASC')
            ->paginate(8);
        return view('monitor.index', ['monitors' => $monitores]);
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
        return View('monitor.create', compact('marcas', 'ubicaciones'));
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
            'tpmon' => 'max:20',
            'numserie' => 'max:25',
            'tamano' => 'max:20',
        ], [
            'numero.max' => 'El número no puede tener más de 20 caracteres.',
            'idmarca.required' => 'Introduce la marca por favor.',
            'modelo.required' => 'Introduce el modelo por favor.',
            'modelo.max' => 'El modelo no puede tener más de 20 caracteres.',
            'idubicacion.required' => 'Introduce la ubicación por favor.',
            'tpmon.max' => 'El tipo no puede tener más de 20 caracteres.',
            'numserie.max' => 'El número de serie no puede tener más de 25 caracteres.',
            'tamano.max' => 'El número de serie no puede tener más de 20 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect('monitors/create')
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        $paginacion = Monitor::paginate();

        // Para establecer la última página que es donde se va a guardar el registro más reciente
        if (($paginacion->total() % $paginacion->lastPage()   == 0) && ($paginacion->total() == $paginacion->lastPage() *  $paginacion->perPage())) {
            // dd('La última página es: ' . ($paginacion->lastPage() + 1));
            $lastpage = $paginacion->lastPage() + 1;
        } else {
            // dd('La última página es: ' . $paginacion->lastPage());
            $lastpage = $paginacion->lastPage();
        }

        $data = Monitor::create($request->all());
        Session::flash('success', 'Monitor insertado');
        // return redirect()->route('monitors.index');
        return redirect()->route('monitors.index', ['page' => $lastpage, 'id' => $data->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function show(Monitor $monitor)
    {
        $tipo = 'show';
        $marca = Marca::findOrFail($monitor->idmarca)->nombre;
        $ubicacion = Ubicacion::findOrFail($monitor->idubicacion)->nombre;
        return View('monitor.show', compact('monitor', 'tipo', 'marca', 'ubicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Monitor $monitor)
    {
        $marcas = Marca::orderBy('nombre')->pluck('nombre', 'id');
        $ubicaciones = Ubicacion::orderBy('nombre')->pluck('nombre', 'id');
        return View('monitor.edit', compact('marcas', 'ubicaciones', 'monitor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Monitor $monitor)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'numero' => 'max:20',
            'idmarca' => 'required',
            'modelo' => 'required|max:20',
            'idubicacion' => 'required',
            'tpmon' => 'max:20',
            'numserie' => 'max:25',
            'tamano' => 'max:20',
        ], [
            'numero.max' => 'El número no puede tener más de 20 caracteres.',
            'idmarca.required' => 'Introduce la marca por favor.',
            'modelo.required' => 'Introduce el modelo por favor.',
            'modelo.max' => 'El modelo no puede tener más de 20 caracteres.',
            'idubicacion.required' => 'Introduce la ubicación por favor.',
            'tpmon.max' => 'El tipo no puede tener más de 20 caracteres.',
            'numserie.max' => 'El número de serie no puede tener más de 25 caracteres.',
            'tamano.max' => 'El número de serie no puede tener más de 20 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('monitors.edit', $monitor->id)
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        // Calculo del indice de una fila en una tabla usando una determinada primary key
        $filas = DB::table(DB::raw('(SELECT ROW_NUMBER() OVER(ORDER BY id ASC) AS fila, id, numero FROM monitors) con_filas'))
            ->select('fila', 'numero')
            ->where('id', '=', $monitor->id)
            // ->groupBy('status')
            ->get();

        $paginacion = Monitor::paginate();
        $fila = $filas->pluck('fila')[0];
        $paginas = $paginacion->perPage();
        $pagina = ceil($fila / $paginas);


        $input = $request->all();
        $monitor->fill($input)->save();
        Session::flash('success', 'Monitor "' . $monitor->id . '" actualizado');
        // return redirect()->route('monitors.index');
        return redirect()->route('monitors.index', ['page' => $pagina, 'id' => $monitor->id]);
    }

    public function showdelete($id)
    {
        $tipo = 'delete';
        $monitor = Monitor::findOrFail($id);
        $marca = Marca::findOrFail($monitor->idmarca)->nombre;
        $ubicacion = Ubicacion::findOrFail($monitor->idubicacion)->nombre;
        return View('monitor.show', compact('monitor', 'tipo', 'marca', 'ubicacion'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Monitor $monitor)
    {
        $monitor->delete();
        Session::flash('success', 'Monitor "' . $monitor->id . '" eliminado');
        return redirect()->route('monitors.index');
    }
}
