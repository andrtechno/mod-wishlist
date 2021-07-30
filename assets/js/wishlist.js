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

        xhr_wish = $.ajax({
            url: that.data('url'),
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('.countWishList').html(data.count ? data.count : '');
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

                } else {
                    common.notify(data.message, 'error');
                }
            }
        });
    });
});
