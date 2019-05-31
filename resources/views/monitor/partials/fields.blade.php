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
        {!! Form::text('tpmon',null,['id'=>'tpmon','class'=>'form-control','placeholder'=>'Tipo','maxlength' => 20])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('numserie', 'Núm. Serie:') !!}
        {!! Form::text('numserie',null,['id'=>'numserie','class'=>'form-control','placeholder'=>'Núm. Serie','maxlength' => 25])!!}
        </div>
    </div>


    <div class="d-flex justify-content-end p-2">
        <div class="form-group col-md-4 ">
        {!! Form::label ('tamano', 'Tamaño:') !!}
        {!! Form::text('tamano',null,['id'=>'tamano','class'=>'form-control','placeholder'=>'Tamaño','maxlength' => 20])!!}
        </div>
    </div>

    <div class="d-flex justify-content-end p-2">
        <div class="form-group col-md-4 ">
        {!! Form::label ('tienedvi', 'DVI') !!}
        {!! Form::checkbox('tienedvi')!!}
        </div>
        <div class="form-group col-md-4 ">
        {!! Form::label ('tienehdmi', 'HDMI') !!}
        {!! Form::checkbox('tienehdmi')!!}
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
        {!! Form::text('tpmon',null,['id'=>'tpmon','class'=>'form-control','placeholder'=>'Tipo','maxlength' => 20])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('numserie', 'Núm. Serie:') !!}
        {!! Form::text('numserie',null,['id'=>'numserie','class'=>'form-control','placeholder'=>'Núm. Serie','maxlength' => 25])!!}
        </div>
    </div>

    <div class="d-flex justify-content-end p-2">
        <div class="form-group col-md-4 ">
        {!! Form::label ('tamano', 'Tamaño:') !!}
        {!! Form::text('tamano',null,['id'=>'tamano','class'=>'form-control','placeholder'=>'Tamaño','maxlength' => 20])!!}
        </div>
    </div>

    <div class="d-flex justify-content-end p-2">
        <div class="form-group col-md-4 ">
        {!! Form::label ('tienedvi', 'DVI') !!}
        {!! Form::checkbox('tienedvi',0,true,['hidden'])!!}
        {!! Form::checkbox('tienedvi')!!}
        </div>
        <div class="form-group col-md-4 ">
        {!! Form::label ('tienehdmi', 'HDMI') !!}
        {!! Form::checkbox('tienehdmi',0,true,['hidden'])!!}
        {!! Form::checkbox('tienehdmi')!!}
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
            {!! Form::text('numero',$monitor->numero,['id'=>'numero','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('marca', 'Marca:') !!}
            {!! Form::text('idmarca',$marca,['id'=>'marca','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('modelo', 'Modelo:') !!}
            {!! Form::text('modelo',$monitor->modelo,['id'=>'modelo', 'class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('ubicacion', 'Ubicación:') !!}
            {!! Form::text('idubicacion',$ubicacion,['id'=>'ubicacion','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
        {!! Form::label ('tipo', 'Tipo:') !!}
        {!! Form::text('tpmon',$monitor->tpmon,['id'=>'tpmon','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('numserie', 'Núm. Serie:') !!}
        {!! Form::text('numserie',$monitor->numserie,['id'=>'numserie','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex justify-content-end p-2">
        <div class="form-group col-md-4 ">
        {!! Form::label ('tamano', 'Tamaño:') !!}
        {!! Form::text('tamano',$monitor->tamano,['id'=>'tamano','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex justify-content-end p-2">
        <div class="form-group col-md-4 ">
        {!! Form::label ('tienedvi', 'DVI') !!}
        @if ($monitor->tienedvi=='0')
            {!! Form::checkbox('tienedvi',null,false,['disabled'])!!}
        @else
            {!! Form::checkbox('tienedvi',null,true,['disabled'])!!}
        @endif
        </div>
        <div class="form-group col-md-4 ">
        {!! Form::label ('tienehdmi', 'HDMI') !!}
        @if ($monitor->tienehdmi=='0')
            {!! Form::checkbox('tienehdmi',null,false,['disabled'])!!}
        @else
            {!! Form::checkbox('tienehdmi',null, true, ['disabled'])!!}
        @endif
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-12">
            {!! Form::label('Observaciones: ')!!}
            {!! Form::textarea('observaciones',$monitor->observaciones,['id'=>'observaciones','class'=>'form-control','readonly']) !!}
        </div>
    </div>
@endif
