(function ($) {
    var frame;
    $(document).ready(function () {
        $('.upload_image_button').on('click', function () {

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
                $('.upload_image').val(attachment.url);
                $('.upload_image_img').show();
                $('.upload_image_img').attr('src', attachment.url);
            });

            // Open the modal.
            frame.open();
        });

        $('.remove_image_button').on('click', function () {
            $('.upload_image').val('');
            $('.upload_image_img').hide();
            $('.remove_image_button').hide();
        });
    });
})(jQuery);