$(document).ready(function() {
    const $panel = $('.js-panel');
    renderAuthorizationFormIntoElement($panel);


    $($panel). on('click', '.js-authorization-submit', function () {
        const $authForm = $panel.find('.js-authorization-form');
        let data = {
            action   : 'authorization',
            username : $authForm.find('[name=username]').val(),
            password : $authForm.find('[name=password]').val()
        };
        try {
            checkParams(data);
        } catch (Error) {
            alert('Неправильный ввод');
            return;
        }

        $.ajax({
            url     : '/auth',
            method  : 'post',
            data    : data,
            dataType: 'json',
            error   : function (json) {
            },
            success : function (json) {
                if (json.success) {

                } else {

                }
            }
        });

        function checkParams(data) {
            if ($.isEmptyObject(data['action'])
                || $.isEmptyObject(data['username'])
                || $.isEmptyObject(data['password'])) {
                throw new Error;
            }
        }
    });
});

function renderAuthorizationFormIntoElement($panel) {
    const $form = $('<form class="authorization-form js-authorization-form">');
    const $userNameInput = $('<input name="username" placeholder="Username">');
    const $passwordInput = $('<input name="password" placeholder="Password">');
    const $submitButton = $('<div class="authorization-form-submit-button js-authorization-submit">');
    $form.append($userNameInput);
    $form.append($passwordInput);
    $submitButton.append(document.createTextNode('Войти'));
    $form.append($submitButton);

    $panel.append($form);
}