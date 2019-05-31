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
        <div class="row justify-content-center mt-3">
            <div class="card col-lg-12">
                <div class="card-header d-inline-flex justify-content-between">
                    <span class="align-self-baseline">Relación de Ordenadores</span>

                    <div class="navbar-text align-self-baseline">
                        <a href="{{route('ordenadors.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo Ordenador</a>
                        <a href="{{route('home')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Volver</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('layouts.errores')
                    @if ($ordenadors->isEmpty())
                        <div><h3>No hay Ordenadores</h3></div>
                    @else
                        <table class="table table-striped mitabladedatos">
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>id</th>
                                    <th>Número</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Ubicación</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>

                             <tfoot>
                                <tr>
                                    <th>Acciones</th>
                                    <th>id</th>
                                    <th>Número</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Ubicación</th>
                                </tr>
                            </tfoot>

                            {{-- @foreach ($ordenadors as $ordenador)
                                @if (isset($_GET["id"]) && ($ordenador->id == $_GET["id"]))
                                    <tr class="bg-success">
                                        <td>
                                        <a href="{{ route('ordenadors.show',$ordenador->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye"></i> Ver</a>

                                        <a href="ordenadors/{{ $ordenador->id }}/edit" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i> Modif.</a>

                                        <a href="{{ route('muestraBorradoOrd',$ordenador->id) }}" class="btn btn-sm btn-danger">
                                        <i class="fa fa-times"></i> Borrar</a>



                                        </td>
                                        <td>{{ $ordenador->id }}</td>
                                        <td>{{ $ordenador->numero }}</td>
                                        <td>{{ $ordenador->marca }}</td>
                                        <td>{{ $ordenador->modelo }}</td>
                                        <td>{{ $ordenador->ubicacion }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>
                                        <a href="{{ route('ordenadors.show',$ordenador->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Ver</a>
                                        <a href="ordenadors/{{ $ordenador->id }}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Modif.</a>
                                        <a href="{{ route('muestraBorradoOrd',$ordenador->id) }}" class="btn btn-sm btn-danger">
                                        <i class="fa fa-times"></i> Borrar</a>
                                        </td>
                                        <td>{{ $ordenador->id }}</td>
                                        <td>{{ $ordenador->numero }}</td>
                                        <td>{{ $ordenador->marca }}</td>
                                        <td>{{ $ordenador->modelo }}</td>
                                        <td>{{ $ordenador->ubicacion }}</td>
                                    </tr>
                                @endif
                            @endforeach --}}
                        </table>
                        {{-- {{ $ordenadors->links() }} lo comento porque estoy usando datatable--}}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
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
            ajax: '{{ url("/ordenadors") }}',
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
                {data: 'numero', name: 'numero'},
                {data: 'marca', name: 'marca'},
                {data: 'modelo', name: 'modelo'},
                {data: 'ubicacion', name: 'ubicacion'},
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

            $(".dt-buttons").css("display", "inline-table");
            $(".dataTables_length").css("display", "inline-table");
            $(".dataTables_filter").css("display", "inline-table");
            $(".dataTables_filter").css("text-align", "right");

            ancho= $(".dataTables_wrapper").width() - $(".dt-buttons").width() - $(".dataTables_length").width();
            console.log(ancho);
            $(".dataTables_filter").css("width", ancho);
    </script>


@endsection
