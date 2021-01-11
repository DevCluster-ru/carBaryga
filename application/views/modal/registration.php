<div id="regr" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Регистрация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal form-material">
                    <div class="form-group">
                        <label class="col-md-12">Логин</label>
                        <div class="col-md-12">
                            <input name="login" type="text" placeholder=""
                                   class="form-control form-control-line" id="login">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">E-Mail</label>
                        <div class="col-md-12">
                            <input name="email" type="email" placeholder=""
                                   class="form-control form-control-line" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Ваш ник в телеграм</label>
                        <div class="col-md-12">
                            <input name="telegram" type="text" placeholder="@username"
                                   class="form-control form-control-line" id="telegram">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Пароль</label>
                        <div class="col-md-12">
                            <input name="password" type="password" placeholder=""
                                   class="form-control form-control-line" id="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Повторите пароль</label>
                        <div class="col-md-12">
                            <input name="confirm_password" type="password" placeholder=""
                                   class="form-control form-control-line" id="confirm_password">
                        </div>
                    </div>
                </form>
                <a href="javascript:issetAccount()" class="col-6">У меня уже есть аккаунт</a>
            </div>
            <div class="modal-footer">
                <button onclick="tryReg()" type="button" class="btn btn-primary">Регистрация</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>

<!--<form class="row g-3 needs-validation" novalidate>-->
<!--    <div class="col-md-4">-->
<!--        <label for="validationCustom01" class="form-label">First name</label>-->
<!--        <input type="text" class="form-control" id="validationCustom01" value="Mark" required>-->
<!--        <div class="valid-feedback">-->
<!--            Looks good!-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-4">-->
<!--        <label for="validationCustom02" class="form-label">Last name</label>-->
<!--        <input type="text" class="form-control" id="validationCustom02" value="Otto" required>-->
<!--        <div class="valid-feedback">-->
<!--            Looks good!-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-4">-->
<!--        <label for="validationCustomUsername" class="form-label">Username</label>-->
<!--        <div class="input-group has-validation">-->
<!--            <span class="input-group-text" id="inputGroupPrepend">@</span>-->
<!--            <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>-->
<!--            <div class="invalid-feedback">-->
<!--                Please choose a username.-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-6">-->
<!--        <label for="validationCustom03" class="form-label">City</label>-->
<!--        <input type="text" class="form-control" id="validationCustom03" required>-->
<!--        <div class="invalid-feedback">-->
<!--            Please provide a valid city.-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-3">-->
<!--        <label for="validationCustom04" class="form-label">State</label>-->
<!--        <select class="form-select" id="validationCustom04" required>-->
<!--            <option selected disabled value="">Choose...</option>-->
<!--            <option>...</option>-->
<!--        </select>-->
<!--        <div class="invalid-feedback">-->
<!--            Please select a valid state.-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-3">-->
<!--        <label for="validationCustom05" class="form-label">Zip</label>-->
<!--        <input type="text" class="form-control" id="validationCustom05" required>-->
<!--        <div class="invalid-feedback">-->
<!--            Please provide a valid zip.-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-12">-->
<!--        <div class="form-check">-->
<!--            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>-->
<!--            <label class="form-check-label" for="invalidCheck">-->
<!--                Agree to terms and conditions-->
<!--            </label>-->
<!--            <div class="invalid-feedback">-->
<!--                You must agree before submitting.-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-12">-->
<!--        <button class="btn btn-primary" type="submit">Submit form</button>-->
<!--    </div>-->