var wishlist = window.wishlist || {};
wishlist = {
    add: function (product_id) {
        $.ajax({
            url: '/wishlist/add/' + product_id,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                $('#countWishlist').html(data.count);
                common.notify(data.message, 'success');
                var selector = $('#wishlist-' + product_id);
                selector.addClass('added');
            }
        });

    }
}