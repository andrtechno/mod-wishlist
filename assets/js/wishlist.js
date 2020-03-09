$(function () {
    var xhr; //:not(.added)
    $(document).on('click', '.btn-wishlist', function (e) {
        var that = $(this);

        if (xhr && xhr.readyState !== 4) {
            xhr.onreadystatechange = null;
            xhr.abort();
        }

        xhr = $.ajax({
            url: that.attr('href'),
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('.countWishList').html(data.count);
                common.notify(data.message, 'success');
                that.toggleClass('added');
                if (data.title)
                    that.attr('title', data.title);
                if (data.url)
                    that.attr('href', data.url);
            }
        });

    });
    $(document).on('click', '.btn-wishlist', function (e) {
        e.preventDefault();
        return false;
    });
});