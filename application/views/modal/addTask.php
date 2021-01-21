<div id="addTaskId" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Создание новой задачи</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-material">
                    <div class="form-group">
                        <label class="col-md-12">Ключевые слова, через запятую</label>
                        <div class="col-md-12">
                            <input name="keyWords" type="text" placeholder=""
                                   class="form-control form-control-line" id="keyWords" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Диапазон цены</label>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" placeholder="Цена ОТ"
                                           class="form-control form-control-line" name="priceFrom"
                                           id="priceFrom" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Цена ДО"
                                           class="form-control form-control-line" name="priceTo"
                                           id="priceTo" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Публикации не старше (время в минутах)</label>
                        <div class="col-md-12">
                            <input type="text" value="1" id="pubTime" name="pubTime"
                                   class="form-control form-control-line" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12">Выберите регион или город для отслеживания</label>
                        <div class="col-md-12">

                            <div class="select-group-region d-inline m-b-5" >
                                <select class="form-control p-1" name="region_id" id="region" onchange="loadCity($(this));">
                                    <option selected value="" disabled="disabled">Выберите область</option>
                                    <?php
                                    // заполняем список областей
                                    foreach ($cities as $array_region => $value_region)
                                    {
                                        echo '<option value="' . $array_region . '">' . $value_region['region_name'] . '</option>' . "\n";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="clearfix" style="height: 1px"></div>
                            <div class="select-group-city d-inline"></div>

                        </div>
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