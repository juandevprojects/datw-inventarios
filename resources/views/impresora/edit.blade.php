@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="card col-lg-8">
                <div class="card-header d-inline-flex justify-content-between">
                    <h2>Modificar impresora</h2>
                <div class="navbar-text">
                    <a href="{{route('impresoras.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Volver</a>
                </div>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @include('layouts.errores')

                {!! Form::model($impresora,['route'=>['impresoras.update',$impresora->id],'method'=>'PUT']) !!}
                    @include('impresora.partials.fields', ['items'=> 'edit'])
                    {!! Form::submit('Grabar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Grabar</span>','class'=>'btn btn-primary btn-sm m-t-10']) !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
