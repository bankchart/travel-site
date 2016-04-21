$(document).ready(function(){
    console.log('test');
    $('.image-scope img').load(function(){
        setTimeout(function(){
            $('.loading-mask').fadeOut('slow');
            setTimeout(function(){
                //$('.image-scope img').removeClass('image-hide');
                $('.image-scope img').fadeIn(1200);
            }, 1000);
        }, 2000);
    });
});
