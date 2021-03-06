@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="card col-lg-8">
                <div class="card-header d-inline-flex justify-content-between">
                    @if($tipo == 'delete')
                        <h2>Eliminar Ordenador</h2>
                    @else
                        <h2>Consultar Ordenador</h2>
                    @endif
                    <div class="navbar-text">
                        <a href="{{route('soft_pc.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Volver</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('layouts.errores')

                    {{ Form::open(['method' => 'delete', 'route' => ['soft_pc.destroy', $ordenador->id]]) }}
                        @include('soft_pc.partials.fields', ['items'=> 'show'])
                        @if($tipo == 'delete')
                            {!! Form::submit('BORRAR',['name'=>'borrar','id'=>'borrar','content'=>'<span>BORRAR</span>','class'=>'btn btn-danger btn-sm m-t-10']) !!}
                        @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
