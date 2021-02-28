<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Восстановление пароля</title>
    <script src="/public/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="/public/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="/public/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/public/assets/libs/bootstrap/dist/css/bootstrap.min.css">
</head>
<style>
    html,body {
        height: 100%;
    }
    p.error-item { margin-top: 20px; color: #e84b4b; }

</style>
<body>
    <div class="container d-flex h-100 justify-content-center">
        <div class="row align-self-center text-center">
            <div class="col">
                <h3>Изменение пароля</h3>
                <form action="/recovery/editPassword" method="POST">
                    <input type="hidden" name="recovery_id" value="<?php echo $this->input->get('recovery_id'); ?>">
<!--                    <small id="emailHelp" class="form-text text-muted">Введите новый пароль и подтверждение пароля</small>-->
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Подтверждение пароля</label>
                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm password" name="confirm_password">
                    </div>

                    <button type="submit" class="btn btn-primary">Сменить пароль</button>
                </form>
                <div class="errors">
                    <?php if ($this->session->errors): ?>
                        <?php foreach ($this->session->errors as $error): ?>
                            <p class="error-item">- <?php echo $error; ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>