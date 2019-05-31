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
        {!! Form::text('tpimpresora',null,['id'=>'tpimpresora','class'=>'form-control','placeholder'=>'Tipo','maxlength' => 20])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('numserie', 'Núm. Serie:') !!}
        {!! Form::text('numserie',null,['id'=>'numserie','class'=>'form-control','placeholder'=>'Núm. Serie','maxlength' => 25])!!}
        </div>
    </div>

    <div class="d-flex justify-content-end p-2">
        <div class="form-group col-md-4 ">
        {!! Form::label ('red', 'Red:') !!}
        {!! Form::text('red',null,['id'=>'red','class'=>'form-control','placeholder'=>'Red','maxlength' => 20])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('memoria', 'Memoria:') !!}
        {!! Form::text('memoria',null,['id'=>'memoria','class'=>'form-control','placeholder'=>'memoria','maxlength' => 10])!!}
        </div>
    </div>

    <div class="d-flex justify-content p-2">
        <div class="form-group col-md-2">
            {!! Form::label ('serie', 'SERIE') !!}
            {!! Form::checkbox('serie')!!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label ('usb', 'USB') !!}
            {!! Form::checkbox('usb')!!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label ('wifi', 'WIFI') !!}
            {!! Form::checkbox('wifi')!!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label ('paralelo', 'PARALELO') !!}
            {!! Form::checkbox('paralelo')!!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label ('ethernet', 'ETHERNET') !!}
            {!! Form::checkbox('ethernet')!!}
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
        {!! Form::text('tpimpresora',null,['id'=>'tpimpresora','class'=>'form-control','placeholder'=>'Tipo','maxlength' => 20])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('numserie', 'Núm. Serie:') !!}
        {!! Form::text('numserie',null,['id'=>'numserie','class'=>'form-control','placeholder'=>'Núm. Serie','maxlength' => 25])!!}
        </div>
    </div>

    <div class="d-flex justify-content-end p-2">
        <div class="form-group col-md-4 ">
        {!! Form::label ('red', 'Red:') !!}
        {!! Form::text('red',null,['id'=>'red','class'=>'form-control','placeholder'=>'Red','maxlength' => 20])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('memoria', 'Memoria:') !!}
        {!! Form::text('memoria',null,['id'=>'memoria','class'=>'form-control','placeholder'=>'memoria','maxlength' => 10])!!}
        </div>
    </div>

    <div class="d-flex justify-content p-2">
        <div class="form-group col-md-2">
            {!! Form::label ('serie', 'SERIE') !!}
            {!! Form::checkbox('serie',0,true,['hidden'])!!}
            {!! Form::checkbox('serie')!!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label ('usb', 'USB') !!}
            {!! Form::checkbox('usb',0,true,['hidden'])!!}
            {!! Form::checkbox('usb')!!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label ('wifi', 'WIFI') !!}
            {!! Form::checkbox('wifi',0,true,['hidden'])!!}
            {!! Form::checkbox('wifi')!!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label ('paralelo', 'PARALELO') !!}
            {!! Form::checkbox('paralelo',0,true,['hidden'])!!}
            {!! Form::checkbox('paralelo')!!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label ('ethernet', 'ETHERNET') !!}
            {!! Form::checkbox('ethernet',0,true,['hidden'])!!}
            {!! Form::checkbox('ethernet')!!}
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
            {!! Form::text('numero',$impresora->numero,['id'=>'numero','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('marca', 'Marca:') !!}
            {!! Form::text('idmarca',$marca,['id'=>'marca','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('modelo', 'Modelo:') !!}
            {!! Form::text('modelo',$impresora->modelo,['id'=>'modelo','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('ubicacion', 'Ubicación:') !!}
            {!! Form::text('idubicacion',$ubicacion,['id'=>'idubicacion','class'=>'form-control','readonly']) !!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
        {!! Form::label ('tipo', 'Tipo:') !!}
        {!! Form::text('tpimpresora',$impresora->tpimpresora,['id'=>'tpimpresora','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('numserie', 'Núm. Serie:') !!}
        {!! Form::text('numserie',$impresora->numserie,['id'=>'numserie','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex justify-content-end p-2">
        <div class="form-group col-md-4 ">
        {!! Form::label ('red', 'Red:') !!}
        {!! Form::text('red',$impresora->red,['id'=>'red','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('memoria', 'Memoria:') !!}
        {!! Form::text('memoria',$impresora->memoria,['id'=>'memoria','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex justify-content p-2">
        <div class="form-group col-md-2">
            {!! Form::label ('serie', 'SERIE') !!}
            {!! Form::checkbox('serie',null, ($impresora->serie=='0') ? false : true ,['disabled'])!!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label ('usb', 'USB') !!}
            {!! Form::checkbox('usb',null, ($impresora->usb=='0') ? false : true ,['disabled'])!!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label ('wifi', 'WIFI') !!}
            {!! Form::checkbox('wifi',null, ($impresora->wifi=='0') ? false : true ,['disabled'])!!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label ('paralelo', 'PARALELO') !!}
            {!! Form::checkbox('paralelo',null, ($impresora->paralelo=='0') ? false : true ,['disabled'])!!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label ('ethernet', 'ETHERNET') !!}
            {!! Form::checkbox('ethernet',null, ($impresora->ethernet=='0') ? false : true ,['disabled'])!!}
        </div>

    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-12">
            {!! Form::label('Observaciones: ')!!}
            {!! Form::textarea('observaciones',null,['id'=>'observaciones','class'=>'form-control','placeholder'=>'Introduce las observaciones']) !!}
        </div>
    </div>
@endif
