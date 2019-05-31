<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Ubicacion;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;


// use App\Http\Controllers\Controller;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ubicaciones = Ubicacion::paginate(8, ['id', 'nombre']);
        return view( 'ubicacion.index', [ 'ubicaciones' => $ubicaciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ubicacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de los campos del formulario
        $validator = Validator::make(
            $request->all(),
            ['nombre' => 'required|max:50|unique:ubicacions',],
            ['nombre.unique' => 'No se ha grabado porque la ubicación introducida porque ya la has usado antes. Introduce otra por favor.', 'nombre.required' => 'Introduce la ubicación por favor.']
        );

        if ($validator->fails()) {
            return redirect('ubicacions/create')
                ->withErrors($validator)
                ->withInput();
        }

        // Preparo presentacion de la información
        $paginacion = Ubicacion::paginate();

        // Para establecer la última página que es donde se va a guardar el registro más reciente
        if (($paginacion->total() % $paginacion->lastPage()   == 0) && ($paginacion->total() == $paginacion->lastPage() *  $paginacion->perPage())) {
            // dd('La última página es: ' . ($paginacion->lastPage() + 1));
            $lastpage = $paginacion->lastPage() + 1;
        } else {
            // dd('La última página es: ' . $paginacion->lastPage());
            $lastpage = $paginacion->lastPage();
        }

        // Ubicacion::create($request->except('_token')); // Si utilizamos html normal
        $data = Ubicacion::create($request->all()); // Si utilizamos laravel collective
        Session::flash('success', 'Ubicacion "' . $request->all()['nombre'] . '" insertada');
        return redirect()->route('ubicacions.index', ['page' => $lastpage, 'id' => $data->id]); // PAso en la url page para que aparezca la vista index en la página donde se incluye la nueva fila y 'id' para que el blade me resalte la nueva fila instalada
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Ubicacion $ubicacion)
    {
        $tipo = 'delete';
        return view('ubicacion.show', compact('ubicacion', 'tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Ubicacion $ubicacion)
    {
        return view('ubicacion.edit', ['ubicacion' => $ubicacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ubicacion $ubicacion)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50|unique:ubicacions',
        ], [
            'nombre.unique' => 'No se ha grabado porque la ubicacion introducida ya la has usado antes. Introduce otra por favor.',
            'nombre.required' => 'Introduce la ubicacion por favor.'
        ]);
        if ($validator->fails()) {
            return redirect()->route('ubicacions.edit', $ubicacion->id)->withErrors($validator)->withInput();
            // equivalente redirect('ubicacions/'. $ubicacion->id.'/edit')->withErrors($validator)->withInput();
        }

        // Calculo del indice de una fila en una tabla usando una determinada primary key
        $filas = DB::table(DB::raw('(SELECT ROW_NUMBER() OVER(ORDER BY id ASC) AS fila, id, nombre FROM ubicacions) con_filas'))
            ->select('fila', 'nombre')
            ->where('id', '=', $ubicacion->id)
            // ->groupBy('status')
            ->get();

        $paginacion = Ubicacion::paginate();
        $fila = $filas->pluck('fila')[0];
        $paginas = $paginacion->perPage();
        $pagina = ceil($fila / $paginas);

        $input = $request->all();
        $ubicacion->fill($input)->save();
        Session::flash('success', 'Ubicacion "' . $ubicacion->id . '" actualizada');
        return redirect()->route('ubicacions.index', ['page' => $pagina, 'id' => $ubicacion->id]);
        // dd( $paginacion->url(3)); //Buscar la forma en que paginación me mande para el index directo con la página sin el id
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ubicacion $ubicacion)
    {
        try {
            $ubicacion->delete();
            Session::flash('success', 'La ubicacion "' . $ubicacion->nombre . '" fue eliminada');
            return redirect()->route('ubicacions.index');
        } catch (\Illuminate\Database\QueryException $ex) {
            $error = $ex->errorInfo;
            if ($error[0] == 23000) {
                $txterror = "No se puede eliminar la ubicacion porque se utiliza en otra tabla";
            } else {
                $txterror = $error[2];
            }

            return redirect()->route('ubicacions.show', $ubicacion->id)
                ->withErrors($txterror)
                ->withInput();
        }
    }
}
