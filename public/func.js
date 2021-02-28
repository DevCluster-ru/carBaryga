function tryReg() {

    $.ajax({
        type: "POST",
        url: "/ajax/registration",
        data: $("#regr form").serialize(),
        success: function (result) {

            let obj_error = false;
            if (result.length != 0) {
                obj_error = JSON.parse(result);
            }

            if (obj_error == false) {
                location.reload();
            } else {
                /* Иначе выводим ошибки в модалке */

                $('#errors').empty();

                $.each(obj_error, function (name_input, error) {
                    name_input = name_input[0].toUpperCase() + name_input.slice(1);

                    if (Array.isArray(error)) {
                        $.each(error, function (key, text_error) {
                            text_error = text_error[0].toUpperCase() + text_error.slice(1);

                            $('#errors').append(`<p class="error-item">${name_input} : ${text_error}<br></p>`);
                        });
                    } else
                        $('#errors').append(`<p class="error-item">${name_input} : ${error}</p>`);
                });

                $('#errors_validate').modal('show');
            }
        }
    });
}

function tryAuth() {

    $.ajax({
        type: "POST",
        url: "/ajax/auth",
        data: $("#auth form").serialize(),
        success: function (result) {

            if (result) {
                location.reload();
            } else {
                $('#errors').empty();
                $('#errors').html('<p class="error-item">Не верный логин или пароль</p>');
                $('#errors_validate').modal('show');
            }
        }
    });
}

function addTask() {
    // let region_name = "";
    let region_name = new Array();
    let region_id = "";
        options = $('select[id=region-1] option:selected');

    $.each(options, function (key, value) {

        region_name.push(value.innerText);

    });

    let city_name = $('select[id=city-1]').find('option:selected').text();

    let datas_form = $("#addTaskId form").serialize();

    $.ajax({
        type: "POST",
        url: "/ajax/task/addTask",
        data: {
            data: datas_form + '&' + region_id,
            region_name: region_name,
            city_name: city_name,
        },
        success: function (result) {

            if (result != '') {

                let obj_error = JSON.parse(result);

                $('#errors').empty();

                $.each(obj_error, function (name_input, error) {
                    name_input = name_input[0].toUpperCase() + name_input.slice(1);

                    if (Array.isArray(error)) {
                        $.each(error, function (key, text_error) {
                            text_error = text_error[0].toUpperCase() + text_error.slice(1);

                            $('#errors').append(`<p class="error-item">${name_input} : ${text_error}<br></p>`);
                        });
                    } else
                        $('#errors').append(`<p class="error-item">${name_input} : ${error}</p>`);
                });

                $('#errors_validate').modal('show');

            } else {
                location.reload();
            }
        }
    });
}

/**
 * @param object obj_params id,mark_auto,model_auto,year_from,year_to,priceFrom,priceTo
 */
function editTaskModal(obj_params) {

    let regions_name = '';
    let regions_id   = '';

    if (obj_params['region_id'].indexOf(',')) {
        regions_name = obj_params['region_name'].split(',');
        regions_id   = obj_params['region_id'].split(',');
    } else {
        regions_name = obj_params['region_name'];
        regions_id   = obj_params['region_id'];
    }

    $.ajax({
        type: 'post',
        url: '/start/returnCitiesAjax',
        async: false,
        success: function (list_regions) {

            let regions = JSON.parse(list_regions);

            if (regions_id.length > 1) {
                $('#region-2').attr('multiple', 'true');
            }

            regions.forEach(function (value, key) {

                $('#region-2').append('<option value="' + value.region_id + '">' + value.region_name + '</option>');

                if ($.inArray(value.region_id, regions_id) != -1) {
                    $(`#region-2 option[value="${value.regions_id}"]`).prop('selected', true);
                }
            });

        }, error: function (err) {
            console.log(err)
        }
    });

    regions_name.forEach(function (value, key) {

        $(`#region-2 option[value="${regions_id[key]}"]`).prop('selected', true);
    });

    $('#region-2').chosen({
        width: "100%"
    });

    loadModels(obj_params, 2);

    $("[name=id]").val(obj_params['id']);
    $(`[id=mark-auto-2] option[value="${obj_params['mark_auto']}"]`).prop('selected', true);
    $(`[id=year-from-2] option[value="${obj_params['year_from']}"]`).prop('selected', true);
    $(`[id=year-to-2] option[value="${obj_params['year_to']}"]`).prop('selected', true);
    $("[id=price-from-2]").val(obj_params['priceFrom']);
    $("[id=price-to-2]").val(obj_params['priceTo']);

    $('#editTaskId').modal('show');

}

