@if (count($errors)>0)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Errores:</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}} </li>
            @endforeach
        </ul>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p><strong>¡Correcto! :</strong> {{Session::get('success')}}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (Session::has('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <p><strong>¡Aviso! :</strong> {{Session::get('info')}}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p><strong>¡Atención! :</strong> {{Session::get('warning')}}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (Session::has('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <p><strong>¡Error! :</strong> {{Session::get('danger')}}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($message = Session::get('mensaje'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <p><strong>{{ $message }}</strong></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
