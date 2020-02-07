<script>
    // Added summernote WYSIWYG
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript', 'fontsize', 'color', 'forecolor', 'backcolor']],
            ['para', ['style', 'ul', 'ol', 'paragraph', 'height']],
            ['insert', ['link', 'table', 'picture', 'video', 'hr']],
            ['misc', ['fullscreen', 'undo', 'redo', 'help']]
        ]
    });

    // Set bootstrap theme for Select2 and added select2 to class
    $.fn.select2.defaults.set( "theme", "bootstrap" );

    $('.select2-element').select2({
        width: '100%'
    });
</script>