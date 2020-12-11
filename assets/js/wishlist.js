$(function () {
    var xhr; //:not(.added)
    $(document).on('click', '.btn-wishlist, .wishlist-remove', function (e) { // touchstart
        e.preventDefault();
        var that = $(this);
        var id = $(this).data('id');

        if (xhr && xhr.readyState !== 4) {
            xhr.onreadystatechange = null;
            //xhr.abort();
        }

        xhr = $.ajax({
            url: that.attr('href'),
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('.countWishList').html(data.count);
                    common.notify(data.message, 'success');
                    if (data.action === 'remove') {
                        $('#wishlist-item-' + data.id).remove();
                          that.html(that.data('text-add'));
                    }else{
                        that.html(that.data('text-remove'));
                    }

                    that.toggleClass('added');
                    if (data.title)
                        that.attr('title', data.title);
                    if (data.url)
                        that.attr('href', data.url);

                } else {
                    common.notify(data.message, 'error');
                }
            }
        });
    });
});