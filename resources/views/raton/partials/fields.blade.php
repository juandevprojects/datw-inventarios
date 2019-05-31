@if($items == 'create')
    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('numero', 'Número:') !!}
            {!! Form::text('numero',null,['id'=>'numero','class'=>'form-control','placeholder'=>'Número','maxlength' => 20])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('marca', 'Marca:') !!}
            {!! Form::select('idmarca',$marcas->prepend('Elige marca',''),null,['id'=>'idmarca','class'=>'form-control']) !!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('modelo', 'Modelo:') !!}
            {!! Form::text('modelo',null,['id'=>'modelo','class'=>'form-control','placeholder'=>'Modelo','maxlength' => 20,'required'])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('ubicacion', 'Ubicación:') !!}
            {!! Form::select('idubicacion',$ubicaciones->prepend('Elige ubicación',''),null,['id'=>'idubicacion','class'=>'form-control']) !!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
        {!! Form::label ('tipo', 'Tipo:') !!}
        {!! Form::text('tpraton',null,['id'=>'tpraton','class'=>'form-control','placeholder'=>'Tipo','maxlength' => 20])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('numserie', 'Núm. Serie:') !!}
        {!! Form::text('numserie',null,['id'=>'numserie','class'=>'form-control','placeholder'=>'Núm. Serie','maxlength' => 25])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-12">
            {!! Form::label('Observaciones: ')!!}
            {!! Form::textarea('observaciones',null,['id'=>'observaciones','class'=>'form-control','placeholder'=>'Introduce las observaciones']) !!}
        </div>
    </div>

@elseif ($items == 'edit')
    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('numero', 'Número:') !!}
            {!! Form::text('numero',null,['id'=>'numero','class'=>'form-control','placeholder'=>'Número','maxlength' => 20])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('marca', 'Marca:') !!}
            {!! Form::select('idmarca',$marcas->prepend('Elige marca',''),null,['id'=>'idmarca','class'=>'form-control']) !!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('modelo', 'Modelo:') !!}
            {!! Form::text('modelo',null,['id'=>'modelo','class'=>'form-control','placeholder'=>'Modelo','maxlength' => 20,'required'])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('ubicacion', 'Ubicación:') !!}
            {!! Form::select('idubicacion',$ubicaciones->prepend('Elige ubicación',''),null,['id'=>'idubicacion','class'=>'form-control']) !!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('tipo', 'Tipo:') !!}
            {!! Form::text('tpraton',null,['id'=>'tpraton','class'=>'form-control','placeholder'=>'Tipo','maxlength' => 20])!!}
        </div>

        <div class="form-group col-md-8">
            {!! Form::label ('numserie', 'Núm. Serie:') !!}
            {!! Form::text('numserie',null,['id'=>'numserie','class'=>'form-control','placeholder'=>'Núm. Serie','maxlength' => 25])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-12">
            {!! Form::label('Observaciones: ')!!}
            {!! Form::textarea('observaciones',null,['id'=>'observaciones','class'=>'form-control','placeholder'=>'Introduce las observaciones']) !!}
        </div>
    </div>

@else
    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('numero', 'Número:') !!}
            {!! Form::text('numero',$raton->numero,['id'=>'numero','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('marca', 'Marca:') !!}
            {!! Form::text('marca',$marca,['id'=>'marca','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('modelo', 'Modelo:') !!}
            {!! Form::text('modelo',$raton->modelo,['id'=>'modelo','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('ubicacion', 'Ubicación:') !!}
            {!! Form::text('ubicacion',$ubicacion,['id'=>'ubicacion','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('tipo', 'Tipo:') !!}
            {!! Form::text('tpraton',$raton->tpraton,['id'=>'tpraton','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('numserie', 'Núm. Serie:') !!}
            {!! Form::text('numserie',$raton->numserie,['id'=>'numserie','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-12">
            {!! Form::label('Observaciones: ')!!}
            {!! Form::textarea('observaciones',$raton->observaciones,['id'=>'observaciones','class'=>'form-control','readonly']) !!}
        </div>
    </div>
@endif
