<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Управление подписками</h4>

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
                    <a href="#" class="btn btn-danger text-white"
                       target="_blank">Купить ПРО аккаунт</a>
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
        <div class="row">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Активные подписки</h4>
                                <h5 class="card-subtitle">На Вашем аккаунте доступно подписок: 10</h5>
                            </div>
                        </div>
                        <!-- title -->
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
    .roundButton{
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
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer text-center">
        All Rights Reserved by Xtreme Admin. Designed and Developed by <a
                href="https://www.wrappixel.com">WrapPixel</a>.
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
