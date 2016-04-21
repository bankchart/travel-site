$(document).ready(function(){
    $('.index-slider').slick({
        infinite: true,
        speed: 1000,
        fade: true,
        slidesToShow: 1,
        arrows: false,
        autoplay: true,
        dots: true
    });
    $(window).load(function(){
        setTimeout(function(){
            $('.loading').fadeOut('slow');
            setTimeout(function(){
                $('.index-slider img').fadeIn(1200);
            }, 1000);
        }, 2000);
    });
});
