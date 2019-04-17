<div class="col-md-5 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Информация о пользователе</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link">Свернуть <i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-12 center-margin">
                <form class="form-horizontal form-label-left input_mask" action="/users" method="post">
                    <input name="_token" hidden value="{!! csrf_token() !!}" />

                    <div class="form-group">
                        <label class="col-md-12 col-sm-12 col-xs-12">Имя пользователя</label>
                        <div class="col-md-12 col-sm-12 col-xs-12 has-feedback">
                            <input type="text" name='name' id="name"  class="form-control has-feedback-left"  placeholder="Имя пользователя">
                            <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12 col-sm-12 col-xs-12">Логин</label>
                        <div class="col-md-12 col-sm-12 col-xs-12 has-feedback">
                            <input type="text" name='login' id="login"  class="form-control has-feedback-left"  placeholder="Логин">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12 col-sm-12 col-xs-12">Пароль</label>
                        <div class="col-md-12 col-sm-12 col-xs-12 has-feedback">
                            <input type="password" name='password' id="password"  class="form-control has-feedback-left"  placeholder="Пароль">
                            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12 col-sm-12 col-xs-12">Пароль еще раз</label>
                        <div class="col-md-12 col-sm-12 col-xs-12 has-feedback">
                            <input type="password" name='password-conform' id="password-conform"  class="form-control has-feedback-left"  placeholder="Пароль еще раз">
                            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                            <button type="reset" class="btn btn-info">Отмена</button>
                        </div>

                        <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-4 col-sm-offset-4">
                            <button type="reset" class="btn btn-default">Удалить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>