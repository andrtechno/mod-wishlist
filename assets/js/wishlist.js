$(function () {
    var xhr; //:not(.added)
    $(document).on('click touchstart', '.btn-wishlist', function (e) {
        e.preventDefault();
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
                if (data.success) {
                    $('.countWishList').html(data.count);
                    common.notify(data.message, 'success');
                    that.toggleClass('added');
                    if (data.title)
                        that.attr('title', data.title);
                    if (data.url)
                        that.attr('href', data.url);
                    if(that.data('text') == true){
                        if(that.hasClass('added')){
                            that.html(wishlist_remove_text);
                        }else{
                            that.html(wishlist_add_text);
                        }
                    }
                } else {
                    common.notify(data.message, 'error');
                }
            }
        });
    });
});