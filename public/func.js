function tryReg() {

    $.ajax({
        type: "POST",
        url: "/ajax/registration",
        data: $("#regr form").serialize(),
        success: function (result) {
console.log(result);
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
    $.ajax({
        type: "POST",
        url: "/ajax/addTask",
        data: $("#addTaskId form").serialize(),
        success: function (result) {
            location.reload()
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
        url: "/ajax/editTask",
        data: $("#editTaskId form").serialize(),
        success: function (result) {
            location.reload()
        }
    });
}

function statusTaskChange(id) {
    $.ajax({
        type: "POST",
        url: "/ajax/updateTask",
        data: "id=" + id,
        success: function (result) {
            console.log(result);
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
        url: "/ajax/removeTask",
        data: "id=" + id,
        success: function (result) {
             location.reload()
        }
    });
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