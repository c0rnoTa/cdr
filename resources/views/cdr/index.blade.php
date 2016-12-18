@extends('generic.layout')

@section('title','Список звонков')

@section('page_title','Список звонков')

@section('page_description','История вызовов по телефонным номерам')

@section('content')

    <div class="row">
       <!-- Фильтр -->
       @include('cdr.filter')
        <!-- Детальный список звонков -->
        @includeIf('cdr.resultstable')
    </div>

    <div class="row">
        <!-- Количество звонков по номерам -->
        @includeIf('cdr.piegraph')
    </div>

@endsection

@section('styles')
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
@endsection

@section('scripts')
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>

    <script>
        $(document).ready(function() {

            // Datatables
            $('#datatable-responsive').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Russian.json"
                },
                "order": [[ 0, "desc" ]]
                // ajax: "js/datatables/json/scroller-demo.json",
                // deferRender: true,
                // scrollY: 380,
                // scrollCollapse: true,
                // scroller: true
            });

            // Каленедарик
            $('#callDate').daterangepicker({
                @if ( isset( $requestcall['callDate'] ) )
                'startDate': '{{ $requestcall['callDate'] }}',
                @endif
                'singleDatePicker': true
            });

            // Выставляем значения в форму запроса
            $('#callDestination').val({{ $requestcall['callDestination'] or 'null'}});
            $('#callSource').val({{ $requestcall['callSource'] or 'null' }});
            @if( !isset($requestcall['callDate']) )
                $('#callDate').val(null);
            @endif

            // Круговой график
            var options = {
                legend: false,
                responsive: false
            };
            new Chart(document.getElementById("canvas1"), {
                type: 'doughnut',
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                data: {
                    labels: [
                        "Symbian",
                        "Blackberry",
                        "Other",
                        "Android",
                        "IOS"
                    ],
                    datasets: [{
                        data: [15, 20, 30, 10, 30],
                        backgroundColor: [
                            "#BDC3C7",
                            "#9B59B6",
                            "#E74C3C",
                            "#26B99A",
                            "#3498DB"
                        ],
                        hoverBackgroundColor: [
                            "#CFD4D8",
                            "#B370CF",
                            "#E95E4F",
                            "#36CAAB",
                            "#49A9EA"
                            ]
                        }]
                    },
                options: options
            });

        });
    </script>
@endsection