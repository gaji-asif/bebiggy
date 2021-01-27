$(document).ready(function () {


    $('.tabs_money ul li').click(function (e) {
        $('.img_active').hide();
        $('.first_img').show();
        $($(this)).find('.first_img').hide();
        $($(this)).find('.img_active').show();
    });



    $(".tablet_menu_icon").click(function () { //When trigger is click in table mobile...
        $(".table_menu").toggle();
    });

   // $('.offer_we_image_a').nailthumb({ width: 100, height: 100 });

    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        items: 1,
        autoplay:true,
        autoplayTimeout:1000,
        autoplayHoverPause:true,
        rewind: false,
        navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"],
    })
});


$(document).on('click', ".course_details .card-header a", function () {
    if ($(this).hasClass('active')) {
        $('.card-header > a').removeClass("active");
    } else {
        $(this).addClass("active");
    }
    //----pause player----//
    var index = $(this).attr('data-index');
    $('.vimeo-player').each(function (key, val) {
        if (key != index) {
            var iframe = $('.vimeo-player')[key];
            var player = $f(iframe);
            player.api('pause');
        }
    });

    

});

