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
        {!! Form::text('tpdisp',null,['id'=>'tpdisp','class'=>'form-control','placeholder'=>'Tipo','maxlength' => 20])!!}
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
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-6">
        {!! Form::label ('maclan', 'MAC-Lan:') !!}
        {!! Form::text('maclan',null,['id'=>'maclan','class'=>'form-control','placeholder'=>'MAC address','maxlength' => 17])!!}
        </div>
        <div class="form-group col-md-6">
        {!! Form::label ('iplan', 'IP-Lan:') !!}
        {!! Form::text('iplan',null,['id'=>'iplan','class'=>'form-control','placeholder'=>'IP address','maxlength' => 15])!!}
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
        {!! Form::text('tpdisp',null,['id'=>'tpdisp','class'=>'form-control','placeholder'=>'Tipo','maxlength' => 20])!!}
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
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-6">
        {!! Form::label ('maclan', 'MAC-Lan:') !!}
        {!! Form::text('maclan',null,['id'=>'maclan','class'=>'form-control','placeholder'=>'MAC address','maxlength' => 17])!!}
        </div>
        <div class="form-group col-md-6">
        {!! Form::label ('iplan', 'IP-Lan:') !!}
        {!! Form::text('iplan',null,['id'=>'iplan','class'=>'form-control','placeholder'=>'IP address','maxlength' => 15])!!}
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
            {!! Form::text('numero',$dispred->numero,['id'=>'numero','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('marca', 'Marca:') !!}
            {!! Form::text('idmarca',$marca,['id'=>'marca','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('modelo', 'Modelo:') !!}
            {!! Form::text('modelo',$dispred->modelo,['id'=>'modelo','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('ubicacion', 'Ubicación:') !!}
            {!! Form::text('idubicacion',$ubicacion,['id'=>'ubicacion','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
        {!! Form::label ('tipo', 'Tipo:') !!}
        {!! Form::text('tpdisp',$dispred->tpdisp,['id'=>'tpdisp','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('numserie', 'Núm. Serie:') !!}
        {!! Form::text('numserie',$dispred->numserie,['id'=>'numserie','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex justify-content-end p-2">
        <div class="form-group col-md-4 ">
        {!! Form::label ('red', 'Red:') !!}
        {!! Form::text('red',$dispred->red,['id'=>'red','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-6">
        {!! Form::label ('maclan', 'MAC-Lan:') !!}
        {!! Form::text('maclan',$dispred->maclan,['id'=>'maclan','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-6">
        {!! Form::label ('iplan', 'IP-Lan:') !!}
        {!! Form::text('iplan',$dispred->iplan,['id'=>'iplan','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-12">
            {!! Form::label('Observaciones: ')!!}
            {!! Form::textarea('observaciones',$dispred->observaciones,['id'=>'observaciones','class'=>'form-control','readonly']) !!}
        </div>
    </div>
@endif
