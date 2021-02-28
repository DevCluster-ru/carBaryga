<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile d-flex no-block dropdown m-t-20">
                        <div class="user-pic"><img src="/public/assets/images/users/1.jpg" alt="users"
                                                   class="rounded-circle" width="40" /></div>
                        <div class="user-content hide-menu m-l-10">
                            <a class="" id="Userdd" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="m-b-0 user-name font-medium">
                                    <?php echo $User["UserName"]?>
<!--                                    <i class="fa fa-angle-down"></i>-->

                                </h5>
                                <span class="op-5 user-email"><?php echo $User["UserEmail"]?></span>
                            </a>
<!--                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Userdd">-->
<!--                                <a class="dropdown-item" href="javascript:void(0)"><i-->
<!--                                        class="ti-user m-r-5 m-l-5"></i> My Profile</a>-->
<!--                                <a class="dropdown-item" href="javascript:void(0)"><i-->
<!--                                        class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>-->
<!--                                <a class="dropdown-item" href="javascript:void(0)"><i-->
<!--                                        class="ti-email m-r-5 m-l-5"></i> Inbox</a>-->
<!--                                <div class="dropdown-divider"></div>-->
<!--                                <a class="dropdown-item" href="javascript:void(0)"><i-->
<!--                                        class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>-->
<!--                                <div class="dropdown-divider"></div>-->
<!--                                <a class="dropdown-item" href="javascript:void(0)"><i-->
<!--                                        class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>-->
<!--                            </div>-->
                        </div>
                    </div>
                    <!-- End User Profile-->


                </li>
                <li class="p-15 m-t-10"><a href="#" onclick="$('#addTaskId').modal('show'); return false"
                                           class="btn btn-block create-btn text-white no-block d-flex align-items-center"><i
                            class="fa fa-plus-square"></i> <span class="hide-menu m-l-5">Создать подписку</span> </a>
                </li>
                <!-- User Profile-->
                <!--
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                             href="index.html" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                             href="pages-profile.html" aria-expanded="false"><i
                            class="mdi mdi-account-network"></i><span class="hide-menu">Profile</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                             href="table-basic.html" aria-expanded="false"><i class="mdi mdi-border-all"></i><span
                            class="hide-menu">Table</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                             href="icon-material.html" aria-expanded="false"><i class="mdi mdi-face"></i><span
                            class="hide-menu">Icon</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                             href="starter-kit.html" aria-expanded="false"><i class="mdi mdi-file"></i><span
                            class="hide-menu">Blank</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                             href="error-404.html" aria-expanded="false"><i class="mdi mdi-alert-outline"></i><span
                            class="hide-menu">404</span></a></li>
                <li class="text-center p-40 upgrade-btn">
                    <a href="https://wrappixel.com/templates/xtremeadmin/"
                       class="btn btn-block btn-danger text-white" target="_blank">Upgrade to Pro</a>
                </li>
                -->
            </ul>

            <style>
                .list-rectangle {
                    list-style: none;
                    margin: 0;
                    padding: 20px 0;
                    margin: 20px 10px!important;
                }
                .list-rectangle>li {
                    position: relative;
                    display: block;
                    max-width: 450px;
                    margin-bottom: .25rem;
                    padding: .325rem .825rem .325rem 1.325rem;
                }
                .list-rectangle>li:last-child {
                    margin-bottom: 0;
                }
                .list-rectangle>li::before {
                    content: "";
                    position: absolute;
                    left: 0;
                    top: 0;
                    bottom: 0;
                    width: 0.5rem;
                    background: #656ce9;
                }
            </style>

            <h2 style="margin-top: 20px; font-family: 'Permanent Marker'; font-size: 20px; text-align: center">CAR BOT - <span style="font-family: 'Montserrat';">это</span></h2>
            <ul class="list-rectangle">
                <li>Крупнейшие доски объявлений в базе (Авито, Авто.Ру, Дром)</li>
                <li>Любое количество заданий на поиск машин</li>
                <li>В нескольких регионах или везде в РФ</li>
                <li>Уведомление ботом в Телеграме о новых объявлениях</li>
                <li>Поиск в крупнейших досках(17 источников)</li>
                <li>Автоматическая проверка авто по вин сразу в выдаче бота</li>
                <li>Нет никакой рекламы</li>
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
