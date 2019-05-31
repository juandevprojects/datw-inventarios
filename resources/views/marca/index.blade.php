@extends('layouts.app')

@section('haydatatables')
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('js/buttons/css/buttons.dataTables.min.css') }}">
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{!! asset('js/buttons/js/dataTables.buttons.min.js') !!}"></script>
    <script type="text/javascript" language="javascript" src="{!! asset('js/jszip/jszip.min.js') !!}"></script>
    <script type="text/javascript" language="javascript" src="{!! asset('js/pdfmake/pdfmake.min.js') !!}"></script>
    <script type="text/javascript" language="javascript" src="{!! asset('js/pdfmake/vfs_fonts.js') !!}"></script>
    <script src="{!! asset('js/buttons/js/buttons.html5.min.js') !!}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-inline-flex  justify-content-between">
                    <span class="align-self-baseline">Marcas</span>
                    <div class="navbar-text align-self-baseline">
                        <a href={{ route('marcas.create') }}>
                            <button type="button" id='nueva'  name='nueva' class="btn btn-info">
                                <i class="fa fa-plus"></i>Nueva Marca
                            </button>
                        </a>

                        <a href={{ url('/home') }}>
                            <button type="button" id='volver'  name='volver' class="btn btn-primary">
                                <i class="fa fa-arrow-left"></i>Volver
                            </button>
                        </a>
                    </div>

                </div>

                <div class="card-body">
                    @include('layouts.errores')
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($marcas->isEmpty())
                        <div>No hay Marcas</div>
                    @else
                        <table class="table table-striped mitabladedatos">
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>id</th>
                                    <th>Nombre</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>

                             <tfoot>
                                <tr>
                                    <th>Acciones</th>
                                    <th>id</th>
                                    <th>Nombre</th>
                                </tr>
                            </tfoot>

                            {{-- @foreach ($marcas as $marca)
                                @if (isset($_GET["id"]) && ($marca->id == $_GET["id"]))
                                    <tr class="bg-success">
                                        <td>
                                            <a href="marcas/{{ $marca->id }}/edit"><button type='button' class='btn btn-warning'><i class='far fa-edit'></i> Modificar</button></a>
                                            <a href={{route('marcas.destroy',$marca->id)}}><button type='button' class='btn btn-danger'><i class='fas fa-trash-alt'></i> Borrar</button></a>
                                        </td>

                                        <td>
                                            {{ $marca->id}}
                                        </td>

                                        <td>
                                            {{ $marca->nombre}}
                                        </td>
                                    </tr>
                                @else

                                    <tr>
                                        <td>
                                            <a href="marcas/{{ $marca->id }}/edit"><button type='button' class='btn btn-warning'><i class='far fa-edit'></i> Modificar</button></a>
                                            <a href={{route('marcas.destroy',$marca->id)}}><button type='button' class='btn btn-danger'><i class='fas fa-trash-alt'></i> Borrar</button></a>
                                        </td>

                                        <td>
                                            {{ $marca->id}}
                                        </td>

                                        <td>
                                            {{ $marca->nombre}}
                                        </td>
                                    </tr>


                                @endif


                            @endforeach --}}

                        </table>
                        {{-- {{ $marcas->links() }} --}}
                        {{-- Para que muestre la paginación hecha en el controlador --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
        // Script para utilizar el datatables
        $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
            var $input = $("input[name='keyword']"), $context = $(".keyword");
            $input.on("input", function () {
                var term = $(this).val();
                $context.show().unmark();
                if (term) {
                    $context.mark(term, {
                        done: function () {
                            $context.not(":has(mark)").hide();
                        }
                    });
                }
            });
            $('#search-filter').focus();
        });

        $('.mitabladedatos').DataTable({
            dom: 'Blfrtip',
            processing: true,
            serverSide: true,
            pageLength: 10,
            order: [ 1, "asc" ],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            ajax: '{{ url("/marcas") }}',
            buttons: [

                'colvis',

                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'TABLOID'
                },
                'excelHtml5'
            ],
            language:{
                lengthMenu:"Mostrar _MENU_ registros por página. ",
                zeroRecords: "Lo sentimos. No se encontraron registros.",
                info: "Mostrando página _PAGE_ de _PAGES_",
                infoEmpty: "No hay registros aún.",
                infoFiltered: "(filtrados de un total de _MAX_ registros)",
                search : "Búsqueda",
                LoadingRecords: "Cargando ...",
                Processing: "Procesando...",
                SearchPlaceholder: "Comience a teclear...",
                paginate: {
                    previous: "Anterior",
                    next: "Siguiente",
                    first: "Primero",
                    last: "Último",
                }
            },
            columns: [
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'id', name: 'id'},
                {data: 'nombre', name: 'nombre'},   // Se colocan los nombres de las columnas de la tabla
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                column.search(val ? val : '', true, false).draw();
                            });
                });
            },

            });

            // $(".dt-buttons").css("display", "inline-table");
            // $(".dataTables_length").css("display", "inline-table");
            // $(".dataTables_filter").css("display", "inline-table");
            // $(".dataTables_filter").css("text-align", "right");
            // ancho= $(".dataTables_wrapper").width() - $(".dt-buttons").width() - $(".dataTables_length").width();
            // console.log(  <?php echo "\"Hola\""; ?>  );
            console.log(  <?php if(isset($_GET["id"])){
                                    echo "\"Si está\"";
                                } else {
                                    echo "\"No está\"";
                                }    ?>  );

            // $(".dataTables_filter").css("width", ancho);

            // (isset($_GET["id"])) ? "Si" : "NO"










    </script>
@endsection
