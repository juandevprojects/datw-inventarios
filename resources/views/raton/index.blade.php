@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="card col-lg-10">
                <div class="card-header d-inline-flex justify-content-between">
                    <span class="align-self-baseline">Relación de Ratones</span>
                    <div class="navbar-text align-self-baseline">
                        <a href="{{route('ratons.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>Nuevo Raton</a>
                        <a href="{{route('home')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Volver</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('layouts.errores')
                    @if ($ratons->isEmpty())
                        <div><h3>No hay Ratones</h3></div>
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
                            @foreach ($ratons as $raton)
                                @if (isset($_GET["id"]) && ($raton->id == $_GET["id"]))
                                    <tr class="bg-success">
                                        <td>
                                        <a href="{{ route('ratons.show',$raton->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Ver</a>
                                        <a href="ratons/{{ $raton->id }}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>Modif.</a>
                                        <a href="{{ route('muestraBorradoRaton',$raton->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Borrar</a>
                                        </td>
                                        <td>{{ $raton->id }}</td>
                                        <td>{{ $raton->numero }}</td>
                                        <td>{{ $raton->marca }}</td>
                                        <td>{{ $raton->modelo }}</td>
                                        <td>{{ $raton->ubicacion }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>
                                        <a href="{{ route('ratons.show',$raton->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Ver</a>
                                        <a href="ratons/{{ $raton->id }}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Modif.</a>
                                        <a href="{{ route('muestraBorradoRaton',$raton->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Borrar</a>
                                        </td>
                                        <td>{{ $raton->id }}</td>
                                        <td>{{ $raton->numero }}</td>
                                        <td>{{ $raton->marca }}</td>
                                        <td>{{ $raton->modelo }}</td>
                                        <td>{{ $raton->ubicacion }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                        {{ $ratons->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
