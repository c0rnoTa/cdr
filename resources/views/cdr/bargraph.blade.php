<div class="col-md-8 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Количество звонков по дням</h2>
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

        var barChartData = {
            labels: [
                @for($i=0; $i<=31 ; $i++)
                "{{  $callsByDate[$i]['day'] }}",
                @endfor
            ],
            datasets: [{
                label: 'Не отвечено',
                backgroundColor: "rgba(104,122,127,0.8)",
                data: [
                    @for($i=0; $i<=31 ; $i++)
                    {{  $callsByDate[$i]['other'] }},
                    @endfor
                    ]
                },{
                label: 'Отвечено',
                backgroundColor: "rgba(139,180,208,0.8)",
                data: [
                    @for($i=0; $i<=31 ; $i++)
                    {{  $callsByDate[$i]['answered'] }},
                    @endfor
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
                    text:"Успешные и не успешные вызовы по дням"
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