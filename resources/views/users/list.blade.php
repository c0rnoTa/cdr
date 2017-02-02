<div class="col-md-7 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Список учетных записей</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link">Свернуть <i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="users-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Логин</th>
                    <th>E-mail</th>
                    <th>Создан</th>
                    <th>Обновлен</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->login }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
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
        $('#users-table').DataTable({
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