<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Marca;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Auth;
use Session;
use Validator;
use DataTables;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Requesto utilizando SQL puro y duro
        // $marcas = DB::select('select id,nombre from marcas order by id;'); // Devuelve un array
        // dd($marcas[0]);

        // Request utilizando Query Builder
        // $marcas = DB::table('marcas')->get(); // Devuelve collection
        // dd($marcas);

        // $marcas = Marca::paginate(8, ['id', 'nombre']);
        // return view('marca.index', ['marcas' => $marcas]);

        // Este script se escribe unicamente para poder utilizar el datatables
        if ($request->ajax()) {
            $items = DB::select( 'SELECT id, nombre FROM marcas;');
            return Datatables::of($items)->addColumn('action', function ($items) {

                $result = "";
                $result .= '<a href="marcas/' . $items->id . '/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>Modificar</a>';

                $result .= '<a href={{  }}route("marcas.destroy",'. $items->id .')}}><button type="button" class="btn btn-danger"><i class="fas  f a-tra s h-a lt"></i>Borrar</button></a>';

                return $result;
            })->make();
        } else {
            $marcas = Marca::paginate(8, ['id', 'nombre']);
            return view('marca.index', ['marcas' => $marcas]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marca.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paginacion= Marca::paginate();

        // Para establecer la última página que es donde se va a guardar el registro más reciente
        if ( ($paginacion->total() % $paginacion->lastPage()   == 0) && ( $paginacion->total() == $paginacion-> lastPage() *  $paginacion->perPage()) ) {
            // dd('La última página es: ' . ($paginacion->lastPage() + 1));
            $lastpage= $paginacion->lastPage() + 1;
        } else {
            // dd('La última página es: ' . $paginacion->lastPage());
            $lastpage = $paginacion->lastPage();
        }

        // Validación de los campos del formulario
        $validator = Validator::make($request->all(), ['nombre' => 'required|max:50|unique:marcas',],
        ['nombre.unique' => 'No se ha grabado porque la marca introducida ya la has usado antes. Introduce otra por favor.', 'nombre.required' => 'Introduce la marca por favor.' ]);

        if ($validator->fails()) {
            return redirect('marcas/create')
                ->withErrors($validator)
                ->withInput();
        }

        // Marca::create($request->except('_token')); // Si utilizamos html normal
        $data= Marca::create($request->all()); // Si utilizamos laravel collective
        Session::flash('success', 'Marca "'.$request->all()['nombre']. '" insertada');
        return redirect()->route('marcas.index', ['page' => $lastpage, 'id' => $data->id]); // PAso en la url page para que aparezca la vista index en la página donde se incluye la nueva fila y 'id' para que el blade me resalte la nueva fila instalada
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show( Marca $marca)
    {
        $tipo = 'delete';
        return view('marca.show', compact('marca', 'tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        return view('marca.edit', ['marca' => $marca]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50|unique:marcas',
        ], [
            'nombre.unique' => 'No se ha grabado porque la marca introducida ya la has usado antes. Introduce otra por favor.',
            'nombre.required' => 'Introduce la marca por favor.'
        ]);
        if ($validator->fails()) {
            return redirect()->route('marcas.edit', $marca->id)->withErrors($validator)->withInput();
            // equivalente redirect('marcas/'. $marca->id.'/edit')->withErrors($validator)->withInput();
        }

        // Calculo del indice de una fila en una tabla usando una determinada primary key
        $filas = DB::table(DB::raw('(SELECT ROW_NUMBER() OVER(ORDER BY id ASC) AS fila, id, nombre FROM marcas) con_filas'))
            ->select('fila', 'nombre')
            ->where('id', '=', $marca->id)
            // ->groupBy('status')
        ->get();

        $paginacion = Marca::paginate();
        $fila= $filas->pluck('fila')[0];
        $paginas = $paginacion->perPage();
        $pagina= ceil($fila / $paginas);

        $input = $request->all();
        $marca->fill($input)->save();
        Session::flash('success', 'Marca "' . $marca->id . '" actualizada');
        return redirect()->route('marcas.index',['page' => $pagina, 'id'=> $marca->id]);
        // dd( $paginacion->url(3)); //Buscar la forma en que paginación me mande para el index directo con la página sin el id
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        try{
            $marca->delete();
            Session::flash('success', 'La marca "' . $marca->nombre . '" fue eliminada');
            return redirect()->route('marcas.index');

        } catch (\Illuminate\Database\QueryException $ex) {
            $error= $ex->errorInfo;
            if ($error[0] == 23000){
                $txterror= "No se puede eliminar la marca porque se utiliza en otra tabla";
            } else{
                $txterror= $error[2];
            }

            return redirect() -> route('marcas.show', $marca->id)
                ->withErrors($txterror)
                ->withInput();
        }

    }
}
