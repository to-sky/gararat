<script>
        // Preloader
        window.addEventListener('load', function load() {
            const loader = document.getElementById('loader');
            setTimeout(function() {
                loader.classList.add('fadeOut');
                $('body').show();
            }, 300);
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