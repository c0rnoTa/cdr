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
            <table id="results-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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

@include('vendor.dataTables')

@push('scripts')
<script>
    $(document).ready(function() {

        // Datatables
        $('#results-table').DataTable({
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