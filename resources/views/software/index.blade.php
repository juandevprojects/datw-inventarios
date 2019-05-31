@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="card col-lg-10">
                <div class="card-header d-inline-flex justify-content-between">
                    <span class="align-self-baseline">Relación de Softwares</span>

                    <div class="navbar-text align-self-baseline">
                        <a href="{{route('softwares.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo Software</a>
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
                    @if ($softwares->isEmpty())
                        <div><h3>No hay Softwares</h3></div>
                    @else
                        <table class="table table-striped">
                            <tr>
                                <th>Acciones</th>
                                <th>id</th>
                                {{-- <th>Descripción</th> --}}
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Tipo</th>
                                <th>Actualizar</th>
                            </tr>
                            @foreach ($softwares as $software)
                                @if (isset($_GET["id"]) && ($software->id == $_GET["id"]))
                                    <tr class="bg-success">
                                        <td>
                                            <a href="{{ route('softwares.show',$software->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i>Ver</a>

                                            <a href="softwares/{{ $software->id }}/edit" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>Modif.</a>

                                            <a href="{{ route('muestraBorradoSoftware',$software->id) }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i>Borrar</a>
                                        </td>

                                        <td>{{ $software->id }}</td>
                                        <td>{{ $software->marca }}</td>
                                        <td>{{ $software->modelo }}</td>
                                        <td>{{ $software->tpsoft }}</td>
                                        <td>{{ $software->actualizar }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>
                                            <a href="{{ route('softwares.show',$software->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i>Ver</a>

                                            <a href="softwares/{{ $software->id }}/edit" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>Modif.</a>

                                            <a href="{{ route('muestraBorradoSoftware',$software->id) }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i>Borrar</a>
                                        </td>
                                        <td>{{ $software->id }}</td>
                                        <td>{{ $software->marca }}</td>
                                        <td>{{ $software->modelo }}</td>
                                        <td>{{ $software->tpsoft }}</td>
                                        <td>{{ $software->actualizar }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                        {{ $softwares->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
