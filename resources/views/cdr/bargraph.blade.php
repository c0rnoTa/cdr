<div class="col-md-8 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Входящие по дням</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link">Свернуть <i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <canvas id="barcanvas"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {

        var randomScalingFactor = function() {
            return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
        };

        var barChartData = {
            labels: [
                @foreach($callsByDate as $day => $dayStat)
                "{{ $day }}",
                @endforeach
            ],
            datasets: [{
                label: 'Отвечено',
                backgroundColor: "rgba(151,187,205,0.5)",
                data: [
                    @foreach($callsByDate as $dayStat)
                    {{ $dayStat['answered'] }},
                    @endforeach
                ]
            }, {
                label: 'Не отвечено',
                backgroundColor: "rgba(220,220,220,0.5)",
                data: [
                    @foreach($callsByDate as $dayStat)
                    {{ $dayStat['other'] }},
                    @endforeach
                ]
            }]

        };

        // Столбчатый график
        new Chart($('#barcanvas'), {
            type: 'bar',
            data: barChartData,
            options: {
                title:{
                    display:true,
                    text:"Отвеченные и пропущенные звонки"
                },
                tooltips: {
                    mode: 'label'
                },
                responsive: true,
                scales: {
                    xAxes: [{
                        stacked: true
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }
        });
    });
</script>
@endpush