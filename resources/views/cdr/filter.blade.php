
    <div class="col-md-4 col-xs-12">
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
                <form class="form-horizontal form-label-left input_mask">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Куда звонили</label>

                        <div class="col-md-9 col-sm-9 col-xs-12 has-feedback">
                            <select class="form-control has-feedback-left">
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
                            <input type="text" class="form-control has-feedback-left"  id="inputSuccess5" placeholder="Не знаю">
                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Когда звонил</label>
                        <div class="col-md-9 col-sm-9 col-xs-12 has-feedback">
                            <input id="birthday" class="date-picker form-control has-feedback-left" type="text" placeholder="Не помню">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
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