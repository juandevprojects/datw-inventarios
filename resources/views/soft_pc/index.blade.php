@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="card col-lg-12">
                <div class="card-header d-inline-flex justify-content-between">
                    <span class="align-self-baseline">Relación de SW instalado en PC's</span>

                    <div class="navbar-text align-self-baseline">
                        <a href="{{route('soft_pcs.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Asignar SW a PC</a>
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
                    @if ($soft_pcs->isEmpty())
                        <div><h3>No hay SW instalado en PC's</h3></div>
                    @else
                        <table class="container table table-striped">
                            <tr class="row">
                                <th class='col-1'>Acciones</th>
                                <th class='col-1'>id</th>
                                <th class='col-2'>Número de PC</th>
                                <th class='col-1'>Marca PC</th>
                                <th class='col-1'>Ubicación PC/SW</th>
                                <th class='col-3'>Software</th>
                                <th class='col-1'>Tipo</th>
                                <th class='col-2'>Fecha de Instalación</th>
                            </tr>
                            @foreach ($soft_pcs as $soft_pc)
                                @if (isset($_GET["id"]) && ($soft_pc->id == $_GET["id"]))
                                    <tr class="row bg-success">
                                        <td class='col-1'>
                                            <a href="soft_pcs/{{ $soft_pc->id }}/edit" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i></a>
                                            <a href="{{ route('muestraBorradoSoft_pc',$soft_pc->id) }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i></a>
                                        </td>
                                        <td class='col-1'>{{ $soft_pc->id }}</td>
                                        <td class='col-2'>{{ $soft_pc->numPC }}</td>
                                        <td class='col-1'>{{ $soft_pc->marca }}</td>
                                        <td class='col-1'>{{ $soft_pc->ubicacion }}</td>
                                        <td class='col-3'>{{ $soft_pc->descripcion }}</td>
                                        <td class='col-1'>{{ $soft_pc->tipo }}</td>
                                        <td class='col-2'>{{ $soft_pc->fecha_instalacion }}</td>
                                    </tr>
                                @else
                                    <tr class="row">
                                        <td class='col-1'>
                                            <a href="soft_pcs/{{ $soft_pc->id }}/edit" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i></a>
                                            <a href="{{ route('muestraBorradoSoft_pc',$soft_pc->id) }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i></a>
                                        </td>
                                        <td class='col-1'>{{ $soft_pc->id }}</td>
                                        <td class='col-2'>{{ $soft_pc->numPC }}</td>
                                        <td class='col-1'>{{ $soft_pc->marca }}</td>
                                        <td class='col-1'>{{ $soft_pc->ubicacion }}</td>
                                        <td class='col-3'>{{ $soft_pc->descripcion }}</td>
                                        <td class='col-1'>{{ $soft_pc->tipo }}</td>
                                        <td class='col-2'>{{ $soft_pc->fecha_instalacion }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                        {{ $soft_pcs->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
