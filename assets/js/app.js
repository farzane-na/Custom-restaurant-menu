jQuery(function($){
    $(document).on('added_to_cart', function(event, fragments, cart_hash, $button){
        // لینک "مشاهده سبد خرید" رو حذف کن
        $('.added_to_cart.wc-forward').remove();

        // پیام سفارشی رو نشون بده
        if( !$('#custom-add-message').length ) {
            $('body').append('<div id="custom-add-message" style="position:fixed; bottom:20px; right:20px; background:#4caf50; color:#fff; padding:10px 15px; border-radius:5px; z-index:9999;">محصول به سبد خرید اضافه شد</div>');
            setTimeout(function(){
                $('#custom-add-message').fadeOut(400, function(){ $(this).remove(); });
            }, 3000); // بعد از 3 ثانیه حذف میشه
        }
    });
});
