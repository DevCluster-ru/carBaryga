<!-- ==============================================================-->
<!-- Topbar header - style you can find in pages.scss-->
<!-- ==============================================================-->
<!--<header class="topbar" data-navbarbg="skin5">-->
<!--    <nav class="navbar top-navbar navbar-expand-md navbar-dark">-->
<!--        <div class="navbar-header" data-logobg="skin5">-->

            <!--             ==============================================================-->
            <!--             Logo-->
            <!--             ==============================================================-->
            <!--            <a class="navbar-brand" href="index.html">-->
            <!--                 Logo icon-->
            <!--                <b class="logo-icon">-->
            <!--                    You can put here icon as well // <i class="wi wi-sunset"></i> //-->
            <!--                     Dark Logo icon-->
            <!--                    <img src="/public/assets/images/logo-icon.png" alt="homepage" class="dark-logo" />-->
            <!--                     Light Logo icon-->
            <!--                    <img src="/public/assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />-->
            <!--                </b>-->
            <!--                End Logo icon-->
            <!--                 Logo text-->
            <!--                <span class="logo-text">-->
            <!--                             dark Logo text-->
            <!--                            <img src="/public/assets/images/logo-text.png" alt="homepage" class="dark-logo" />-->
            <!--                     Light Logo text-->
            <!--                            <img src="/public/assets/images/logo-light-text.png" class="light-logo" alt="homepage" />-->
            <!--                        </span>-->
            <!--            </a>-->



            <!--             ==============================================================-->
            <!--             End Logo-->
            <!--             ==============================================================-->
            <!--             This is for the sidebar toggle which is visible on mobile only-->
            <!--            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i-->
            <!--                    class="ti-menu ti-close"></i></a>-->
<!--        </div>-->
        <!--         ==============================================================-->
        <!--         End Logo-->
        <!--         ==============================================================-->
<!--        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">-->
            <!--             ==============================================================-->
            <!--             toggle and nav items-->
            <!--             ==============================================================-->
<!--            <ul class="navbar-nav float-left mr-auto">-->
                <!--                 ==============================================================-->
                <!--                 Search-->
                <!--                 ==============================================================-->
                <!--                <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark"-->
                <!--                                                    href="javascript:void(0)"><i class="ti-search"></i></a>-->
                <!--                    <form class="app-search position-absolute">-->
                <!--                        <input type="text" class="form-control" placeholder="Search &amp; enter"> <a-->
                <!--                            class="srh-btn"><i class="ti-close"></i></a>-->
                <!--                    </form>-->
                <!--                </li>-->
<!--            </ul>-->
            <!--             ==============================================================-->
            <!--             Right side toggle and nav items-->
            <!--             ==============================================================-->
<!--            <ul class="navbar-nav float-right">-->
<!---->
<!--                --><?php //if ($User) { ?>
<!---->
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link d-inline-block" href="/logout"><b>Выход</b></a>-->
<!--                    </li>-->



                    <!--                 ==============================================================-->
                    <!--                 User profile and search-->
                    <!--                 ==============================================================-->
<!--                    <li class="nav-item dropdown">-->
<!--                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""-->
<!--                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img-->
<!--                                    src="/public/assets/images/users/1.jpg" alt="user" class="rounded-circle"-->
<!--                                    width="31"></a>-->
<!--                        <div class="dropdown-menu dropdown-menu-right user-dd animated">-->
<!--                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i>-->
<!--                                My Profile</a>-->
<!--                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i>-->
<!--                                My Balance</a>-->
<!--                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i>-->
<!--                                Inbox</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!---->
<!--                --><?php //} else {?>
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link d-inline-block" href="#" onclick="$('#regr').modal('show'); return false">Регистрация</a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link d-inline-block" href="#" onclick="$('#auth').modal('show'); return false"><b>Вход</b></a>-->
<!--                    </li>-->
<!--                --><?php //} ?>

                <!--                ==============================================================-->
                <!--                User profile and search-->
                <!--                 ==============================================================-->
<!--            </ul>-->
<!--        </div>-->
<!--    </nav>-->
<!--</header>-->

<!-- ==============================================================-->
<!-- End Topbar header-->
<!-- ==============================================================-->

<style>
    .navbar { z-index: 11; }
    .navbar-nav { margin-left: auto; }
    .navbar-light .navbar-nav .nav-link { color: #eee; font-weight: bold; font-size: 15px; }
    #logo { font-family: 'Permanent Marker'; font-weight: bold; color: #eee; }
    .navbar-light .navbar-toggler { border-color: #eee; color: #eee; }
    .navbar-light .navbar-toggler-icon { color: #eee; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 238, 238, 238%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e"); }
    .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover { color: rgba(99, 185, 236, 0.7);}
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
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon navbar-toggler-icon2"></span>
    </button>
    <div class="collapse navbar-collapse float-right" id="navbarNavDropdown">
        <ul class="navbar-nav float-right">

            <?php if ($User) { ?>

            <li class="nav-item">
                <a class="nav-link d-inline-block" href="/logout"><b>Выход</b></a>
            </li>

            <!--                 ============================================================== -->
            <!--                 User profile and search -->
            <!--                 ============================================================== -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                            src="/public/assets/images/users/1.jpg" alt="user" class="rounded-circle"
                            width="31"></a>
                <div class="dropdown-menu dropdown-menu-right user-dd animated">
                    <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i>
                        My Profile</a>
                    <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i>
                        My Balance</a>
                    <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i>
                        Inbox</a>
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