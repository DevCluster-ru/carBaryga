<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Управление подписками</h4>

                <?php if ($this->session->userdata('UserBalance') <= 0): ?>
                    <p class="text-muted">Приобретите ПРО аккаунт и получите все возможности сервиса</p>
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
            <div class="col-7">
                <div class="text-right upgrade-btn">

                    <?php if ($this->session->userdata('UserBalance') <= 0): ?>
                        <button href="#" class="btn btn-danger text-white"
                                target="_blank" id="subscription">Купить на PRO аккаунт
                        </button>
                    <?php else: ?>
                        <div class="alert alert-success d-inline-block" role="alert">
                            Вы используете PRO аккаунт
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
                        <p class="text-muted">Стоимость месячной подписки 299 руб.</p>
                        <li>
                            <img src="/public/assets/images/payment-icons/qiwi_icon.png" alt="qiwi_icon">
                            <label class="title_payment" for="qiwi_payment">Qiwi</label>
                            <input type="radio" name="payment_method" value="qiwi_payment" id="qiwi_payment">
                        </li>
                        <li>
                            <img src="/public/assets/images/payment-icons/yandex_icon.png" alt="yandex_icon">
                            <label class="title_payment" for="yandex_payment">Яндекс.Деньги</label>
                            <input type="radio" name="payment_method" value="yandex_payment" id="yandex_payment">
                        </li>
                        <li>
                            <img src="/public/assets/images/payment-icons/card_icon.png" alt="card_icon">
                            <label class="title_payment" for="card_payment">Карта</label>
                            <input type="radio" name="payment_method" value="card_payment" id="card_payment">
                        </li>
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
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Активные подписки</h4>
                                <?php if ($this->session->userdata('UserBalance') <= 0): ?>
                                    <h5 class="card-subtitle">На Вашем аккаунте доступно подписок: 0</h5>
                                    <div class="alert alert-warning" role="alert">
                                        Вам необходимо приобрести PRO аккаунт
                                    </div>
                                <?php else: ?>
                                    <h5 class="card-subtitle">На Вашем аккаунте доступно подписок: 10</h5>
                                    <div class="alert alert-info" role="alert">
                                        Вы не можете активировать одновременно более 10 задач
                                    </div>
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

                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
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
                                <th class="border-top-0">Время жизни объявления (мин)</th>
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
                                        <?php echo $item->priceTo ?></td>
                                    <td>
                                        <?php echo $item->pubTime ?></td>
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
                                                     '<?php echo $item->_id ?>',
                                                     '<?php echo $item->keyWords ?>',
                                                     '<?php echo $item->priceFrom ?>',
                                                     '<?php echo $item->priceTo ?>',
                                                     '<?php echo $item->pubTime ?>'
                                                     )">
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
