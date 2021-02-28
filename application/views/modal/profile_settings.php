<div id="profile_settings" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Настройки профиля</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="profile-edit-data">

                </div>

                <form method="post" id="editProfileForm">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Имя</label>
                        <input type="text" name="login" class="form-control" placeholder="Enter email" value="<?php echo $this->session->userdata("UserName"); ?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Telegram name</label>
                        <input type="text" name="telegram" class="form-control" placeholder="Telegram name" value="<?php echo $this->session->userdata("UserTelegram"); ?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $this->session->userdata("UserEmail"); ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Пароль</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Подтверждение пароля</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password">
                    </div>

                    <button type="submit" class="btn btn-primary" onclick="editProfile(); return false;">Изменить профиль</button>
                </form>

            </div>
<!--            <div class="modal-footer">-->
<!--                <button class="btn btn-primary" type="button" data-dismiss="modal">Изменить данные</button>-->
<!--            </div>-->
        </div>
    </div>
</div>