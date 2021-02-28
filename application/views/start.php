

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">

        <?php if ($this->session->has_userdata('registration')): ?>
            <h6 class="alert alert-success d-inline-block">Регистрация прошла успешно. На вашу почту отправленно сообщение с данными для входа.</h6>
        <?php endif; ?>

        <div class="row align-items-center">



            <div class="col-md-6">
                <h4 class="page-title">Управление подписками</h4>

                <?php if ($this->session->userdata('UserBalance') <= 0): ?>
<!--                    <p class="text-muted">Приобретите ПРО аккаунт и получите все возможности сервиса</p>-->
                <div class="alert alert-info">
                    <p class="text-justify">Внимание! У вас бесплатный вариант с ограничениями (одна подписка, давность объявлений 3 часа, один регион поиска). Для снятия всех ограничений и получения максимального функционала приобретите ПРО аккаунт за 299р. / неделя</p>
                </div>
                <?php endif; ?>


                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <!--                            <li class="breadcrumb-item"><a href="#">Home</a></li>-->
                            <!--                            <li class="breadcrumb-item active" aria-current="page">Library</li>-->
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-right upgrade-btn">
                    <?php if ($this->session->userdata('UserBalance') <= 0): ?>
                        <button href="#" class="btn btn-danger text-white"
                                target="_blank" id="subscription"><b>Купить на PRO аккаунт</b>
                        </button>
                    <?php else: ?>
                        <div class="alert alert-success d-inline-block" role="alert">
                            <span class="d-block">Вы используете PRO аккаунт</span>
                            <span class="d-block text-info">Подписка действует до:
                                <?php if ($this->session->has_userdata('EndSubscription'))
                                    echo $this->session->userdata('EndSubscription');
                                ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->


    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->

        <div class="row subscription">
            <div class="col-12">
                <form action="subscription/preparationForPayment" method="POST" data-form="payment">
                    <h5>Выберите способ оплаты:</h5>
                    <ul class="payment-menu bg-white p-3">
                        <p class="text-muted">Стоимость недельной подписки 299 руб.</p>
                        <li>
                            <img src="/public/assets/images/payment-icons/qiwi_icon.png" alt="qiwi_icon">
                            <label class="title_payment" for="qiwi_payment">Qiwi</label>
                            <input type="radio" name="payment_method" value="qiwi_payment" id="qiwi_payment" checked>
                        </li>
