$(function () {
    var xhr_wish; //:not(.added)
    $(document).on('click', '.btn-wishlist, .wishlist-remove', function (e) { // touchstart
        e.preventDefault();
        var that = $(this);
        var id = $(this).data('id');

        if (xhr_wish && xhr_wish.readyState !== 4) {
            xhr_wish.onreadystatechange = null;
            //xhr.abort();
        }
        var url;
        if (that.data('url')) {
            url = that.data('url');
        } else if (that.attr('href')) {
            url = that.attr('href');
        }
        xhr_wish = $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('.wishlist-count').html(data.count ? data.count : '');
                    common.notify(data.message, 'success');
                    if (data.action === 'remove') {
                        $('#wishlist-item-' + data.id).remove();
                        that.html(that.data('text-add'));
                    } else {
                        that.html(that.data('text-remove'));
                    }

                    that.toggleClass('added');
                    if (data.title)
                        that.attr('title', data.title);
                    if (data.url)
                        that.data('url', data.url);
                    $(document).trigger( "wishlist:success", data);
                } else {
                    common.notify(data.message, 'error');
                }
            }
        });
    });
});
