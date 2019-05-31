@if($items == 'create')
    <div class="d-flex p-2">
        <div class="form-group col-md-12">
            {!! Form::label ('descripcion', 'Descripción:') !!}
            {!! Form::text('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Descripción','maxlength' => 80])!!}
        </div>

    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('marca', 'Marca:') !!}
            {!! Form::select('idmarca',$marcas->prepend('Elige marca',''),null,['id'=>'idmarca','class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('modelo', 'Modelo:') !!}
            {!! Form::text('modelo',null,['id'=>'modelo','class'=>'form-control','placeholder'=>'Modelo','maxlength' => 20,'required'])!!}
        </div>

    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
        {!! Form::label ('tpsoft', 'Tipo:') !!}
        {!! Form::text('tpsoft',null,['id'=>'tpsoft','class'=>'form-control','placeholder'=>'Tipo','maxlength' => 20])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('numserie', 'Núm. Serie:') !!}
        {!! Form::text('numserie',null,['id'=>'numserie','class'=>'form-control','placeholder'=>'Núm. Serie','maxlength' => 25])!!}
        </div>
    </div>

    <div class="d-flex p-2 justify-content-between">
        <div class="form-group col-md-4 ">
            {!! Form::label ('licencia', 'Licencia:') !!}
            {!! Form::text('licencia',null,['id'=>'licencia','class'=>'form-control','placeholder'=>'Licencia','maxlength' => 25,'required'])!!}
        </div>
        <div class="form-group col-md-8 align-self-center">
            {!! Form::label ('actualizar', 'Actualizar') !!}
            {!! Form::checkbox('actualizar')!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-6">
        {!! Form::label ('origen', 'Origen:') !!}
        {!! Form::text('origen',null,['id'=>'origen','class'=>'form-control','placeholder'=>'Origen','maxlength' => 50])!!}
        </div>
        <div class="form-group col-md-6">
        {!! Form::label ('hd', 'HD:') !!}
        {!! Form::text('hd',null,['id'=>'hd','class'=>'form-control','placeholder'=>'hd','maxlength' => 50])!!}
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
        <div class="form-group col-md-12">
            {!! Form::label ('descripcion', 'Descripción:') !!}
            {!! Form::text('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Descripción','maxlength' => 80])!!}
        </div>

    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('marca', 'Marca:') !!}
            {!! Form::select('idmarca',$marcas->prepend('Elige marca',''),null,['id'=>'idmarca','class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('modelo', 'Modelo:') !!}
            {!! Form::text('modelo',null,['id'=>'modelo','class'=>'form-control','placeholder'=>'Modelo','maxlength' => 20,'required'])!!}
        </div>

    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
        {!! Form::label ('tpsoft', 'Tipo:') !!}
        {!! Form::text('tpsoft',null,['id'=>'tpsoft','class'=>'form-control','placeholder'=>'Tipo','maxlength' => 20])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('numserie', 'Núm. Serie:') !!}
        {!! Form::text('numserie',null,['id'=>'numserie','class'=>'form-control','placeholder'=>'Núm. Serie','maxlength' => 25])!!}
        </div>
    </div>

    <div class="d-flex p-2 justify-content-between">
        <div class="form-group col-md-4 ">
            {!! Form::label ('licencia', 'Licencia:') !!}
            {!! Form::text('licencia',null,['id'=>'licencia','class'=>'form-control','placeholder'=>'Licencia','maxlength' => 25,'required'])!!}
        </div>
        <div class="form-group col-md-8 align-self-center">
            {!! Form::label ('actualizar', 'Actualizar') !!}
            {!! Form::checkbox('actualizar',0,true,['hidden'])!!}
            {!! Form::checkbox('actualizar')!!}
        </div>

    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-6">
        {!! Form::label ('origen', 'Origen:') !!}
        {!! Form::text('origen',null,['id'=>'origen','class'=>'form-control','placeholder'=>'Origen','maxlength' => 50])!!}
        </div>
        <div class="form-group col-md-6">
        {!! Form::label ('hd', 'HD:') !!}
        {!! Form::text('hd',null,['id'=>'hd','class'=>'form-control','placeholder'=>'hd','maxlength' => 50])!!}
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
        <div class="form-group col-md-12">
            {!! Form::label ('descripcion', 'Descripción:') !!}
            {!! Form::text('descripcion',$software->descripcion,['id'=>'descripcion','class'=>'form-control','readonly'])!!}
        </div>

    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('modelo', 'Marca:') !!}
            {!! Form::text('idmarca',$marca,['id'=>'modelo', 'class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('modelo', 'Modelo:') !!}
            {!! Form::text('modelo',$software->modelo,['id'=>'modelo', 'class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
        {!! Form::label ('tpsoft', 'Tipo:') !!}
        {!! Form::text('tpsoft',$software->tpsoft,['id'=>'tpsoft','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('numserie', 'Núm. Serie:') !!}
        {!! Form::text('numserie',$software->numserie,['id'=>'numserie','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2 justify-content-between">
        <div class="form-group col-md-4 ">
            {!! Form::label ('licencia', 'Licencia:') !!}
            {!! Form::text('licencia',$software->licencia,['id'=>'licencia','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8 align-self-center">
            {!! Form::label ('actualizar', 'Actualizar') !!}
            {!! Form::checkbox('actualizar',null, ($software->actualizar=='0') ? false : true ,['disabled'])!!}
            {{-- @if ($software->actualizar=='0')
                {!! Form::checkbox('actualizar',null,false,['disabled'])!!}
            @else
                {!! Form::checkbox('actualizar',null,true,['disabled'])!!}
            @endif --}}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-6">
        {!! Form::label ('origen', 'Origen:') !!}
        {!! Form::text('origen',$software->origen,['id'=>'origen','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-6">
        {!! Form::label ('hd', 'HD:') !!}
        {!! Form::text('hd',$software->hd,['id'=>'hd','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-12">
            {!! Form::label('Observaciones: ')!!}
            {!! Form::textarea('observaciones',$software->observaciones,['id'=>'observaciones','class'=>'form-control','readonly']) !!}
        </div>
    </div>
@endif
