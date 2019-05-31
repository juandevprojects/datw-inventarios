@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="card col-lg-8">
                <div class="card-header d-inline-flex justify-content-between">
                    <h2>Modificar ordenador</h2>
                <div class="navbar-text">
                    <a href="{{route('ordenadors.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Volver</a>
                </div>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @include('layouts.errores')

                {!! Form::model($ordenador,['route'=>['ordenadors.update',$ordenador->id],'method'=>'PUT']) !!}
                    @include('ordenador.partials.fields', ['items'=> 'edit'])
                    {!! Form::submit('Grabar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Grabar</span>','class'=>'btn btn-primary btn-sm m-t-10']) !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
