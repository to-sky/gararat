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

// Disabling form submissions if there are invalid fields
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