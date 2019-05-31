@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="card col-lg-10">
                <div class="card-header d-inline-flex justify-content-between">
                    <span class="align-self-baseline">Relación de Impresoras</span>

                    <div class="navbar-text align-self-baseline">
                        <a href="{{route('impresoras.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Impresora</a>
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
                    @if ($impresoras->isEmpty())
                        <div><h3>No hay Impresoras</h3></div>
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
                            @foreach ($impresoras as $impresora)
                                @if (isset($_GET["id"]) && ($impresora->id == $_GET["id"]))
                                    <tr class="bg-success">
                                        <td>
                                            <a href="{{ route('impresoras.show',$impresora->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i>Ver</a>

                                            <a href="impresoras/{{ $impresora->id }}/edit" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>Modif.</a>

                                            <a href="{{ route('muestraBorradoImpresora',$impresora->id) }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i>Borrar</a>
                                        </td>

                                        <td>{{ $impresora->id }}</td>
                                        <td>{{ $impresora->numero }}</td>
                                        <td>{{ $impresora->marca }}</td>
                                        <td>{{ $impresora->modelo }}</td>
                                        <td>{{ $impresora->ubicacion }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>
                                            <a href="{{ route('impresoras.show',$impresora->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i>Ver</a>

                                            <a href="impresoras/{{ $impresora->id }}/edit" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>Modif.</a>

                                            <a href="{{ route('muestraBorradoImpresora',$impresora->id) }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i>Borrar</a>
                                        </td>
                                        <td>{{ $impresora->id }}</td>
                                        <td>{{ $impresora->numero }}</td>
                                        <td>{{ $impresora->marca }}</td>
                                        <td>{{ $impresora->modelo }}</td>
                                        <td>{{ $impresora->ubicacion }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                        {{ $impresoras->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
