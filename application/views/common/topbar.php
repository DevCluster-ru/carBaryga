<style>
    .navbar { z-index: 11; }
    .navbar-nav { margin-left: auto; }
    .navbar-light .navbar-nav .nav-link { color: #eee; font-weight: bold; font-size: 15px; }
    #logo { font-family: 'Permanent Marker'; font-weight: bold; color: #eee; }
    .navbar-light .navbar-toggler { border-color: #eee; color: #eee; }
    .navbar-light .navbar-toggler-icon { color: #eee; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 238, 238, 238%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e"); }
    .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover { color: rgba(99, 185, 236, 0.7);}
    .mail-contact { display: flex; flex-basis: 100%; justify-content: right; color: #f8f8f8; }
</style>

<!--<header class="topbar" data-navbarbg="skin5">-->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand" href="/" id="logo">
<!--        Logo icon-->
                        <b class="logo-icon">
<!--                            You can put here icon as well // <i class="wi wi-sunset"></i> //-->
<!--                             Dark Logo icon-->
<!--                            <img src="/public/assets/images/logo-icon.png" alt="homepage" class="dark-logo" />-->
<!--                             Light Logo icon-->
                            <img src="/public/assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
        CAR BOT
    </a>

        <?php if ($User) { echo '<div class="mail-contact">Контакты: timig@yandex.ru</div>'; } ?>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon navbar-toggler-icon2"></span>
    </button>
    <div class="collapse navbar-collapse float-right" id="navbarNavDropdown">
        <ul class="navbar-nav float-right">

            <?php if ($User) { ?>

            <!--                 ============================================================== -->
            <!--                 User profile and search -->
            <!--                 ============================================================== -->

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href=""
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/public/assets/images/users/1.jpg" alt="user" class="rounded-circle"
                            width="31">  &nbsp;&nbsp;Аккаунт
                </a>
                <div class="dropdown-menu dropdown-menu-right user-dd animated">
                    <a class="dropdown-item" onclick="$('#addTaskId').modal('show'); return false"><i class="ti-check m-r-5 m-l-5"></i>
                        Создать подписку</a>
                    <a class="dropdown-item" onclick="modalProfileSettings(); return false;"><i class="ti-user m-r-5 m-l-5"></i>
                        Профиль</a>
                    <a class="dropdown-item" onclick="modalBalance(); return false;"><i class="ti-wallet m-r-5 m-l-5"></i>
                        Баланс</a>
                    <a class="dropdown-item" href="/logout"><i class="ti-eraser m-r-5 m-l-5"></i>
                        Выход</a>
                </div>
            </li>




            <?php } else {?>
                <li class="nav-item">
                    <a class="nav-link d-inline-block ml-3" href="#" onclick="$('#regr').modal('show'); return false">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-inline-block ml-3" href="#" onclick="$('#auth').modal('show'); return false"><b>Вход</b></a>
                </li>
            <?php } ?>
        </ul>
    </div>

</nav>
<!--</header>-->