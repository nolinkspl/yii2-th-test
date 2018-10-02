$(document).ready(function() {
    const $panel = $('.js-panel');
    renderAuthorizationFormIntoElement($panel);


    $($panel). on('click', '.js-authorization-submit', function () {
        const $authForm = $panel.find('.js-authorization-form');
        console.log($authForm.find('[name=username]'));
        let data = {
            username : $authForm.find('[name=username]').val(),
            password : $authForm.find('[name=password]').val()
        };
        $.ajax({
            url     : '../Controller/Auth.php',
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
    });

    function tryAuthorization() {

    }


});

function renderAuthorizationFormIntoElement($panel) {
    const $form = $('<form class="authorization-form js-authorization-form">');
    const $userNameInput = $('<input name="username" placeholder="Username">');
    const $passwordInput = $('<input name="password" placeholder="Password">');
    const $submitButton = $('<div class="authorization-form-submit-button js-authorization-submit">');
    $form.append($userNameInput);
    $form.append($passwordInput);
    $form.append($submitButton);

    $panel.append($form);
}