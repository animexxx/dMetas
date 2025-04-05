(function ($) {
    var frameM;
    $(document).ready(function () {
        //Sortable
        $('.gallery_box').sortable({
            items: '.gal_ele',
            forcePlaceholderSize: true,
            dropOnEmpty: true,
            placeholder: 'sortable-placeholder',
            update: function () {
                var gallery_box = $(this);
                var ids = [];
                gallery_box.find('.gal_ele').each(function (i, e) {
                    ids.push($(e).data('id'));
                });
                gallery_box.parent().find('.upload_m_image').val(ids.join(','));
            }
        });
        $('.gallery_box').disableSelection();

        $('body').on('click', 'button.del', function (e) {
            var gal_ele = $(this).parent();
            var id = gal_ele.data('id');
            var hidden_val = gal_ele.parents('.dMetas_box').find('.upload_m_image');
            var array = hidden_val.val().split(",").map(Number);
            array = array.filter(item => item != id);
            hidden_val.val(array.join(','));
            gal_ele.remove();
            return false;
        });


        $('.upload_m_image_button').on('click', function () {
            //define var
            var metaBox = $(this).parent();
            var hidden_input = metaBox.find('.upload_m_image');
            var gallery_box = metaBox.find('.gallery_box');

            // Create a new media frame
            frameM = wp.media({
                title: 'Gallery',
                button: {
                    text: 'Select'
                },
                multiple: 'add'
            });

            frameM.on('open', function () {
                var selection = frameM.state().get('selection');
                ids = hidden_input.val().split(',');
                ids.forEach(function (id) {
                    attachment = wp.media.attachment(id);
                    attachment.fetch();
                    selection.add(attachment ? [attachment] : []);
                });


            });

            // modify DOM
            frameM.on('content:activate:browse', function () {

                render_collection(frameM);

                frameM.content.get().collection.on('reset add', function () {

                    render_collection(frameM);

                });

            });

            frameM.on('select', function () {
                var attachment = frameM.state().get('selection').toJSON();

                attachment.forEach(function (i) {
                    if (i.id != '' && i.id != null) {
                        if (gallery_box.find('.gal_ele[data-id=' + i.id + ']').length < 1) {
                            gallery_box.append('<div class="gal_ele" data-id="' + i.id + '"><img src="' + i.url + '"/><button class="del">X</button></div>');
                            var hvl = hidden_input.val();
                            hidden_input.val(hvl + ',' + i.id);
                        }
                    }

                });

            });

            // Open the modal.
            frameM.open();
        });
    });

    function render_collection(frame) {
        // Note: Need to find a differen 'on' event. Now that attachments load custom fields, this function can't rely on a timeout. Instead, hook into a render function foreach item
        // set timeout for 0, then it will always run last after the add event
        setTimeout(function () {
            // vars
            var $content = frame.content.get().$el;
            collection = frame.content.get().collection || null;

            if (collection) {
                var i = -1;

                collection.each(function (item) {
                    i++;
                    var $li = $content.find('.attachments > .attachment:eq(' + i + ')');
                    // if image is already inside the gallery, disable it!
                    var attachment = frame.state().get('selection').toJSON();
                    attachment.forEach(function (i) {
                        if (item.id == i.id) {
                            item.off('selection:single');
                            $li.addClass('dMetas-selected');
                        }
                    });

                });
            }
        }, 10);
    }
})(jQuery);