function editTask() {
    // let region_name = $('select[id=region-2]').find('option:selected').text();
    // let city_name = $('select[id=city-2]').find('option:selected').text();
    let id = $("[name=id]").val();
    let datas_form = $("#form-edit-task").serialize();

    let region_name = new Array();
        options = $('select[id=region-2] option:selected');

    $.each(options, function (key, value) {

        region_name.push(value.innerText);

    });

    let city_name = $('select[id=city-1]').find('option:selected').text();

    $.ajax({
        type: "POST",
        url: "/ajax/task/editTask",
        data: {
            data: datas_form,
            region_name: region_name,
            city_name: city_name,
        },
        success: function (result) {
            console.log(result);
            location.reload()
        }
    });
}

function statusTaskChange(id) {

    $.ajax({
        type: "POST",
        url: "/ajax/task/updateStatusTask",
        data: {task_id: id},
        success: function (result) {
            location.reload();
        }, error: function (error) {
            console.log(error);
        }
    });
}

function removeTask(id) {

    if (confirm("Вы действительно хотите удалить задачу?")) {

        $.ajax({
            type: "POST",
            url: "/ajax/task/removeTask",
            data: "id=" + id,
            success: function (result) {
                location.reload()
            }
        });

    }
}

function issetAccount() {
    $('#regr').modal('hide');
    $('#auth').modal('show');
}

function notIssetAccount() {
    $('#auth').modal('hide');
    $('#regr').modal('show');
}

function modalRecovery() {
    $('#auth').modal('hide');
    $('#recovery_password').modal('show');
}

function modalProfileSettings() {
    $('#profile_settings').modal('show');
}

function modalBalance() {
    $('#topbar-balance').modal('show');
}

function editProfile() {
    $.ajax({
        type: "POST",
        url: "/ajax/auth/editProfile",
        data: $("#editProfileForm").serialize(),
        success: function (result) {
            console.log(result);
            if (typeof result != 'undefined' && result != '') {
                let obj_error = JSON.parse(result);

                $('#errors').empty();

                $.each(obj_error, function (name_input, error) {
                    name_input = name_input[0].toUpperCase() + name_input.slice(1);

                    if (Array.isArray(error)) {
                        $.each(error, function (key, text_error) {
                            text_error = text_error[0].toUpperCase() + text_error.slice(1);

                            $('#errors').append(`<p class="error-item">${name_input} : ${text_error}<br></p>`);
                        });
                    } else
                        $('#errors').append(`<p class="error-item">${name_input} : ${error}</p>`);
                });

                $('#errors_validate').css('z-index', '1051');
                $('#errors_validate').modal('show');

            } else {
                $('#profile_settings').modal('hide');
                document.location.reload();
            }
        }
    });
}

function recoveryPass() {

    /* Клик по кнопке "Отправить" (забытый пароль) */

    $.ajax({
        type: "POST",
        url: "/recovery/sendRecoveredPass",
        data: $("#recovery_password form").serialize(),
        success: function (result) {
            // console.log(result);
            let data = JSON.parse(result);
            if (typeof data.error !== 'undefined') {
                // если есть ошибки валидации
                $('#send-status').html('<p class="error-status">' + data.error + '</p>');

            } else {
                $('.success-status').html('<p class="success-status">' + data.message + '</p>');
                $('#recovery_password').modal('hide');
                $('#recovery_success').modal('show');
            }
        }
    });
}

