@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="card col-lg-8">
                <div class="card-header d-inline-flex justify-content-between">
                    <h2>Nueva Marca</h2>
                    <div class="navbar-text">
                        <a href="{{route('marcas.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Volver</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @include('layouts.errores')

                    {{-- formularios hechos utilizando Laravel Collective --}}
                    {!! Form::open(['route'=>'marcas.store', 'method'=>'POST']) !!}
                    @include('marca.partials.fields', ['items'=> 'create'])
                    {!! Form::submit('Grabar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Grabar</span>','class'=>'btn btn-primary btn-sm m-t-10']) !!}
                    {!! Form::close() !!}

                    {{-- formularios hechos con html norma --}}
                    {{-- <form method="POST" action="{{route('marcas.store')}}" accept-charset="UTF-8">
                        @csrf
                        @include('marca.partials.fields', ['items'=> 'create'])
                        <input name="grabar" id="grabar" class="btn btn-primary btn-sm m-t-10" type="submit" value="Grabar">

                    </form> --}}


                </div>
            </div>
        </div>
    </div>
@endsection
