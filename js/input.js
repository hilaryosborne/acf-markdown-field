(function($){

    function initialise_field(el) {

        var editor_el = $(el).find('.editor').get(0);
        var field_el = $(el).find('.preview-pre').get(0);

        new MediumEditor(editor_el, {
            toolbar: {
                buttons: ['bold', 'italic', 'underline', 'anchor', 'h2', 'h3', "unorderedlist"]
            },
            extensions: {
                markdown: new MeMarkdown(function (md) {
                    field_el.textContent = md;
                })
            }
        });
    }

    if (typeof acf.add_action !== 'undefined') {

        acf.add_action('ready append show_field/type=markdown', function( $el ){
            // search $el for fields of type 'markdown'
            acf.get_fields({ type : 'markdown'}, $el).each(function(){
                initialise_field( $(this) );
            });
        });

    } else {

        $(document).live('acf/setup_fields', function(e, postbox){

            $(postbox).find('.field[data-field_type="markdown"]').each(function(){
                initialise_field( $(this) );
            });
        });

    }

})(jQuery);