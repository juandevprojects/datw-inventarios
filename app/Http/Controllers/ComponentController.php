<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Component;
use App\Marca;
use App\Ubicacion;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $components = DB::table('components')
            ->select('components.id', 'components.numero', 'marcas.nombre as marca', 'components.modelo', 'ubicacions.nombre as ubicacion') // Selecciono las columnas que quiero ver de cada marca
            ->join('marcas', 'components.idmarca', '=', 'marcas.id') // uno la tabla marcas con la tabla components con un valor de busqueda
            ->join('ubicacions', 'components.idubicacion', '=', 'ubicacions.id') // uno la tabla ubicacions con la tabla component que anteriormente está unido con la tabla marcas
            ->orderBy('id', 'ASC')
            ->paginate(8);
        return view('component.index', ['components' => $components]);
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
        return View('component.create', compact('marcas', 'ubicaciones'));
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
            'tpcomp' => 'max:20',
            'numserie' => 'max:25',
        ], [
            'numero.max' => 'El número no puede tener más de 20 caracteres.',
            'idmarca.required' => 'Introduce la marca por favor.',
            'modelo.required' => 'Introduce el modelo por favor.',
            'modelo.max' => 'El modelo no puede tener más de 20 caracteres.',
            'idubicacion.required' => 'Introduce la ubicación por favor.',
            'tpcomp.max' => 'El tipo no puede tener más de 20 caracteres.',
            'numserie.max' => 'El número de serie no puede tener más de 25 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect('components/create')
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        $paginacion = Component::paginate();

        // Para establecer la última página que es donde se va a guardar el registro más reciente
        if (($paginacion->total() % $paginacion->lastPage()   == 0) && ($paginacion->total() == $paginacion->lastPage() *  $paginacion->perPage())) {
            // dd('La última página es: ' . ($paginacion->lastPage() + 1));
            $lastpage = $paginacion->lastPage() + 1;
        } else {
            // dd('La última página es: ' . $paginacion->lastPage());
            $lastpage = $paginacion->lastPage();
        }

        $data = Component::create($request->all());
        Session::flash('success', 'Componente insertado');
        // return redirect()->route('components.index');
        return redirect()->route('components.index', ['page' => $lastpage, 'id' => $data->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function show(Component $component)
    {
        $tipo = 'show';
        $marca = Marca::findOrFail($component->idmarca)->nombre;
        $ubicacion = Ubicacion::findOrFail($component->idubicacion)->nombre;
        return View('component.show', compact('component', 'tipo', 'marca', 'ubicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function edit(Component $component)
    {
        $marcas = Marca::orderBy('nombre')->pluck('nombre', 'id');
        $ubicaciones = Ubicacion::orderBy('nombre')->pluck('nombre', 'id');
        return View('component.edit', compact('marcas', 'ubicaciones', 'component'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Component $component)
    {
        $validator = Validator::make($request->all(), [
            'numero' => 'max:20',
            'idmarca' => 'required',
            'modelo' => 'required|max:20',
            'idubicacion' => 'required',
            'tpcomp' => 'max:20',
            'numserie' => 'max:25',
        ], [
            'numero.max' => 'El número no puede tener más de 20 caracteres.',
            'idmarca.required' => 'Introduce la marca por favor.',
            'modelo.required' => 'Introduce el modelo por favor.',
            'modelo.max' => 'El modelo no puede tener más de 20 caracteres.',
            'idubicacion.required' => 'Introduce la ubicación por favor.',
            'tpcomp.max' => 'El tipo no puede tener más de 20 caracteres.',
            'numserie.max' => 'El número de serie no puede tener más de 25 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('components.edit', $component->id)
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        // Calculo del indice de una fila en una tabla usando una determinada primary key
        $filas = DB::table(DB::raw('(SELECT ROW_NUMBER() OVER(ORDER BY id ASC) AS fila, id, numero FROM components) con_filas'))
            ->select('fila', 'numero')
            ->where('id', '=', $component->id)
            // ->groupBy('status')
            ->get();

        $paginacion = Component::paginate();
        $fila = $filas->pluck('fila')[0];
        $paginas = $paginacion->perPage();
        $pagina = ceil($fila / $paginas);


        $input = $request->all();
        $component->fill($input)->save();
        Session::flash('success', 'component "' . $component->id . '" actualizado');
        // return redirect()->route('components.index');
        return redirect()->route('components.index', ['page' => $pagina, 'id' => $component->id]);
    }

    public function showdelete($id)
    {
        $tipo = 'delete';
        $component = Component::findOrFail($id);
        $marca = Marca::findOrFail($component->idmarca)->nombre;
        $ubicacion = Ubicacion::findOrFail($component->idubicacion)->nombre;
        return View('component.show', compact('component', 'tipo', 'marca', 'ubicacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function destroy(Component $component)
    {
        $component->delete();
        Session::flash('success', 'component "' . $component->id . '" eliminado');
        return redirect()->route('components.index');
    }
}
