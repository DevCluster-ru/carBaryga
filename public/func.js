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

    let region_name = $('select[name=region_id]').find('option:selected').text();
    let city_name = $('select[name=city_id]').find('option:selected').text();

    let datas_form = $("#addTaskId form").serialize();

    $.ajax({
        type: "POST",
        url: "/ajax/task/addTask",
        data: {
            data : datas_form,
            region_name : region_name,
            city_name : city_name,
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

function editTaskModal(id,keyWords,priceFrom,priceTo,pubTime ) {

    $("[name=id]").val(id);
    $("[name=keyWords]").val(keyWords);
    $("[name=priceFrom]").val(priceFrom);
    $("[name=priceTo]").val(priceTo);
    $("[name=pubTime]").val(pubTime);
    $('#editTaskId').modal('show');

}

function editTask()
{
    $.ajax({
        type: "POST",
        url: "/ajax/task/editTask",
        data: $("#editTaskId form").serialize(),
        success: function (result) {
            location.reload()
        }
    });
}

function statusTaskChange(id) {
    $.ajax({
        type: "POST",
        url: "/ajax/task/updateStatusTask",
        data: "id=" + id,
        success: function (result) {

            if (typeof result !== 'undefined' && result != '') {
                let error = JSON.parse(result);
                $('.toast').toast('show');
            } else {
                location.reload()
            }
        }
    });
}

function removeTask(id) {
    $.ajax({
        type: "POST",
        url: "/ajax/task/removeTask",
        data: "id=" + id,
        success: function (result) {
             location.reload()
        }
    });
}

function issetAccount()
{
    $('#regr').modal('hide');
    $('#auth').modal('show');
}
function notIssetAccount()
{
    $('#auth').modal('hide');
    $('#regr').modal('show');
}

function modalRecovery()
{
    $('#auth').modal('hide');
    $('#recovery_password').modal('show');
}

function modalProfileSettings()
{
    $('#profile_settings').modal('show');
}

function modalBalance()
{
    $('#topbar-balance').modal('show');
}

function editProfile()
{
    $.ajax({
        type: "POST",
        url: "/ajax/auth/editProfile",
        data: $("#editProfileForm").serialize(),
        success: function (result) {

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

            }
            $('#profile_settings').modal('hide');
            document.location.reload();
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

$(document).ready(function (){
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
});

function loadCity(select)
{
    // послыаем AJAX запрос, который вернёт список городов для выбранной области

    let region_id =  select.val();

    // console.log(region_id);
    $.ajax({
        dataType: "json",
        type: 'get',
        url: '/start/getCities',
        data: {
            region_id : region_id,
        },
        success: function (city_list) {

            let div_select_group_city = document.querySelector('.select-group-city');
                div_select_group_city.innerHTML = '';

            let citySelect = document.createElement('select');
                citySelect.setAttribute('name', 'city_id');
            citySelect.setAttribute('class', 'form-control p-1');

            let option = document.createElement('option');
                option.setAttribute('class', 'option-select-city');
                option.textContent = 'Выберите город';

                div_select_group_city.append(citySelect);

            let select_city = $('select[name=city_id]');
                select_city.append(option);

            $.each(city_list, function(i){
                select_city.append('<option value="' + i + '">' + this + '</option>');
            });
        }, error: function (err) {
            console.log(err);
        }
    });
}