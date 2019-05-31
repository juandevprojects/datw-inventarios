@if($items == 'create')

     <div class="d-flex p-2">
        <div class="form-group col-md-6">
            {!! Form::label ('ordenador', 'Elige el ordenador donde se instalará el software:') !!}
            {!! Form::select('idpc',$ordenadors->prepend('Elige PC',''),null,['id'=>'idpc','class'=>'form-control']) !!}
        </div>
    </div>
    <div class="d-flex p-2">
        <div class="form-group col-md-12">
            {!! Form::label ('software', 'Elige el Software a instalar:') !!}
            {!! Form::select('idsoft',$softwares->prepend('Elige software',''),null,['id'=>'idsoft','class'=>'form-control']) !!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-5">
            {!! Form::label ('fechainst', 'Fecha Instalación:') !!}
            {!! Form::date('fechainst', \Carbon\Carbon::now(),['id'=>'fechainst','class'=>['datapicker','form-control']]) !!}
        </div>
    </div>

    <div class="d-flex p-2">
        {{-- <input class="date form-control" type="text"> --}}

        <div class="form-group col-md-5">
            {!! Form::label ('fechainst', 'Fecha Instalación:') !!}
            {!! Form::text('fechainst',\Carbon\Carbon::now(),['id'=>'datetimepicker','class'=>'form-control'])!!}
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
        {!! Form::text('tppc',null,['id'=>'tppc','class'=>'form-control','placeholder'=>'Tipo','maxlength' => 20])!!}
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
        <div class="form-group col-md-4">
        {!! Form::label ('maclan', 'MAC-Lan:') !!}
        {!! Form::text('maclan',null,['id'=>'maclan','class'=>'form-control','placeholder'=>'MAC address','maxlength' => 17])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('iplan', 'IP-Lan:') !!}
        {!! Form::text('iplan',null,['id'=>'iplan','class'=>'form-control','placeholder'=>'IP address','maxlength' => 15])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
        {!! Form::label ('macwifi', 'MAC-Wifi:') !!}
        {!! Form::text('macwifi',null,['id'=>'macwifi','class'=>'form-control','placeholder'=>'MAC address','maxlength' => 17])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('ipwifi', 'IP-Wifi:') !!}
        {!! Form::text('ipwifi',null,['id'=>'ipwifi','class'=>'form-control','placeholder'=>'IP address','maxlength' => 15])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
        {!! Form::label ('hd1', 'HD1:') !!}
        {!! Form::text('hd1',null,['id'=>'hd1','class'=>'form-control','placeholder'=>'HD','maxlength' => 50])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('hd2', 'HD2:') !!}
        {!! Form::text('hd2',null,['id'=>'hd2','class'=>'form-control','placeholder'=>'HD','maxlength' => 50])!!}
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
            {!! Form::text('numero',$ordenador->numero,['id'=>'numero','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('marca', 'Marca:') !!}
            {!! Form::text('idmarca',$marca,['id'=>'marca','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
            {!! Form::label ('modelo', 'Modelo:') !!}
            {!! Form::text('modelo',$ordenador->modelo,['id'=>'modelo','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
            {!! Form::label ('ubicacion', 'Ubicación:') !!}
            {!! Form::text('idubicacion',$ubicacion,['id'=>'ubicacion','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
        {!! Form::label ('tipo', 'Tipo:') !!}
        {!! Form::text('tppc',$ordenador->tppc,['id'=>'tppc','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('numserie', 'Núm. Serie:') !!}
        {!! Form::text('numserie',$ordenador->numserie,['id'=>'numserie','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex justify-content-end p-2">
        <div class="form-group col-md-4 ">
        {!! Form::label ('red', 'Red:') !!}
        {!! Form::text('red',$ordenador->red,['id'=>'red','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
        {!! Form::label ('maclan', 'MAC-Lan:') !!}
        {!! Form::text('maclan',$ordenador->maclan,['id'=>'maclan','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('iplan', 'IP-Lan:') !!}
        {!! Form::text('iplan',$ordenador->iplan,['id'=>'iplan','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
        {!! Form::label ('macwifi', 'MAC-Wifi:') !!}
        {!! Form::text('macwifi',$ordenador->macwifi,['id'=>'macwifi','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('ipwifi', 'IP-Wifi:') !!}
        {!! Form::text('ipwifi',$ordenador->ipwifi,['id'=>'ipwifi','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-4">
        {!! Form::label ('hd1', 'HD1:') !!}
        {!! Form::text('hd1',$ordenador->hd1,['id'=>'hd1','class'=>'form-control','readonly'])!!}
        </div>
        <div class="form-group col-md-8">
        {!! Form::label ('hd2', 'HD2:') !!}
        {!! Form::text('hd2',$ordenador->hd2,['id'=>'hd2','class'=>'form-control','readonly'])!!}
        </div>
    </div>

    <div class="d-flex p-2">
        <div class="form-group col-md-12">
            {!! Form::label('Observaciones: ')!!}
            {!! Form::textarea('observaciones',$ordenador->observaciones,['id'=>'observaciones','class'=>'form-control','readonly']) !!}
        </div>
    </div>
@endif
