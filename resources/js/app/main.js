// Input only numbers 1-9
$(document).on('keydown', 'input[type="number"]', function (e) {
    e = (e) ? e : window.event;
    let currentVal = $(this).val();
    let charCode = (e.which) ? e.which : e.keyCode;

    if (charCode > 31 && (charCode < 49 || charCode > 57)) {
        if (currentVal > 0) {
            $(this).val(currentVal);
        } else {
            $(this).val(1);
        }

        return false;
    }

    return true;
});