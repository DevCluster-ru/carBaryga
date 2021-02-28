<div id="editTaskId" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Редактирование подписки</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-material" id="form-edit-task">

                    <input type="hidden" value="0" name="id">

                    <div class="form-group">
                        <label class="col-md-12">Марка автомобиля</label>
                        <div class="col-md-12">
                            <div class="select-group-marks-2">
                                <select onchange="loadModels($(this).val(), 2);" class="form-control form-control-line" id="mark-auto-2" name="mark_auto" required>

                                <option selected value="Выберите марку">Выберите марку</option>
                                <?php foreach ($marks as $mark => $models_array): ?>
                                    <option value="<?php echo $mark; ?>">
                                        <?php echo $mark; ?>
                                    </option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="clearfix" style="height: 1px"></div>
                            <div class="select-group-models-2"></div>
                        </div>
                    </div>

<!--                    <div class="form-group">-->
<!--                        <label class="col-md-12">Марка и модель авто</label>-->
<!--                        <div class="col-md-12">-->
<!--                            <input name="mark_auto" type="text" placeholder=""-->
<!--                                   class="form-control form-control-line" id="keyWords">-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="form-group">
                        <label class="col-md-12">Диапазон цены</label>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <input id="price-from-2" type="text" placeholder="Цена от"
                                           class="form-control form-control-line only-number" name="priceFrom">
                                </div>
                                <div class="col-md-6">
                                    <input id="price-to-2" type="text" placeholder="Цена до"
                                           class="form-control form-control-line only-number" name="priceTo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Года автомобиля</label>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    /* Устанвливаем диапозон годов автомобилей */
                                    $year_array = range(1950,2021);
                                    ?>
                                    <select class="form-control form-control-line" name="year_from"
                                            id="year-from-2" required>
                                        <?php foreach ($year_array as $year): ?>
                                            <?php $selected = $year == 2000 ? 'selected' : ''; ?>
                                            <option <?php echo $selected; ?> value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control form-control-line" name="year_to"
                                            id="year-to-2" required>
                                        <?php foreach ($year_array as $year): ?>
                                            <?php $selected = $year == 2005 ? 'selected' : ''; ?>
                                            <option <?php echo $selected; ?> value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <?php if ($this->session->userdata('UserBalance') <= 0): ?>
                                    <label class="col-md-12">
                                        <p class="text-info">
                                            Вы используете бесплатную подписку:<br>
                                            время давности объявления - 180 мин.
                                        </p>
                                    </label>
                                <?php else: ?>
                                    <label class="col-md-12">
                                        <p class="text-info">
                                            Вы используете платную подписку:<br>
                                            время давности объявления - менее 1 минуты.
                                        </p>
                                    </label>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label class="col-md-12"><strong>Выбор региона для отслеживания</strong></label>

                                    <?php if ($this->session->userdata('UserBalance') > 0): ?>
                                        <div class="form-check block-all-regions">
                                            <input type="checkbox" class="form-check-input" id="all_regions-2" name="all_regions">
                                            <label class="form-check-label mb-2" for="all_regions">Вся Россия</label>
                                        </div>

                                        <div class="form-check block-some-regions">
                                            <input type="checkbox" class="form-check-input" id="some_regions-2" name="some_regions">
                                            <label class="form-check-label mb-2" for="some_regions">Выбрать несколько регионов</label>
                                        </div>
                                    <?php endif; ?>

                                    <div class="col-md-12">

<!--                                        <p class="selected_regions"></p>-->
<!--                                        <p class="selected_city"></p>-->
                                        <div class="clearfix" style="height: 1px"></div>

                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="select-group-region-2">
                                        <select class="form-control p-1 mb-2 chosen" name="region_id[]" id="region-2">

                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button onclick="editTask()" type="button" class="btn btn-primary">Сохранить задачу</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>