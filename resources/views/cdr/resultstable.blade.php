<div class="col-md-8 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Детальная статистика звонков</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link">Свернуть <i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Время звонка</th>
                    <th>Номер клиента</th>
                    <th>Городской</th>
                    <th>Результат</th>
                    <th>Длительность</th>
                </tr>
                </thead>
                <tbody>
                @foreach($calls as $call)
                <tr>
                    <td>{{ $call->calldate }}</td>
                    <td>{{ $call->src }}</td>
                    <td>{{ $call->dst }}</td>
                    <td>{{ $call->disposition }}</td>
                    <td>{{ $call->billsec }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@push('styles')
<!-- Datatables -->
<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endpush

@push('scripts')
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
<script>
    $(document).ready(function() {

        // Datatables
        $('#datatable-responsive').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Russian.json"
            },
            "order": [[0, "desc"]]
            // ajax: "js/datatables/json/scroller-demo.json",
            // deferRender: true,
            // scrollY: 380,
            // scrollCollapse: true,
            // scroller: true
        });

    });
</script>
@endpush