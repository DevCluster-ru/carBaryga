<style>
    .error-status { margin-top: 20px; color: #e84b4b; }
    .success-status { color: green; }
</style>
<div id="recovery_password" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Восстановление пароля</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal form-material" onsubmit="return false;">
                    <div class="form-group">
                        <label class="col-md-12">Введите ваш Email указанный при регистрации аккаунта
                            <p><small class="text-muted">На данный Email будет отправлено сообщение с ссылкой</small></p>
                        </label>
                        <div class="col-md-12">
                            <input name="email_recovery" type="email" placeholder="usermail@mail.com"
                                   class="form-control form-control-line">
                            <button onclick="recoveryPass()" type="button" class="btn btn-primary mt-3">Отправить</button>
                        </div>
                    </div>
                </form>
                <div class="send-status error-item" id="send-status">

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>