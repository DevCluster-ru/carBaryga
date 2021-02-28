<div id="auth" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Авторизация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-material">
                    <div class="form-group">
                        <label class="col-md-12">Логин</label>
                        <div class="col-md-12">
                            <input name="email" type="email" placeholder="usermail@mail.com"
                                   class="form-control form-control-line" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Пароль</label>
                        <div class="col-md-12">
                            <input name="password" type="password" placeholder="******"
                                   class="form-control form-control-line" id="password">
                        </div>
                    </div>
                </form>
                <a href="javascript:modalRecovery()" class="col-6">Восстановление пароля</a>
                <a href="javascript:notIssetAccount()" class="col-6">У меня нет аккаунта</a>
            </div>
            <div class="modal-footer">
                <button onclick="tryAuth()" type="button" class="btn btn-primary">Войти</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>