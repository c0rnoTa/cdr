<div class="col-md-8 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Результаты запроса</h2>
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