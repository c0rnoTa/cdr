<div class="col-md-4 col-sm-12 col-xs-12">
    <div class="x_panel tile fixed_height_320 overflow_hidden">
        <div class="x_title">
            <h2>Успешность дозвона по номеру</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link">Свернуть <i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="" style="width:100%">
                <tr>
                    <th style="width:37%;">
                        <p>&nbsp;</p>
                    </th>
                    <th>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <p class="">Результат дозвона</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <p class="">Количство звонков</p>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <canvas id="piecanvas2" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                    </td>
                    <td>
                        <table class="tile_info">
                            <?php $colornames = ['blue','green','purple','aero','red','dark'] ?>
                            @for( $i=0; $i<count($statsByDisposition); $i++)
                                <tr>
                                    <td>
                                        <p><i class="fa fa-square {{ $colornames[$i] }}"></i>{{ $statsByDisposition[$i]->disposition }} </p>
                                    </td>
                                    <td>{{ $statsByDisposition[$i]->amount }}</td>
                                </tr>
                            @endfor
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<!-- Chart.js -->
<script src="../vendors/Chart.js/dist/Chart.min.js"></script>
<script>
    $(document).ready(function() {

        // Круговой график
        new Chart($('#piecanvas2'), {
            type: 'doughnut',
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: {
                labels: [
                    @foreach($statsByDisposition as $dststat)
                    "{{ $dststat->disposition }}",
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($statsByDisposition as $dststat)
                        {{ $dststat->amount }},
                        @endforeach
                    ],
                    backgroundColor: [
                        "#3498DB",
                        "#26B99A",
                        "#9B59B6",
                        "#BDC3C7",
                        "#E74C3C"
                    ],
                    hoverBackgroundColor: [
                        "#49A9EA",
                        "#36CAAB",
                        "#B370CF",
                        "#CFD4D8",
                        "#E95E4F"
                    ]
                }]
            },
            options: {
                legend: false,
                responsive: false
            }
        });

    });
</script>
@endpush