<!--                        <li>-->
<!--                            <img src="/public/assets/images/payment-icons/yandex_icon.png" alt="yandex_icon">-->
<!--                            <label class="title_payment" for="yandex_payment">Яндекс.Деньги</label>-->
<!--                            <input type="radio" name="payment_method" value="yandex_payment" id="yandex_payment">-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <img src="/public/assets/images/payment-icons/card_icon.png" alt="card_icon">-->
<!--                            <label class="title_payment" for="card_payment">Карта</label>-->
<!--                            <input type="radio" name="payment_method" value="card_payment" id="card_payment">-->
<!--                        </li>-->
                        <button type="submit" class="btn btn-primary">Оплатить</button>
                    </ul>
                </form>
            </div>
        </div>

        <style>
            form[data-form=payment] input[type=radio] {
                cursor: pointer;
            }

            .subscription {
                display: none;
            }

            label.title_payment {
                cursor: pointer;
            }

            ul.payment-menu {
                list-style: none;
            }

            ul.payment-menu li {
                display: inline-block;
                margin-right: 50px;
            }
        </style>

        <div class="row">
            <!-- column -->
            <div class="col-12">


                <h4>Добавьте бота в телеграм: <b style="color: #2d76a0">@CandyCarBot</b></h4>
                <hr>

                <div class="card">
                    <div class="card-body">

                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Активные подписки</h4>
                                <?php if ($this->session->userdata('UserBalance') <= 0): ?>
                                    <h5 class="card-subtitle">На Вашем аккаунте доступно подписок: 1</h5>
                                    <div class="alert alert-warning" role="alert">
                                        Вам необходимо приобрести PRO аккаунт
                                    </div>
                                <?php else: ?>
                                    <h5 class="card-subtitle">На Вашем аккаунте осталось доступных подписок: безлимит</h5>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- title -->
                    </div>

                    <style>

                        .toast {
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                        }
                    </style>

                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
                        <div class="toast-header">
                            <!--                            <img src="..." class="rounded mr-2" alt="...">-->
                            <strong class="mr-auto text-danger">Ошибка</strong>
                            <!--                            <small class="text-muted">11 mins ago</small>-->
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Вы превысили лимит отслеживаемых задач
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table v-middle">
                            <thead>
                            <tr class="bg-light">
                                <th class="border-top-0">Ключевые слова</th>
                                <th class="border-top-0">Цена от</th>
                                <th class="border-top-0">Цена до</th>
                                <th class="border-top-0">Год</th>
                                <th class="border-top-0">Давность объявления (мин)</th>
                                <th class="border-top-0">Область(город)</th>
                                <th class="border-top-0">Статус</th>
                                <th class="border-top-0">Управление</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($Tasks as $item) { ?>
                                <tr>
                                    <td taskId="<?php echo $item->_id ?>">
                                        <div class="d-flex align-items-center">
                                            <h4 class="m-b-0 font-14"><?php echo $item->keyWords ?></h4>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $item->priceFrom ?>
                                    </td>
                                    <td>
                                        <?php echo $item->priceTo ?>
                                    </td>

<!--                                    Года -->

                                    <td>
                                        <?php echo "$item->year_from - $item->year_to"; ?>
                                    </td>

<!--                                    Время жизни объявления -->

                                    <td>
                                        <?php echo $item->pubTime ?>
                                    </td>
                                    <td>
                                        <?php

                                            if (isset($item->region_name) && !empty($item->region_name)) {
                                                if (is_array($item->region_name)) {
                                                    foreach ($item->region_name as $region_name) {

                                                        if ($region_name != end($item->region_name)) {
                                                            echo $region_name . ', ';
                                                        } else {
                                                            echo $region_name;
                                                        }
                                                    }
                                                } else {
                                                    echo $item->region_name;
                                                }
                                            } else {
                                                echo 'Регион не выбран';
                                            }

                                        ?>
                                    </td>
                                    <?php if ($item->status == false) { ?>
                                        <td><label style="cursor: pointer"
                                                   onclick="statusTaskChange('<?php echo $item->_id ?>')"
                                                   class="label label-danger">Неактивно</label></td>
                                    <?php } else { ?>
                                        <td><label style="cursor: pointer"
                                                   onclick="statusTaskChange('<?php echo $item->_id ?>')"
                                                   class="label label-success">Aктивно</label></td>
                                    <?php } ?>
                                    <td>

                                        <div class="roundButton"
                                             onclick="editTaskModal(
                                                     {
                                                         id : '<?php echo $item->_id; ?>',
                                                         mark_auto :'<?php echo $item->mark_auto; ?>',
                                                         model_auto : '<?php echo $item->model_auto; ?>',
                                                         year_from : '<?php echo $item->year_from; ?>',
                                                         year_to : '<?php echo $item->year_to; ?>',
                                                         priceFrom : '<?php echo $item->priceFrom; ?>',
                                                         priceTo : '<?php echo $item->priceTo; ?>',
                                                         region_name :  '<?php echo implode(',', $item->region_name); ?>' ,
                                                         region_id : '<?php echo implode(',', $item->region_id); ?>',
                                                         //city_name : '<?php //echo $item->city_name; ?>//',
                                                         //city_id : '<?php //echo $item->city_id; ?>//',
                                                     })">
                                            <i class="far fa-edit"></i></div>
                                        <div class="roundButton" style="margin-top: 1px;"
                                             onclick="removeTask('<?php echo $item->_id ?>')">
                                            <i class="far fa-window-close"></i>
                                        </div>
                                        <style>
                                            .roundButton {
                                                cursor: pointer;
                                                display: inline-block;
                                                vertical-align: middle;
                                            }
                                        </style>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
