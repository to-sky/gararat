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

// Header burger button
$('#burgerIcon').click(function () {
    $('.header-main').toggleClass('header-menu-opened');
});

(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Hide alert popup
$(function() {
    let alert = $('.alert[data-auto-close]');

    alert.each(function() {
        let that = $(this);
        let delay = that.data('auto-close');

        setTimeout(function () {
            that.animate({top: "-100px"}, 1500)
        }, delay);
    });
});

// Change language
$('input[name="language"]').click(function () {
    window.location.href = "/language/" + $(this).val();
});