<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Software;
use App\Marca;
use App\Ubicacion;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $softguares = DB::table('softwares')
            ->select('softwares.id', 'softwares.descripcion', 'marcas.nombre as marca', 'softwares.tpsoft', 'softwares.actualizar', 'softwares.modelo')
            ->join('marcas', 'softwares.idmarca', '=', 'marcas.id')
            ->orderBy('id', 'ASC')
            ->paginate(8);
        return view('software.index', ['softwares' => $softguares]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::orderBy('nombre')->pluck('nombre', 'id');
        return View('software.create', compact('marcas'));
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
            'descripcion' => 'max:80',
            'idmarca' => 'required',
            'modelo' => 'required|max:20',
            'tpsoft' => 'max:20',
            'numserie' => 'max:25',
            'licencia' => 'max:25',
        ], [
            'descripcion.max' => 'El número no puede tener más de 80 caracteres.',
            'idmarca.required' => 'Introduce la marca por favor.',
            'modelo.required' => 'Introduce el modelo por favor.',
            'modelo.max' => 'El modelo no puede tener más de 20 caracteres.',
            'tpsoft.max' => 'El tipo no puede tener más de 20 caracteres.',
            'numserie.max' => 'El número de serie no puede tener más de 25 caracteres.',
            'licencia.max' => 'El número de serie no puede tener más de 25 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect('softwares/create')
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        $paginacion = Software::paginate();
        // dd('Estoy en el método store de softwares');

        // Para establecer la última página que es donde se va a guardar el registro más reciente
        if (($paginacion->total() % $paginacion->lastPage()   == 0) && ($paginacion->total() == $paginacion->lastPage() *  $paginacion->perPage())) {
            // dd('La última página es: ' . ($paginacion->lastPage() + 1));
            $lastpage = $paginacion->lastPage() + 1;
        } else {
            // dd('La última página es: ' . $paginacion->lastPage());
            $lastpage = $paginacion->lastPage();
        }

        $data = Software::create($request->all());
        Session::flash('success', 'Software insertado');
        // return redirect()->route('softwares.index');
        return redirect()->route('softwares.index', ['page' => $lastpage, 'id' => $data->id]);
        // return 'Hola';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function show(Software $software)
    {
        $tipo = 'show';
        $marca = Marca::findOrFail($software->idmarca)->nombre;
        return View('software.show', compact('software', 'tipo', 'marca'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function edit(Software $software)
    {
        $marcas = Marca::orderBy('nombre')->pluck('nombre', 'id');
        $ubicaciones = Ubicacion::orderBy('nombre')->pluck('nombre', 'id');
        return View('software.edit', compact('marcas', 'ubicaciones', 'software'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Software $software)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'max:80',
            'idmarca' => 'required',
            'modelo' => 'required|max:20',
            'tpsoft' => 'max:20',
            'numserie' => 'max:25',
            'licencia' => 'max:25',
        ], [
            'descripcion.max' => 'El número no puede tener más de 80 caracteres.',
            'idmarca.required' => 'Introduce la marca por favor.',
            'modelo.required' => 'Introduce el modelo por favor.',
            'modelo.max' => 'El modelo no puede tener más de 20 caracteres.',
            'tpsoft.max' => 'El tipo no puede tener más de 20 caracteres.',
            'numserie.max' => 'El número de serie no puede tener más de 25 caracteres.',
            'licencia.max' => 'El número de serie no puede tener más de 25 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('softwares.edit', $software->id)
                ->withErrors($validator)
                ->withInput();
        }

        // **** Arreglo de página
        // Calculo del indice de una fila en una tabla usando una determinada primary key
        $filas = DB::table(DB::raw( '(SELECT ROW_NUMBER() OVER(ORDER BY id ASC) AS fila, id, modelo FROM softwares) con_filas'))
            ->select('fila', 'modelo')
            ->where('id', '=', $software->id)
            // ->groupBy('status')
            ->get();

        $paginacion = Software::paginate();
        $fila = $filas->pluck('fila')[0];
        $paginas = $paginacion->perPage();
        $pagina = ceil($fila / $paginas);


        $input = $request->all();
        $software->fill($input)->save();
        Session::flash('success', 'Software "' . $software->id . '" actualizado');
        // return redirect()->route('softwares.index');
        return redirect()->route('softwares.index', ['page' => $pagina, 'id' => $software->id]);
    }

    public function showdelete($id)
    {
        $tipo = 'delete';
        $software = Software::findOrFail($id);
        $marca = Marca::findOrFail($software->idmarca)->nombre;
        return View('software.show', compact('software', 'tipo', 'marca'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function destroy(Software $software)
    {
        $software->delete();
        Session::flash('success', 'Software "' . $software->id . '" eliminado');
        return redirect()->route('softwares.index');
    }
}
