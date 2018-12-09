(function ($) {
    var frame;
    $(document).ready(function () {
        $('.upload_image_button').on('click', function () {
            var hidden_input = $(this).parent().find('.upload_image');
            var img_up = $(this).parent().find('.upload_image_img');
            // If the media frame already exists, reopen it.
            if (frame) {
                frame.open();
                return;
            }

            // Create a new media frame
            frame = wp.media({
                title: 'Select or Upload Media Of Your Chosen Persuasion',
                button: {
                    text: 'Use this media'
                },
                multiple: true  // Set to true to allow multiple files to be selected
            });

            // Fires when a user has selected attachment(s) and clicked the select button.
            // @see media.view.MediaFrame.Post.mainInsertToolbar()
            frame.on('select', function () {
                var attachment = frame.state().get('selection').first().toJSON();
                hidden_input.val(attachment.url);
                img_up.show();
                img_up.attr('src', attachment.url);
            });

            // Open the modal.
            frame.open();
        });

        $('.remove_image_button').on('click', function () {
            var hidden_input = $(this).parent().find('.upload_image');
            var img_up = $(this).parent().find('.upload_image_img');
            hidden_input.val('');
            img_up.hide();
            $(this).hide();
        });
    });
})(jQuery);