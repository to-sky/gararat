<script>
    // Get collapsed icon
    function getCollapsedIcon(el) {
        let targetId = $(el).attr('id');
        let targetBtn = $('[data-target="#' + targetId + '"]');

        return $(targetBtn).find('i');
    }

    // Collapsed events
    $(document).on('show.bs.collapse', '[data-item-header]', function () {
        getCollapsedIcon($(this)).toggleClass('ti-arrow-circle-down ti-arrow-circle-up');
    }).on('hide.bs.collapse', '[data-item-header]', function() {
        getCollapsedIcon($(this)).toggleClass('ti-arrow-circle-up ti-arrow-circle-down');
    });

    // Add repeater
    $('.repeater').repeater({
        isFirstItemUndeletable: true,
        show: function () {
            $(this).slideDown();

            let currentItemNumber = $('[data-repeater-tabel]').length;
            let tableNewId = `table${currentItemNumber}`;

            let tableCollapseBtn = $('[data-item-collapse]', $(this));
                tableCollapseBtn.attr('data-target', `#${tableNewId}`);

            $('[data-item-header]', $(this)).attr('id', tableNewId);
            $('[data-repeater-table-title]', $(this)).text('Table');
        },
        hide: function (deleteElement) {
            let tableName = $('[data-repeater-table-title]', $(this)).text();
                tableName = tableName.length ? tableName : 'Table';

            $.confirm({
                title: '<p>Delete table</p>',
                content: `Are you sure you want to delete "<b>${tableName}</b>"?`,
                type: 'red',
                icon: 'far fa-frown',
                closeIcon: true,
                theme: 'modern',
                animation: 'scale',
                buttons: {
                    confirm: {
                        text: 'Delete',
                        btnClass: 'btn-outline-danger',
                        action: function() {
                            $(this).slideUp(deleteElement);
                        }
                    },
                    cancel: {
                        btnClass: 'btn-outline-secondary',
                        action: function() {
                            this.close();
                        }
                    }
                }
            });
        },
        repeaters: [{
            selector: '.inputs',
            isFirstItemUndeletable: true
        }]
    });
</script>
