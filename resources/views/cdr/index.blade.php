@extends('generic.layout')

@section('title','Список звонков')

@section('page_title','Список звонков')

@section('page_description','История вызовов по телефонным номерам')

@section('content')

    <div class="row">

        <!-- Фильтр -->
        @include('cdr.filter')
        <!-- /Фильтр -->

        <!-- Результаты запроса -->
        @includeIf('cdr.results')
        <!-- /Результаты запроса -->

    </div>

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

    <!-- Datatables -->
    <script>
        $(document).ready(function() {

            $('#datatable-responsive').DataTable({
                // ajax: "js/datatables/json/scroller-demo.json",
                // deferRender: true,
                // scrollY: 380,
                // scrollCollapse: true,
                // scroller: true
            });

        });
    </script>
    <!-- /Datatables -->
@endsection