
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Фильтр запроса</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link">Свернуть <i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left input_mask" action="/cdr" method="post">
                    <input name="_token" hidden value="{!! csrf_token() !!}" />

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Куда звонили</label>

                        <div class="col-md-9 col-sm-9 col-xs-12 has-feedback">
                            <select name='callDestination' id="callDestination" class="form-control has-feedback-left">
                                <option value="">Не важно</option>
                                @foreach($dst as $number)
                                <option value="{{ $number->dst }}">{{ $number->dst }}</option>
                                @endforeach
                            </select>
                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Кто звонил</label>
                        <div class="col-md-9 col-sm-9 col-xs-12 has-feedback">
                            <input type="text" name='callSource' id="callSource"  class="form-control has-feedback-left"  placeholder="Не знаю">
                            <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Когда звонил</label>
                        <div class="col-md-9 col-sm-9 col-xs-12 has-feedback">
                            <input name='callDate' id="callDate" class="date-picker form-control has-feedback-left" type="text" placeholder="Не помню">
                            <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-5 col-sm-9 col-xs-12 col-md-offset-7">
                            <button type="reset" class="btn btn-primary">Сброс</button>
                            <button type="submit" class="btn btn-success">Искать</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    @endpush

    @push('scripts')
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script>
        $(document).ready(function() {

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
        });
    </script>
    @endpush