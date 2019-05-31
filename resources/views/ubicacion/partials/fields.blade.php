{{-- Utilizando html normal --}}
{{-- <div class="form-group">
    <label for="nombre">Marca:</label>
    @if($items == 'create')
        <input id="nombre" class="form-control" placeholder="Introduce la marca" maxlength="50" name="nombre" type="text">
    @elseif ($items == 'edit')
        <input id="nombre" class="form-control" placeholder="Introduce la marca" maxlength="50" name="nombre" type="text">
    @else
        <input id="nombre" class="form-control" name="nombre" type="text" disabled readonly>
    @endif
</div> --}}

{{-- utilizando laravel collective --}}
<div class="form-group">
    {!! Form::label ('ubicacion', 'Ubicación:') !!}
    @if($items == 'create')
        {!! Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Introduce la ubicación','maxlength' => 50,'required'])!!}
    @elseif ($items == 'edit')
        {!! Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Introduce la ubicación','maxlength' => 50,'required'])!!}
    @else
        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder'=>$nombre ,'disabled']) !!}
    @endif
</div>
