@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="card col-lg-10">
                <div class="card-header d-inline-flex justify-content-between">
                    <span class="align-self-baseline">Relación de Monitores</span>

                    <div class="navbar-text align-self-baseline">
                        <a href="{{route('monitors.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo Monitor</a>
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
                    @if ($monitors->isEmpty())
                        <div><h3>No hay Monitores</h3></div>
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
                            @foreach ($monitors as $monitor)
                                @if (isset($_GET["id"]) && ($monitor->id == $_GET["id"]))
                                    <tr class="bg-success">
                                        <td>
                                            <a href="{{ route('monitors.show',$monitor->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i>Ver</a>

                                            <a href="monitors/{{ $monitor->id }}/edit" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>Modif.</a>

                                            <a href="{{ route('muestraBorradoMonitor',$monitor->id) }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i>Borrar</a>
                                        </td>

                                        <td>{{ $monitor->id }}</td>
                                        <td>{{ $monitor->numero }}</td>
                                        <td>{{ $monitor->marca }}</td>
                                        <td>{{ $monitor->modelo }}</td>
                                        <td>{{ $monitor->ubicacion }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>
                                            <a href="{{ route('monitors.show',$monitor->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i>Ver</a>

                                            <a href="monitors/{{ $monitor->id }}/edit" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>Modif.</a>

                                            <a href="{{ route('muestraBorradoMonitor',$monitor->id) }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i>Borrar</a>
                                        </td>
                                        <td>{{ $monitor->id }}</td>
                                        <td>{{ $monitor->numero }}</td>
                                        <td>{{ $monitor->marca }}</td>
                                        <td>{{ $monitor->modelo }}</td>
                                        <td>{{ $monitor->ubicacion }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                        {{ $monitors->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
