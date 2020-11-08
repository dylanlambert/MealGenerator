<script>
    $(function () {
        $(document).on('click', '.btn-add', function (e) {
            e.preventDefault();

            var dynaForm = $('.dynamic-wrap'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone());

            id = randomString(10)
            idSelect1 = 'ingredient[' + id + '][id]';
            idInput = 'ingredient[' + id + '][qty]';
            idSelect2 = 'ingredient[' + id + '][type]';

            newEntry.find('select').first().attr('name', idSelect1);
            newEntry.find('input').attr('name', idInput);
            newEntry.find('select').last().attr('name', idSelect2);

            newEntry.appendTo(dynaForm);

            newEntry.find('input').val('');
            dynaForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<i class="far fa-minus-square"></i>');
        }).on('click', '.btn-remove', function (e) {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });

    function randomString(length) {
        return Math.round((Math.pow(36, length + 1) - Math.random() * Math.pow(36, length))).toString(36).slice(1);
    }
</script>
