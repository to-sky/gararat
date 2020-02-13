<script>
        // Preloader
        window.addEventListener('load', function load() {
            const loader = document.getElementById('loader');
            setTimeout(function() {
                loader.classList.add('fadeOut');
                $('body').show();
            }, 300);
        });

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

        // Init select2
        $('.select2-element').select2({
            width: '100%'
        });

        // Modals
        $('#deleteItemModal').on('show.bs.modal', function (e) {
            let target = $(e.relatedTarget);
            let id = target.data('id');

            $('#confirmDeleteForm').attr('action', target.attr('href'));

            let bodyText = target.data('modal-body-text');

            $(this).find('span.modal-body-text').text(bodyText);
        });

        // Show filename into input file input
        $('.custom-file-input').on('change',function(){
            let path = $(this).val();
            let fileName = path.replace(/C:\\fakepath\\/, '');

            $(this).next('.custom-file-label').html(fileName);
        });
</script>