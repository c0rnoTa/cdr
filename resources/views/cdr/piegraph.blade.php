<div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel tile fixed_height_320 overflow_hidden">
        <div class="x_title">
            <h2>Количество входящих по номерам</h2>
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
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <p class="">Городские</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <p class="">Звонков</p>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                    </td>
                    <td>
                        <table class="tile_info">
                            @foreach($callsByDst as $dst)
                            <tr>
                                <td>
                                    <p><i class="fa fa-square red"></i>{{ $dst->dst }} </p>
                                </td>
                                <td>{{ $dst->amount }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>