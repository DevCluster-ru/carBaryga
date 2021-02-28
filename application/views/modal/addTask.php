<div id="addTaskId" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Создание новой подписки</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-material" id="form_task">
                    <div class="form-group">
                        <label class="col-md-12">Марка автомобиля</label>
                        <div class="col-md-12">
                            <div class="select-group-marks-1">
                                <select onchange="loadModels($(this).val(), 1);" class="form-control form-control-line" name="mark_auto"
                                        id="mark-auto-1" required">
                                    <option selected value="Выберите марку">Выберите марку</option>
                                    <?php foreach ($marks as $mark => $models_array): ?>
                                        <option value="<?php echo $mark; ?>"><?php echo $mark; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="clearfix" style="height: 1px"></div>
                            <div class="select-group-models-1"></div>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Диапазон цены</label>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" placeholder="Цена ОТ"
                                           class="form-control form-control-line only-number" name="priceFrom"
                                           id="priceFrom" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Цена ДО"
                                           class="form-control form-control-line only-number" name="priceTo"
                                           id="priceTo" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12">Года автомобиля</label>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                        /* Устанвливаем диапозон годов автомобилей */
                                        $year_array = range(1950,2021);
                                    ?>
                                    <select class="form-control form-control-line" name="year_from"
                                            id="year_from" required>
                                        <?php foreach ($year_array as $year): ?>
                                        <?php $selected = $year == 2000 ? 'selected' : ''; ?>
                                              <option <?php echo $selected; ?> value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control form-control-line" name="year_to"
                                            id="year_to" required>
                                        <?php foreach ($year_array as $year): ?>
                                            <?php $selected = $year == 2005 ? 'selected' : ''; ?>
                                            <option <?php echo $selected; ?> value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
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
                                <input type="checkbox" class="form-check-input" id="all_regions-1" name="all_regions">
                                <label class="form-check-label mb-2" for="all_regions">Вся Россия</label>
                            </div>

                            <div class="form-check block-some-regions">
                                <input type="checkbox" class="form-check-input" id="some_regions-1" name="some_regions">
                                <label class="form-check-label mb-2" for="some_regions">Выбрать несколько регионов</label>
                            </div>
                        <?php endif; ?>

                        <div class="col-md-12">

                            <div class="select-group-region-1">
                                <select class="form-control p-1 mb-2" name="region_id[]" id="region-1">
                                    <?php
                                        // заполняем список областей

                                        foreach ($cities as $key => $info_region)
                                        {
                                            echo '<option value="' . $info_region->region_id . '">' . $info_region->region_name . '</option>';
                                        }

                                    ?>
                                </select>
                            </div>
                            <div class="clearfix" style="height: 1px"></div>
                            <div class="select-group-city-1"></div>

                        </div>

                        <script>
                            $('#region-1').chosen({
                                width: "100%",
                                placeholder_text_single: "Выберите регион",
                            });
                        </script>

                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button onclick="addTask()" type="button" class="btn btn-primary">Сохранить задачу</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>