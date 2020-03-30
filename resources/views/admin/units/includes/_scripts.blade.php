<script>
    // Define dataTable on modal
    let table;
    let selectedClasses = 'selected bgc-blue-100';
    let partsCountElement = $('#partsCount');
    let partsCount = partsCountElement.data('parts-count');
    let partsTable = $('#partsContent');
    let inputPartIdName = 'input[name$="[part_id]"]';
    let inputQtyName = 'input[name$="[qty]"]';

    // Add parts modal
    $('[data-action="add-part"]').click(function () {
        $.confirm({
            title: 'Parts',
            type: 'dark',
            typeAnimated: true,
            columnClass: 'col-md-8',
            theme: 'modern',
            content: function () {
                let self = this;
                let selectedParts = partsTable.find(inputPartIdName);
                let excludedPartIds = $.map(selectedParts, function(el) {
                    return $(el).val();
                });

                // Get table with parts
                return $.get({
                    type: 'PUT',
                    url: '{{ route('admin.units.get-parts') }}',
                    data: {
                        excludePartIds: excludedPartIds
                    }
                }).fail(function(){
                    self.setContent('Something went wrong.');
                });
            },
            contentLoaded: function(data){
                this.setContentAppend(data);
            },
            onContentReady: function () {
                table = $('#partsDataTable').DataTable({
                    select: true
                });

                $('#partsDataTable tbody').on( 'click', 'tr', function () {
                    $(this).toggleClass(selectedClasses);
                }).on( 'click', 'tr td input', function (e) {
                    e.stopPropagation();
                });
            },
            buttons: {
                ok: {
                    text: 'Add parts',
                    btnClass: 'btn-outline-success',
                    action: function () {
                        let tableRows = table.rows('.selected');
                        let selectedRows = tableRows.nodes();
                        let addedRowsCount = tableRows.data().length;

                        partsCount = partsCount + addedRowsCount;
                        updatePartsCount(partsCount);

                        // Show "Actions buttons", remove ".selected" class and append to page
                        $.each(selectedRows, function(i, el) {
                            $(el).find('[data-row="actions"]').removeClass('d-n');
                            $(el).removeClass(selectedClasses);
                            $(el).appendTo('tbody', partsTable);
                        });
                    }
                },
                cancel: {
                    btnClass: 'btn-outline-secondary',
                    action: function () {
                        this.close();
                    }
                },
            },
        });
    });

    $("body").on('DOMSubtreeModified', partsTable, function() {
        updatePartInputIndexed();
    });

    // Update index on parts inputs
    function updatePartInputIndexed() {
        partsTable.find('tr').each(function(i, el) {
            $(el).find(inputQtyName, el).attr('name', `parts[${i}][qty]`);
            $(el).find(inputPartIdName, el).attr('name', `parts[${i}][part_id]`);
        });
    }

    // Update count of parts on card header
    function updatePartsCount(count) {
        partsCountElement.data('parts-count', count);
        partsCountElement.text(count);
    }

    // Remove part row
    $(document).on('click', '.delete-part', function () {
        $(this).closest('tr').remove();

        partsCount--;
        updatePartsCount(partsCount);
    });
</script>