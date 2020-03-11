var $popupOverlay = renderPopupOverlay();
$('body').append($popupOverlay);

$(document).on('click', '.js-transfer-money-button', function () {

    var userId = parseInt($(this).data('user-id'));
    var $popup = renderTransferMoneyPopup();
    $('body').append($popup);

    $popup.show();
    $popupOverlay.show();

    $popup.find('button').click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        var $amountInput = $popup.find('input[name=amount]');

        $.ajax({
            url: '?r=site/transfer-money',
            type: "POST",
            data: {
                user_id: userId,
                amount: $amountInput.val()
            },
            dataType: 'json',
            success: function (response) {
                closePopup($popup);

                if (response.status === 'ok') {
                    alert('success');
                    window.location.reload();
                } else {
                    alert(response.data);
                }
            },
            error: function (response) {
                closePopup($popup);
                alert('error');
            }
        });
    });

    $popupOverlay.click(function() {
        closePopup($popup);
    });
});

function closePopup($popup)
{
    $popup.remove();
    $popupOverlay.hide();
}

function renderPopupOverlay()
{
    return $('<div class="popup-overlay"></div>');
}

function renderTransferMoneyPopup()
{
    return $('<div class="js-transfer-money-popup transfer-money-popup popover">\n' +
        '    <div class="popover-title"></div>\n' +
        '    <div class="popover-content">\n' +
        '        <form href="#">\n' +
        '            <label>Amount<input name="amount" type="number" required></label>\n' +
        '            <button>Send</button>\n' +
        '        </form>\n' +
        '    </div>\n' +
        '</div>');
}