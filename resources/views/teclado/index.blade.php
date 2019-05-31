@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="card col-lg-10">
                <div class="card-header d-inline-flex justify-content-between">
                    <span class="align-self-baseline">Relación de Teclados</span>
                    <div class="navbar-text align-self-baseline">
                        <a href="{{route('teclados.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo Teclado</a>
                        <a href="{{route('home')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Volver</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('layouts.errores')
                    @if ($teclados->isEmpty())
                        <div><h3>No hay Teclados</h3></div>
                    @else
                        <table class="table table-striped">
                            <tr>
                                <th>Acciones</th>
                                <th>id</th>
                                <th>Número</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Ubicación</th>
                            </tr>
                            @foreach ($teclados as $teclado)
                                @if (isset($_GET["id"]) && ($teclado->id == $_GET["id"]))
                                    <tr class="bg-success">
                                        <td>
                                        <a href="{{ route('teclados.show',$teclado->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Ver</a>
                                        <a href="teclados/{{ $teclado->id }}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Modif.</a>
                                        <a href="{{ route('muestraBorradoTeclado',$teclado->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Borrar</a>
                                        </td>
                                        <td>{{ $teclado->id }}</td>
                                        <td>{{ $teclado->numero }}</td>
                                        <td>{{ $teclado->marca }}</td>
                                        <td>{{ $teclado->modelo }}</td>
                                        <td>{{ $teclado->ubicacion }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>
                                        <a href="{{ route('teclados.show',$teclado->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Ver</a>
                                        <a href="teclados/{{ $teclado->id }}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Modif.</a>
                                        <a href="{{ route('muestraBorradoTeclado',$teclado->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Borrar</a>
                                        </td>
                                        <td>{{ $teclado->id }}</td>
                                        <td>{{ $teclado->numero }}</td>
                                        <td>{{ $teclado->marca }}</td>
                                        <td>{{ $teclado->modelo }}</td>
                                        <td>{{ $teclado->ubicacion }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                        {{ $teclados->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
