@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-inline-flex  justify-content-between">
                    <span class="align-self-baseline">Ubicaciones</span>
                    <div class="navbar-text align-self-baseline">
                        <a href={{ route('ubicacions.create') }}>
                            <button type="button" id='nueva'  name='nueva' class="btn btn-info">
                                <i class="fa fa-plus"></i>Nueva Ubicacion
                            </button>
                        </a>

                        <a href={{ url('/home') }}>
                            <button type="button" id='volver'  name='volver' class="btn btn-primary">
                                <i class="fa fa-arrow-left"></i>Volver
                            </button>
                        </a>
                    </div>

                </div>

                <div class="card-body">
                    @include('layouts.errores')
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($ubicaciones->isEmpty())
                        <div>No hay Ubicaciones</div>
                    @else
                        <table class='table table-striped'>
                            <thead>
                                <tr> {{-- Encabezado de la tabla --}}
                                    <th scope='col'>Acciones</th>
                                    <th scope='col'>Id</th>
                                    <th scope='col'>Nombre</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($ubicaciones as $ubicacion)
                                    @if (isset($_GET["id"]) && ($ubicacion->id == $_GET["id"]))
                                        <tr class="bg-success">
                                            <td> {{--  Creamos los botones de acción  --}}
                                                <a href="ubicacions/{{ $ubicacion->id }}/edit"><button type='button' class='btn btn-warning'><i class='far fa-edit'></i> Modificar</button></a>
                                                <a href={{route('ubicacions.destroy',$ubicacion->id)}}><button type='button' class='btn btn-danger'><i class='fas fa-trash-alt'></i> Borrar</button></a>
                                            </td>

                                            <td>
                                                {{ $ubicacion->id}}
                                            </td>

                                            <td>
                                                {{ $ubicacion->nombre}}
                                            </td>
                                        </tr>
                                    @else

                                        <tr>
                                            <td> {{--  Creamos los botones de acción  --}}
                                                <a href="ubicacions/{{ $ubicacion->id }}/edit"><button type='button' class='btn btn-warning'><i class='far fa-edit'></i> Modificar</button></a>
                                                <a href={{route('ubicacions.destroy',$ubicacion->id)}}><button type='button' class='btn btn-danger'><i class='fas fa-trash-alt'></i> Borrar</button></a>
                                            </td>

                                            <td>
                                                {{ $ubicacion->id}}
                                            </td>

                                            <td>
                                                {{ $ubicacion->nombre}}
                                            </td>
                                        </tr>


                                    @endif


                                @endforeach
                            </tbody>
                        </table>
                        {{ $ubicaciones->links() }}
                        {{-- Para que muestre la paginación hecha en el controlador --}}
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
