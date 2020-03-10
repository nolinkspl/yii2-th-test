$(document).on('click', '.js-transfer-money-button', function () {

    var userId = parseInt($(this).data('user-id'));
    var $popup = $('.js-transfer-money-popup');

    $popup.toggle();

    $popup.find('button').click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        var $amountInput = $popup.find('input[name=amount]');

        $.ajax({
            url: 'transfer-money',
            type: "POST",
            data: {
                user_id: userId,
                amount: $amountInput.val()
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'ok') {
                    alert('success');
                } else {
                    console.log(response.data);
                }

                //window.location.reload();
            },
            error: function (response) {
                alert('error');
                //window.location.reload();
            }
        });
    })
});