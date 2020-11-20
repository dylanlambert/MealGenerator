<script>
    $(function() {
        // Remove button click
        $(document).on(
            'click',
            '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
            function(e) {
                e.preventDefault();
                $(this).closest('.form-inline').remove();
            }
        );
        // Add button click
        $(document).on(
            'click',
            '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
            function(e) {
                e.preventDefault();
                var container = $(this).closest('[data-role="dynamic-fields"]');
                cloned = container.children().filter('.form-inline:first-child').clone();
                ingredientsSelect = cloned.find('.ingredient');
                id = randomString(5);
                options = ingredientsSelect.find('option').clone();
                toadd = "<div class=\"form-inline dynamicField\">" +
                    "<div class=\"form-group\">\n" +
                    "    <label class=\"sr-only\" for=\"field-value\">Ingrédient</label>\n" +
                    "    <select class=\"selectpicker ingredient\" data-live-search=\"true\" name=\"ingredient["+id+"][id]\">\n" +
                    "    </select>\n" +
                    "</div>\n" +
                    "<div class=\"form-group\">\n" +
                    "    <label class=\"sr-only\" for=\"field-value\">Quantitée</label>\n" +
                    "    <input class=\"form-control qty\" type=\"number\" placeholder=\"quantité\" name=\"ingredient["+id+"][qty]\">\n" +
                    "</div>\n" +
                    "<div class=\"form-group\">\n" +
                    "    <label class=\"sr-only\" for=\"field-value\">Unitée</label>\n" +
                    "    <select class=\"form-control type\" name=\"ingredient["+id+"][type]\">\n" +
                    "        <option value=\"unite\"> Unité </option>\n" +
                    "        <option value=\"gramme\"> Gramme </option>\n" +
                    "        <option value=\"millimeter\"> Millilitre </option>\n" +
                    "    </select>\n" +
                    "</div>\n" +
                    "<button class=\"btn btn-danger\" data-role=\"remove\">-</button>\n" +
                    "<button class=\"btn btn-primary\" data-role=\"add\">+</button>" +
                    "</div>";
                container.append(toadd);
                $('select[name="ingredient['+id+'][id]"]').append(options);
                $('select[name="ingredient['+id+'][id]"]').selectpicker('refresh');
            }
        );
    });

    function randomString(length) {
        return Math.round((Math.pow(36, length + 1) - Math.random() * Math.pow(36, length))).toString(36).slice(1);
    }

    tinymce.init({
        selector: '#tiny',
        height: 500,
        menubar: false,
        toolbar: "undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent",
    });
</script>