$(document).ready(function () {

    //$('#region-1').trigger("chosen:updated");

    $('input[id=telegram]').on('focus', function () {
        if ($(this).val() == '') {
            $(this).val('@');
        }
    });

    $('input[id=telegram]').on('blur', function () {
        if ($(this).val() == '@') {
            $(this).val('');
        }
    });

    $('#subscription').click(function () {

        if ($('.subscription').css('display') !== 'none') {
            $('.subscription').css('display', 'none');
        } else {
            $('.subscription').css('display', 'block');
        }
    });

    $('#all_regions-1').click(function () {
        if ($(this).prop('checked') == true) {
            $('#region_1_chosen').css('display', 'none');
            $('#region-1').val('');
            $('#city-1').remove();
            $('.block-some-regions').css('display', 'none');
        } else {
            $('#region_1_chosen').css('display', 'block');
            $('.block-some-regions').css('display', 'block');
        }
    });

    $('#all_regions-2').click(function () {
        if ($(this).prop('checked') == true) {
            $('#region_2_chosen').css('display', 'none');
            $('#region-2').val('');
            $('#city-2').remove();
            $('.block-some-regions').css('display', 'none');

        } else {
            $('#region_2_chosen').css('display', 'block');
            $('.block-some-regions').css('display', 'block');

        }
    });


    $('#some_regions-1').click(function () {
        if ($(this).prop('checked') == true) {

            $('.block-all-regions').css('display', 'none');
            $('#city-1').css('display', 'none');
            $('#city-1').remove();
            //$('#region-1').addClass('chosen-region-1');
            $('#region-1').chosen('destroy');
            $('#region-1').attr('multiple', 'true');
            $('#region-1').chosen();
        }

        if ($(this).prop('checked') == false) {
            $('.block-all-regions').css('display', 'block');
            $('#region-1').chosen('destroy');
            $('#region-1').removeAttr('multiple');
            $('#region-1').chosen();
        }

        $('#region-1').trigger("chosen:updated");

        //$(".chosen-region-1").chosen();

    });

    $('#some_regions-2').click(function () {
        if ($(this).prop('checked') == true) {

            $('#city-2').css('display', 'none');
            $('#city-2').remove();
            //$('#region-1').addClass('chosen-region-1');
            $('#region-2').chosen('destroy');
            $('#region-2').attr('multiple', 'true');
            $('#region-2').chosen();
        }

        if ($(this).prop('checked') == false) {
            $('#region-2').chosen('destroy');
            $('#region-2').removeAttr('multiple');
            $('#region-2').chosen();
        }

        $('#region-2').trigger("chosen:updated");

        //$(".chosen-region-1").chosen();

    });

    $('.only-number').keypress(function (e) {

        if (e.keyCode < 47 || e.keyCode > 58) {
            return false;
        }
    });

});

/**
 * @param select_val - значение марки
 * @param group - группа селектов(или в добавлении задания или в редактировании 1 или 2)
 */
function loadModels(select_val, group) {
    // послыаем AJAX запрос, который вернёт список моделей для выбранной марки

    let mark = '';
    if (typeof select_val['mark_auto'] != 'undefined') {
        mark = select_val['mark_auto'];
    } else {
        mark = select_val;
    }
    let checked_model = select_val['model_auto'];

    $.ajax({
        type: 'post',
        url: '/start/getMarksAndModels',
        data: {
            mark_name: mark,
        },
        success: function (models_list) {

            let div_select_group_models = document.querySelector(`.select-group-models-${group}`);
            div_select_group_models.innerHTML = '';

            let modelsSelect = document.createElement('select');
            modelsSelect.setAttribute('name', 'model_auto');
            modelsSelect.setAttribute('id', `model-auto-${group}`);
            modelsSelect.setAttribute('class', 'form-control');

            let option = document.createElement('option');
            option.setAttribute('class', 'option-select-models');
            option.textContent = 'Выберите модель';

            div_select_group_models.append(modelsSelect);

            let select_models = $(`select[id="model-auto-${group}"]`);
            select_models.append(option);

            models_list = JSON.parse(models_list);

            $.each(models_list, function (i) {

                if (models_list[i] === checked_model) {
                    select_models.append('<option value="' + models_list[i] + '" selected>' + models_list[i] + '</option>');
                } else {
                    select_models.append('<option value="' + models_list[i] + '">' + models_list[i] + '</option>');
                }
            });
        }, error: function (err) {
            console.log(err);
        }
    });
}