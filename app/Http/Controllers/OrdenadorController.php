<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Ordenador;
use App\Marca;
use App\Ubicacion;
use DataTables;

use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;

class OrdenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $ordenadores = DB::table('ordenadors')
        //     ->select('ordenadors.id', 'ordenadors.numero', 'marcas.nombre as marca', 'ordenadors.modelo', 'ubicacions.nombre as ubicacion')
        //     ->join('marcas', 'ordenadors.idmarca', '=', 'marcas.id')
        //     ->join('ubicacions', 'ordenadors.idubicacion', '=', 'ubicacions.id')
        //     ->orderBy('id', 'ASC')
        //     ->paginate(8);
        // return view('ordenador.index', ['ordenadors' => $ordenadores]);


        if ($request->ajax()) {
            $items = DB::select('SELECT ordenadors.id, ordenadors.numero, marcas.nombre as marca, ordenadors.modelo, ubicacions.nombre as ubicacion FROM ordenadors,marcas,ubicacions where idmarca=marcas.id and idubicacion=ubicacions.id order by ordenadors.id;');
            return Datatables::of($items)->addColumn('action', function ($items) {
                $result = "";
                $result .= '<a href="ordenadors/' . $items->id . '" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Ver</a>';
                $result .= '<a href="ordenadors/' . $items->id . '/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Modif.</a>';
                $result .= '<a href="ordenadors/showdelete/' . $items->id . '" id="' . $items->id . '" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Borrar</a>';
                return $result;
            })->make();
        } else {
            $ordenadores = DB::table('ordenadors')
                ->select('ordenadors.id', 'ordenadors.numero', 'marcas.nombre as marca', 'ordenadors.modelo', 'ubicacions.nombre as ubicacion')
                ->join('marcas', 'ordenadors.idmarca', '=', 'marcas.id')
                ->join('ubicacions', 'ordenadors.idubicacion', '=', 'ubicacions.id')
                ->orderBy('id', 'ASC')
                ->paginate(8);
            return view('ordenador.index', ['ordenadors' => $ordenadores]);
        }
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
        return View('ordenador.create', compact('marcas', 'ubicaciones'));
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
            'tppc' => 'max:20',
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
            'tppc.max' => 'El tipo no puede tener más de 20 caracteres.',
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
            return redirect('ordenadors/create')
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        $paginacion = Ordenador::paginate();

        // Para establecer la última página que es donde se va a guardar el registro más reciente
        if (($paginacion->total() % $paginacion->lastPage()   == 0) && ($paginacion->total() == $paginacion->lastPage() *  $paginacion->perPage())) {
            // dd('La última página es: ' . ($paginacion->lastPage() + 1));
            $lastpage = $paginacion->lastPage() + 1;
        } else {
            // dd('La última página es: ' . $paginacion->lastPage());
            $lastpage = $paginacion->lastPage();
        }

        $data = Ordenador::create($request->all());
        Session::flash('success', 'Ordenador insertado');
        // return redirect()->route('ordenadors.index');
        return redirect()->route('ordenadors.index', ['page' => $lastpage, 'id' => $data->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ordenador  $ordenador
     * @return \Illuminate\Http\Response
     */
    public function show(Ordenador $ordenador)
    {
        $tipo = 'show';
        $marca = Marca::findOrFail($ordenador->idmarca)->nombre;
        $ubicacion = Ubicacion::findOrFail($ordenador->idubicacion)->nombre;
        return View('ordenador.show', compact('ordenador', 'tipo', 'marca', 'ubicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ordenador  $ordenador
     * @return \Illuminate\Http\Response
     */
    public function edit(Ordenador $ordenador)
    {
        $marcas = Marca::orderBy('nombre')->pluck('nombre', 'id');
        $ubicaciones = Ubicacion::orderBy('nombre')->pluck('nombre', 'id');
        return View('ordenador.edit', compact('marcas', 'ubicaciones', 'ordenador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ordenador  $ordenador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ordenador $ordenador)
    {
        $validator = Validator::make($request->all(), [
            'numero' => 'max:20',
            'idmarca' => 'required',
            'modelo' => 'required|max:20',
            'idubicacion' => 'required',
            'tppc' => 'max:20',
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
            'tppc.max' => 'El tipo no puede tener más de 20 caracteres.',
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
            return redirect()->route('ordenadors.edit', $ordenador->id)
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        // Calculo del indice de una fila en una tabla usando una determinada primary key
        $filas = DB::table(DB::raw('(SELECT ROW_NUMBER() OVER(ORDER BY id ASC) AS fila, id, numero FROM ordenadors) con_filas'))
            ->select('fila', 'numero')
            ->where('id', '=', $ordenador->id)
            // ->groupBy('status')
            ->get();

        $paginacion = Ordenador::paginate();
        $fila = $filas->pluck('fila')[0];
        $paginas = $paginacion->perPage();
        $pagina = ceil($fila / $paginas);


        $input = $request->all();
        $ordenador->fill($input)->save();
        Session::flash('success', 'Ordenador "' . $ordenador->id . '" actualizado');
        // return redirect()->route('ordenadors.index');
        return redirect()->route('ordenadors.index', ['page' => $pagina, 'id' => $ordenador->id]);
    }

    public function showdelete($id)
    {
        $tipo = 'delete';
        $ordenador = Ordenador::findOrFail($id);
        $marca = Marca::findOrFail($ordenador->idmarca)->nombre;
        $ubicacion = Ubicacion::findOrFail($ordenador->idubicacion)->nombre;
        return View('ordenador.show', compact('ordenador', 'tipo', 'marca', 'ubicacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ordenador  $ordenador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ordenador $ordenador)
    {
        $ordenador->delete();
        Session::flash('success', 'Ordenador "' . $ordenador->id . '" eliminado');
        return redirect()->route('ordenadors.index');
    }
}
