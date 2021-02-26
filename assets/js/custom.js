/*---------------------------------------------------------
jQuery Required for Slippa Script by Onlinetoolhub
Project:    Slippa - Domain & Website Marketplace -  V 1.2
Version:    V 1.2
Last change:    25.05.2020
Assigned to:    Onlinetoolhub
----------------------------------------------------------*/

/* ----------------- MAIN JS FILE ----------------- */


/* ----------------- Start Document ----------------- */
(function ($) {
    "use strict";

    $(document).ready(function () {

        /*----------------------------------------------------*/
        /*  Back to Top
        /*----------------------------------------------------*/
        // Button
        function backToTop() {
            $('body').append('<div id="backtotop"><a href="#"></a></div>');
        }
        backToTop();

        // Showing Button
        var pxShow = 600; // height on which the button will show
        var scrollSpeed = 500; // how slow / fast you want the button to scroll to top.

        $(window).scroll(function () {
            if ($(window).scrollTop() >= pxShow) {
                $("#backtotop").addClass('visible');
            } else {
                $("#backtotop").removeClass('visible');
            }
        });

        $('#backtotop a').on('click', function () {
            $('html, body').animate({
                scrollTop: 0
            }, scrollSpeed);
            return false;
        });


        /*--------------------------------------------------*/
        /*  Ripple Effect
        /*--------------------------------------------------*/
        $('.ripple-effect, .ripple-effect-dark').on('click', function (e) {
            var rippleDiv = $('<span class="ripple-overlay">'),
                rippleOffset = $(this).offset(),
                rippleY = e.pageY - rippleOffset.top,
                rippleX = e.pageX - rippleOffset.left;

            rippleDiv.css({
                top: rippleY - (rippleDiv.height() / 2),
                left: rippleX - (rippleDiv.width() / 2),
            }).appendTo($(this));

           
            window.setTimeout(function () {
                rippleDiv.remove();
            }, 800);
        });


        /*--------------------------------------------------*/
        /*  Interactive Effects
        /*--------------------------------------------------*/
        $(".switch, .radio").each(function () {
            var intElem = $(this);
            intElem.on('click', function () {
                intElem.addClass('interactive-effect');
                setTimeout(function () {
                    intElem.removeClass('interactive-effect');
                }, 400);
            });
        });


        /*--------------------------------------------------*/
        /*  Sliding Button Icon
        /*--------------------------------------------------*/
        $(window).on('load', function () {
            $(".button.button-sliding-icon").not(".task-listing .button.button-sliding-icon").each(function () {
                var buttonWidth = $(this).outerWidth() + 30;
                $(this).css('width', buttonWidth);
            });
        });


        /*--------------------------------------------------*/
        /*  Sliding Button Icon
        /*--------------------------------------------------*/
        $('.bookmark-icon').on('click', function (e) {
            e.preventDefault();
            $(this).toggleClass('bookmarked');
        });

        $('.bookmark-button').on('click', function (e) {
            e.preventDefault();
            $(this).toggleClass('bookmarked');
        });


        /*----------------------------------------------------*/
        /*  Notifications Boxes
        /*----------------------------------------------------*/
        $("a.close").removeAttr("href").on('click', function () {
            function slideFade(elem) {
                var fadeOut = {
                    opacity: 0,
                    transition: 'opacity 0.5s'
                };
                elem.css(fadeOut).slideUp();
            }
            slideFade($(this).parent());
        });

        /*--------------------------------------------------*/
        /*  Full Screen Page Scripts
        /*--------------------------------------------------*/

        // Wrapper Height (window height - header height)
        function wrapperHeight() {
            var headerHeight = $("#header-container").outerHeight();
            var windowHeight = $(window).outerHeight() - headerHeight;
            $('.full-page-content-container, .dashboard-content-container, .dashboard-sidebar-inner, .dashboard-container, .full-page-container').css({
                height: windowHeight
            });
            $('.dashboard-content-inner').css({
                'min-height': windowHeight
            });
        }

        // Enabling Scrollbar
        function fullPageScrollbar() {
            $(".full-page-sidebar-inner, .dashboard-sidebar-inner").each(function () {

                var headerHeight = $("#header-container").outerHeight();
                var windowHeight = $(window).outerHeight() - headerHeight;
                var sidebarContainerHeight = $(this).find(".sidebar-container, .dashboard-nav-container").outerHeight();

                // Enables scrollbar if sidebar is higher than wrapper
                if (sidebarContainerHeight > windowHeight) {
                    $(this).css({
                        height: windowHeight
                    });

                } else {
                    $(this).find('.simplebar-track').hide();
                }
            });
        }

        // Init
        $(window).on('load resize', function () {
            wrapperHeight();
            fullPageScrollbar();
        });

        // Thumnail Switcher
        function avatarSwitcher() {
            var readURL = function (input, name = 'profile-pic') {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.' + name).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            };

            $(".file-upload").on('change', function () {
                readURL(this);
            });

            $(".image-upload").on('change', function () {
                readURL(this, $(this).data('img'));
            });

            $(".upload-button").on('click', function () {
                $(".file-upload").click();
            });

            $(".image-upload-button").on('click', function () {
                var id = $(this).next('.image-upload').attr('id')
                $('#' + id).click();
            });
        }
        avatarSwitcher();


        /*----------------------------------------------------*/
        /* Dashboard Scripts
        /*----------------------------------------------------*/

        // Dashboard Nav Submenus
        $('.dashboard-nav ul li a').on('click', function (e) {
            if ($(this).closest("li").children("ul").length) {
                if ($(this).closest("li").is(".active-submenu")) {
                    $('.dashboard-nav ul li').removeClass('active-submenu');
                } else {
                    $('.dashboard-nav ul li').removeClass('active-submenu');
                    $(this).parent('li').addClass('active-submenu');
                }
                e.preventDefault();
            }
        });


        // Responsive Dashbaord Nav Trigger
        $('.dashboard-responsive-nav-trigger').on('click', function (e) {
            e.preventDefault();
            $(this).toggleClass('active');

            var dashboardNavContainer = $('body').find(".dashboard-nav");

            if ($(this).hasClass('active')) {
                $(dashboardNavContainer).addClass('active');
            } else {
                $(dashboardNavContainer).removeClass('active');
            }

            $('.dashboard-responsive-nav-trigger .hamburger').toggleClass('is-active');

        });

        // Fun Facts
        function funFacts() {
            /*jslint bitwise: true */
            function hexToRgbA(hex) {
                var c;
                if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)) {
                    c = hex.substring(1).split('');
                    if (c.length == 3) {
                        c = [c[0], c[0], c[1], c[1], c[2], c[2]];
                    }
                    c = '0x' + c.join('');
                    return 'rgba(' + [(c >> 16) & 255, (c >> 8) & 255, c & 255].join(',') + ',0.07)';
                }
            }

            $(".fun-fact").each(function () {
                var factColor = $(this).attr('data-fun-fact-color');

                if (factColor !== undefined) {
                    $(this).find(".fun-fact-icon").css('background-color', hexToRgbA(factColor));
                    $(this).find("i").css('color', factColor);
                }
            });

        }
        funFacts();


        // Messages Scrollbar
        $(window).on('load resize', function () {
            var winwidth = $(window).width();
            if (winwidth > 1199) {

                // Notes
                $('.row').each(function () {
                    var mbh = $(this).find('.main-box-in-row').outerHeight();
                    var cbh = $(this).find('.child-box-in-row').outerHeight();
                    if (mbh < cbh) {
                        var headerBoxHeight = $(this).find('.child-box-in-row .headline').outerHeight();
                        var mainBoxHeight = $(this).find('.main-box-in-row').outerHeight() - headerBoxHeight + 39;

                        $(this).find('.child-box-in-row .content')
                            .wrap('<div class="dashboard-box-scrollbar" style="max-height: ' + mainBoxHeight + 'px" data-simplebar></div>');
                    }
                });

            }
        });

        // Mobile Adjustment for Single Button Icon in Dashboard Box
        $('.buttons-to-right').each(function () {
            var btr = $(this).width();
            if (btr < 36) {
                $(this).addClass('single-right-button');
            }
        });

        // Small Footer Adjustment
        $(window).on('load resize', function () {
            var smallFooterHeight = $('.small-footer').outerHeight();
            $('.dashboard-footer-spacer').css({
                'padding-top': smallFooterHeight + 45
            });
        });


        // Auto Resizing Message Input Field
        /* global jQuery */
        jQuery.each(jQuery('textarea[data-autoresize]'), function () {
            var offset = this.offsetHeight - this.clientHeight;

            var resizeTextarea = function (el) {
                jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
            };
            jQuery(this).on('keyup input', function () {
                resizeTextarea(this);
            }).removeAttr('data-autoresize');
        });


        /*--------------------------------------------------*/
        /*  Star Rating
        /*--------------------------------------------------*/
        function starRating(ratingElem) {

            $(ratingElem).each(function () {

                var dataRating = $(this).attr('data-rating');

                // Rating Stars Output
                function starsOutput(firstStar, secondStar, thirdStar, fourthStar, fifthStar) {
                    return ('' +
                        '<span class="' + firstStar + '"></span>' +
                        '<span class="' + secondStar + '"></span>' +
                        '<span class="' + thirdStar + '"></span>' +
                        '<span class="' + fourthStar + '"></span>' +
                        '<span class="' + fifthStar + '"></span>');
                }

                var fiveStars = starsOutput('star', 'star', 'star', 'star', 'star');

                var fourHalfStars = starsOutput('star', 'star', 'star', 'star', 'star half');
                var fourStars = starsOutput('star', 'star', 'star', 'star', 'star empty');

                var threeHalfStars = starsOutput('star', 'star', 'star', 'star half', 'star empty');
                var threeStars = starsOutput('star', 'star', 'star', 'star empty', 'star empty');

                var twoHalfStars = starsOutput('star', 'star', 'star half', 'star empty', 'star empty');
                var twoStars = starsOutput('star', 'star', 'star empty', 'star empty', 'star empty');

                var oneHalfStar = starsOutput('star', 'star half', 'star empty', 'star empty', 'star empty');
                var oneStar = starsOutput('star', 'star empty', 'star empty', 'star empty', 'star empty');

                // Rules
                if (dataRating >= 4.75) {
                    $(this).append(fiveStars);
                } else if (dataRating >= 4.25) {
                    $(this).append(fourHalfStars);
                } else if (dataRating >= 3.75) {
                    $(this).append(fourStars);
                } else if (dataRating >= 3.25) {
                    $(this).append(threeHalfStars);
                } else if (dataRating >= 2.75) {
                    $(this).append(threeStars);
                } else if (dataRating >= 2.25) {
                    $(this).append(twoHalfStars);
                } else if (dataRating >= 1.75) {
                    $(this).append(twoStars);
                } else if (dataRating >= 1.25) {
                    $(this).append(oneHalfStar);
                } else if (dataRating < 1.25) {
                    $(this).append(oneStar);
                }

            });

        }
        starRating('.star-rating');

        /*--------------------------------------------------*/
        /*  Tippy JS 
        /*--------------------------------------------------*/
        /* global tippy */
        tippy('[data-tippy-placement]', {
            delay: 100,
            arrow: true,
            arrowType: 'sharp',
            size: 'regular',
            duration: 200,

            // 'shift-toward', 'fade', 'scale', 'perspective'
            animation: 'shift-away',

            animateFill: true,
            theme: 'dark',

            // How far the tooltip is from its reference element in pixels 
            distance: 10,

        });

        /*--------------------------------------------------*/
        /*  Keywords
        /*--------------------------------------------------*/
        $(".keywords-container").each(function () {

            var keywordInput = $(this).find(".keyword-input");
            var keywordsList = $(this).find(".keywords-list");

            // adding keyword
            function addKeyword() {
                var $newKeyword = $("<span class='keyword'><span class='keyword-remove'></span><span class='keyword-text'>" + keywordInput.val() + "</span></span>");
                keywordsList.append($newKeyword).trigger('resizeContainer');
                keywordInput.val("");
            }

            // add via enter key
            keywordInput.on('keyup', function (e) {
                if ((e.keyCode == 13) && (keywordInput.val() !== "")) {
                    addKeyword();
                }
            });

            // add via button
            $('.keyword-input-button').on('click', function () {
                if ((keywordInput.val() !== "")) {
                    addKeyword();
                }
            });

            // removing keyword
            $(document).on("click", ".keyword-remove", function () {
                $(this).parent().addClass('keyword-removed');

                function removeFromMarkup() {
                    $(".keyword-removed").remove();
                }
                setTimeout(removeFromMarkup, 500);
                keywordsList.css({
                    'height': 'auto'
                }).height();
            });


            // animating container height
            keywordsList.on('resizeContainer', function () {
                var heightnow = $(this).height();
                var heightfull = $(this).css({
                    'max-height': 'auto',
                    'height': 'auto'
                }).height();

                $(this).css({
                    'height': heightnow
                }).animate({
                    'height': heightfull
                }, 200);
            });

            $(window).on('resize', function () {
                keywordsList.css({
                    'height': 'auto'
                }).height();
            });

            // Auto Height for keywords that are pre-added
            $(window).on('load', function () {
                var keywordCount = $('.keywords-list').children("span").length;

                // Enables scrollbar if more than 3 items
                if (keywordCount > 0) {
                    keywordsList.css({
                        'height': 'auto'
                    }).height();

                }
            });

        });


        /*--------------------------------------------------*/
        /*  Bootstrap Range Slider
        /*--------------------------------------------------*/

        // Thousand Separator
        function ThousandSeparator(nStr) {
            nStr += '';
            var x = nStr.split('.');
            var x1 = x[0];
            var x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }

        // Default Bootstrap Range Slider
        var currencyAttr = $(".range-slider").attr('data-slider-currency');

        $(".range-slider").slider({
            formatter: function (value) {
                return currencyAttr + ThousandSeparator(parseInt(value[0])) + " - " + currencyAttr + ThousandSeparator(parseInt(value[1]));
            }
        });

        $(".range-slider-single").slider();


        /*----------------------------------------------------*/
        /*  Payment Accordion
        /*----------------------------------------------------*/
        var radios = document.querySelectorAll('.payment-tab-trigger > input');

        for (var i = 0; i < radios.length; i++) {
            radios[i].addEventListener('change', expandAccordion);
        }

        function expandAccordion(event) {
            /* jshint validthis: true */
            var tabber = this.closest('.payment');
            var allTabs = tabber.querySelectorAll('.payment-tab');
            for (var i = 0; i < allTabs.length; i++) {
                allTabs[i].classList.remove('payment-tab-active');
            }
            clearInputs('paymentForm');
            event.target.parentNode.parentNode.classList.add('payment-tab-active');
        }

        /*----------------------------------------------------*/
        /*  Share URL and Buttons
        /*----------------------------------------------------*/
        /* global ClipboardJS */
        $('.copy-url input').val(window.location.href);
        new ClipboardJS('.copy-url-button');

        $(".share-buttons-icons a").each(function () {
            var buttonBG = $(this).attr("data-button-color");
            if (buttonBG !== undefined) {
                $(this).css('background-color', buttonBG);
            }
        });


        /*----------------------------------------------------*/
        /*  Tabs
        /*----------------------------------------------------*/
        var $tabsNav = $('.popup-tabs-nav'),
            $tabsNavLis = $tabsNav.children('li');

        $tabsNav.each(function () {
            var $this = $(this);

            $this.next().children('.popup-tab-content').stop(true, true).hide().first().show();
            $this.children('li').first().addClass('active').stop(true, true).show();
        });

        $tabsNavLis.on('click', function (e) {
            var $this = $(this);

            $this.siblings().removeClass('active').end().addClass('active');

            $this.parent().next().children('.popup-tab-content').stop(true, true).hide()
                .siblings($this.find('a').attr('href')).fadeIn();

            e.preventDefault();
        });

        var hash = window.location.hash;
        var anchor = $('.tabs-nav a[href="' + hash + '"]');
        if (anchor.length === 0) {
            $(".popup-tabs-nav li:first").addClass("active").show(); //Activate first tab
            $(".popup-tab-content:first").show(); //Show first tab content
        } else {
            anchor.parent('li').click();
        }

        // Disable tabs if there's only one tab
        $('.popup-tabs-nav').each(function () {
            var listCount = $(this).find("li").length;
            if (listCount < 2) {
                $(this).css({
                    'pointer-events': 'none'
                });
            }
        });


        /*----------------------------------------------------*/
        /*  Indicator Bar
        /*----------------------------------------------------*/
        $('.indicator-bar').each(function () {
            var indicatorLenght = $(this).attr('data-indicator-percentage');
            $(this).find("span").css({
                width: indicatorLenght + "%"
            });
        });


        /*----------------------------------------------------*/
        /*  Custom Upload Button
        /*----------------------------------------------------*/

        var uploadButton = {
            $button: $('.uploadButton-input-visual'),
            $nameField: $('.uploadButton-file-name-visual')
        };

        var uploadButton2 = {
            $button: $('.uploadButton-input-cover'),
            $nameField: $('.uploadButton-file-name-cover')
        };

        var uploadButton3 = {
            $button: $('.uploadButton-input-thumb'),
            $nameField: $('.uploadButton-file-name-thumb')
        };

        var uploadButton4 = {
            $button: $('.uploadButton-input-profit'),
            $nameField: $('.uploadButton-file-name-profit')
        };

        uploadButton.$button.on('change', function () {
            _populateFileField($(this), uploadButton);
        });

        uploadButton2.$button.on('change', function () {
            _populateFileField($(this), uploadButton2);
        });

        uploadButton3.$button.on('change', function () {
            _populateFileField($(this), uploadButton3);
        });

        uploadButton4.$button.on('change', function () {
            _populateFileField($(this), uploadButton4);
        });

        function _populateFileField($button, varaibale) {
            var selectedFile = [];
            for (var i = 0; i < $button.get(0).files.length; ++i) {
                selectedFile.push($button.get(0).files[i].name + '<br>');
            }
            varaibale.$nameField.html(selectedFile);
        }


        /*----------------------------------------------------*/
        /*  Slick Carousel
        /*----------------------------------------------------*/
        $('.blog-carousel').slick({
            infinite: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            responsive: [{
                breakpoint: 1365,
                settings: {
                    slidesToShow: 3,
                    dots: true,
                    arrows: false
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    dots: true,
                    arrows: false
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    dots: true,
                    arrows: false
                }
            }
            ]
        });

        $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',

            fixedContentPos: false,
            fixedBgPos: true,

            overflowY: 'auto',

            closeBtnInside: true,
            preloader: false,

            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in',
            disableOn: function () {
                if (userID === '') {
                    popnotificaton('<b> Please login to perform this action </b>', 'info');
                    setTimeout(function () {
                        window.location.replace(baseUrl + "login");
                    }, 2000);
                    return false;
                }
                return true;
            }
        });

    });

})(this.jQuery);


// -------------------------------------------------------------
//  Owl Carousel
// -------------------------------------------------------------

/*----------------------------------------------------*/
/*  Recent / Popular & Solid Listings
/*----------------------------------------------------*/
"use strict";

function LoadThreeSliders() {

    $("#recent-slider,#popular-slider,#sold-slider,feature-active").owlCarousel({
        items: 4,
        nav: true,
        autoplay: true,
        dots: true,
        autoplayHoverPause: true,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left '></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                slideBy: 1
            },
            500: {
                items: 1,
                slideBy: 1
            },
            991: {
                items: 2,
                slideBy: 1
            },
            1200: {
                items: 4,
                slideBy: 1
            },
        }

    });
}


/*----------------------------------------------------*/
/*  Sponsored Listings
/*----------------------------------------------------*/
(function () {

    "use strict";

    $("#featured-slider").owlCarousel({
        items: 4,
        nav: true,
        autoplay: true,
        dots: true,
        autoplayHoverPause: true,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left '></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                slideBy: 1
            },
            500: {
                items: 1,
                slideBy: 1
            },
            991: {
                items: 2,
                slideBy: 1
            },
            1200: {
                items: 4,
                slideBy: 1
            },
        }

    });

}());


/*----------------------------------------------------*/
/*  Apps Listings
/*----------------------------------------------------*/
(function () {

    "use strict";

    $("#featured-slider-app,#feature-active-app").owlCarousel({
        items: 5,
        nav: true,
        autoplay: true,
        dots: true,
        autoplayHoverPause: true,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left '></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                slideBy: 1
            },
            500: {
                items: 1,
                slideBy: 1
            },
            991: {
                items: 3,
                slideBy: 1
            },
            1200: {
                items: 5,
                slideBy: 1
            },
        }

    });

}());

/*----------------------------------------------------*/
/*  Featured Sliders Listing Page
/*----------------------------------------------------*/

(function () {

    "use strict";

    $("#featured-slider-page").owlCarousel({
        items: 2,
        nav: true,
        autoplay: true,
        dots: true,
        autoplayHoverPause: true,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left '></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                slideBy: 1
            },
            500: {
                items: 1,
                slideBy: 1
            },
            991: {
                items: 2,
                slideBy: 1
            },
            1200: {
                items: 2,
                slideBy: 1
            },
        }

    });

}());


/*----------------------------------------------------*/
/*  Sponsored Slider
/*----------------------------------------------------*/
(function () {

    "use strict";

    $("#sponsored-slider").owlCarousel({
        items: 1,
        nav: true,
        autoplay: true,
        dots: true,
        autoplayHoverPause: true,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left '></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                slideBy: 1
            },
            500: {
                items: 1,
                slideBy: 1
            },
            991: {
                items: 1,
                slideBy: 1
            },
            1200: {
                items: 1,
                slideBy: 1
            },
        }

    });

}());

/*----------------------------------------------------*/
/*  Featured Domains Slider
/*----------------------------------------------------*/
if ($('#feature-active').length > 0) {
    $("#feature-active").owlCarousel({
        items: 4,
        nav: true,
        autoplay: true,
        dots: true,
        autoplayHoverPause: true,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left '></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                slideBy: 1
            },
            500: {
                items: 1,
                slideBy: 1
            },
            991: {
                items: 2,
                slideBy: 1
            },
            1200: {
                items: 4,
                slideBy: 1
            },
        }

    });
} // slider animation

/*----------------------------------------------------*/
/*  More from user Slider
/*----------------------------------------------------*/
(function () {

    "use strict";

    $("#user-products-slider").owlCarousel({
        items: 4,
        nav: true,
        autoplay: true,
        dots: true,
        autoplayHoverPause: true,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left '></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                slideBy: 1
            },
            500: {
                items: 1,
                slideBy: 1
            },
            991: {
                items: 2,
                slideBy: 1
            },
            1200: {
                items: 4,
                slideBy: 1
            },
        }

    });

}());

/*----------------------------------------------------*/
/*  Ending Soon Slider
/*----------------------------------------------------*/
(function () {

    "use strict";

    $("#ending-soon-slider").owlCarousel({
        items: 4,
        nav: true,
        autoplay: true,
        dots: true,
        autoplayHoverPause: true,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left '></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                slideBy: 1
            },
            500: {
                items: 1,
                slideBy: 1
            },
            991: {
                items: 2,
                slideBy: 1
            },
            1200: {
                items: 4,
                slideBy: 1
            },
        }

    });

}());

/*----------------------------------------------------*/
/*  Ending Soon Slider
/*----------------------------------------------------*/
(function () {

    "use strict";

    $("#featured-apps").owlCarousel({
        items: 5,
        nav: true,
        autoplay: true,
        dots: true,
        autoplayHoverPause: true,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left '></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                slideBy: 1
            },
            500: {
                items: 1,
                slideBy: 1
            },
            991: {
                items: 2,
                slideBy: 1
            },
            1200: {
                items: 5,
                slideBy: 1
            },
        }

    });

}());



/*----------------------------------------------------*/
/*  Pricing Plans Sliders
/*----------------------------------------------------*/
(function () {

    "use strict";

    $("#pricing-plans-1,#pricing-plans-2,#pricing-plans-3").owlCarousel({
        items: 3,
        nav: true,
        autoplay: true,
        dots: true,
        autoplayHoverPause: true,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left '></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                slideBy: 1
            },
            500: {
                items: 1,
                slideBy: 1
            },
            991: {
                items: 2,
                slideBy: 1
            },
            1200: {
                items: 3,
                slideBy: 1
            },
        }

    });

}());

/*----------------------------------------------------*/
/*  Top Domain Ads Crousel Slider
/*----------------------------------------------------*/
$(document).ready(function () {
    "use strict";

    $('.owl-domain-prices-previw').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsiveClass: true,
        dots: false,
        responsive: {
            0: {
                items: 1,
            },
            340: {
                items: 1,
                margin: 20
            },
            350: {
                items: 2,
                margin: 20
            },
            490: {
                items: 3,
                margin: 20
            },
            780: {
                items: 2,
                margin: 20
            },
            1000: {
                items: 3,
                loop: true,
                margin: 20
            },
            1200: {
                items: 4,
                loop: true,
                margin: 20
            }
        }
    })
});

/*--------------------------------------------------*/
/*  Tooltips
/*--------------------------------------------------*/
$(window).on('load', function () {
    $('[data-toggle="tooltip"]').tooltip()
});

//Panel Colapse//
function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);



/*--------------------------------------------------*/
/*  Load Trending Listings
/*--------------------------------------------------*/
"use strict";

function loadTrendingAds() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $('#loadingtrendingAds').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'main/loadTrendingAds/',
        data: {
            [csrfName]: csrfHash
        },
        success: function (data) {
            $('#trendingAds').fadeOut(100).html(data.response).fadeIn(500);
            $('#trendingAds').html(data.response);
            $('.txt_csrfname').val(data.token);
            LoadThreeSliders();
            $('#loadingtrendingAds').hide();
        },
        complete: function () {
            $('#loadingtrendingAds').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
}


/****
function to add cart one time
**/
function addCartOneItem(price) {
    var name = "";
    var count = 1;
    var thumb = "";
    var cur = "";
    var d = new Date();
    var n = d.getTime();
    var id = n;
    var sale = "";
    shoppingCart.addItemToCart(name, price, count, thumb, cur, id, sale)
}

/*--------------------------------------------------*/
/*  Discount Coupon
/*--------------------------------------------------*/
$(document).on("submit", "#discountCouponForm", function (event) {
    event.preventDefault();

    // shoppingCart.clearCart();
    var price = $("#payAmt").text();
    price = price.replace(/\,/g, '');
    price = parseFloat(price, 10).toFixed(2)
    addCartOneItem(price)
    //
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var cartArray = shoppingCart.listCart();
    $('#loadingCoupon').show();

    if ($("#checkoutCoupon").val() === "") {
        bootstrap_alert.error('Please enter a coupon code', '#discountCouponValidate');
        $('#loadingCoupon').hide();
        return;
    }

    if (Array.isArray(cartArray) && cartArray.length === 0) {

        bootstrap_alert.error('Sorry Coupon Code is not valid', '#discountCouponValidate');
        $('#loadingCoupon').hide();
        return;
    }

    $.ajax({
        method: 'POST',
        url: baseUrl + 'main/validate_discount_code',
        data: {
            code: $('#checkoutCoupon').val(),
            purchases: cartArray,
            [csrfName]: csrfHash
        },
        success: function (data) {
            var dataArr = JSON.parse(data);
            if (dataArr.error == 1) {
                $('.txt_csrfname').val(dataArr.token);
                bootstrap_alert.error('Invalid Code', '#discountCouponValidate');
                $('#loadingCoupon').hide();
                return;
            } else {

                var dataArr = JSON.parse(data);
                var price = $("#payAmt").text();
                price = price.replace(/\,/g, '');
                total = parseFloat(price, 10).toFixed(2)

                $('.txt_csrfname').val(dataArr.token);
                bootstrap_alert.success('Successfully applied the discount code', '#discountCouponValidate');

                if ($('#feeAmt').text() != '') {
                    var feeAmt = parseFloat($('#feeAmt').text().trim()).toFixed(2);
                } else {
                    var feeAmt = 0;
                }

                // remove discount coupon
                var buttonVal = $("#discountCodeApply").text().trim();
                if (buttonVal == "Remove Coupon") {
                    var gtotal = parseFloat(total) + parseFloat(feeAmt);
                    gtotal = gtotal.toFixed(2);
                    $('.total-discount').html('0');
                    $('.total-cost').html(gtotal);
                    $('#txt_paytotal').val(gtotal);
                    $("#checkoutCoupon").attr('readonly', false);
                    $("#discountCodeApply").html("Apply");
                    $("#checkoutCoupon").val('');
                    bootstrap_alert.warning('Successfully remove the discount code', '#discountCouponValidate');
                    return;
                }
                if (dataArr.discountType === '0') {

                    discount = total * dataArr.discount / 100;
                    var gtotal = parseFloat(total - discount) + parseFloat(feeAmt);
                    gtotal = gtotal.toFixed(2);


                    if (gtotal < 1) {
                        bootstrap_alert.error('Invalid Code', '#discountCouponValidate');
                    } else {

                        $('.discount-type').html(dataArr.discount + '%');
                        $('.total-discount').html(' - $' + discount);
                        $('.total-cost').html(gtotal);
                        $('#txt_paytotal').val(gtotal);

                        addCartOneItem(gtotal)
                        $("#checkoutCoupon").val($("#checkoutCoupon").val());
                        $("#checkoutCoupon").attr('readonly', 'readonly');
                        $("#discountCodeApply").html("Remove Coupon");
                        bootstrap_alert.success('Successfully applied the discount code', '#discountCouponValidate');
                    }


                } else if (dataArr.discountType === '1') {

                    var gtotal = parseFloat(total - dataArr.discount) + parseFloat(feeAmt);
                    gtotal = gtotal.toFixed(2);
                    if (gtotal < 1) {
                        bootstrap_alert.error('Invalid Code', '#discountCouponValidate');
                    } else {
                        $('.discount-type').html("fixed");
                        $('.total-discount').html(" - $" + dataArr.discount);
                        $('.total-cost').html(gtotal);
                        $('#txt_paytotal').val(gtotal);
                        addCartOneItem(gtotal)
                        $("#checkoutCoupon").val($("#checkoutCoupon").val());
                        $("#checkoutCoupon").attr('readonly', 'readonly');
                        $("#discountCodeApply").html("Remove Coupon");
                        bootstrap_alert.success('Successfully applied the discount code', '#discountCouponValidate');
                    }
                }

            }
            $('#loadingCoupon').hide();
        },
        complete: function () {
            $('#loadingCoupon').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});

/*--------------------------------------------------*/
/*  Button Next
/*--------------------------------------------------*/
$(document).on('click', '#BtnNext', function () {
    var form = $('#createListingForm');

    form.validate();
    //if (checkDiscountPrice()) {
    if (form.valid()) {

        $("#ThirdTab").removeAttr('href');
        $("#SecondStep").show();
        $("#collapseTwo").collapse('hide');
        $("#collapseOne").collapse('hide');
        $("#collapseThree").collapse('toggle');
        $("#collapseThree").collapse('toggle');
        $("#ThirdTab").removeClass("expandable_false");
    }
    //}

});


/*--------------------------------------------------*/
/*  Button Next Pay
/*--------------------------------------------------*/
$(document).on('click', '#BtnNextPay', function () {
    var form = $('#createListingForm');
    form.validate();
    if (form.valid()) {
        $("#FifthTab").removeAttr('href');
        $("#FifthStep").show();
        $("#collapseFive").collapse('hide');
        $("#collapseSix").collapse('toggle');
        $("#SixthTab").removeClass("expandable_false");
    }
});


/*--------------------------------------------------*/
/*  Button Pay Domain
/*--------------------------------------------------*/
$(document).on('click', '#BtnNextPayDom', function () {
    var form = $('#createListingForm');
    form.validate();
    if (form.valid()) {
        $("#FifthTab").removeAttr('href');
        $("#FourthStep").show();
        $("#collapseFour").collapse('hide');
        $("#collapseSix").collapse('toggle');
        $("#collapseSix").removeAttr('href');
        $("#SixthTab").removeClass('expandable_false');

    }
});

/*--------------------------------------------------*/
/*  Button Skip
/*--------------------------------------------------*/
$(document).on('click', '#BtnSkip', function () {
    var form = $('#createListingForm');
    form.validate();
    if (form.valid()) {
        $('.listings').prop("checked", false);
        $('.sponsored').prop("checked", false);
        $("#FourthTab").removeAttr('href');
        $("#FourthStep").show();
        $("#collapseFour").collapse('hide');
        $("#collapseFive").collapse('toggle');
        $("#FifthTab").removeClass('expandable_false');
    }
});

/*--------------------------------------------------*/
/*  Button Final Next 
/*--------------------------------------------------*/
$(document).on('click', '#BtnNextFinal', function () {
    var form = $('#createListingForm');

    form.validate();
    if (form.valid()) {
        TotalAmount = parseFloat($('#txt_payamount').val());
        $("#pay_listing").show();
        $("#create_listing_sesction").hide();


        if (TotalAmount > 0) {
            $('#answer_3_freecheckout').prop("disabled", true);
            $('#answer_3_freecheckout').prop("checked", false);
            $('#answer_1_payvia_card').prop("checked", false);
            $('#answer_2_payvia_paypal').prop("checked", false);
            $('#answer_4_payvia_paypal').prop("checked", true);
            $('#Pay_free').hide();
            $('#Pay_Credit_Card').hide();
            $('#Pay_stripe').show();
            $('#button_pay').show();
        } else {
            $('#answer_3_freecheckout').prop("checked", true);
            $('#answer_2_payvia_paypal').prop("checked", false);
            $('#answer_1_payvia_card').prop("checked", false);
            $('#answer_1_payvia_card').prop("disabled", true);
            $('#answer_4_payvia_paypal').prop("checked", false);
            $('#answer_4_payvia_paypal').prop("disabled", true);
            $('#answer_2_payvia_paypal').prop("disabled", true);
            $('#freecheckout_select').show();
            $('#Pay_free').show();
            $('#Pay_Credit_Card').hide();
            $('#Pay_stripe').hide();
            $('#button_pay').show();
        }
    }
});


/*--------------------------------------------------*/
/*  Verify New Domain
/*--------------------------------------------------*/

$(document).on('click', '.button-verify-url', function () {
    // $("#siteURL").prop('readonly', true);
    // $(".button-verify-url").prop('disabled', true);
    $("#loadingImageVerify").show();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();

    if ($("#selectedCategory").val() === '') {
        $("#domainVerificationDiv").hide();
        // $("#siteURL").prop('readonly', false);
        $(".button-verify-url").prop('disabled', false);
        $("#loadingImageVerify").hide();
        return false;
    }

    if ($("#siteURL").val() === '') {
        $("#domainVerificationDiv").hide();
        // $("#siteURL").prop('readonly', false);
        $(".button-verify-url").prop('disabled', false);
        $("#loadingImageVerify").hide();
        bootstrap_alert.error('Please enter URL', '#DomainValMsg');
        return false;
    }


    if (!isUrlValid($("#siteURL").val())) {
        $("#domainVerificationDiv").hide();
        // $("#siteURL").prop('readonly', false);
        $(".button-verify-url").prop('disabled', false);
        bootstrap_alert.error(errorinvalidUrl, '#DomainValMsg');
        $("#loadingImageVerify").hide();
        return;
    }

    CheckBlacklistedDomains($("#siteURL").val(), function (response) {
        if (response === true) {
            bootstrap_alert.error(errorBlacklistedDomain, '#DomainValMsg');
            // $("#siteURL").prop('readonly', false);
            $(".button-verify-url").prop('disabled', false);
            $("#domainVerificationDiv").hide();
            $("#loadingImageVerify").hide();
            return;
        } else {
            // $("#domainVerificationDiv").show();
            // $("#loadingImageVerify").show();
            $.ajax({
                url: baseUrl + 'common/uploadFileGenerator/',
                type: "POST",
                data: {
                    lisingtDomain: $("#siteURL").val(),
                    [csrfName]: csrfHash
                },
                dataType: "json",
                success: function (data) {
                    $("#loadingImageVerify").hide();
                    if (data !== '') {
                        $('.txt_csrfname').val(data.token);
                        if (data.response !== false) {

                            // loadingInfo = '<div>' +
                            //     '1). DOWNLOAD FILE : &nbsp;<a href="' + baseUrl + '/assets/verification/' + data.response['token'] + '.zip' + '" class="btn btn-success">DOWNLOAD FILE</a><br>' +
                            //     '2). UNZIP AND UPLOAD .TXT FILE TO YOUR DOMAIN ROOT FOLDER<br>' +
                            //     '3). <b>IF YOU HAVE DONE EVERYTHING RIGHT YOU SHOULD BE ABLE TO ACCESS THE FILE FROM FOLLOWING URL</b>' +
                            //     '<a style="display: inline-block;" href="' + '//' + data.response['domain'] + '/' + data.response['token'] + '.txt' + '" target="_blank">' + 'http://' + data.response['domain'] + '/' + data.response['token'] + '.txt' + '</a><br>' +
                            //     '4). NOW PLEASE VERIFY : <button id="btnVerifyDomain" name="btnVerifyDomain" type="button" class="btn btn-info centerButtons">VERIFY</button>' +
                            //     '</div></br>' +
                            //     '';
                            $('#savedDataInfo').val(JSON.stringify(data.response));
                            if (data.response.validations === true) {
                                // $("#verificationFile").html(loadingInfo);
                                return;
                            } else {
                                var values = $('#savedDataInfo').val();
                                values = JSON.parse(values);
                                $("#domainVerificationDiv").hide();
                                // bootstrap_alert.success('Successfully Verified your domain.. Please wait..', '#DomainValMsg');
                                csrfName = $('.txt_csrfname').attr('name');
                                csrfHash = $('.txt_csrfname').val();
                                $('#loadingImageContinue').show();
                                $.ajax({
                                    url: baseUrl + 'common/checkListingExists/',
                                    type: "POST",
                                    data: {
                                        lisingtDomain: $("#siteURL").val(),
                                        branch_1_group_1: $('#listing_type').val(),
                                        [csrfName]: csrfHash
                                    },
                                    dataType: "json",
                                    success: function (data) {
                                        $('.txt_csrfname').val(data.token);
                                        if (data.response === true) {
                                            // $("#siteURL").prop('readonly', false);
                                            //   bootstrap_alert.error('Sorry, You already have a listing for this domain.', '#DomainValMsg');
                                            $('#loadingImageContinue').hide();
                                            $('#loadingImageVerify').hide();

                                            $("#btnfoward").hide();
                                            return;
                                        } else {
                                            $('#loadingImageContinue').hide();
                                            $('#loadingImageVerify').hide();

                                            //bootstrap_alert.success('Your Request is Processing..', '#ContinueVal');
                                            // $("#siteURL").prop('readonly', true);
                                            setTimeout(function () {


                                                $("#domainName").html(values.domain);
                                                $("#WebsiteName").html(values.domain);
                                                $("#website_BusinessName").val(values.domain);
                                                $("#domainTitle").html(values.domain);
                                                $("#domain_id").val(values.id);
                                                $("#FirstTab").removeAttr('href');
                                                $("#FirstStep").show();
                                                $("#collapseOne").collapse('hide');
                                                $("#collapseTwo").collapse('toggle');
                                                $("#secondTab").removeClass("expandable_false");
                                                $("#FirstTab").removeClass("expandable_false");

                                                listing_urlSlugGenerator()

                                            }, 1000);
                                            return;
                                        }
                                    },
                                    error: function (data) {
                                        bootstrap_alert.success('oh!!');
                                        $('#loadingImageVerify').hide();

                                    }
                                });
                            }
                        } else {
                            $("#loadingImageVerify").hide();
                            bootstrap_alert.error('Something Went Wrong', '#DomainValMsg');
                            // $("#siteURL").prop('readonly', true);
                            // $(".button-verify-url").prop('disabled', false);
                            return;
                        }
                    }
                }
            });
        }
    });
});





/*--------------------------------------------------*/
/*  Verify App URL
/*--------------------------------------------------*/

$(document).on('click', '.button-verify-appurl', function () {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $("#loadingImageVerify").show();
    if (!isUrlValid($("#appURL").val())) {
        bootstrap_alert.error(errorinvalidUrl, '#AppUrlValMsg');
        $("#loadingImageVerify").hide();
        return;
    }

    CheckPlaystoreApp($("#appURL").val(), function (response) {

        // console.log("app name");
        // console.log(response);
        // console.log($("#appURL").val());
        if (response === false) {
            bootstrap_alert.error(errorIvalidAppURL, '#AppUrlValMsg');
            $("#loadingImageVerify").hide();
            return;
        } else {
            $("#loadingImageVerify").hide();
            // bootstrap_alert.success('Please wait..', '#ContinueVal');
            // $("#appURL").prop("readonly", true);
            setTimeout(function () {
                $("#FirstTab").removeAttr('href');
                $("#FirstStep").show();
                $("#collapseOne").collapse('hide');
                $("#collapseTwo").collapse('toggle');

                $("#secondTab").removeClass("expandable_false");
                $("#FirstTab").removeClass("expandable_false");

            }, 3000);
            return;
        }
    });
});

/*--------------------------------------------------*/
/*  Admin Verify App URL 
/*--------------------------------------------------*/

$(document).on('click', '.button-verify-appurl-admin', function () {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $("#loadingImageVerify").show();
    if (!isUrlValid($("#appURL").val())) {
        bootstrap_alert.error(errorinvalidUrl, '#AppUrlValMsg');
        $("#loadingImageVerify").hide();
        return;
    }

    CheckPlaystoreApp($("#appURL").val(), function (response) {
        if (response === false) {
            bootstrap_alert.error(errorIvalidAppURL, '#AppUrlValMsg');
            $("#loadingImageVerify").hide();
            return;
        } else {
            $("#loadingImageVerify").hide();
            return;
        }
    });
});


/*--------------------------------------------------*/
/*  Verify Business Name
/*--------------------------------------------------*/

$(document).on('click', '.button-verify-business', function () {


    var values = $('#busninessTitle').val();
    if (values === '') {
        return false;
    }

    if (!isNameFormat($("#busninessTitle").val())) {
        // $("#siteURL").prop('readonly', false);
        //$(".button-verify-url").prop('disabled', false);
        bootstrap_alert.error(errorinvalidName, '#DomainValMsg');
        return;
    }

    // $("#busninessTitle").prop('readonly', true);
    //$(".button-verify-business").prop('disabled', true);
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();

    // bootstrap_alert.success('Successfully Verified your business name.. Please wait..', '#DomainValMsg');
    csrfName = $('.txt_csrfname').attr('name');
    csrfHash = $('.txt_csrfname').val();
    $('#loadingImageVerify').show();
    $.ajax({
        url: baseUrl + 'common/registerBusinessName/',
        type: "POST",
        data: {
            lisingtDomain: $("#busninessTitle").val(),
            [csrfName]: csrfHash
        },
        dataType: "json",
        success: function (data) {
            if (data !== '') {
                $('.txt_csrfname').val(data.token);
                $('#savedDataInfo').val(JSON.stringify(data.response));
                var values = $('#savedDataInfo').val();
                values = JSON.parse(values);
                $("#domainVerificationDiv").hide();
                // bootstrap_alert.success('Successfully Verified your Business name.. Please wait..', '#DomainValMsg');
                csrfName = $('.txt_csrfname').attr('name');
                csrfHash = $('.txt_csrfname').val();
                // $('#loadingImageContinue').show();
                $.ajax({
                    url: baseUrl + 'common/checkBusinessListingExists/',
                    type: "POST",
                    data: {
                        lisingtDomain: $("#busninessTitle").val(),
                        branch_1_group_1: $('#listing_type').val(),
                        [csrfName]: csrfHash
                    },
                    dataType: "json",
                    success: function (data) {
                        bootstrap_alert.success(data);
                        $('.txt_csrfname').val(data.token);
                        if (data.response === true) {
                            // $("#busninessTitle").prop('readonly', false);
                            bootstrap_alert.error('Sorry, You already have a listing for this Business name.', '#DomainValMsg');
                            // $('#loadingImageContinue').hide();
                            $('#loadingImageVerify').hide();

                            $("#btnfoward").hide();
                            return;
                        } else {
                            // $('#loadingImageContinue').hide();
                            $('#loadingImageVerify').hide();
                            // bootstrap_alert.success('Please wait..', '#ContinueVal');
                            // $("#busninessTitle").prop('readonly', true);
                            setTimeout(function () {
                                $("#domainName").html(values.domain);
                                $("#WebsiteName").html(values.domain);
                                $("#website_BusinessName").val(values.domain);
                                $("#domainTitle").html(values.domain);
                                $("#domain_id").val(values.id);
                                $("#FirstTab").removeAttr('href');
                                $("#FirstStep").show();
                                $("#collapseOne").collapse('hide');
                                $("#collapseTwo").collapse('toggle');

                                $("#secondTab").removeClass("expandable_false");
                                $("#FirstTab").removeClass("expandable_false");

                                listing_urlSlugGenerator();
                            }, 2000);
                            return;
                        }
                    },
                    error: function (data) {
                        bootstrap_alert.success('oh!!');
                    }
                });
            }
        },
        error: function (data) {

        }
    });

});
/***
 * <span id="loaderImage" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
 *  $('#loaderImage').show();
        $("#button_pay").prop('disabled', true);
 */


/*Submit Payment Form*/
$(document).on('submit', '#payWrapper', function (e) {
    e.preventDefault();
    var form = $(this);

    form.validate();
    if (form.valid()) {
        $('#loaderImage').show();
        if ($('#answer_4_payvia_paypal').is(':checked')) {
            var stripe = $('input[type="radio"][name="branch_1_pay_1"]').val();
            $('#loaderImage').show();
            if (stripe === "payvia_stripe") {

                $("#button_pay").prop('disabled', true);
                Stripe.createToken({
                    number: $('#stripe_credit_card').val(),
                    cvc: $('#s  ecurity_code').val(),
                    exp_month: $("input[name=txt_month]").val(),
                    exp_year: $("input[name=txt_year]").val()
                }, function (status, response) {
                    if (response.error) {
                        //enable the submit button
                        $("#submit-btn").show();

                        //display the errors on the form
                        $("#error-message").html(response.error.message).show();
                    } else {
                        console.log(response);
                        //get token id
                        var token = response['id'];
                        //insert the token into the form
                        $("#payWrapper").append("<input type='hidden' name='token' value='" + token + "' />");
                        //submit form to the server
                        $("#payWrapper")[0].submit();


                    }
                });

            }
        } else {

            $(this)[0].submit();
        }

    }

});



// /*Submit Payment Form*/
// $(document).on('submit', '#payWrapper', function(e) {
//     e.preventDefault();
//     var form = $(this);
//     form.validate();
//     if (form.valid()) {

//         Stripe.createToken({
//             number: $('#stripe_credit_card').val(),
//             cvc: $('#security_code').val(),
//             exp_month: $("input[name=txt_month]").val(),
//             exp_year: $("input[name=txt_year]").val()
//         }, function(status, response) {
//             if (response.error) {
//                 //enable the submit button
//                 $("#submit-btn").show();
//                 $("#loader").css("display", "none");
//                 //display the errors on the form
//                 $("#error-message").html(response.error.message).show();
//             } else {
//                 console.log(response);
//                 //get token id
//                 var token = response['id'];
//                 //insert the token into the form
//                 $("#payWrapper").append("<input type='hidden' name='token' value='" + token + "' />");
//                 //submit form to the server
//                 $("#payWrapper")[0].submit();
//             }
//         });


//     }

// });


/*Submit Listing Type*/
$(document).on('submit', '#listingTypeForm', function (e) {
    e.preventDefault();
    var form = $(this);
    form.validate();
    if (form.valid()) {

        if ($("input[name='branch_1_group_1']:checked").val() === 'Sell-Websites') {
            window.location.href = baseUrl + "user/create_listings/website/";
        } else if ($("input[name='branch_1_group_1']:checked").val() === 'Sell-Domains') {
            window.location.href = baseUrl + "user/create_listings/domain/";
        } else if ($("input[name='branch_1_group_1']:checked").val() === 'Sell-Apps') {
            window.location.href = baseUrl + "user/create_listings/app/";
        } else if ($("input[name='branch_1_group_1']:checked").val() === 'Sell-Businesses') {
            window.location.href = baseUrl + "user/create_listings/business/";
        } else if ($("input[name='branch_1_group_1']:checked").val() === 'Sell-Solutions') {
            window.location.href = baseUrl + "user/create_solution/solution/";
        }


    }

});

/*----------------------------------*/
/*-----------headingOne--------------*/
/*----------------------------------*/
$(document).on('click', '.accordion_', function (e) {
    // $("#collapseOne").collapse('hide');
    // $("#collapseTwo").collapse('hide');
    // $("#collapseThree").collapse('hide');
    // $("#collapseFour").collapse('hide');
    // $("#collapseFive").collapse('hide');
    // $("#collapseSix").collapse('hide');

    let accord_id = $(this).attr('aria-controls');
    if (!$(this).hasClass('expandable_false')) {
        $('.collapse').collapse('hide');
        $("#" + accord_id).collapse('toggle');
    }

});

function checkDiscountPrice() {
    $(document).on('change', '#website_discountprice , #website_buynowprice', function () {
        var discount = parseInt($('#website_discountprice').val());
        var buy_now = parseInt($('#website_buynowprice').val());
        $(".txt_price").next().remove('span');
        if (discount > 0) {
            if ($('#website_buynowprice').val() == 0 || $('#website_buynowprice').val() == '' || $('#website_buynowprice').val() == undefined) {
                $(".txt_price").after('<span for="slug-error" class="error">Buy now price is requried </span>');
                return false;
            }
            if (buy_now > discount) {
                $(".txt_price").after('<span for="slug-error" class="error">Price must be Greater than buynow price</span>');
                return false;
            }
        }
    });
}


checkDiscountPrice();

/*--------------------------------------------------*/
/*  Submit Listings Form
/*--------------------------------------------------*/

$(document).on('submit', '#createListingForm', function (e) {
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(this);

    if ($('input[name=website_1_group_2]:checked', form).val() === 'auction') {
        if ($('#website_reserveprice').length > 0) {
            if ($('#website_reserveprice').val() !== '' && $('#website_startingprice').val() !== '') {
                if ($('#website_reserveprice').val() < $('#website_startingprice').val()) {
                    bootstrap_alert.error('Reserved Price should be greater than Minimum Price', '#submitValidaton');
                    return;
                }
            }
        }
    }
    var discount = parseInt($('#website_discountprice').val());
    var buy_now = parseInt($('#website_buynowprice').val());
    $(".txt_price").next().remove('span');
    if (discount > 0) {
        if ($('#website_buynowprice').val() == 0 || $('#website_buynowprice').val() == '' || $('#website_buynowprice').val() == undefined) {
            $(".txt_price").after('<span for="slug-error" class="error">Buy now price is requried </span>');
            return false;
        }
        if (buy_now > discount) {
            $(".txt_price").after('<span for="slug-error" class="error">Price must be Greater than buynow price</span>');
            return false;
        }
    }
    form.validate();
    if (form.valid()) {
        $('#loadingImageSubmit').show();
        $.ajax({
            type: 'POST',
            url: baseUrl + 'user/add_listing',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {

                $('.txt_csrfname').val(data.token);
                if (data.response !== false) {
                    var rData = data.response;
                    // bootstrap_alert.success('Successfully saved your listing.. Please wait..', '#submitValidaton');
                    $('#listing_id').val(rData.id);
                    $('#txt_listingid').val(rData.id);
                    $('#loadingImageSubmit').hide();
                    $("#ThirdTab").removeAttr('href');
                    $("#linkAnalyticsAdd").attr("href", baseUrl + "analytics/index/" + $('#domain_id').val() + "/" + $('#listing_id').val() + "/123");
                    $("#ThirdStep").show();
                    $("#collapseThree").collapse('hide');
                    $("#collapseFour").removeClass("expandable_false");
                    $("#stepfour").removeClass("expandable_false");
                    $("#FourthTab").removeClass("expandable_false");
                    $("#response_success").fadeIn();
                    $("#response_success").html("<span class='text-white bg-danger p-2'> <b> Record Updated </b></span>").delay(1000).fadeOut(400);
                    if (rData.listing_type != undefined) {
                        if ((rData.listing_type).trim() == 'app' || (rData.listing_type).trim() == 'business') {
                            console.log((rData.listing_type).trim() + " inside");
                            $("#collapseFive").collapse('toggle');
                            $("#FifthTab").removeClass("expandable_false");
                        } else {
                            $("#collapseFour").collapse('toggle');
                        }
                    }
                } else {
                    bootstrap_alert.error(updateError, '#submitValidaton');
                    $('#loadingImageSubmit').hide();
                    return;
                }
            },
        });
    }

});




/*--------------------------------------------------*/
/*  Admin Upladte Listings Form
/*--------------------------------------------------*/

$(document).on('submit', '#createListingFormAdmin', function (e) {
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(this);

    if ($('input[name=website_1_group_2]:checked', form).val() === 'auction') {
        if ($('#website_reserveprice').length > 0) {
            if ($('#website_reserveprice').val() !== '' && $('#website_startingprice').val() !== '') {
                if ($('#website_reserveprice').val() < $('#website_startingprice').val()) {
                    bootstrap_alert.error('Reserved Price should be greater than Minimum Price', '#submitValidaton');
                    return;
                }
            }
        }
    }

    form.validate();
    if (form.valid()) {
        $('#loadingImageSubmit').show();
        $.ajax({
            type: 'POST',
            url: baseUrl + 'admin/add_listing',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#loadingImageSubmit').hide();

                $("#response_success").fadeIn();
                $("#response_success").html("<span class='btn text-white btntheme_color_a mt-2 p-2'> <b> Record Updated </b></span>").
                    delay(2000).fadeOut(400);
                setTimeout(function () {
                    location.reload();
                }, 2000);
            },
        });
    }

});


/*--------------------------------------------------*/
/*   Category Form
/*--------------------------------------------------*/

$(document).on('submit', '#CategorySettingsForm', function (e) {
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(this);

    form.validate();
    if (form.valid()) {
        $('#loadingCategories').show();
        $.ajax({
            method: 'POST',
            url: baseUrl + 'admin/save_category_data',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response === true) {
                    bootstrap_alert.success(sucessfullycompleted, '#categoriesSettingsMsg');
                    $('#loadingCategories').hide();
                    location.reload(true);
                } else {
                    bootstrap_alert.error(updateError, '#categoriesSettingsMsg');
                    $('#loadingCategories').hide();
                    return;
                }
            },
        });
    }
});
$(document).on('submit', '#badgeForm', function (e) {
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(this);

    form.validate();
    if (form.valid()) {
        $('#loadingCategories').show();
        $.ajax({
            method: 'POST',
            url: baseUrl + 'admin/save_badge_data',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response === true) {
                    bootstrap_alert.success(sucessfullycompleted, '#categoriesSettingsMsg');
                    $('#loadingCategories').hide();
                    location.reload(true);
                } else {
                    bootstrap_alert.error(updateError, '#categoriesSettingsMsg');
                    $('#loadingCategories').hide();
                    return;
                }
            },
        });
    }
});

$(document).on('submit', '#manageAdvertisementForm', function (e) {
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(this);

    form.validate();
    if (form.valid()) {
        $('#loadingCategories').show();
        $.ajax({
            method: 'POST',
            url: baseUrl + 'admin/save_advertisement_data',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response === true) {
                    bootstrap_alert.success(sucessfullycompleted, '#categoriesSettingsMsg');
                    $('#loadingCategories').hide();
                    location.reload(true);
                } else {
                    bootstrap_alert.error(updateError, '#categoriesSettingsMsg');
                    $('#loadingCategories').hide();
                    return;
                }
            },
        });
    }
});
$(document).on('submit', '#couponForm', function (e) {
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(this);

    form.validate();
    if (form.valid()) {
        $('#loadingCategories').show();
        $.ajax({
            method: 'POST',
            url: baseUrl + 'admin/save_coupon_data',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response === true) {
                    bootstrap_alert.success(sucessfullycompleted, '#categoriesSettingsMsg');
                    $('#loadingCategories').hide();
                    location.reload(true);
                } else {
                    bootstrap_alert.error(updateError, '#categoriesSettingsMsg');
                    $('#loadingCategories').hide();
                    return;
                }
            },
        });
    }
});
/*--------------------------------------------------*/
/*   Monetization method Form
/*--------------------------------------------------*/

$(document).on('submit', '#MonetizationMethodSettingsForm', function (e) {
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(this);

    form.validate();
    if (form.valid()) {
        $('#loadingCategories').show();
        $.ajax({
            method: 'POST',
            url: baseUrl + 'admin/save_monetiztion_method_data',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response === true) {
                    bootstrap_alert.success(sucessfullycompleted, '#categoriesSettingsMsg');
                    $('#loadingCategories').hide();
                    location.reload(true);
                } else {
                    bootstrap_alert.error(updateError, '#categoriesSettingsMsg');
                    $('#loadingCategories').hide();
                    return;
                }
            },
        });
    }
});


/*--------------------------------------------------*/
/*   Seravice Type Form
/*--------------------------------------------------*/

$(document).on('submit', '#ServiceCategoryType', function (e) {
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(this);

    form.validate();
    if (form.valid()) {
        $('#loadingCategories').show();
        $.ajax({
            method: 'POST',
            url: baseUrl + 'admin/service_category_data',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response === true) {
                    bootstrap_alert.success(sucessfullycompleted, '#categoriesSettingsMsg');
                    $('#loadingCategories').hide();
                    location.reload(true);
                } else {
                    bootstrap_alert.error(updateError, '#categoriesSettingsMsg');
                    $('#loadingCategories').hide();
                    return;
                }
            },
        });
    }
});

/*--------------------------------------------------*/
/*   Solution Category Type Form
/*--------------------------------------------------*/

$(document).on('submit', '#SolutionCategoryForm', function (e) {
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(this);
    $('#txt_solution_url_slug').next().remove('span');
    form.validate();
    if (form.valid()) {
        $('#loadingCategories').show();
        $.ajax({
            method: 'POST',
            url: baseUrl + 'admin/save_solution_category_data',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response === true) {
                    bootstrap_alert.success(sucessfullycompleted, '#categoriesSettingsMsg');
                    $('#loadingCategories').hide();
                    location.reload(true);
                } else {
                    bootstrap_alert.error(updateError, '#categoriesSettingsMsg');
                    $('#loadingCategories').hide();
                    return;
                }
            },
        });
    }
});
/*--------------------------------------------------*/
/*  Category URL Slug Generator
/*--------------------------------------------------*/
$(document).on('change', '#category_name', function (e) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    title = $("#category_name").val();
    if ($("#category_name").val() !== '') {
        $.ajax({
            method: 'POST',
            url: baseUrl + 'common/category_urlSlugGenerator',
            data: {
                'title': title,
                [csrfName]: csrfHash
            },
            dataType: 'json',
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response) {
                    $("#category_url_slug").val(data.response);
                    return;
                }
            },
            complete: function () { },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    } else {
        $("#category_url_slug").val("");
    }
});


/*--------------------------------------------------*/
/*  Expert_directory URL Slug Generator
/*--------------------------------------------------*/
$(document).on('change', '#profile_name', function (e) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    profile_name = $("#profile_name").val();
    if ($("#profile_name").val() !== '') {
        $.ajax({
            method: 'POST',
            url: baseUrl + 'common/expert_urlSlugGenerator',
            data: {
                'profile_name': profile_name,
                [csrfName]: csrfHash
            },
            dataType: 'json',
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response) {
                    $("#expert_url_slug").val(data.response);
                    return;
                }
            },
            complete: function () { },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    } else {
        $("#expert_url_slug").val("");
    }
});


/*--------------------------------------------------*/
/*  Change Category Icon Upload
/*--------------------------------------------------*/
$(document).on('change', '#file-upload', function (e) {
    var i = $(this).prev('label').clone();
    var file = $('#file-upload')[0].files[0].name;
    $(this).prev('label').text(file);
});





/*--------------------------------------------------*/
/*  Membershipt URL Slug Generator
/*--------------------------------------------------*/
$(document).on('change', '#membership_listings_slug', function (e) {
    editMembership_urlSlugGenerator();
});

$(document).on('change', '#membership_name', function (e) {
    membership_urlSlugGenerator();
});

function membership_urlSlugGenerator() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    title = $("#membership_name").val();
    if ($("#membership_name").val() !== '') {
        $.ajax({
            method: 'POST',
            url: baseUrl + 'common/membership_urlSlugGenerator',
            data: {
                'title': title,
                [csrfName]: csrfHash
            },
            dataType: 'json',
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response) {
                    $("#membership_listings_slug").val(data.response);
                    return;
                }
            },
            complete: function () { },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    } else {
        $("#membership_listings_slug").val("");
    }
}

function editMembership_urlSlugGenerator() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    title = $("#membership_listings_slug").val();
    if ($("#membership_listings_slug").val() !== '') {
        $.ajax({
            method: 'POST',
            url: baseUrl + 'common/membership_urlSlugGenerator',
            data: {
                'title': title,
                [csrfName]: csrfHash
            },
            dataType: 'json',
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response) {
                    $("#membership_listings_slug").val(data.response);
                    return;
                }
            },
            complete: function () { },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    } else {
        $("#membership_listings_slug").val("");
    }
}




/*--------------------------------------------------*/
/*  App , Website , domain , business URL Slug Generator
/*--------------------------------------------------*/
$(document).on('change', '#listings_slug', function (e) {

    editListing_urlSlugGenerator();
});


$(document).on('change', '.appName', function (e) {
    listing_urlSlugGenerator();
});

function listing_urlSlugGenerator() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    title = $("#website_BusinessName").val();
    if ($("#website_BusinessName").val() !== '') {
        $.ajax({
            method: 'POST',
            url: baseUrl + 'common/listing_urlSlugGenerator',
            data: {
                'title': title,
                [csrfName]: csrfHash
            },
            dataType: 'json',
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response) {
                    $("#listings_slug").val(data.response);
                    return;
                }
            },
            complete: function () { },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    } else {
        $("#listings_slug").val("");
    }
}

function editListing_urlSlugGenerator() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    title = $("#listings_slug").val();
    if ($("#listings_slug").val() !== '') {
        $.ajax({
            method: 'POST',
            url: baseUrl + 'common/listing_urlSlugGenerator',
            data: {
                'title': title,
                [csrfName]: csrfHash
            },
            dataType: 'json',
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response) {
                    $("#listings_slug").val(data.response);
                    return;
                }
            },
            complete: function () { },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    } else {
        $("#listings_slug").val("");
    }
}




/*--------------------------------------------------*/
/*   Listing Header Form
/*--------------------------------------------------*/

$(document).on('submit', '#ListingsSettingsForm', function (e) {
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(this);
    form.validate();
    if (form.valid()) {
        $('#loadinglistings').show();
        $.ajax({
            type: 'POST',
            url: baseUrl + 'admin/save_listing_header_data',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response === true) {
                    bootstrap_alert.success(sucessfullycompleted, '#listingSettingsMsg');
                    $('#loadinglistings').hide();
                    location.reload(true);
                } else {
                    bootstrap_alert.error(updateError, '#listingSettingsMsg');
                    $('#loadinglistings').hide();
                    return;
                }
            },
        });
    }

});


/*--------------------------------------------------*/
/*  Listing URL Change Event
/*--------------------------------------------------*/




//     $("#siteURL").prop('readonly', true);
//     var csrfName = $('.txt_csrfname').attr('name');
//     var csrfHash = $('.txt_csrfname').val();
//     $("#btnfoward").hide();
//     if ($("#selectedCategory").val() === '') {
//         $("#domainVerificationDiv").hide();
//         return;
//     }

//     if ($("#siteURL").val() === '') {
//         $("#domainVerificationDiv").hide();
//         return;
//     }

//     if (!isUrlValid($("#siteURL").val())) {
//         $("#domainVerificationDiv").hide();
//         bootstrap_alert.error(errorinvalidUrl, '#DomainValMsg');
//         $("#siteURL").prop('readonly', false);
//         return;
//     }

//     CheckBlacklistedDomains($("#siteURL").val(), function (response) {
//         if (response === true) {
//             bootstrap_alert.error(errorBlacklistedDomain, '#DomainValMsg');
//             $("#domainVerificationDiv").hide();
//             return;
//         } else {
//             $("#domainVerificationDiv").show();
//             $("#loadingImageVerify").show();

//             $.ajax({
//                 url: baseUrl + 'common/uploadFileGenerator/',
//                 type: "POST",
//                 data: {
//                     lisingtDomain: $("#siteURL").val(),
//                     [csrfName]: csrfHash
//                 },
//                 dataType: "json",
//                 success: function (data) {
//                     if (data !== '') {
//                         if (data.response !== false) {
//                             $('.txt_csrfname').val(data.token);
//                             $("#loadingImageVerify").hide();
//                             loadingInfo = '<div>' +
//                                 '1). DOWNLOAD FILE : &nbsp;<a href="' + baseUrl + '/assets/verification/' + data.response['token'] + '.zip' + '" class="btn btn-success">DOWNLOAD FILE</a><br>' +
//                                 '2). UNZIP AND UPLOAD .TXT FILE TO YOUR DOMAIN ROOT FOLDER<br>' +
//                                 '3). <b>IF YOU HAVE DONE EVERYTHING RIGHT YOU SHOULD BE ABLE TO ACCESS THE FILE FROM FOLLOWING URL</b>' +
//                                 '<a style="display: inline-block;" href="' + '//' + data.response['domain'] + '/' + data.response['token'] + '.txt' + '" target="_blank">' + 'http://' + data.response['domain'] + '/' + data.response['token'] + '.txt' + '</a><br>' +
//                                 '4). NOW PLEASE VERIFY : <button id="btnVerifyDomain" name="btnVerifyDomain" type="button" class="btn btn-info centerButtons">VERIFY</button>' +
//                                 '</div></br>' +
//                                 '';
//                             $('#savedDataInfo').val(JSON.stringify(data.response));
//                             if (data.response.validations === true) {
//                                 $("#verificationFile").html(loadingInfo);
//                                 return;
//                             } else {
//                                 var values = $('#savedDataInfo').val();
//                                 values = JSON.parse(values);
//                                 $("#domainVerificationDiv").hide();
//                                 bootstrap_alert.success('Successfully Verified your domain.. Please wait..', '#DomainValMsg');
//                                 csrfName = $('.txt_csrfname').attr('name');
//                                 csrfHash = $('.txt_csrfname').val();
//                                 $('#loadingImageContinue').show();
//                             
//                                 $.ajax({
//                                     url: baseUrl + 'common/checkListingExists/',
//                                     type: "POST",
//                                     data: {
//                                         lisingtDomain: $("#siteURL").val(),
//                                         branch_1_group_1: $('#listing_type').val(),
//                                         [csrfName]: csrfHash
//                                     },
//                                     dataType: "json",
//                                     success: function (data) {
//                                         $('.txt_csrfname').val(data.token);
//                                         if (data.response === true) {
//                                             bootstrap_alert.error('Sorry, You already have a listing for this domain.', '#DomainValMsg');
//                                             $('#loadingImageContinue').hide();
//                                             $("#btnfoward").hide();
//                                             return;
//                                         } else {
//                                             $('#loadingImageContinue').hide();
//                                             bootstrap_alert.success('Please wait..', '#ContinueVal');
//                                             $("#siteURL").prop("readonly", true);
//                                             setTimeout(function () {
//                                                 $("#domainName").html(values.domain);
//                                                 $("#WebsiteName").html(values.domain);
//                                                 $("#website_BusinessName").val(values.domain);
//                                                 $("#domainTitle").html(values.domain);
//                                                 $("#domain_id").val(values.id);
//                                                 $("#FirstTab").removeAttr('href');
//                                                 $("#FirstStep").show();
//                                                 $("#collapseOne").collapse('hide');
//                                                 $("#collapseTwo").collapse('toggle');
//                                             }, 3000);
//                                             return;
//                                         }
//                                     }
//                                 });
//                             }
//                         } else {
//                             $("#loadingImageVerify").hide();
//                             $("#siteURL").prop('disabled', false);
//                             bootstrap_alert.error('Something Went Wrong', '#DomainValMsg');
//                             return;
//                         }
//                     }
//                 }
//             });
//         }
//     });
// });


/*--------------------------------------------------*/
/*  App URL Change Event
/*--------------------------------------------------*/

// $(document).on('change', '#appURL', function (e) {
//     var csrfName = $('.txt_csrfname').attr('name');
//     var csrfHash = $('.txt_csrfname').val();
//     $("#loadingImageVerify").show();
//     if (!isUrlValid($("#appURL").val())) {
//         bootstrap_alert.error(errorinvalidUrl, '#AppUrlValMsg');
//         $("#loadingImageVerify").hide();
//         return;
//     }

//     CheckPlaystoreApp($("#appURL").val(), function (response) {
//         if (response === false) {
//             bootstrap_alert.error(errorIvalidAppURL, '#AppUrlValMsg');
//             $("#loadingImageVerify").hide();
//             return;
//         } else {
//             $("#loadingImageVerify").hide();
//             bootstrap_alert.success('Please wait..', '#ContinueVal');
//             $("#appURL").prop("readonly", true);
//             setTimeout(function () {
//                 $("#FirstTab").removeAttr('href');
//                 $("#FirstStep").show();
//                 $("#collapseOne").collapse('hide');
//                 $("#collapseTwo").collapse('toggle');
//             }, 3000);
//             return;
//         }
//     });
// });


/*--------------------------------------------------*/
/*  Button Verification Click
/*--------------------------------------------------*/

$(document).on('click', '#btnVerifyDomain', function () {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $("#loadingImageVerify").show();
    var values = $('#savedDataInfo').val();
    values = JSON.parse(values);

    $.ajax({
        url: baseUrl + 'common/readAndVerifyDomain/',
        type: "POST",
        data: {
            dataArr: values,
            [csrfName]: csrfHash
        },
        dataType: "json",
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data !== '') {
                if (data.response !== false) {
                    $("#loadingImageVerify").hide();
                    // bootstrap_alert.success('Successfully Verified your domain.. Please wait..', '#DomainValMsg');
                    csrfName = $('.txt_csrfname').attr('name');
                    csrfHash = $('.txt_csrfname').val();
                    $('#loadingImageContinue').show();
                    $.ajax({
                        url: baseUrl + 'common/checkListingExists/',
                        type: "POST",
                        data: {
                            lisingtDomain: $("#siteURL").val(),
                            branch_1_group_1: $('#listing_type').val(),
                            [csrfName]: csrfHash
                        },
                        dataType: "json",
                        success: function (data) {
                            $('.txt_csrfname').val(data.token);
                            if (data.response === true) {
                                bootstrap_alert.error('Sorry, You already have a listing for this domain.', '#DomainValMsg');
                                $('#loadingImageContinue').hide();
                                $("#btnfoward").hide();
                                return;
                            } else {
                                $('#loadingImageContinue').hide();
                                // bootstrap_alert.success('Please wait..', '#ContinueVal');
                                // $("#siteURL").prop("readonly", true);
                                setTimeout(function () {
                                    $("#domainName").html(values.domain);
                                    $("#WebsiteName").html(values.domain);
                                    $("#website_BusinessName").val(values.domain);
                                    $("#domainTitle").html(values.domain);
                                    $("#domain_id").val(values.id);
                                    $("#FirstTab").removeAttr('href');
                                    $("#FirstStep").show();
                                    $("#collapseOne").collapse('hide');
                                    $("#collapseTwo").collapse('toggle');
                                }, 3000);
                                return;
                            }
                        }
                    });
                } else {
                    $("#loadingImageVerify").hide();
                    $("#btnfoward").hide();
                    //bootstrap_alert.error('Verification Failed.. Please try again', '#DomainValMsg');
                    return;
                }

            } else {
                $("#loadingImageVerify").hide();
                $("#btnfoward").hide();
                bootstrap_alert.error('Something Went Wrong', '#DomainValMsg');
                return;
            }
        }
    });
});


$('input[type=radio][name=branch_1_group_2]').change(function () {
    if (this.value === 'Sell-Auction') {
        $('#Sell-Auction').show();
        $("#Sell-Classified").hide();
    } else {
        $("#Sell-Auction").hide();
        $('#Sell-Classified').show();
    }
});


$('input[type=radio][name=branch_1_pay_1]').change(function () {

    if (this.value === 'payvia_card') {
        showDiv('#Pay_Credit_Card');
        hideDiv('#Pay_paypal');
        hideDiv('#Pay_free');
        hideDiv('#Pay_stripe');
    } else if (this.value === 'payvia_paypal') {
        hideDiv('#Pay_Credit_Card');
        showDiv('#Pay_paypal');
        hideDiv('#Pay_free');
        hideDiv('#Pay_stripe');
    } else if (this.value === 'payvia_stripe') {
        hideDiv('#Pay_Credit_Card');
        hideDiv('#Pay_paypal');
        hideDiv('#Pay_free');
        showDiv('#Pay_stripe');
    } else if (this.value === 'free_checkout') {
        hideDiv('#Pay_Credit_Card');
        hideDiv('#Pay_paypal');
        showDiv('#Pay_free');
        hideDiv('#Pay_stripe');
    }

});

/*--------------------------------------------------*/
/*  Pricing Option Change Calculations
/*--------------------------------------------------*/
$('input[type=radio][name=listing_group_1]').change(function () {

    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $('#LoadingPayCalVal').show();
    $('#btnfoward').hide();
    // bootstrap_alert.success('Please wait..', '#PayCalVal');
    $.ajax({
        method: 'POST',
        url: baseUrl + 'user/get_selectedListingHeader/' + this.value,
        data: {
            [csrfName]: csrfHash
        },
        dataType: "json",
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response !== false) {
                dataArr = data.response;
                Output = '<li>' + dataArr[0].listing_name + '-' + ' $ ' + dataArr[0].listing_price + '</li>';
                $('#listings').html(Output);
                $('#txt_payid').val(dataArr[0].listing_id);
                $('.txt_listingname').val(dataArr[0].listing_name);
                $('.txt_listamount').val(dataArr[0].listing_price);
                $('#txt_payamount').val(dataArr[0].listing_price);
                $('#LoadingPayCalVal').hide();
                $('#btnfoward').show();
            }
        },
        complete: function () {
            $('#LoadingPayCalVal').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});


/*--------------------------------------------------*/
/* Listing Sponsor Option Changed Calculations
/*--------------------------------------------------*/
/*--------------------------------------------------*/
/* Listing Sponsor Option Changed Calculations
/*--------------------------------------------------*/
$('input[type=radio][name=sponsor_group_1]').change(function () {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $('#LoadingPayCalVal').show();
    $('#btnfoward').hide();
    bootstrap_alert.success('Please wait..', '#PayCalVal');
    $.ajax({
        method: 'POST',
        url: baseUrl + 'user/get_selectedListingHeader/' + this.value,
        data: {
            [csrfName]: csrfHash
        },
        dataType: "json",
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response !== false) {
                dataArr = data.response;
                var TotalAmount = parseFloat(dataArr[0].listing_price) + parseFloat($('.txt_listamount').val());
                Output = '<li>' + $('.txt_listingname').val() + '-' + currency_code + $('.txt_listamount').val() + '</li>' +
                    '<li>' + dataArr[0].listing_name + '-' + currency_code + dataArr[0].listing_price + '</li>';
                $('#listings').html(Output);
                $('#total').html('<b>TOTAL AMOUNT : </b> ' + currency_code + TotalAmount);
                $('#txt_sponsored_id').val(dataArr[0].listing_id);
                $('#txt_payamount').val(TotalAmount);
                $('#LoadingPayCalVal').hide();
                $('#btnfoward').show();
            }
        },
        complete: function () {
            $('#LoadingPayCalVal').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) { alert(thrownError); }
    });
});


/*--------------------------------------------------*/
/* Last 12 Months Revenue Anual Profit Change
/*--------------------------------------------------*/
$(document).on('keyup', '#last12_monthsrevenue', function (e) {
    e.preventDefault();
    // //if (this.value !== '') {
    //    if ($('#last12_monthsexpenses').val() !== '') {
    $('#annual_profit').val(this.value - $('#last12_monthsexpenses').val());
    //    }
    //}
});

/*--------------------------------------------------*/
/* Last 12 Months Revenue Expenses Change
/*--------------------------------------------------*/
$(document).on('keyup', '#last12_monthsexpenses', function (e) {
    e.preventDefault();
    // if (this.value !== '') {
    // if ($('#last12_monthsrevenue').val() !== '') {
    $('#annual_profit').val($('#last12_monthsrevenue').val() - this.value);
    // }
    // }
});

/*--------------------------------------------------*/
/* Last 12 Months Revenue Anual Profit Change
/*--------------------------------------------------*/
$(document).on('keyup', '#last12_monthsrevenue1', function (e) {
    e.preventDefault();
    // //if (this.value !== '') {
    //    if ($('#last12_monthsexpenses').val() !== '') {
    $('#annual_profit1').val(this.value - $('#last12_monthsexpenses1').val());
    //    }
    //}
});

/*--------------------------------------------------*/
/* Last 12 Months Revenue Expenses Change
/*--------------------------------------------------*/
$(document).on('keyup', '#last12_monthsexpenses1', function (e) {
    e.preventDefault();
    // if (this.value !== '') {
    // if ($('#last12_monthsrevenue').val() !== '') {
    $('#annual_profit1').val($('#last12_monthsrevenue1').val() - this.value);
    // }
    // }
});


/*--------------------------------------------------*/
/* Last 12 Months Revenue Profit Calculation
/*--------------------------------------------------*/
$(document).on('keyup', '#website_reserveprice', function (e) {
    e.preventDefault();
    //if (this.value !== '' && $('#website_startingprice').val() !== '') {
    if (this.value < $('#website_startingprice').val()) {
        bootstrap_alert.error('Reserved Price should be greater than Minimum Price', '#reservredPriceWebsite');
        return;
    }
    //}
});

/*--------------------------------------------------*/
/* Domain Reserved Price Change Event
/*--------------------------------------------------*/
$(document).on('keyup', '#domain_reserveprice', function (e) {
    // e.preventDefault();
    if (this.value !== '' && $('#domain_startingprice').val() !== '') {
        if (this.value < $('#domain_startingprice').val()) {
            bootstrap_alert.error('Reserved Price should be greater than Minimum Price', '#reservredPriceHelp');
            return;
        }
    }
});


/*--------------------------------------------------
|  Withdrawal User Reviews 
/*--------------------------------------------------*/
$(document).on("click", ".paginationReviews li a", function (e) {
    // e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $.ajax({
        url: baseUrl + "main/profile_reviews/" + $('#profile_id').val() + '/' + $(this).attr('data-ci-pagination-page'),
        method: "POST",
        data: {
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $('#user_reviews_tab').fadeOut(100).html(data.response).fadeIn(500);
        }
    });
});

/*--------------------------------------------------
|  Link Google Analytics Button
/*--------------------------------------------------*/
$(document).on('click', '#link_googleAnalytics', function (e) {
    // e.preventDefault();
    $('#wrapped').attr('action', baseUrl + "analytics/index").submit();
});

/*--------------------------------------------------
|  Unlink Google Analytics Button
/*--------------------------------------------------*/
$(document).on('click', '#unlink_googleAnalytics', function (e) {
    e.preventDefault();
    window.location = baseUrl + "analytics/unlink/" + $('#domain_id').val();
});

/*--------------------------------------------------
| Listing Type Selection
/*--------------------------------------------------*/
$('input[type=radio][name=website_1_group_2]').change(function () {
    if (this.value === 'auction') {
        hideDiv('#Sell-Classified-Website');
        showDiv('#Sell-Auction-Website');
        $("#website_buynowpriceclas").prop('disabled', true);
        $("#website_buynowpriceauc").prop('disabled', false);
    } else {
        hideDiv('#Sell-Auction-Website');
        showDiv('#Sell-Classified-Website');
        $("#website_buynowpriceauc").prop('disabled', true);
        $("#website_buynowpriceclas").prop('disabled', false);
    }
});


/*--------------------------------------------------
|  Cancel Offer
/*--------------------------------------------------*/
$(document).on('click', '.cancel_offer', function (e) {
    e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $(this).prop('disabled', true);
    $.ajax({
        method: 'POST',
        url: baseUrl + 'user/update_offer_status/' + $(this).attr("data-offerid"),
        data: {
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $(this).prop('disabled', false);
            if (data.response !== false) {
                location.reload(true);
            }
        },
        complete: function () {

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});

/*--------------------------------------------------
|  Accept Cancel Request
/*--------------------------------------------------*/
$(document).on('click', '.accept_cancel', function (e) {
    e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $(this).prop('disabled', true);
    $('#loadercontract').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'main/acceptCancelreq/' + $(this).attr("data-contractid"),
        data: {
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $(this).prop('disabled', false);
            location.reload(true);
            if (data.response !== false) {
                $('#loadercontract').hide();
            }
        },
        complete: function () {
            $('#loadercontract').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});


/*--------------------------------------------------
|  Upload Google Key
/*--------------------------------------------------*/
$("#upload_key_form").submit(function (e) {
    e.preventDefault();
    var data = new FormData(this);
    $('#loaderkey').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'admin/upload_key/',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success("Sucessfully Uploaded", '#notificationkey');
                $('#loaderkey').hide();
            } else {
                bootstrap_alert.error(updateError, '#notificationkey');
                $('#loaderkey').hide();
            }
        },
        complete: function () {
            $('#loaderkey').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});


/*--------------------------------------------------
|  Upload Bulk Import
/*--------------------------------------------------*/
$("#upload_bulk_import").submit(function (e) {
    e.preventDefault();
    $("#upload_bulk_import_btn").attr("disabled", true);
    var data = new FormData(this);
    $('#loaderkey').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'admin/bulk_import/',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success("Sucessfully Imported", '#notificationkey');
                $("#upload_bulk_import_btn").attr("disabled", false);
                $('#loaderkey').hide();
            } else {
                bootstrap_alert.error(data.response, '#notificationkey');
                $("#upload_bulk_import_btn").attr("disabled", false);
                $('#loaderkey').hide();
            }
        },
        complete: function () {
            $('#loaderkey').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});


/*--------------------------------------------------
|  Reject Cancel Request
/*--------------------------------------------------*/
$(document).on('click', '.reject_cancel', function (e) {
    e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $('#loadercontract').show();
    $(this).prop('disabled', true);
    $.ajax({
        method: 'POST',
        url: baseUrl + 'main/rejectCancelreq/' + $(this).attr("data-contractid"),
        data: {
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            location.reload(true);
            $('.txt_csrfname').val(data.token);
            $(this).prop('disabled', false);
            $('#loadercontract').hide();
            if (data.response !== false) {
                location.reload(true);
            }
        },
        complete: function () {
            $('#loadercontract').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});


/*--------------------------------------------------
|  Raise a Dispute
/*--------------------------------------------------*/
$(document).on('click', '.raise_dispute', function (e) {
    e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $('#loadercontract').show();
    $(this).prop('disabled', true);
    $.ajax({
        method: 'POST',
        url: baseUrl + 'main/raisedaDispute/' + $(this).attr("data-contractid"),
        data: {
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $(this).prop('disabled', false);
            $('#loadercontract').hide();
            if (data.response !== false) {
                location.reload(true);
            }
        },
        complete: function () {
            $('#loadercontract').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});


/*--------------------------------------------------
|  Place an Offer
/*--------------------------------------------------*/
$(document).on('submit', '.offer-now-form', function (e) {
    e.preventDefault();
    $('#loaderoffer').show();
    if ($('.offer_amount').val() === "") {
        $('#loaderoffer').hide();
        bootstrap_alert.error('Please enter a Offer Value ', '#offerValidation');
        return;
    }

    if ($('.offer_amount').val() < (parseFloat($('.offer_min_value').val()))) {
        $('#loaderoffer').hide();
        bootstrap_alert.error('Offer Value Must be Greater than ' + (parseFloat($('.offer_min_value').val())), '#offerValidation');
        return;
    }

    $.ajax({
        method: 'POST',
        url: baseUrl + 'main/add_offer',
        data: $(".offer-now-form").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                $('#loaderoffer').hide();
                $('.offer_amount').val('');
                $('.offer_msg').val('');
                $.magnificPopup.close();
                $('#OfferSuccessfull').modal('show');
            } else {
                $('#loaderoffer').hide();
                bootstrap_alert.error(data.response, '#offerValidation');
                return;
            }
        },
        complete: function () { },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});

/*--------------------------------------------------
|  Place a Bid
/*--------------------------------------------------*/
$(document).on('submit', '#bid-now-form', function (e) {
    e.preventDefault();
    $('#loader').show();
    if ($('#bid_amount').val() === "") {
        $('#loader').hide();
        bootstrap_alert.error('Please enter a Bid Value', '#bidValidation');
        return;
    }

    if ($('#bid_amount').val() < (parseFloat($('#current_bid_value').val()) + parseFloat($('#bid_gap_value').val()))) {
        $('#loader').hide();
        bootstrap_alert.error('Bid Value Must be Greater than ' + (parseFloat($('#current_bid_value').val()) + parseFloat($('#bid_gap_value').val())), '#bidValidation');
        return;
    }

    $.ajax({
        method: 'POST',
        url: baseUrl + 'main/add_bid',
        data: $("#bid-now-form").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                $('#loader').hide();
                $('#bid_amount').val('');
                $.magnificPopup.close();
                $('#BidSuccessfull').modal('show');
            } else {
                $('#loader').hide();
                bootstrap_alert.error(data.response, '#bidValidation');
                return;
            }
        },
        complete: function () { },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });

});

/*--------------------------------------------------
|  Radio Button Change
/*--------------------------------------------------*/
$(document).on('change', '[type*="radio"]', function (e) {
    var me = $(this);
});


/*--------------------------------------------------
|  Review Submit Form
/*--------------------------------------------------*/
$(document).on('submit', '#leave-review-form', function (e) {
    e.preventDefault();
    if ($("input[name='rating']:checked").val() === "") {
        bootstrap_alert.error('Please enter a Bid Value', '#reviewVal');
        return;
    }

    $.ajax({
        method: 'POST',
        url: baseUrl + 'main/post_review',
        data: $("#leave-review-form").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                $('#review_msg').val('');
                $.magnificPopup.close();
                location.reload(true);
            } else {
                bootstrap_alert.error(updateError, '#reviewVal');
                return;
            }
        },
        complete: function () {

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });

});

/*----------------------------------------------------------------------
| Add Notification
------------------------------------------------------------------------*/
function add_notification(subject, notification, url) {
    $.ajax({
        type: "POST",
        url: baseUrl + "user/add_notification",
        data: {
            subject: subject,
            notification: notification,
            url: url
        },
        cache: false,
        success: function (response) {

        }
    });
}

/*----------------------------------------------------------------------
| Successful Bid Popup Hidden 
------------------------------------------------------------------------*/
$(document).on('hidden.bs.modal', '#BidSuccessfull', function () {
    location.reload(true);
});

/*----------------------------------------------------------------------
| Function to submit comment
------------------------------------------------------------------------*/
$(document).on('submit', '#commentsForm', function (e) {
    e.preventDefault();
    var txtarea = $('#write-comment');
    var message = txtarea.val();
    if (message !== "") {
        txtarea.val('');
        $.ajax({
            type: "POST",
            url: baseUrl + "common/insert_comment",
            data: $("#commentsForm").serialize(),
            dataType: 'json',
            cache: false,
            success: function (response) {
                $('.txt_csrfname').val(response.token);
                $('.txt_csrfname').attr('name', response.token_name);
                if (response.response !== false) {
                    // 
                    // loadComments($('#comment_listing').val(), $('#comment_section').val());
                    // return;
                    bootstrap_alert.success('Your comment has been added.', '#commentsVal');
                    setTimeout(function(){
                        location.reload(); 
                     }, 500);
                    
                } else {
                    bootstrap_alert.success(updateError, '#commentsVal');
                }
            }
        });
    } else {
        bootstrap_alert.error('Failed', '#commentsVal');
        return;
    }
});


/*----------------------------------------------------------------------
| Load Comments
------------------------------------------------------------------------*/
function loadComments(id, type) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $.ajax({
        type: "POST",
        url: baseUrl + "user/get_comments",
        data: {
            listing_id: id,
            type: type,
            [csrfName]: csrfHash
        },
        dataType: "json",
        cache: false,
        success: function (threads) {
            $('.txt_csrfname').val(threads.token);
            $('#prev-comment').empty();

            $.each(threads.response, function (key, thread) {

                if (thread.author_comment === '0') {
                    comment = '<li  class="comment-auction user-comment">' +
                        '<div class="info-comments">' +
                        '<a href="#">' + thread.firstname + '</a>' +
                        '<span>' + thread.ago + '</span>' +
                        '</div>' +
                        '<a class="avatar-comments" href="#">' +
                        '<img src="' + baseUrl + 'assets/img/users/' + thread.thumbnail + '" width="35" alt="Profile Avatar" title="' + thread.firstname + '" />';
                    '</a>' +
                        '<p>' + thread.body + '</p>' +
                        '</li>';
                } else {
                    comment = '<li  class="comment-auction author-comment">' +
                        '<div class="info-comments">' +
                        '<a href="#">' + thread.firstname + ' (Author)</a>' +
                        '<span>' + thread.ago + '</span>' +
                        '</div>' +
                        '<a class="avatar-comments" href="#">' +
                        '<img src="' + baseUrl + 'assets/img/users/' + thread.thumbnail + '" width="35" alt="Profile Avatar" title="' + thread.firstname + '" />';
                    '</a>' +
                        '<p>' + thread.body + '</p>' +
                        '</li>';
                }

                $('#prev-comment').append(comment);
                $('#write-comment').val('');
                $('#prev-comments').load(location.href + " #prev-comments");
            });
        }

    });
}

/*----------------------------------------------------------------------
| User Details Save Form
------------------------------------------------------------------------*/
$(document).on('submit', '#UserAssingnPermissionForm', function (e) {
    e.preventDefault();
    $('#loader').show();
    var data = new FormData(this);
    $.ajax({
        method: 'POST',
        url: baseUrl + 'common/SaveUserSettings',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function (data) {
            if (data.response === true) {
                $('.txt_csrfname').val(data.token);
                bootstrap_alert.success(sucessfullycompleted, '#validator');
            } else {
                bootstrap_alert.error(updateError, '#validator');
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });

});

/*----------------------------------------------------------------------
| User Details Save Form
------------------------------------------------------------------------*/
$(document).on('submit', '#UserDetailsChangeForm', function (e) {
    e.preventDefault();
    $('#loader').show();
    var data = new FormData(this);
    $.ajax({
        method: 'POST',
        url: baseUrl + 'common/SaveUserSettings',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function (data) {
            if (data.response === true) {
                $('.txt_csrfname').val(data.token);
                bootstrap_alert.success(sucessfullycompleted, '#validator');
            } else {
                bootstrap_alert.error(updateError, '#validator');
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });

});


/*----------------------------------------------------------------------
| Password Change Form
------------------------------------------------------------------------*/
$(document).on('submit', '#ChangePasswordForm', function (e) {
    e.preventDefault();
    $('#loadingImageChangePassword').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'common/changePasswordUpdate',
        data: $("#ChangePasswordForm").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success(sucessfullycompleted, '#buttonChangePassword');
            } else {
                bootstrap_alert.error(updateError, '#buttonChangePassword');
            }
        },
        complete: function () {
            $('#loadingImageChangePassword').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });

});

/*--------------------------------------------------
|  User Status Switch
/*--------------------------------------------------*/

if ($('.status-switch label.user-invisible').hasClass('current-status')) {
    $('.status-indicator').addClass('right');
}

$('.status-switch label.user-invisible').on('click', function () {
    $('.status-indicator').addClass('right');
    $('.status-switch label').removeClass('current-status');
    $('.user-invisible').addClass('current-status');
    $('.user-avatar,.status-icon').removeClass('status-online');
    changeStatusTo(0)
});

$('.status-switch label.user-online').on('click', function () {
    $('.status-indicator').removeClass('right');
    $('.status-switch label').removeClass('current-status');
    $('.user-online').addClass('current-status');
    $('.user-avatar,.status-icon').addClass('status-online');
    changeStatusTo(1)
});


/*--------------------------------------------------
|  User Status Switch Function
/*--------------------------------------------------*/
function changeStatusTo(status) {
    $.ajax({
        type: "POST",
        url: baseUrl + "common/ChangeUserOnlineStatus",
        data: {
            status: status,
            [csrfName]: csrfHash
        },
        dataType: 'json',
        cache: false,
    });
}
/*--------------------------------------------------
|  Open Contract Dialog Box Open
/*--------------------------------------------------*/

$('.popup-with-open-contract').click(function () {
    $('#offer-amount').html($(this).data('bidcur') + addCommas($(this).data('bidamount')));
    $('#offer-from').html('Open Contract With ' + $(this).data('bidder'));
    $('#o_bid_id_cont').val($(this).data('bidid'));
    $('#businessName').html($(this).data('bidid'));
    $('#customerName').html($(this).data('bidder'));
    $('#bid_amount').html($(this).data('bidcur') + addCommas($(this).data('bidamount')));
});

$('.popup-with-open-contract').magnificPopup({
    type: 'inline',

    fixedContentPos: false,
    fixedBgPos: true,

    overflowY: 'auto',

    closeBtnInside: true,
    preloader: false,

    midClick: true,
    removalDelay: 300,
    mainClass: 'my-mfp-zoom-in',
    disableOn: function () {
        if (userID === '') {
            popnotificaton('<b> Please login to accept the offer </b>', 'info');
            setTimeout(function () {
                window.location.replace(baseUrl + "login");
            }, 2000);
            return false;
        }
        return true;
    },
    callbacks: {
        open: function () {

        },
        close: function () {

        }

    }
});


/*--------------------------------------------------
|  Offer Accept Dialog Box Open
/*--------------------------------------------------*/

$('.popup-with-accept-offer').click(function () {
    $('#offer-amount').html($(this).data('bidcur') + addCommas($(this).data('bidamount')));
    $('.offer-from').html('Accept Offer From ' + $(this).data('bidder'));
    $('#offer_id').val($(this).data('bidid'));
    $('#businessName').html($(this).data('bidid'));
    $('#customerName').html($(this).data('bidder'));
    $('#bid_amount').html($(this).data('bidcur') + addCommas($(this).data('bidamount')));
});

$('.popup-with-accept-offer').magnificPopup({
    type: 'inline',

    fixedContentPos: false,
    fixedBgPos: true,

    overflowY: 'auto',

    closeBtnInside: true,
    preloader: false,

    midClick: true,
    removalDelay: 300,
    mainClass: 'my-mfp-zoom-in',
    disableOn: function () {
        if (userID === '') {
            popnotificaton('<b> Please login to accept the offer </b>', 'info');
            setTimeout(function () {
                window.location.replace(baseUrl + "login");
            }, 2000);
            return false;
        }
        return true;
    },
    callbacks: {
        open: function () {

        },
        close: function () {

        }

    }
});



/*--------------------------------------------------
|  Offer Accept Send Message
/*--------------------------------------------------*/


$('.popup-with-send-message').click(function () {
    $('#sendMessageh3').html('Direct Message To ' + $(this).data('bidder'));
    $('.owner_id').val($(this).data('ownerid'));
    $('#o_bid_id').html($(this).data('bidid'));
});


$('.popup-with-send-message').magnificPopup({
    type: 'inline',

    fixedContentPos: false,
    fixedBgPos: true,

    overflowY: 'auto',

    closeBtnInside: true,
    preloader: false,

    midClick: true,
    removalDelay: 300,
    mainClass: 'my-mfp-zoom-in',
    disableOn: function () {
        if (userID === '') {
            popnotificaton('<b> Please login to accept the offer </b>', 'info');
            setTimeout(function () {
                window.location.replace(baseUrl + "login");
            }, 2000);
            return false;
        }
        return true;
    },
    callbacks: {
        open: function () {

        },
        close: function () {

        }

    }
});


/*--------------------------------------------------
| Number Formatting
/*--------------------------------------------------*/

function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}


/*--------------------------------------------------
|  Accept Bidders
/*--------------------------------------------------*/

$('.popup-with-accept-bidders').click(function () {
    $('#avatarbids').html('<img src="' + $(this).data('thumbnail') + '" alt="" class="msgavatar centerButtons">');
    $('#offer-from').html('Accept Bids From ' + $(this).data('bidder'));
    $('.o_bid_id').val($(this).data('bidid'));
});

$('.popup-with-accept-bidders').magnificPopup({
    type: 'inline',

    fixedContentPos: false,
    fixedBgPos: true,

    overflowY: 'auto',

    closeBtnInside: true,
    preloader: false,

    midClick: true,
    removalDelay: 300,
    mainClass: 'my-mfp-zoom-in',
    disableOn: function () {
        if (userID === '') {
            popnotificaton('<b> Please login to accept the offer </b>', 'info');
            setTimeout(function () {
                window.location.replace(baseUrl + "login");
            }, 2000);
            return false;
        }
        return true;
    },
    callbacks: {
        open: function () {

        },
        close: function () {

        }

    }
});


/*--------------------------------------------------
|  Accept Bidders Form
/*--------------------------------------------------*/
$(document).on('submit', '#acceptBidderForm', function (e) {
    e.preventDefault();
    $('#loader').show();
    $.ajax({
        type: "POST",
        url: baseUrl + "user/accept_bidder",
        data: $("#acceptBidderForm").serialize(),
        cache: false,
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                $('#loader').hide();
                bootstrap_alert.success('Sucessfully Approved the Bids from this Bidder', '#acceptmsg');
                $('#manage_bidders').load(location.href + " #manage_bidders");
            } else {
                $('#loader').hide();
                bootstrap_alert.error(updateError, '#acceptmsg');
            }
        }
    });
});

/*--------------------------------------------------
|  Report Listing Form
/*--------------------------------------------------*/
$(document).on('submit', '#ReportForm', function (e) {
    e.preventDefault();

    if (userID === '') {
        popnotificaton('<b> Please login to perform this action </b>', 'info');
        setTimeout(function () {
            window.location.replace(baseUrl + "login");
        }, 2000);
        return false;
    }

    if ($('#txt_reason').val() === "") {
        bootstrap_alert.error('Please enter why do you report', '#validationMsg');
        return;
    }

    $.ajax({
        type: "POST",
        url: baseUrl + "user/insert_report",
        data: $("#ReportForm").serialize(),
        dataType: 'json',
        cache: false,
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success('Your Request has been sent', '#validationMsg');
                location.reload(true);
            } else {
                bootstrap_alert.error(updateError, '#validationMsg');
            }
        }
    });
});


/*--------------------------------------------------
|  Open Contract Time Left
/*--------------------------------------------------*/

function timeleft() {

    var today = new Date();
    var todayDate = today.toLocaleDateString();
    var todayDateYear = parseInt(todayDate.substr(0, 4));
    var todayDateMonth = parseInt(todayDate.substr(4, 6).replace("-", ""));
    var todayDateDay = parseInt(todayDate.substr(6).replace("-", ""));
    var todayTime = today.toLocaleTimeString();
    var todayTimeHour = parseInt(todayTime.substr(0, 2).replace("/", ""));
    var todayTimeMinutes = parseInt(todayTime.substr(3).replace("/", ""));

    var completeZero = function (x) {
        if (x < 10) return '0' + x;
        return x;
    };

    todayDateDay = completeZero(todayDateDay);
    todayDateMonth = completeZero(todayDateMonth);
    todayTimeHour = completeZero(todayTimeHour);
    todayTimeMinutes = completeZero(todayTimeMinutes);

    var deadline = 0;

    var getTime = function () {
        var t = Date.parse(deadline) - Date.parse(new Date());
        var seconds = Math.floor(t / 1000 % 60);
        var minutes = Math.floor(t / 1000 / 60 % 60);
        var hours = Math.floor(t / (1000 * 60 * 60) % 24);
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };

    };

    var time = function () {
        timeleft = getTime();
        d = timeleft.days >= 0 ? timeleft.days : 0;
        h = timeleft.hours >= 0 ? timeleft.hours : 0;
        m = timeleft.minutes >= 0 ? timeleft.minutes : 0;
        s = timeleft.seconds >= 0 ? timeleft.seconds : 0;

        d = completeZero(d);
        h = completeZero(h);
        m = completeZero(m);
        s = completeZero(s);

        var color = 'rgb(' +
            Math.round((24 - h) * 255 / 24) + ',' +
            0 + ',' + // Math.round(m * 100 / 60) + ',' +
            0 + ')'; // Math.round(s * 100 / 60) + ')';

        if (d > 0) {
            document.getElementById("days").innerHTML = '<span>' + d + '</span> days,';
        }
        if (h > 0 || m > 0 || s > 0) {
            document.getElementById("time").innerHTML = h + ':' + m + ':' + '<span>' + s + '</span>';
            document.getElementById("container").style["background-color"] = color;
            setTimeout(function () {
                time();
            }, 1000);
            document.getElementById("action").style.opacity = 0;
        } else {
            document.getElementById("action").style.opacity = 100;
            document.getElementById("time").innerHTML = "time's " + '<span>up.</span>';
        }
    };

    deadline = dateval + " ";
    deadline += timeval;

    time();

}


/*--------------------------------------------------
|  Withdrawal Method Change
/*--------------------------------------------------*/
$(document).on('change', '#withdrawal_method', function (e) {
    e.preventDefault();
    if (this.value !== '' && $('#domain_startingprice').val() !== '') {
        if (this.value < $('#domain_startingprice').val()) {
            bootstrap_alert.error('Reserved Price should be greater than Minimum Price', '#validator');
            return;
        }
    }

});

/*--------------------------------------------------
|  Withdrawal Request 
/*--------------------------------------------------*/
$(document).on('submit', '#withdrawForm', function (e) {
    e.preventDefault();
    $('#loader').show();

    if ($('#withdraw_amount').val() === '') {
        bootstrap_alert.error('Please enter a withdrawal amount', '#validator');
        $('#loader').hide();
        return;
    }

    $.ajax({
        type: "POST",
        url: baseUrl + "user/create_withdrawal",
        data: $("#withdrawForm").serialize(),
        dataType: 'json',
        cache: false,
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                $('#loader').hide();
                bootstrap_alert.success('Sucessfully Approved sent the withdrawal Request', '#validator');
                window.setTimeout(function () {
                    location.reload(true)
                }, 3000);
            } else {
                $('#loader').hide();
                bootstrap_alert.error(data.response, '#validator');
            }
        }
    });
});

/*--------------------------------------------------
|  Withdrawal History Pagination 
/*--------------------------------------------------*/
$(document).on("click", ".paginationWithdrawals li a", function (e) {
    e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $.ajax({
        url: baseUrl + "user/user_withdrawals/" + $(this).attr('data-ci-pagination-page'),
        method: "POST",
        data: {
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $('#user_withdrawals').fadeOut(100).html(data.response).fadeIn(500);
        }
    });
});


/*--------------------------------------------------
|  Pagination Blog
/*--------------------------------------------------*/
$(document).on("click", ".paginationBlog li a", function (e) {
    e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $.ajax({
        url: baseUrl + "main/blog_pagination/" + $(this).attr('data-ci-pagination-page'),
        method: "POST",
        data: {
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $('#recent-posts').fadeOut(100).html(data.response).fadeIn(500);
        }
    });
});

/*--------------------------------------------------
|  Next Post
/*--------------------------------------------------*/
$(document).on("click", ".next-post", function (e) {
    //e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $.ajax({
        url: baseUrl + "main/blog_nextprev/" + $('#current_id').val() + '/max',
        method: "POST",
        data: {
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $('#posts-nav').fadeOut(100).html(data.response).fadeIn(500);
        }
    });
});


/*--------------------------------------------------
|  Prev Post
/*--------------------------------------------------*/
$(document).on("click", ".prev-post", function (e) {
    //e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $.ajax({
        url: baseUrl + "main/blog_nextprev/" + $('#current_id').val() + '/min',
        method: "POST",
        data: {
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $('#posts-nav').fadeOut(100).html(data.response).fadeIn(500);
        }
    });
});



/*--------------------------------------------------*/
/*  User Login
/*--------------------------------------------------*/
$(document).on('submit', '#UserLoginForm', function (e) {
    e.preventDefault();
    var form = $(this);
    var data = form.serialize();
    if ($('#login_username').val() === "") {
        bootstrap_alert.error(errorUsernameBlank, '#loginStatus');
        return;
    }

    if ($('#login_password').val() === "") {
        bootstrap_alert.error(errorPasswordBlank, '#loginStatus');
        return;
    }

    $('#loadingImageLogin').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'common/LoginUser',
        data: data,
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === 0) {
                bootstrap_alert.warning(errorAccountLogin, '#loginStatus');
                return;
            } else if (data.response === 1) {
                bootstrap_alert.warning(errorAccountActivation, '#loginStatus');
                return;
            } else if (data.response === 2) {
                bootstrap_alert.success(successLogin, '#loginStatus');
                window.location.href = referrer;
                return;
            } else if (data.response === 3) {
                bootstrap_alert.error(errorAccountBanned, '#loginStatus');
                return;
            } else if (data.response === 4) {
                bootstrap_alert.error(errorAccountDisabled, '#loginStatus');
                return;
            } else if (data.response === 8) {
                bootstrap_alert.error(errorNoPermissions, '#loginStatus');
                return;
            } else {
                bootstrap_alert.error(errorInvalidLogin, '#loginStatus');
                return;
            }
        },
        complete: function () {
            $('#loadingImageLogin').hide();
            changeStatusTo(1)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });

});


/*--------------------------------------------------*/
/*  User signup
/*--------------------------------------------------*/

$(document).on('submit', '#UserRegistrationForm', function (e) {
    $('#register_submit').prop('disabled', true);
    e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var form = $(this);
    var formData = form.serialize();

    if ($("#register_firstname").val() === "") {
        bootstrap_alert.error(errorLastAndFirstNames, '#registrationStatus');
        $('#register_submit').prop('disabled', false);
        return;
    }

    if ($("#register_lastname").val() === "") {
        bootstrap_alert.error(errorLastAndFirstNames, '#registrationStatus');
        $('#register_submit').prop('disabled', false);
        return;
    }

    if ($("#register_repassword").val() !== "" && $('#register_password').val() !== "" && $('#register_username').val() !== "" && $('#register_email').val() !== "" && $('#register_firstname').val() !== "" && $('#register_lastname').val() !== "") {

        if ($("#register_repassword").val() === $('#register_password').val()) {

            $.getJSON(baseUrl + 'common/RegistrationEmailChecks/', {
                register_email: $("#register_email").val(),
                [csrfName]: csrfHash
            }, function (data) {

                if (data.response !== 'false') {

                    $.getJSON(baseUrl + 'common/RegistrationUsernameChecks/', {
                        register_username: $("#register_username").val(),
                        [csrfName]: csrfHash
                    }, function (data) {

                        if (data.response !== 'false') {

                            if ($('#register_termsconditions').prop("checked") === false) {
                                bootstrap_alert.error(errorTermsandConditionsCheck, '#registrationStatus');
                                $('#register_submit').prop('disabled', false);
                                return;
                            }

                            $('#loadingImageRegister').show();
                            $.ajax({
                                method: 'POST',
                                url: baseUrl + 'common/RegisterUser',
                                data: formData,
                                dataType: 'json',
                                success: function (data) {
                                    $('.txt_csrfname').val(data.token);
                                    if (data.response === true) {
                                        bootstrap_alert.success(successRegistration, '#registrationStatus');
                                        $('.auto-form-wrapper input[type="text"]').val('');
                                        $('.auto-form-wrapper input[type="password"]').val('');
                                        setTimeout(() => {
                                            window.location.href = baseUrl + 'login';
                                        }, 2000);
                                    } else {
                                        bootstrap_alert.error(errorRegistration, '#registrationStatus');
                                        return;
                                    }
                                },
                                complete: function () {
                                    $('.txt_csrfname').val(data.token);
                                    $('#loadingImageRegister').hide();
                                    $('#register_submit').prop('disabled', false);
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    $('#register_submit').prop('disabled', false);

                                    alert(thrownError);
                                }
                            });
                        } else {
                            bootstrap_alert.error(errorRegistration, '#registrationStatus');
                            $('.txt_csrfname').val(data.token);
                            $('#register_submit').prop('disabled', false);
                            return;
                        }

                    });

                } else {
                    bootstrap_alert.error(errorRegistration, '#registrationStatus');
                    $('.txt_csrfname').val(data.token);
                    $('#register_submit').prop('disabled', false);
                    return;
                }

            });
        } else {
            bootstrap_alert.error(errorRegistration, '#registrationStatus');
            $('#register_submit').prop('disabled', false);
            return;
        }
    } else {
        bootstrap_alert.error(errorRegistration, '#registrationStatus');
        $('#register_submit').prop('disabled', false);
        return;
    }

});


/*--------------------------------------------------*/
/*  User signup username availablity check
/*--------------------------------------------------*/
var disbale_btn_username = false;
var disbale_btn_email = false;
var disbale_btn_pass = false;
$(document).on('change', '#register_username', function (e) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    if ($("#register_username").val() !== "") {
        
        if($('#register_email').val() === '')
            disbale_btn_email = true;
        $("#register_submit").attr("disabled", true);
        $("#i_usernamecheck").toggleClass('fa-check-circle valid-icon', false);
        $("#i_usernamecheck").toggleClass('fa-times-circle invalid-icon', false);
        $("#i_usernamecheck").toggleClass('fa-check-circle', false);
        $("#i_usernamecheck").toggleClass('fa-cog fa-spin', true);

        $.getJSON(baseUrl + 'common/RegistrationUsernameChecks/', {
            register_username: $("#register_username").val(),
            [csrfName]: csrfHash
        }, function (data) {
            if (data === 'false') {
                // $("#register_submit").attr("disabled", true);
                $('#register_username').css({ "border-color": "#FF0000", "border-width": "1px", "border-style": "solid" });
                $("#register_username_error").html('Username already taken.');

                disbale_btn_username = false;
                check_disabled_btn_counter();
                // check_disabled_btn_counter(disbale_btn_counter);
                // $("#i_usernamecheck").toggleClass('fa-check-circle valid-icon', false);
                // $("#i_usernamecheck").toggleClass('fa-cog fa-spin', false)
                // $("#i_usernamecheck").toggleClass('fa-times-circle invalid-icon', true);
            } else {
                // $("#register_submit").attr("disabled", false);
                $('#register_username').css({ "border": "none" });
                $("#register_username_error").html('');

                disbale_btn_username = true;
                check_disabled_btn_counter();
                // check_disabled_btn_counter(disbale_btn_counter);
                // $("#i_usernamecheck").toggleClass('fa-times-circle invalid-icon', false);
                // $("#i_usernamecheck").toggleClass('fa-cog fa-spin', false);
                // $("#i_usernamecheck").toggleClass('fa-check-circle valid-icon', true);
            }

        });

    } else {
        disbale_btn_username = false;
        // check_disabled_btn_counter(disbale_btn_counter);
        $('#register_username').css({ "border-color": "#FF0000", "border-width": "1px", "border-style": "solid" });
        $("#register_username_error").html('Username Required.');
        check_disabled_btn_counter();
        // $("#register_submit").attr("disabled", true);
        // $("#i_usernamecheck").toggleClass('fa-check-circle valid-icon', false);
        // $("#i_usernamecheck").toggleClass('fa-times-circle invalid-icon', false);
        // $("#i_usernamecheck").toggleClass('fa-cog fa-spin', false);
        // $("#i_usernamecheck").toggleClass('fa-check-circle', true);
    }
    // $('.txt_csrfname').val(data.token);
});


/*--------------------------------------------------*/
/*  User signup Email availablity check
/*--------------------------------------------------*/

$(document).on('change', '#register_email', function (e) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    if ($("#register_email").val() !== "") {

        if (isEmail($("#register_email").val())) {
            $("#register_submit").attr("disabled", true);
            // $("#i_emailcheck").toggleClass('fa-check-circle valid-icon', false);
            // $("#i_emailcheck").toggleClass('fa-times-circle invalid-icon', false);
            // $("#i_emailcheck").toggleClass('fa-check-circle', false);
            // $("#i_emailcheck").toggleClass('fa-cog fa-spin', true);

            $.getJSON(baseUrl + 'common/RegistrationEmailChecks/', {
                register_email: $("#register_email").val(),
                [csrfName]: csrfHash
            }, function (data) {
                if (data === 'false') {
                    // $("#register_submit").attr("disabled", true);
                    // console.log('if part');
                    $('#register_email').css({ "border-color": "#FF0000", "border-width": "1px", "border-style": "solid" });
                    $("#register_email_error").html('Email already taken.');

                    disbale_btn_email = false;
                    check_disabled_btn_counter();
                    // check_disabled_btn_counter(disbale_btn_counter);
                    // $("#i_emailcheck").toggleClass('fa-check-circle valid-icon', false);
                    // $("#i_emailcheck").toggleClass('fa-cog fa-spin', false)
                    // $("#i_emailcheck").toggleClass('fa-times-circle invalid-icon', true);
                } else {
                    //console.log('else part');
                    disbale_btn_email = true;
                    // check_disabled_btn_counter(disbale_btn_counter);
                    // $("#register_submit").attr("disabled", false);
                    $('#register_email').css({ "border": "none" });
                    $("#register_email_error").html('');
                    check_disabled_btn_counter();
                    // $("#i_emailcheck").toggleClass('fa-times-circle invalid-icon', false);
                    // $("#i_emailcheck").toggleClass('fa-cog fa-spin', false);
                    // $("#i_emailcheck").toggleClass('fa-check-circle valid-icon', true);
                }

            });
        } else {
            //console.log('outer else part');
            disbale_btn_email = false;
            // check_disabled_btn_counter(disbale_btn_counter);
            // $("#register_submit").attr("disabled", true);
            $('#register_email').css({ "border": "none" });
            $("#register_email_error").html('Required valid email.');
            check_disabled_btn_counter();
            // $("#i_emailcheck").toggleClass('fa-check-circle valid-icon', false);
            // $("#i_emailcheck").toggleClass('fa-cog fa-spin', false)
            // $("#i_emailcheck").toggleClass('fa-times-circle invalid-icon', true);
        }
    } else {
        //  console.log('outer1 else part');
        disbale_btn_email = false;
        // check_disabled_btn_counter(disbale_btn_counter);
        $('#register_email').css({ "border-color": "#FF0000", "border-width": "1px", "border-style": "solid" });
        $("#register_email_error").html('Email Required.');
        check_disabled_btn_counter();
        // $("#register_submit").attr("disabled", true);
        // $("#i_emailcheck").toggleClass('fa-check-circle valid-icon', false);
        // $("#i_emailcheck").toggleClass('fa-times-circle invalid-icon', false);
        // $("#i_emailcheck").toggleClass('fa-cog fa-spin', false);
        // $("#i_emailcheck").toggleClass('fa-check-circle', true);
    }
    //$('.txt_csrfname').val(data.token);
});


/*--------------------------------------------------*/
/*  Retype Password checker
/*--------------------------------------------------*/

$(document).on('change', '#register_repassword', function (e) {

    if ($("#register_repassword").val() !== "") {
        // $("#register_submit").attr("disabled", true);
        $("#i_retypepasswordcheck").toggleClass('fa-check-circle valid-icon', false);
        $("#i_retypepasswordcheck").toggleClass('fa-times-circle invalid-icon', false);
        $("#i_retypepasswordcheck").toggleClass('fa-check-circle', false);
        $("#i_retypepasswordcheck").toggleClass('fa-cog fa-spin', true);

        if ($("#register_repassword").val() !== $('#register_password').val()) {
            // $("#register_submit").attr("disabled", true);
            $('#register_repassword').css({ "border-color": "#FF0000", "border-width": "1px", "border-style": "solid" });
            $("#register_repassword_error").html('Password not match.');
            disbale_btn_pass = false;
            // check_disabled_btn_counter(disbale_btn_counter);
            // $("#i_retypepasswordcheck").toggleClass('fa-check-circle valid-icon', false);
            // $("#i_retypepasswordcheck").toggleClass('fa-cog fa-spin', false)
            // $("#i_retypepasswordcheck").toggleClass('fa-times-circle invalid-icon', true);
            check_disabled_btn_counter();
        } else {
            disbale_btn_pass = true;
            // check_disabled_btn_counter(disbale_btn_counter);
            // $("#register_submit").attr("disabled", false);
            $('#register_repassword').css({ "border": "none" });
            $("#register_repassword_error").html('');

            // $("#i_retypepasswordcheck").toggleClass('fa-times-circle invalid-icon', false);
            // $("#i_retypepasswordcheck").toggleClass('fa-cog fa-spin', false);
            // $("#i_retypepasswordcheck").toggleClass('fa-check-circle valid-icon', true);
            check_disabled_btn_counter();
        }
    } else {
        $('#register_repassword').css({ "border-color": "#FF0000", "border-width": "1px", "border-style": "solid" });
        $("#register_repassword_error").html('Password not match.');
        disbale_btn_pass = false;
        // check_disabled_btn_counter(disbale_btn_counter);
        // $("#register_submit").attr("disabled", true);
        // $("#i_retypepasswordcheck").toggleClass('fa-check-circle valid-icon', false);
        // $("#i_retypepasswordcheck").toggleClass('fa-times-circle invalid-icon', false);
        // $("#i_retypepasswordcheck").toggleClass('fa-cog fa-spin', false);
        // $("#i_retypepasswordcheck").toggleClass('fa-check-circle', true);
        check_disabled_btn_counter();
    }
});

function check_disabled_btn_counter() {
    
    $('#register_submit').prop('disabled', false);
    if ((disbale_btn_username == true) && (disbale_btn_email == true)) {
        // $("#register_submit").removeAttr("disabled");
        $('#register_submit').prop('disabled', false);
    } else {
        $('#register_submit').prop('disabled', true);
    }
}

/*--------------------------------------------------
| Filter Search 
/*--------------------------------------------------*/
function filterSearch(min, max) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var parameters = {};
    parameters['category'] = '';
    parameters['business_registeredCountry'] = $('#location-input').val();
    parameters['searchterm'] = $('#searchterm').val();
    parameters['extension'] = '';
    parameters['min'] = min;
    parameters['max'] = max;
    if ($('#website_industry').length) {
        parameters['category'] = $('#website_industry').val();
    }

    if ($('#extension').length) {
        parameters['extension'] = $('#extension').val();
    }

    if ($("#classified_check").is(':checked')) {
        parameters['listing_option'] = 'classified';
    } else if ($("#auction_check").is(':checked')) {
        parameters['listing_option'] = 'auction';
    } else {
        parameters['listing_option'] = '';
    }
    var jsonstring = JSON.stringify(parameters);
    $.ajax({
        method: "POST",
        url: baseUrl + "main/single_search/" + $('#listing_type').val() + '/' + 0 + '/' + $('#sortyby').val(),
        data: {
            parameters: jsonstring,
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $('#searchResultsDiv').fadeOut(100).html(data.response).fadeIn(500);
        }
    });
}

/*--------------------------------------------------
|  Search Results Paginations 
/*--------------------------------------------------*/

// Old Code

/*$(document).on("click", ".paginationSearch li a", function(e) {
    e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var parameters = {};
    parameters['business_registeredCountry'] = $('#location-input').val();
    parameters['category'] = '';
    parameters['extension'] = '';
    parameters['listing_option'] = '';
    parameters['searchterm'] = $('#searchterm').val();
    parameters['min'] = $('.range-slider').data('slider').getValue()[0];
    parameters['max'] = $('.range-slider').data('slider').getValue()[1];
    if ($('#website_industry').length) {
        parameters['category'] = $('#website_industry').val();
    }

    if ($('#extension').length) {
        parameters['extension'] = $('#extension').val();
    }

    if ($("#classified_check").is(':checked')) {
        parameters['listing_option'] = 'classified';
    } else if ($("#auction_check").is(':checked')) {
        parameters['listing_option'] = 'auction';
    } else {
        parameters['listing_option'] = '';
    }

    if ($('#marketplace-input').length > 0) {
        $("#listing_type").val($("#marketplace-input").val());
    }

    var jsonstring = JSON.stringify(parameters);
    $.ajax({
        method: "POST",
        url: baseUrl + "main/single_search/" + $('#listing_type').val() + '/' + $(this).attr('data-ci-pagination-page'),
        data: {
            parameters: jsonstring,
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function(data) {
            $('.txt_csrfname').val(data.token);
            $('#searchResultsDiv').fadeOut(100).html(data.response).fadeIn(500);
        }
    });
});*/

// Updated Code

// $(document).on("click", ".paginationSearch li a", function(e) {
//     e.preventDefault();
//     var csrfName = $('.txt_csrfname').attr('name');
//     var csrfHash = $('.txt_csrfname').val();
//     var parameters = {};
//     parameters['business_registeredCountry'] = $('#location-input').val();
//     parameters['category'] = '';
//     parameters['extension'] = '';
//     parameters['listing_option'] = '';
//     parameters['searchterm'] = $('#searchterm').val();
//     parameters['min'] = $('.range-slider').data('slider').getValue()[0];
//     parameters['max'] = $('.range-slider').data('slider').getValue()[1];
//     if ($('#website_industry').length) {
//         parameters['category'] = $('#website_industry').val();
//     }

//     if ($('#extension').length) {
//         parameters['extension'] = $('#extension').val();
//     }

//     if ($("#classified_check").is(':checked')) {
//         parameters['listing_option'] = 'classified';
//     } else if ($("#auction_check").is(':checked')) {
//         parameters['listing_option'] = 'auction';
//     } else {
//         parameters['listing_option'] = '';
//     }

//     if ($('#marketplace-input').length > 0) {
//         $("#listing_type").val($("#marketplace-input").val());
//     }

//     var jsonstring = JSON.stringify(parameters);
//     $.ajax({
//         method: "POST",
//         url: baseUrl + "main/single_search/" + $('#listing_type').val() + '/' + $(this).attr('data-ci-pagination-page'),
//         data: {
//             parameters: jsonstring,
//             [csrfName]: csrfHash
//         },
//         dataType: 'json',
//         success: function(data) {
//             $('.txt_csrfname').val(data.token);
//             $('#response_print_here').fadeOut(100).html(data.response).fadeIn(500);
//             activatePopup();
//         }
//     });
// });


// // ------- pagination code --------------//

// $(document).on("click", ".mypage li a", function(e) {
//     e.preventDefault();
//     var csrfName = $('.txt_csrfname').attr('name');
//     var csrfHash = $('.txt_csrfname').val();

//     $.ajax({
//         method: "POST",
//         url: baseUrl + "main/websitesForSaleAjax/" + $(this).attr('data-ci-pagination-page'),
//         data: {
//             [csrfName]: csrfHash,

//         },
//         dataType: 'json',
//         success: function(data) {
//             $('.txt_csrfname').val(data.token);
//             $('#viewProduct').fadeOut(100).html(data.response).fadeIn(500);
//             //  activatePopup();
//         }
//     });
// });

//------------------------//
/*--------------------------------------------------
| Sorting Change Event
/*--------------------------------------------------*/
$(document).on("change", "#sortyby", function (e) {
    e.preventDefault();
    var min = $('.range-slider').data('slider').getValue()[0];
    var max = $('.range-slider').data('slider').getValue()[1];
    if ($('#marketplace-input').length > 0) {
        $("#listing_type").val($("#marketplace-input").val());
    }
    filterSearch(min, max);
});

/*--------------------------------------------------
| Listing type Change Auction
/*--------------------------------------------------*/
$(document).on("change", "#auction_check", function (e) {
    e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var parameters = {};
    parameters['business_registeredCountry'] = $('#location-input').val();
    parameters['category'] = '';
    parameters['extension'] = '';
    parameters['listing_option'] = '';
    parameters['searchterm'] = $('#searchterm').val();
    parameters['min'] = $('.range-slider').data('slider').getValue()[0];
    parameters['max'] = $('.range-slider').data('slider').getValue()[1];
    if ($('#website_industry').length) {
        parameters['category'] = $('#website_industry').val();
    }

    if ($('#extension').length) {
        parameters['extension'] = $('#extension').val();
    }

    if ($(this).is(':checked')) {
        parameters['listing_option'] = 'auction';
        if ($("#classified_check").is(':checked')) {
            $("#classified_check").prop('checked', false);
        }
    }

    if ($('#marketplace-input').length > 0) {
        $("#listing_type").val($("#marketplace-input").val());
    }

    var jsonstring = JSON.stringify(parameters);
    $.ajax({
        method: "POST",
        url: baseUrl + "main/single_search/" + $('#listing_type').val() + '/' + 0 + '/' + $('#sortyby').val(),
        data: {
            parameters: jsonstring,
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $('#searchResultsDiv').fadeOut(100).html(data.response).fadeIn(500);
        }
    });
});

/*--------------------------------------------------
| Listing type Change Classified
/*--------------------------------------------------*/
$(document).on("change", "#classified_check", function (e) {
    e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var parameters = {};
    parameters['business_registeredCountry'] = $('#location-input').val();
    parameters['category'] = '';
    parameters['extension'] = '';
    parameters['listing_option'] = '';
    parameters['searchterm'] = $('#searchterm').val();
    parameters['min'] = $('.range-slider').data('slider').getValue()[0];
    parameters['max'] = $('.range-slider').data('slider').getValue()[1];
    if ($('#website_industry').length) {
        parameters['category'] = $('#website_industry').val();
    }

    if ($('#extension').length) {
        parameters['extension'] = $('#extension').val();
    }

    if ($(this).is(':checked')) {
        parameters['listing_option'] = 'classified';
        if ($("#auction_check").is(':checked')) {
            $("#auction_check").prop('checked', false);
        }
    }

    if ($('#marketplace-input').length > 0) {
        $("#listing_type").val($("#marketplace-input").val());
    }

    var jsonstring = JSON.stringify(parameters);
    $.ajax({
        method: "POST",
        url: baseUrl + "main/single_search/" + $('#listing_type').val() + '/' + 0 + '/' + $('#sortyby').val(),
        data: {
            parameters: jsonstring,
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $('#searchResultsDiv').fadeOut(100).html(data.response).fadeIn(500);
        }
    });
});

/*--------------------------------------------------
| Category Change Event
/*--------------------------------------------------*/
if ($('.range-slider').length > 0) {
    $(document).on("change", "#website_industry", function (e) {
        e.preventDefault();
        var min = $('.range-slider').data('slider').getValue()[0];
        var max = $('.range-slider').data('slider').getValue()[1];
        if ($('#marketplace-input').length > 0) {
            $("#listing_type").val($("#marketplace-input").val());
        }
        filterSearch(min, max);
    });
}


/*--------------------------------------------------
| Change Marketplace
/*--------------------------------------------------*/
if ($('.range-slider').length > 0) {
    $(document).on("click", "#marketplace-input", function (e) {
        e.preventDefault();
        var min = $('.range-slider').data('slider').getValue()[0];
        var max = $('.range-slider').data('slider').getValue()[1];
        if ($('#marketplace-input').length > 0) {
            $("#listing_type").val($("#marketplace-input").val());
        }
        filterSearch(min, max);
    });
}


/*--------------------------------------------------
| Search Button
/*--------------------------------------------------*/
if ($('.range-slider').length > 0) {
    $(document).on("click", ".button-search", function (e) {
        e.preventDefault();
        var min = $('.range-slider').data('slider').getValue()[0];
        var max = $('.range-slider').data('slider').getValue()[1];
        if ($('#marketplace-input').length > 0) {
            $("#listing_type").val($("#marketplace-input").val());
        }
        filterSearch(min, max);
    });
}


/*--------------------------------------------------
| Country Dropdown Change
/*--------------------------------------------------*/
if ($('.range-slider').length > 0) {
    $(document).on("change", "#location-input", function (e) {
        e.preventDefault();
        var min = $('.range-slider').data('slider').getValue()[0];
        var max = $('.range-slider').data('slider').getValue()[1];
        if ($('#marketplace-input').length > 0) {
            $("#listing_type").val($("#marketplace-input").val());
        }
        filterSearch(min, max);
    });
}


/*--------------------------------------------------
| TLD Dropdown Change
/*--------------------------------------------------*/
if ($('.range-slider').length > 0) {
    $(document).on("change", "#extension", function (e) {
        e.preventDefault();
        var min = $('.range-slider').data('slider').getValue()[0];
        var max = $('.range-slider').data('slider').getValue()[1];
        if ($('#marketplace-input').length > 0) {
            $("#listing_type").val($("#marketplace-input").val());
        }
        filterSearch(min, max);
    });
}

/*--------------------------------------------------
| Slider Change
/*--------------------------------------------------*/
if ($('.range-slider').length > 0) {
    $('.range-slider').slider().on('slideStop', function (event) {
        var min = parseInt(event.value[0]);
        var max = parseInt(event.value[1]);
        if ($('#marketplace-input').length > 0) {
            $("#listing_type").val($("#marketplace-input").val());
        }
        filterSearch(min, max);
    });
}

/*--------------------------------------------------*/
/*  Admin Login
/*--------------------------------------------------*/

$(document).on('submit', '#AdminLoginForm', function (e) {
    e.preventDefault();
    var form = $(this);
    var data = form.serialize();
    if ($('#login_username').val() === "") {
        bootstrap_alert.error(errorUsernameBlank, '#loginStatus');
        return;
    }

    if ($('#login_password').val() === "") {
        bootstrap_alert.error(errorPasswordBlank, '#loginStatus');
        return;
    }

    $('#loadingImageLogin').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'common/LoginUser/0',
        data: data,
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === 0) {
                bootstrap_alert.warning(errorAccountLogin, '#loginStatus');
                return;
            } else if (data.response === 1) {
                bootstrap_alert.warning(errorAccountActivation, '#loginStatus');
                return;
            } else if (data.response === 2) {
                bootstrap_alert.success('Welcome Admin !! ' + successLogin, '#loginStatus');
                if (document.referrer != "") {
                    window.location.replace(document.referrer);
                }
                window.location.href = baseUrl + 'admin/';
                return;
            } else if (data.response === 3) {
                bootstrap_alert.error(errorAccountBanned, '#loginStatus');
                return;
            } else if (data.response === 4) {
                bootstrap_alert.error(errorAccountDisabled, '#loginStatus');
                return;
            } else if (data.response === 8) {
                bootstrap_alert.error(errorNoPermissions, '#loginStatus');
                return;
            } else {
                bootstrap_alert.error(errorInvalidLogin, '#loginStatus');
                return;
            }
        },
        complete: function () {
            $('#loadingImageLogin').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });

});


/*--------------------------------------------------*/
/*  Admin Pages Creation
/*--------------------------------------------------*/

$(document).on('submit', '#pageSettingsForm', function (e) {
    e.preventDefault();
    if ($.trim($('#txt_page_title').val()) === "") {
        bootstrap_alert.error('Please enter a Page Title', '#notification');
        return;
    }

    if ($.trim($('#txt_page_meta_description').val()) === "") {
        bootstrap_alert.error('Please enter a Meta Description', '#notification');
        return;
    }

    if ($.trim($('#txt_page_meta_keywords').val()) === "") {
        bootstrap_alert.error('Please enter a Meta Keywords', '#notification');
        return;
    }

    if ($.trim($('#txt_page_description').val()) === "") {
        bootstrap_alert.error('Please enter a Description', '#notification');
        return;
    }

    $('#loader').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'admin/save_page_data',
        data: $("#pageSettingsForm").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success(sucessfullycompleted, '#notification');
                clearInputs('pageSettingsForm');
                $('#txt_page_description').summernote('reset');
                loadPageData();
                $('#loader').hide();
                return;
            } else {
                bootstrap_alert.error(updateError, '#notification');
                $('#loader').hide();
                return;
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});



/*
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- * /
/*  Solution URL Slug Generator
/*--------------------------------------------------*/

$(document).on("change", "#txt_solution_title", function (e) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    title = $("#txt_solution_title").val();
    if ($("#txt_solution_title").val() !== '') {
        $.ajax({
            method: 'POST',
            url: baseUrl + 'common/solution_urlSlugGenerator',
            data: {
                'title': title,
                [csrfName]: csrfHash
            },
            dataType: 'json',
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response) {
                    $("#txt_solution_url_slug").val(data.response);
                    return;
                }
            },
            complete: function () { },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    } else {
        $("#txt_solution_url_slug").val("");
    }
});

/**
 * if solution slug changes
 */

function updateSlug() {

    checkSolutionSlug();
}


// common function to checkSolutionSlug 
function checkSolutionSlug() {

    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    slug = $("#txt_solution_url_slug").val();
    tableId = $("#solution_id").val();

    var rawData = {
        'slug': slug,
        'tableId': tableId,
        [csrfName]: csrfHash
    };

    var flag = false;
    if ($("#txt_solution_url_slug").val() !== '') {
        $.ajax({
            method: 'POST',
            url: baseUrl + 'common/solution_urlSlugCheck',
            data: rawData,
            async: false,
            dataType: 'json',
            success: function (data) {
                // console.log("success data---");
                // console.log(data);
                $('.txt_csrfname').val(data.token);
                if (data.response != "duplicate") {
                    $("#txt_solution_url_slug").val(data.response);
                    flag = true;

                } else {
                    $("#txt_solution_url_slug").after('<span for="slug-error" class="error">Slug can not be duplicate</span>');
                    this.flag = false;
                }
            },
            complete: function () {

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
                console.log(xhr);
                $('.txt_csrfname').val(xhr.token);
            }
        });
    } else {
        $("#txt_solution_url_slug").after('<span for="slug-error" class="error">Slug is required</span>');

    }

    return flag;
}


/*
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- * /
/*  Courses URL Slug Generator
/*--------------------------------------------------*/

$(document).on("change", "#course_name", function (e) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    course_name = $("#course_name").val();
    if ($("#course_name").val() !== '') {
        $.ajax({
            method: 'POST',
            url: baseUrl + 'common/course_urlSlugGenerator',
            data: {
                'course_name': course_name,
                [csrfName]: csrfHash
            },
            dataType: 'json',
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response) {
                    $("#txt_course_url_slug").val(data.response);
                    return;
                }
            },
            complete: function () { },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    } else {
        $("#txt_course_url_slug").val("");
    }
});


$(document).on('change', '#txt_course_url_slug', function (e) {
    e.preventDefault();
    checkCourseSlug();
});

function checkCourseSlug() {

    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    slug = $("#txt_course_url_slug").val();
    tableId = $("#solution_id").val();
    var flag = false;
    if ($("#txt_course_url_slug").val() !== '') {
        $.ajax({
            method: 'POST',
            url: baseUrl + 'common/course_urlSlugCheck',
            data: {
                'slug': slug,
                'tableId': tableId,
                [csrfName]: csrfHash
            },
            async: false,
            dataType: 'json',
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response != "duplicate") {
                    $("#txt_course_url_slug").val(data.response);
                    flag = true;

                } else {
                    $("#txt_course_url_slug").after('<span for="slug-error" class="error">Slug can not be duplicate</span>');
                    this.flag = false;

                }
            },
            complete: function () { },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    } else {
        $("#txt_course_url_slug").val("");
    }

    return flag;
}



/*--------------------------------------------------*/
/*  Page URL Slug Generator
/*--------------------------------------------------*/

$(document).on("change", "#txt_page_title", function (e) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    title = $("#txt_page_title").val();
    if ($("#txt_page_title").val() !== '') {
        $.ajax({
            method: 'POST',
            url: baseUrl + 'common/urlSlugGenerator',
            data: {
                'title': title,
                [csrfName]: csrfHash
            },
            dataType: 'json',
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response) {
                    $("#txt_page_url_slug").val(data.response);
                    return;
                }
            },
            complete: function () { },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    } else {
        $("#txt_page_url_slug").val("");
    }
});



/*--------------------------------------------------*/
/*  Blog Post Creation
/*--------------------------------------------------*/

$(document).on('submit', '#blogSettingsForm', function (e) {
    e.preventDefault();
    var formData = new FormData(this);

    if ($.trim($('#txt_blogpost_title').val()) === "") {
        bootstrap_alert.error('Please enter a Blog Title', '#notification');
        return;
    }

    if ($.trim($('#txt_blogpost_meta_description').val()) === "") {
        bootstrap_alert.error('Please enter a Blog Meta Description', '#notification');
        return;
    }

    if ($.trim($('#txt_blogpost_meta_keywords').val()) === "") {
        bootstrap_alert.error('Please enter Meta Keywords', '#notification');
        return;
    }

    if ($.trim($('#txt_blogpost_description').val()) === "") {
        bootstrap_alert.error('Please enter blog post', '#notification');
        return;
    }

    $('#loader').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'admin/save_blog_data',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success(sucessfullycompleted, '#notification');
                clearInputs('blogSettingsForm');
                $('#txt_blogpost_description').summernote('reset');
                loadBlogData();
                $('#loader').hide();
                return;
            } else {
                bootstrap_alert.error(updateError, '#notification');
                $('#loader').hide();
                return;
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});

/*--------------------------------------------------*/
/*  Blog URL Slug Generator
/*--------------------------------------------------*/

$(document).on("change", "#txt_blogpost_title", function (e) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    title = $("#txt_blogpost_title").val();
    if ($("#txt_blogpost_title").val() !== '') {
        $.ajax({
            method: 'POST',
            url: baseUrl + 'common/blog_urlSlugGenerator',
            data: {
                'title': title,
                [csrfName]: csrfHash
            },
            dataType: 'json',
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if (data.response) {
                    $("#txt_blogpost_url_slug").val(data.response);
                    return;
                }
            },
            complete: function () { },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    } else {
        $("#txt_blogpost_url_slug").val("");
    }
});


/*--------------------------------------------------*/
/*  IMages Manager
/*--------------------------------------------------*/

$(document).on('submit', '#Imageform', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $('#loaderImage').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'admin/save_images_data',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success('Sucessfully Images were uploaded', '#validator');
                $('#loaderImage').hide();
                return;
            } else {
                bootstrap_alert.error(updateError, '#validator');
                $('#loaderImage').hide();
                return;
            }
        },
        complete: function () {
            $('#loaderImage').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});
/*--------------------------------------------------*/
/*  General Settings Save
/*--------------------------------------------------*/

$(document).on('submit', '#generalSettingsForm', function (e) {
    e.preventDefault();
    $('#loader').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'admin/save_general_settings',
        data: $("#generalSettingsForm").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success(sucessfullycompleted, '#notification');
                loadPageData();
                $('#loader').hide();
                return;
            } else {
                bootstrap_alert.error(updateError, '#notification');
                $('#loader').hide();
                return;
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});


/*--------------------------------------------------*/
/*  Cron Jobs Manager
/*--------------------------------------------------*/

$('#cronJobsFrom').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: baseUrl + 'cron/save_job',
        type: 'POST',
        data: $("#cronJobsFrom").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            loadCronData();
        },
        complete: function () { },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});


/*--------------------------------------------------*/
/*  Announcement Manager
/*--------------------------------------------------*/

$('.announcementForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: baseUrl + 'admin/save_announcement',
        type: 'POST',
        data: $("#announcementForm").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success(sucessfullycompleted, '#notification');
                clearInputs('announcementForm');
                loadAnnouncementData();
                $('#loader').hide();
                return;
            } else {
                bootstrap_alert.error(updateError, '#notification');
                $('#loader').hide();
                return;
            }
        },
        complete: function () { },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});

/*--------------------------------------------------*/
/*  Save Language From
/*--------------------------------------------------*/

$('#newLanguageFrom').on('submit', function (e) {
    e.preventDefault();
    $('#loader').show();
    $.ajax({
        url: baseUrl + 'admin/save_language_data',
        type: 'POST',
        data: $("#newLanguageFrom").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success(sucessfullycompleted, '#notification');
                loadLanguageData();
                $('#loader').hide();
                return;
            } else {
                bootstrap_alert.error(updateError, '#notification');
                $('#loader').hide();
                return;
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});


/*--------------------------------------------------*/
/*  Ads From
/*--------------------------------------------------*/
$('#AdsForm').on('submit', function (e) {
    e.preventDefault();
    $('#loader').show();
    $.ajax({
        url: baseUrl + 'admin/save_ads',
        type: 'POST',
        data: $("#AdsForm").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success(sucessfullycompleted, '#notification');
                $('#loader').hide();
                return;
            } else {
                bootstrap_alert.error(updateError, '#notification');
                $('#loader').hide();
                return;
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});

/*--------------------------------------------------*/
/*  Ads From
/*--------------------------------------------------*/
$('#EmailForm').on('submit', function (e) {
    e.preventDefault();
    $('#loader').show();
    $.ajax({
        url: baseUrl + 'admin/save_email_settings',
        type: 'POST',
        data: $("#EmailForm").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success(sucessfullycompleted, '#notification');
                $('#loader').hide();
                return;
            } else {
                bootstrap_alert.error(updateError, '#notification');
                $('#loader').hide();
                return;
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});

/*--------------------------------------------------*/
/*  Paypal Setup form
/*--------------------------------------------------*/
$(document).on('submit', '#paypal_setup_form', function (e) {
    e.preventDefault();
    $('#loader').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'admin/paypal_data_Save/1',
        data: $("#paypal_setup_form").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success(sucessfullycompleted, '#notification');
                $("#paymentContent").load(location.href + " #paymentContent");
                location.reload(true);
                if ($("#paypal_status").val() == '1') {
                    $("#defaultPaypalStatus").hide();
                    $("#paypalInactivity").html("<label class='form-control badge badge-success'> ACTIVE </label>");
                } else {
                    $("#defaultPaypalStatus").hide();
                    $("#paypalInactivity").html("<label class='form-control badge badge-danger'> INACTIVE </label>");
                }
            } else {
                bootstrap_alert.error(updateError, '#notification');
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});


/*--------------------------------------------------*/
/*  Paypal Pro Setup form
/*--------------------------------------------------*/
$(document).on('submit', '#paypalpro_setup_form', function (e) {
    e.preventDefault();
    $('#loader').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'admin/paypal_data_Save/2',
        data: $("#paypalpro_setup_form").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success(sucessfullycompleted, '#notification');
                location.reload(true);
                if ($("#paypalpro_status").val() == '1') {
                    $("#defaultPaypalProStatus").hide();
                    $("#paypalInactivityPro").html("<label class='form-control badge badge-success'> ACTIVE </label>");
                } else {
                    $("#defaultPaypalProStatus").hide();
                    $("#paypalInactivityPro").html("<label class='form-control badge badge-danger'> INACTIVE </label>");
                }
            } else {
                bootstrap_alert.error(updateError, '#notification');
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});


/*--------------------------------------------------*/
/*  Stripe Setup form
/*--------------------------------------------------*/
$(document).on('submit', '#stripesetup_form', function (e) {
    e.preventDefault();
    $('#loader').show();
    $('#product_payment').attr('disabled', true);
    $.ajax({
        method: 'POST',
        url: baseUrl + 'admin/paypal_data_Save/3',
        data: $("#stripesetup_form").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success(sucessfullycompleted, '#notification');
                location.reload(true);
                if ($("#paypalpro_status").val() == '1') {
                    $("#defaultPaypalProStatus").hide();
                    $("#paypalInactivityPro").html("<label class='form-control badge badge-success'> ACTIVE </label>");
                } else {
                    $("#defaultPaypalProStatus").hide();
                    $("#paypalInactivityPro").html("<label class='form-control badge badge-danger'> INACTIVE </label>");
                }
            } else {
                bootstrap_alert.error(updateError, '#notification');
            }

            $('#product_payment').attr('disabled', false);

        },
        complete: function () {
            $('#loader').hide();
            $("#cardholder_name").val('');
            $("#stripe_credit_card").val('');
            $("#expiration-month-and-year").val('');
            $("#security_code").val('');
            $('#product_payment').attr('disabled', false);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
            $('#product_payment').attr('disabled', false);
        }
    });
});


/*--------------------------------------------------*/
/*  Reset Password Form
/*--------------------------------------------------*/
$(document).on('submit', '#ResetPasswordForm', function (e) {
    e.preventDefault();
    $('#loadingImageReset').show();
    $.getJSON(baseUrl + 'common/RegistrationEmailChecks/', {
        register_email: $("#reset_email").val()
    }, function (data) {
        if (data === 'false') {
            $.ajax({
                method: 'POST',
                url: baseUrl + 'common/reset_user_password',
                data: $("#ResetPasswordForm").serialize(),
                dataType: 'json',
                success: function (data) {
                    $('.txt_csrfname').val(data.token);
                    if (data.response === true) {
                        bootstrap_alert.success(successReset, '#ResetStatus');
                    } else {
                        bootstrap_alert.error(errorReset, '#ResetStatus');
                    }
                },
                complete: function () {
                    $('#loadingImageReset').hide();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        } else {
            bootstrap_alert.error(errorResetEmail, '#ResetStatus');
            $('#loadingImageReset').hide();
        }
    });
});


/*--------------------------------------------------*/
/*  Reset Email Validation
/*--------------------------------------------------*/
$(document).on("change", "#reset_email", function (e) {

    if ($("#reset_email").val() !== "") {

        if (isEmail($("#reset_email").val())) {

            $("#button_reset").attr("disabled", false);
            $("#i_emailcheckReset").toggleClass('fa-times-circle invalid-icon', false);
            $("#i_emailcheckReset").toggleClass('fa-cog fa-spin', false);
            $("#i_emailcheckReset").toggleClass('fa-check-circle valid-icon', true);
        } else {
            $("#button_reset").attr("disabled", true);
            $("#i_emailcheckReset").toggleClass('fa-check-circle valid-icon', false);
            $("#i_emailcheckReset").toggleClass('fa-cog fa-spin', false)
            $("#i_emailcheckReset").toggleClass('fa-times-circle invalid-icon', true);
        }
    } else {
        $("#button_reset").attr("disabled", true);
        $("#i_emailcheckReset").toggleClass('fa-check-circle valid-icon', false);
        $("#i_emailcheckReset").toggleClass('fa-times-circle invalid-icon', false);
        $("#i_emailcheckReset").toggleClass('fa-cog fa-spin', false);
        $("#i_emailcheckReset").toggleClass('fa-check-circle', true);
    }

});

/*--------------------------------------------------*/
/*  Reset Password Update
/*--------------------------------------------------*/
$(document).on('submit', '#resetPasswordChangeForm', function (e) {
    e.preventDefault();

    if ($('#reset_user_password').val() === "") {
        bootstrap_alert.error(errorPasswordBlank, '#resetCompleteStatus');
        return;
    }

    if ($('#reset_user_repassword').val() === "") {
        bootstrap_alert.error(errorPasswordBlank, '#resetCompleteStatus');
        return;
    }

    $('#loadingImageresetComplete').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'common/reset_user_password_update',
        data: $("#resetPasswordChangeForm").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success(sucessfullycompleted, '#resetCompleteStatus');
                window.location.href = baseUrl + 'login';
            } else {
                bootstrap_alert.error(updateError, '#resetCompleteStatus');
            }
        },
        complete: function () {
            $('#loadingImageresetComplete').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});

/*--------------------------------------------------*/
/*  Reset Password Change
/*--------------------------------------------------*/
$(document).on("change", "#reset_user_repassword", function (e) {

    if ($("#reset_user_repassword").val() !== "") {

        $("#resetComplete_submit").attr("disabled", true);
        $("#i_retypepasswordcheckrs").toggleClass('fa-check-circle valid-icon', false);
        $("#i_retypepasswordcheckrs").toggleClass('fa-times-circle invalid-icon', false);
        $("#i_retypepasswordcheckrs").toggleClass('fa-check-circle', false);
        $("#i_retypepasswordcheckrs").toggleClass('fa-cog fa-spin', true);

        if ($("#reset_user_repassword").val() !== $('#reset_user_password').val()) {
            $("#resetComplete_submit").attr("disabled", true);
            $("#i_retypepasswordcheckrs").toggleClass('fa-check-circle valid-icon', false);
            $("#i_retypepasswordcheckrs").toggleClass('fa-cog fa-spin', false)
            $("#i_retypepasswordcheckrs").toggleClass('fa-times-circle invalid-icon', true);
        } else {
            $("#resetComplete_submit").attr("disabled", false);
            $("#i_retypepasswordcheckrs").toggleClass('fa-times-circle invalid-icon', false);
            $("#i_retypepasswordcheckrs").toggleClass('fa-cog fa-spin', false);
            $("#i_retypepasswordcheckrs").toggleClass('fa-check-circle valid-icon', true);
        }
    } else {
        $("#resetComplete_submit").attr("disabled", true);
        $("#i_retypepasswordcheckrs").toggleClass('fa-check-circle valid-icon', false);
        $("#i_retypepasswordcheckrs").toggleClass('fa-times-circle invalid-icon', false);
        $("#i_retypepasswordcheckrs").toggleClass('fa-cog fa-spin', false);
        $("#i_retypepasswordcheckrs").toggleClass('fa-check-circle', true);
    }
});

/*--------------------------------------------------*/
/*  Reset User Password Change
/*--------------------------------------------------*/
$('#reset_user_password').on('keyup', function () {
    var password = $(this);
    if (password === "") {

        $("#resetComplete_submit").attr("disabled", true);
        $("#i_passwordcheckrs").toggleClass('fa-check-circle valid-icon', false);
        $("#i_passwordcheckrs").toggleClass('fa-times-circle invalid-icon', false);
        $("#i_passwordcheckrs").toggleClass('fa-check-circle', false);
        $("#i_passwordcheckrs").toggleClass('fa-cog fa-spin', true);
    } else {
        $("#resetComplete_submit").attr("disabled", false);
        $("#i_passwordcheckrs").toggleClass('fa-times-circle invalid-icon', false);
        $("#i_passwordcheckrs").toggleClass('fa-cog fa-spin', false);
        $("#i_passwordcheckrs").toggleClass('fa-check-circle valid-icon', true);

        if ($("#txt_user_retypepassword").val() !== "") {

            if ($("#reset_user_repassword").val() !== $('#reset_user_password').val()) {
                $("#resetComplete_submit").attr("disabled", true);
                $("#i_retypepasswordcheckrs").toggleClass('fa-check-circle valid-icon', false);
                $("#i_retypepasswordcheckrs").toggleClass('fa-cog fa-spin', false)
                $("#i_retypepasswordcheckrs").toggleClass('fa-times-circle invalid-icon', true);
            } else {
                $("#resetComplete_submit").attr("disabled", false);
                $("#i_retypepasswordcheckrs").toggleClass('fa-times-circle invalid-icon', false);
                $("#i_retypepasswordcheckrs").toggleClass('fa-cog fa-spin', false);
                $("#i_retypepasswordcheckrs").toggleClass('fa-check-circle valid-icon', true);
            }
        }

        var pass = password.val();
        var passLabel = $('[for="password"]');
        var stength = 'Weak';
        var pclass = 'danger';
        if (best.test(pass) == true) {
            stength = 'Very Strong';
            pclass = 'success';
        } else if (better.test(pass) == true) {
            stength = 'Strong';
            pclass = 'warning';
        } else if (good.test(pass) == true) {
            stength = 'Almost Strong';
            pclass = 'warning';
        } else if (bad.test(pass) == true) {
            stength = 'Weak';
        } else {
            stength = 'Very Weak';
        }

        var popover = password.attr('data-content', stength).data('bs.popover');
        popover.setContent();
        popover.$tip.addClass(popover.options.placement).removeClass('danger success info warning primary').addClass(pclass);
    }
});

/*--------------------------------------------------
|  Withdrawals Method Change
/*--------------------------------------------------*/
$(document).on('change', '#withdrawal_methods', function (e) {
    e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $.getJSON(baseUrl + 'common/get_selected_row/tbl_withdrawal_methods/id/' + $("#withdrawal_methods").val(), {
        [csrfName]: csrfHash
    }, function (data) {
        if (data.response !== '') {
            $('#withdrawal_threshold').val(data.response[0].threshold);
            $('#fee_method').val(data.response[0].cal_meth);
            $('#fee_amount').val(data.response[0].cal_meth);
            $('#withdrawal_status').val(data.response[0].status);
        }
    });
});


/*--------------------------------------------------
|  Withdrawals Filter Change
/*--------------------------------------------------*/
$(document).on('change', '#filter_type_withdraw', function (e) {
    e.preventDefault();
    loadWithdrawalsData($("#filter_type_withdraw").val());
});


/*--------------------------------------------------
|  Withdrawals Filter Change
/*--------------------------------------------------*/
$(document).on('change', '#filter_product', function (e) {
    e.preventDefault();
    searchLoadListingsData($("#filter_product").val());
});


/*--------------------------------------------------
|  Withdrawals Settings Update
/*--------------------------------------------------*/
$(document).on('submit', '#withdrawalsFrom', function (e) {
    e.preventDefault();
    $('#loader').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'admin/withdrawals_setup',
        data: $("#withdrawalsFrom").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                bootstrap_alert.success(sucessfullycompleted, '#notification');
            } else {
                bootstrap_alert.error(updateError, '#notification');
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});


/*--------------------------------------------------*/
/*  Copy Page URL Tooltip
/*--------------------------------------------------*/

function setTooltip(message, id) {
    $(id).tooltip('hide')
        .attr('data-original-title', message)
        .tooltip('show');
}

function hideTooltip(id) {
    setTimeout(function () {
        $(id).tooltip('hide');
    }, 1000);
}

function hideAllTooltips() {
    setTimeout(function () {
        $('.copy-url-button').tooltip('hide');
    }, 1000);
}

var cb = new ClipboardJS('.copy-pageurl');

$(document).on('click', '.copy-pageurl', function (event) {

    var link = $(this);
    var btn_id = $(this).attr('id');
    var clipboard = new ClipboardJS('#' + btn_id);

    $('#' + btn_id).tooltip({
        trigger: 'click',
        placement: 'bottom'
    });

    clipboard.on('success', function (e) {
        hideAllTooltips();
        setTooltip('Copied!', '#' + btn_id);
    });

    clipboard.on('error', function (e) {
        setTooltip('Failed!', '#' + btn_id);
        hideTooltip('#' + btn_id);
    });
});



/*--------------------------------------------------
| Listing Filter Change
/*--------------------------------------------------*/
$(document).on("change", "#filter_type", function (e) {
    e.preventDefault();
    loadListingsData($('#filter_type').val())
});

/*--------------------------------------------------
| Auction Listings
/*--------------------------------------------------*/
function auctionListings() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $('#loadingAuctions').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'main/loadAuctions/',
        data: {
            [csrfName]: csrfHash
        },
        success: function (data) {
            $('#auctionListings').fadeOut(100).html(data.response).fadeIn(500);
            $('#auctionListings').html(data.response);
            $('.txt_csrfname').val(data.token);
            $('#loadingAuctions').hide();
        },
        complete: function () {
            $('#loadingAuctions').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
}

/*--------------------------------------------------
| Auction Pagination
/*--------------------------------------------------*/
$(document).on("click", ".paginationAuction li a", function (e) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    e.preventDefault();
    $.ajax({
        url: baseUrl + "main/auction_pag/" + $('#myAuctionsTab .active').attr('id') + '/' + $(this).attr('data-ci-pagination-page'),
        method: "POST",
        data: {
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $('#auction_table').fadeOut(100).html(data.response).fadeIn(500);
        }
    });
});

/*--------------------------------------------------
| Auction Tab Change
/*--------------------------------------------------*/
$('#myAuctionsTab').on("shown.bs.tab", function (event) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $('#loadingAuctions').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'main/auction_pag/' + event.target.id + '/' + 0,
        data: {
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $('#auction_table').fadeOut(100).html(data.response).fadeIn(500);
            $('#auction_table').html(data.response);
            $('#loadingAuctions').hide();
        },
        complete: function () {
            $('#loadingAuctions').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});


/*--------------------------------------------------
| Offer Pagination
/*--------------------------------------------------*/
$(document).on("click", ".paginationOffer li a", function (e) {
    e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $.ajax({
        url: baseUrl + "main/offers_pag/" + $('#myOffersTab .active').attr('id') + '/' + $(this).attr('data-ci-pagination-page'),
        method: "POST",
        data: {
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $('#offer_table').fadeOut(100).html(data.response).fadeIn(500);
        }
    });
});

/*--------------------------------------------------
| Offer Tab Change
/*--------------------------------------------------*/
$('#myOffersTab').on("shown.bs.tab", function (event) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $('#loadingAuctions').show();
    $.ajax({
        method: 'POST',
        url: baseUrl + 'main/offers_pag/' + event.target.id + '/' + 0,
        data: {
            [csrfName]: csrfHash
        },
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $('#offer_table').fadeOut(100).html(data.response).fadeIn(500);
            $('#offer_table').html(data.response);
            $('#loadingAuctions').hide();
        },
        complete: function () {
            $('#loadingAuctions').hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});

/*--------------------------------------------------
| Year Filter Change
/*--------------------------------------------------*/
$(document).on("change", "#year_drop", function (e) {
    e.preventDefault();
    loadMonthlyWiseTotalEarnings('monthlyearningschart', $(this).val())
});

/*--------------------------------------------------
| Language Selection
/*--------------------------------------------------*/
$('.slippa-selectactive').select2({
    minimumResultsForSearch: Infinity
});


/*--------------------------------------------------
| Sort Selection
/*--------------------------------------------------*/
$('.slippa-sort').select2({
    minimumResultsForSearch: Infinity
});



/*--------------------------------------------------
| Pre Loader
/*--------------------------------------------------*/
jQuery(window).load(function () {
    jQuery(".slippa-preloder").fadeOut(300);
});


/*--------------------------------------------------
| Contact Form
/*--------------------------------------------------*/
$(document).on('submit', '#contactform', function (e) {
    e.preventDefault();
    $('#loader').show();

    if ($("#contact_name").val() === "") {
        bootstrap_alert.error(contactErrorEmptyName, '#notification');
        $('#loader').hide();
        return;
    }

    if ($("#contact_email").val() === "") {
        bootstrap_alert.error(contactErrorEmptyEmail, '#notification');
        $('#loader').hide();
        return;
    }

    if (!validateEmail($("#contact_email").val())) {
        bootstrap_alert.error(contactErrorInvalidEmail, '#notification');
        $('#loader').hide();
        return;
    }

    if ($("#contact_subject").val() === "") {
        bootstrap_alert.error(contactErrorEmptySubject, '#notification');
        $('#loader').hide();
        return;
    }

    if ($("#contact_msg").val() === "") {
        bootstrap_alert.error(contactErrorEmptyMsg, '#notification');
        $('#loader').hide();
        return;
    }

    $.ajax({
        method: 'POST',
        url: baseUrl + 'common/send_msg',
        data: $("#contactform").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response === true) {
                $('#loader').hide();
                clearInputs('contactform');
                bootstrap_alert.success(msgSentSuccess, '#notification');
            } else {
                $('#loader').hide();
                bootstrap_alert.error(updateError, '#notification');
            }
        },
        complete: function () {
            $('#loader').hide();
            $('#notification').show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
});

/*--------------------------------------------------
| Text Rotator
/*--------------------------------------------------*/
function textRotator() {

    var TxtRotate = function (el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtRotate.prototype.tick = function () {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

        var that = this;
        var delta = 300 - Math.random() * 100;

        if (this.isDeleting) {
            delta /= 2;
        }

        if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            this.loopNum++;
            delta = 500;
        }

        setTimeout(function () {
            that.tick();
        }, delta);
    };

    window.onload = function () {
        $.getJSON(baseUrl + 'common/text_rotator', function (textrot) {
            var elements = document.getElementsByClassName('txt-rotate');
            for (var i = 0; i < elements.length; i++) {
                var toRotate = textrot;
                var period = elements[i].getAttribute('data-period');
                if (toRotate) {
                    new TxtRotate(elements[i], toRotate, period);
                }

            }

            var css = document.createElement("style");
            css.type = "text/css";
            css.innerHTML = ".txt-rotate > .wrap { border-right: 0.08em solid #666 }";
            document.body.appendChild(css);
        });
    };
}


/*--------------------------------------------------
| Checkout page
/*--------------------------------------------------*/
function checkoutpage() {
    $(function () {

        if ($('.creditly-wrapper .paypal').length > 0) {
            var paypal = Creditly.initialize(
                '.creditly-wrapper .paypal .expiration-month-and-year',
                '.creditly-wrapper .paypal .credit-card-number',
                '.creditly-wrapper .paypal .security-code',
                '.creditly-wrapper .paypal .card-type');
        }


        if ($('.creditly-wrapper .stripe').length > 0) {
            var stripe = Creditly.initialize(
                '.creditly-wrapper .stripe .expiration-month-and-year',
                '.creditly-wrapper .stripe .credit-card-number',
                '.creditly-wrapper .stripe .security-code',
                '.creditly-wrapper .stripe .card-type');
        }


        $('input[type="radio"][name="cardType"]').change(function () {
            //console.log('change evbent fiere');
            if (this.value === 'PayPal_Pro') {
                if ($('#stripe').length > 0) {
                    hideDiv('#stripe');
                }
                if ($('#paypal-pro').length > 0) {
                    showDiv('#paypal-pro');
                }
            } else if (this.value === 'Stripe') {
                if ($('#stripe').length > 0) {
                    showDiv('#stripe');
                }
                if ($('#paypal-pro').length > 0) {
                    hideDiv('#paypal-pro');
                }
            }
        });

        $(".creditly-card-form .submitpay").click(function (e) {
            e.preventDefault();

            if ($('input[name="cardType"]:checked').val() === 'PayPal_Pro') {
                var output = paypal.validate();
                if (output) {
                    $(".submitpay").prop('disabled', true);
                    alert();
                    $('#txt_Domains').val(JSON.stringify(cartArray));
                    $('#txt_payTotal').val(shoppingCart.totalCart());
                    $('.txt_month').val(output["expiration_month"]);
                    $('.txt_year').val(output["expiration_year"]);
                    $('#paymentType').val('PayPal_Pro');
                    $('#paymentForm').submit();
                }
            } else if ($('input[name="cardType"]:checked').val() === 'Stripe') {
                $("#loader").css("display", "block");
                var output = stripe.validate();

                if (output) {
                    $('#txt_Domains').val(JSON.stringify(cartArray));
                    $('#txt_payTotal').val(shoppingCart.totalCart());
                    $('.txt_month').val(output["expiration_month"]);
                    $('.txt_year').val(output["expiration_year"]);
                    $('#paymentType').val('Stripe');
                    $(".submitpay").prop('disabled', true);

                    Stripe.createToken({
                        number: $('#stripe_credit_card').val(),
                        cvc: $('#security_code').val(),
                        exp_month: $("input[name=txt_month]").val(),
                        exp_year: $("input[name=txt_year]").val()
                    }, function (status, response) {
                        if (response.error) {
                            //enable the submit button
                            $("#submit-btn").show();
                            $("#loader").css("display", "none");
                            $(".submitpay").prop('disabled', false);
                            //display the errors on the form
                            // $("#error-message").html(response.error.message).show();
                            // console.log(response.error);
                            bootstrap_alert.error(response.error.code, '#paymentValidations');
                        } else {
                            $(".submitpay").prop('disabled', false);
                            $("#loader").css("display", "none");
                            //get token id
                            var token = response['id'];
                            //insert the token into the form
                            $("#paymentForm").append("<input type='hidden' name='token' value='" + token + "' />");
                            //submit form to the server
                            // $("#paymentForm")[0].submit();
                            $('#paymentForm').submit();
                        }
                    });
                }
                $("#loader").css("display", "none");
            } else if ($('input[name="cardType"]:checked').val() === 'PayPal_Express') {
                var cartArray = shoppingCart.listCart();
                $('#txt_Domains').val(JSON.stringify(cartArray));
                $('#txt_payTotal').val(shoppingCart.totalCart());
                $('#paymentType').val('PayPal_Express');
                $('#paymentForm').submit();
                $(".submitpay").prop('disabled', false);
                $("#loader").css("display", "none");
            }
        });

    });

    $("body").on("creditly_client_validation_error", function (e, data) {
        bootstrap_alert.error(data["messages"].join(", "), '#paymentValidations');
    });
    $("#loader").css("display", "none");


}



/*--------------------------------------------------
| Create Listings Checkout
/*--------------------------------------------------*/
function checkoutlistingspage() {
    $(function () {

        if ($('.creditly-wrapper .paypal').length > 0) {
            var paypal = Creditly.initialize(
                '.creditly-wrapper .paypal .expiration-month-and-year',
                '.creditly-wrapper .paypal .credit-card-number',
                '.creditly-wrapper .paypal .security-code',
                '.creditly-wrapper .paypal .card-type');
        }

        if ($('.creditly-wrapper .stripe').length > 0) {
            var stripe = Creditly.initialize(
                '.creditly-wrapper .stripe .expiration-month-and-year',
                '.creditly-wrapper .stripe .credit-card-number',
                '.creditly-wrapper .stripe .security-code',
                '.creditly-wrapper .stripe .card-type');
        }

        $(".creditly-card-form .submit").click(function (e) {
            e.preventDefault();
            if ($('input[name="branch_1_pay_1"]:checked').val() === 'payvia_card') {
                showDiv('#Pay_Credit_Card');
                hideDiv('#Pay_paypal');
                hideDiv('#Pay_free');
                hideDiv('#Pay_stripe');
                var output = paypal.validate();
                if (output) {
                    $('.txt_month').val(output.expiration_month);
                    $('.txt_year').val(output.expiration_year);
                    $('#payWrapper').submit();
                }
            } else if ($('input[name="branch_1_pay_1"]:checked').val() === 'payvia_stripe') {
                hideDiv('#Pay_Credit_Card');
                hideDiv('#Pay_paypal');
                hideDiv('#Pay_free');
                showDiv('#Pay_stripe');
                var output = stripe.validate();
                if (output) {
                    $('.txt_month').val(output.expiration_month);
                    $('.txt_year').val(output.expiration_year);
                    $('#payWrapper').submit();
                }
            } else if ($('input[name="branch_1_pay_1"]:checked').val() === 'payvia_paypal') {
                hideDiv('#Pay_Credit_Card');
                showDiv('#Pay_paypal');
                hideDiv('#Pay_free');
                hideDiv('#Pay_stripe');
                $('#payWrapper').submit();
            } else if ($('input[name="branch_1_pay_1"]:checked').val() === 'free_checkout') {
                hideDiv('#Pay_Credit_Card');
                hideDiv('#Pay_paypal');
                showDiv('#Pay_free');
                hideDiv('#Pay_stripe');
                $('#payWrapper').submit();
            }
        });
    });

    $("body").on("creditly_client_validation_error", function (e, data) {
        bootstrap_alert.error(data["messages"].join(", "), '#paymentValidations');
    });
}

/*--------------------------------------------------
| Plugin Status Changer
/*--------------------------------------------------*/

$(".plugin_activate").click(function () {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    if ($(this).attr('data-actkey') !== 'VPS') {
        if ($(this).hasClass("active")) {
            id = $(this).attr('data-pluginid');
            status = 1;
        } else {
            id = $(this).attr('data-pluginid');
            status = 0;
        }

        $.getJSON(baseUrl + 'common/plugin_status_changer/' + id + '/' + status, {
            [csrfName]: csrfHash
        }, function (data) {
            $('.txt_csrfname').val(data.token);
            if (data.response !== 'false') {
                location.reload(true);
                return;
            }
        });
    }
});


/*--------------------------------------------------
| General Dates Changer
/*--------------------------------------------------*/
$(document).on('submit', '#modalListingChanger', function (e) {
    e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $.ajax({
        url: baseUrl + "common/update_listing_plans/",
        method: "POST",
        data: $("#modalListingChanger").serialize(),
        dataType: 'json',
        success: function (data) {
            $('.txt_csrfname').val(data.token);
            $('#change-listing').modal('hide');
        }
    });
});

/*--------------------------------------------------
| Hide Div
/*--------------------------------------------------*/
function hideDiv(el) {
    $('input', el).each(function () {
        $(this).attr('disabled', 'disabled');
    });
    $(el).hide();
}


/*--------------------------------------------------
| Show Div
/*--------------------------------------------------*/
function showDiv(el) {
    $('input', el).each(function () {
        $(this).removeAttr('disabled');
    });
    $(el).show();
}


/*--------------------------------------------------*/
/* Bunisess name under development
/*--------------------------------------------------*/

// $(document).on('change', '#businessName', function (e) {
//     var bunisessName = $("#busniessName").val();
//     alert(bunisessName);

//     bootstrap_alert.success('Please wait..', '#ContinueVal');
//     $("#businessName").prop("readonly", true);
//     setTimeout(function () {
//         var bunisessName = $("#busniessName").val();
//         $("#domainName").html(bunisessName);
//         $("#WebsiteName").html(bunisessName);
//         $("#website_BusinessName").val(bunisessName);
//         $("#domainTitle").html(bunisessName);
//         // $("#domain_id").val(values.id);
//         $("#FirstTab").removeAttr('href');
//         $("#FirstStep").show();
//         $("#collapseOne").collapse('hide');
//         $("#collapseTwo").collapse('toggle');
//     }, 2000);
//     return;
// })

/** changes in webiste_status on selected option */
$("#selected_section").hide();
$("#website_status").on('change', function () {
    var selectedValue = $('select[name="website_status"] option:selected').val().trim();
    var optionValue = $('select[name="website_status"] option:selected').attr('data-file');
    var fileName = 'user/includes/' + optionValue;

    if (selectedValue == 'Established') {
        showPartials(fileName);
        $("#selected_section").show();
    } else if (selectedValue == 'Starter') {
        showPartials(fileName);
        $("#selected_section").show();
    } else {
        $("#selected_section").hide();
    }

});


/* common ajax function  */
function ajax(url, method, data, asyncVal = true) {
    return $.ajax({
        async: asyncVal,
        url: url,
        method: method,
        data: data,
    });
}

/* show partials */
function showPartials(partialName) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var url = baseUrl + "user/load_partial";
    var data = {
        [csrfName]: csrfHash,
        'page': partialName
    }
    ajax(url, 'POST', data).done(
        function (msg) {
            data = JSON.parse(msg);
            $('.txt_csrfname').val(data.token);
            $("#selected_section").html(data.response);
            datapickerInit()
        }).fail(function (msg) {
            $("#selected_section").html("System error");
        });

}


// on ajax view collect date (partial page)
$(document).on('change', "#established_date", function () {
    oldDate = $("#established_date").val();
    calculateAge(oldDate);
});

// calculate age
function calculateAge(oldDate) {
    todayDate = Date.parse(formatDate(new Date()));
    oldDate = Date.parse(formatDate(oldDate));
    var age = Math.round((todayDate - oldDate) / (365.25 * 24 * 60 * 60 * 1000));
    $("#website_age").val(age);
}

//date format  yyyy/mm/dd
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('/');
}

// datapicker code can not futhur to current data
function datapickerInit() {
    var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
    $('.datepicker').datepicker({
        orientation: 'bottom',
        format: 'yyyy/mm/dd',
        todayHighlight: true,
        autoclose: true,
        endDate: '+0d',

    })
}
// call function to dom date input
datapickerInit();

// Normal datapicker code
function datapickerNormal() {
    var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
    $('.datapickerNormal').datepicker({
        orientation: 'bottom',
        format: 'yyyy/mm/dd',
        todayHighlight: true,
        autoclose: true,

    })
}

// call function to dom date input
datapickerNormal();

// Get solution's subcategory  for admin
$(document).on('change', '#solution_category', function () {
    let mainCategory = $("#solution_category").val();
    let csrfName = $('.txt_csrfname').attr('name');
    let csrfHash = $('.txt_csrfname').val();

    data = {
        'categoryId': mainCategory,
        [csrfName]: csrfHash,
    }
    let url = baseUrl + "admin/subCategorySolution";
    $response = ajax(url, 'POST', data)
        .done(function (data) {
            $('.txt_csrfname').val(data.token);
            formatElement = $("#sub_category");
            var option_html = '<option value="">Select SubCategory</option>';
            data.subCategories.forEach(function (element) {
                option_html += '<option value="' + element.id + '">' + element.c_name + '</option>';
            })
            $("#sub_category").html(option_html);
        })
        .fail(function (data) {

            $('.txt_csrfname').val(data.token);

        });
});


// Get solution's subcategory  for user
$(document).on('change', '#solution_category_user', function () {
    let mainCategory = $("#solution_category_user").val();
    let csrfName = $('.txt_csrfname').attr('name');
    let csrfHash = $('.txt_csrfname').val();

    data = {
        'categoryId': mainCategory,
        [csrfName]: csrfHash,
    }
    let url = baseUrl + "user/subCategorySolution";
    $response = ajax(url, 'POST', data)
        .done(function (data) {
            $('.txt_csrfname').val(data.token);
            formatElement = $("#sub_category");
            var option_html = '<option value="">Select SubCategory</option>';
            data.subCategories.forEach(function (element) {
                option_html += '<option value="' + element.id + '">' + element.c_name + '</option>';
            })
            $("#sub_category").html(option_html);
        })
        .fail(function (data) {
            $('.txt_csrfname').val(data.token);
        });
});


// Get solution's subcategory  for admin
$(document).on('change', '#solution_category_admin', function () {
    let mainCategory = $("#solution_category_admin").val();
    let csrfName = $('.txt_csrfname').attr('name');
    let csrfHash = $('.txt_csrfname').val();

    data = {
        'categoryId': mainCategory,
        [csrfName]: csrfHash,
    }
    let url = baseUrl + "admin/subCategorySolution";
    $response = ajax(url, 'POST', data)
        .done(function (data) {
            $('.txt_csrfname').val(data.token);
            formatElement = $("#sub_category");
            var option_html = '<option value="">Select SubCategory</option>';
            data.subCategories.forEach(function (element) {
                option_html += '<option value="' + element.id + '">' + element.c_name + '</option>';
            })
            $("#sub_category").html(option_html);
        })
        .fail(function (data) {
            $('.txt_csrfname').val(data.token);
        });
});


// // Get solution's subcategory  admin
// $(document).on('change', '#admin_solution_category', function () {
//     let mainCategory = $("#admin_solution_category").val();
//     let csrfName = $('.txt_csrfname').attr('name');
//     let csrfHash = $('.txt_csrfname').val();

//     data = {
//         'categoryId': mainCategory,
//         [csrfName]: csrfHash,
//     }
//     let url = baseUrl + "admin/subCategorySolution";
//     $response = ajax(url, 'POST', data)
//         .done(function (data) {
//             $('.txt_csrfname').val(data.token);
//             formatElement = $("#sub_category");
//             var option_html = '<option value="">Select SubCategory</option>';
//             data.subCategories.forEach(function (element) {
//                 option_html += '<option value="' + element.id + '">' + element.c_name + '</option>';
//             })
//             $("#sub_category").html(option_html);
//         })
//         .fail(function (data) {
//             $('.txt_csrfname').val(data.token);
//         });
// });



/*--------------------------------------------------*/
/*  Select Specific item from dropdown
/*--------------------------------------------------*/
"use strict";

function selectElement(id, valueToSelect) {
    $('#' + id).val(valueToSelect);
}



/**
 * Solution will be website , app and domain
 * 
 */

$(document).on('change', '#txt_solution_url', function () {

    if (!isUrlValid($("#txt_solution_url").val())) {
        bootstrap_alert.error(errorinvalidUrl, '#SolutionUrlValMsg');
        $("#txt_solution_url").val('')
        return;
    }
});



/*--------------------------------------------------*/
/*  validation of solutions form step1 user
/*--------------------------------------------------*/

$(document).on('click', '#solution_step1', function (e) {
    e.preventDefault();
    // console.log("outside ---");
    $('#txt_solution_url_slug').next().remove('span');

    var form = $('#solutionFormStep1');
    form.validate();
    if (form.valid()) {
        if (checkSolutionSlug()) {
            $('#txt_solution_url_slug').next().remove('span');
            // console.log("inside ---");
            tinyMCE.triggerSave();
            //if (form.valid()) {
            url = baseUrl + 'user/addSolution'
            data = form.serialize();
            ajax(url, 'POST', data)
                .done(function (data) {
                    $('.txt_csrfname').val(data.token);
                    $('input[name="solution_id"]').val(data.response.id);
                    $('input[name="list_id"]').val(data.response.list_id);
                    $('input[name="txt_listingid"]').val(data.response.list_id);
                    $('input[name="domain_id"]').val(data.response.domain_id);
                    // -move to next step2
                    $("#home").removeClass('active');
                    $("#menu3").removeClass('active');
                    $("#menu2").removeClass('active');
                    $("a[href=#home]").removeClass('active');
                    $("a[href=#menu3]").removeClass('active');
                    $("a[href=#menu2]").removeClass('active');

                    $("a[href=#menu1]").addClass('active');
                    $("#menu1").addClass('active');
                })
                .fail(function (error) {


                });
            //}
        }
    }
});




/*--------------------------------------------------*/
/*  validation of solutions form step2
/*--------------------------------------------------*/
$(document).on('click', '#solution_step2', function (e) {
    e.preventDefault();

    // -move to next step3
    $("#home").removeClass('active');
    $("a[href=#home]").removeClass('active');

    $("#menu1").removeClass('active');
    $("a[href=#menu1]").removeClass('active');

    $("a[href=#menu2]").addClass('active');
    $("#menu2").addClass('active');


    $("#menu3").removeClass('active');
    $("a[href=#menu3]").removeClass('active');


});


/*--------------------------------------------------*/
/*  pervious  of solutions form step2 to step1
/*--------------------------------------------------*/
$(document).on('click', '#solution_step_2', function (e) {
    e.preventDefault();

    // -move to next step3
    $("#menu1").removeClass('active');
    $("#menu2").removeClass('active');
    $("#menu3").removeClass('active');
    $("a[href=#menu1]").removeClass('active');
    $("a[href=#menu2]").removeClass('active');
    $("a[href=#menu3]").removeClass('active');

    $("a[href=#home]").addClass('active');
    $("#home").addClass('active');


});



/*--------------------------------------------------*/
/*  pervious  of solutions form step3 to step2
/*--------------------------------------------------*/
$(document).on('click', '#solution_step_3', function (e) {
    e.preventDefault();


    $("a[href=#home]").removeClass('active');
    $("#home").removeClass('active');

    $("#menu1").addClass('active');
    $("a[href=#menu1]").addClass('active');

    $("#menu2").removeClass('active');
    $("a[href=#menu2]").removeClass('active');

    $("#menu3").removeClass('active');
    $("a[href=#menu3]").removeClass('active');


});





// /*--------------------------------------------------*/
// /*  validation of solutions form step3
// /*--------------------------------------------------*/
// $(document).on('click', '#solution_step3', function (e) {
//     e.preventDefault();

//     // -move to next step4
//     $("#home").removeClass('active');
//     $("a[href=#home]").removeClass('active');

//     $("#menu2").removeClass('active');
//     $("a[href=#menu2]").removeClass('active');


//     $("#menu3").removeClass('active');
//     $("a[href=#menu3]").removeClass('active');

//     $("a[href=#menu4]").addClass('active');
//     $("#menu4").addClass('active');

// });
/*--------------------------------------------------*/
/*  pervious  of solutions form step4 to step3
/*--------------------------------------------------*/
$(document).on('click', '#solution_step_4', function (e) {
    e.preventDefault();


    $("a[href=#home]").removeClass('active');
    $("#home").removeClass('active');

    $("#menu1").removeClass('active');
    $("a[href=#menu1]").removeClass('active');

    $("#menu2").addClass('active');
    $("a[href=#menu2]").addClass('active');

    $("#menu3").removeClass('active');
    $("a[href=#menu3]").removeClass('active');


});

// /*--------------------------------------------------*/
// /*  validation of solutions form step4
// /*--------------------------------------------------*/
// $(document).on('click', '#solution_step4', function (e) {
//     e.preventDefault();

//     // -move to next step5
//     $("#home").removeClass('active');
//     $("a[href=#home]").removeClass('active');

//     $("#menu4").removeClass('active');
//     $("a[href=#menu4]").removeClass('active');

//     $("a[href=#menu5]").addClass('active');
//     $("#menu5").addClass('active');

// });

/*--------------------------------------------------*/
/*  pervious  of solutions form step5 to step4
/*--------------------------------------------------*/
$(document).on('click', '#solution_step_5', function (e) {
    e.preventDefault();


    $("a[href=#home]").removeClass('active');
    $("#home").removeClass('active');

    $("#menu1").removeClass('active');
    $("a[href=#menu1]").removeClass('active');

    $("#menu3").addClass('active');
    $("a[href=#menu3]").addClass('active');

    
    $("#menu4").removeClass('active');
    $("a[href=#menu4]").removeClass('active');


});


/*--------------------------------------------------*/
/*  pervious  of solutions form step4 to step3
/*--------------------------------------------------*/
$(document).on('click', '#solution_step_6', function (e) {
    e.preventDefault();


    $("a[href=#home]").removeClass('active');
    $("#home").removeClass('active');

    $("#menu1").removeClass('active');
    $("a[href=#menu1]").removeClass('active');

    $("#menu4").addClass('active');
    $("a[href=#menu4]").addClass('active');

    $("#menu5").removeClass('active');
    $("a[href=#menu5]").removeClass('active');


});



/*--------------------------------------------------*/
/*  validation of solutions form step3
/*--------------------------------------------------*/
$(document).on('click', '#solution_step3', function (e) {
    e.preventDefault();
    var form = $('#solutionFormStep3');
    form.validate();
    if (form.valid()) {
        url = baseUrl + 'user/addSolution'
        data = form.serialize();
        ajax(url, 'POST', data)
            .done(function (data) {
                $('.txt_csrfname').val(data.token);
                $('input[name="solution_id"]').val(data.response.id);
                $('input[name="list_id"]').val(data.response.list_id);
                $('input[name="txt_listingid"]').val(data.response.list_id);
                $('input[name="domain_id"]').val(data.response.domain_id);
                // -move to next step4
                $("#home").removeClass('active');
                $("#menu2").removeClass('active');
                $("#menu1").removeClass('active');
                $("#menu4").removeClass('active');
                $("#menu5").removeClass('active');
                $("a[href=#home]").removeClass('active');
                $("a[href=#menu2]").removeClass('active');
                $("a[href=#menu1]").removeClass('active');
                $("a[href=#menu4]").removeClass('active');
                $("a[href=#menu5]").removeClass('active');

                $("a[href=#menu3]").addClass('active');
                $("#menu3").addClass('active');

            })
            .fail(function (error) {
                $('.txt_csrfname').val(error.token);


            });
    }

});



/*--------------------------------------------------*/
/*  validation of solutions form step3
/*--------------------------------------------------*/
$(document).on('click', '#solution_step4', function (e) {
    e.preventDefault();
    var form = $('#solutionFormStep4');
    let price = parseInt($('#website_buynowprice_soln').val());
    let view_price = parseInt($('#view_buynow').val());
    $.validator.addMethod("notMoreThen", function (value, element) {
        if ( price < view_price) {
            return false;
        } else {
            return true;
        };
    }, "View Price value not more then Price value");

    form.validate();
    if (form.valid()) {
        url = baseUrl + 'user/addSolution'
        data = form.serialize();
        ajax(url, 'POST', data)
            .done(function (data) {
                $('.txt_csrfname').val(data.token);
                $('input[name="solution_id"]').val(data.response.id);
                $('input[name="list_id"]').val(data.response.list_id);
                $('input[name="domain_id"]').val(data.response.domain_id);
                //$('#myModal').modal('show');

                $("#menu4").removeClass('active');
                $("#menu3").removeClass('active');
                $("a[href=#menu3]").removeClass('active');
                $("a[href=#menu4]").removeClass('active');
            
                $("a[href=#menu4]").addClass('active');
                $("#menu4").addClass('active');
            
            })
            .fail(function (error) {
                $('.txt_csrfname').val(error.token);


            });
    }

});




/*--------------------------------------------------*/
/*  validation of solutions form step4 edit case
/*--------------------------------------------------*/
$(document).on('click', '#solution_step_edit_4', function (e) {
    e.preventDefault();
    var form = $('#solutionFormStep4');
    let price = parseInt($('#website_buynowprice_soln').val());
    let view_price = parseInt($('#view_buynow').val());
    let trueORFalse = price <view_price ? false : true;
    console.log(trueORFalse);
    $.validator.addMethod("notMoreThen", function (value, element) {
        if ( price < view_price) {
            return false;
        } else {
            return true;
        };
    }, "View Price value not more then Price value");

    form.validate(
       { 
           rules: {
            view_price:{
                notMoreThen:true
            },
          },
        
        }
    );
    if (form.valid()) {
        url = baseUrl + 'user/addSolution'
        data = form.serialize();
        ajax(url, 'POST', data)
            .done(function (data) {
                $('.txt_csrfname').val(data.token);
                $('input[name="solution_id"]').val(data.response.id);
                $('input[name="list_id"]').val(data.response.list_id);
                $('input[name="domain_id"]').val(data.response.domain_id);
                $('#myModal').modal('show');

                $("#menu4").removeClass('active');
                $("#menu3").removeClass('active');
                $("a[href=#menu3]").removeClass('active');
                $("a[href=#menu4]").removeClass('active');
            
            })
            .fail(function (error) {
                $('.txt_csrfname').val(error.token);


            });
    }

});


/*--------------------------------------------------*/
/*  validation of solutions form step4
/*--------------------------------------------------*/
$(document).on('click', '#solution_step5', function (e) {

    var form = $('#solutionFormStep5');
    form.validate();
    if (form.valid()) {
        e.preventDefault();
        $("#home").removeClass('active');
        $("#menu2").removeClass('active');
        $("#menu1").removeClass('active');
        $("#menu3").removeClass('active');
        $("#menu4").removeClass('active');
        $("a[href=#home]").removeClass('active');
        $("a[href=#menu2]").removeClass('active');
        $("a[href=#menu1]").removeClass('active');
        $("a[href=#menu3]").removeClass('active');
        $("a[href=#menu4]").removeClass('active');

        $("a[href=#menu5]").addClass('active');
        $("#menu5").addClass('active');
    }
    

});


/*--------------------------------------------------*/
/*  validation of solutions form step5
/*--------------------------------------------------*/
$(document).on('click', '.solution_step6', function (e) {
    e.preventDefault();
    $("#home").removeClass('active');
    $("#menu2").removeClass('active');
    $("#menu1").removeClass('active');
    $("#menu3").removeClass('active');
    $("#menu4").removeClass('active');
    $("#menu5").removeClass('active');
    $("a[href=#home]").removeClass('active');
    $("a[href=#menu2]").removeClass('active');
    $("a[href=#menu1]").removeClass('active');
    $("a[href=#menu3]").removeClass('active');
    $("a[href=#menu4]").removeClass('active');
    $("a[href=#menu5]").removeClass('active');

    $("a[href=#menu6]").addClass('active');
    $("#menu6").addClass('active');

});


/*--------------------------------------------------*/
/*  redirect after complete solutins adding
/*--------------------------------------------------*/
$(document).on('click', "#closeUser,#btnTimesUser", function () {
    setTimeout(function () {
        window.location.href = baseUrl + "user/manage_solutions"
    }, 1000);
});

//---- admin123----///

/*--------------------------------------------------*/
/*  validation of solutions form step12 
/*--------------------------------------------------*/

$(document).on('click', '#solution_step12', function (e) {
    e.preventDefault();
    if (checkSolutionSlug()) {
        tinyMCE.triggerSave();
        var form = $('#solutionFormStep12');
        form.validate();
        if (form.valid()) {
            url = baseUrl + 'admin/addSolution'
            data = form.serialize();
            // console.log(data);
            ajax(url, 'POST', data)
                .done(function (data) {
                    $('.txt_csrfname').val(data.token);
                    $('input[name="solution_id"]').val(data.response.id);
                    $('input[name="list_id"]').val(data.response.list_id);
                    $('input[name="domain_id"]').val(data.response.domain_id);
                    // -move to next step2
                    $("#home").removeClass('active');
                    $("#menu3").removeClass('active');
                    $("#menu2").removeClass('active');
                    $("a[href=#home]").removeClass('active');
                    $("a[href=#menu3]").removeClass('active');
                    $("a[href=#menu2]").removeClass('active');

                    $("a[href=#menu1]").addClass('active');
                    $("#menu1").addClass('active');
                })
                .fail(function (error) {


                });
        }

    }
});


/*--------------------------------------------------*/
/*  validation of solutions form step2
/*--------------------------------------------------*/
$(document).on('click', '#solution_step22', function (e) {
    // e.preventDefault();

    // -move to next step3
    $("#home").removeClass('active');
    $("#menu3").removeClass('active');

    $("#menu1").removeClass('active');
    $("a[href=#home]").removeClass('active');
    $("a[href=#menu2]").removeClass('active');
    $("a[href=#menu1]").removeClass('active');
    $("a[href=#menu2]").addClass('active');
    $("#menu2").addClass('active');

});


/*--------------------------------------------------*/
/*  validation of solutions form step3
/*--------------------------------------------------*/
$(document).on('click', '#solution_step32', function (e) {
    e.preventDefault();
    var form = $('#solutionFormStep32');
    form.validate();
    if (form.valid()) {
        url = baseUrl + 'admin/addSolution'
        data = form.serialize();
        ajax(url, 'POST', data)
            .done(function (data) {
                $('.txt_csrfname').val(data.token);
                $('input[name="solution_id"]').val(data.response.id);
                // -move to next step4
                $("#home").removeClass('active');
                $("#menu2").removeClass('active');
                $("#menu1").removeClass('active');
                $("a[href=#home]").removeClass('active');
                $("a[href=#menu2]").removeClass('active');
                $("a[href=#menu1]").removeClass('active');

                $("a[href=#menu3]").addClass('active');
                $("#menu3").addClass('active');

            })
            .fail(function (error) {
                $('.txt_csrfname').val(error.token);


            });
    }

});



/*--------------------------------------------------*/
/*  validation of solutions form step3
/*--------------------------------------------------*/
$(document).on('click', '#solution_step42', function (e) {
    e.preventDefault();
    var form = $('#solutionFormStep42');
    let price = parseInt($('#website_buynowprice_soln').val());
    let view_price = parseInt($('#view_buynow').val());
    $.validator.addMethod("notMoreThen", function (value, element) {
        if ( price < view_price) {
            return false;
        } else {
            return true;
        };
    }, "View Price value not more then Price value");

    form.validate(
        { 
            rules: {
             view_price:{
                 notMoreThen:true
             },
           },
         
         }
    );
    if (form.valid()) {
        url = baseUrl + 'admin/addSolution'
        data = form.serialize();
        ajax(url, 'POST', data)
            .done(function (data) {
                $('.txt_csrfname').val(data.token);
                $('input[name="solution_id"]').val(data.response.id);
                $('#myModal').modal('show');
            })
            .fail(function (error) {
                $('.txt_csrfname').val(error.token);


            });
    }

});
/*--------------------------------------------------*/
/*  redirect after complete solutins adding
/*--------------------------------------------------*/
$(document).on('click', "#close,#btnTimes", function () {
    setTimeout(function () {
        window.location.href = baseUrl + "admin/solution_listings"
    }, 1000);
});
// $('a[href=#menu1]').css('pointer-events', 'none');
// $('a[href=#menu2]').css('pointer-events', 'none');
// $('a[href=#menu3]').css('pointer-events', 'none');


/*--------------------------------------------------*/
/*  delte solutions 
/*--------------------------------------------------*/
$(document).on('click', '#deleteSolution', function (e) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var url = baseUrl + $("#deleteSolution").attr('data-url');

    var data = {
        [csrfName]: csrfHash,
        "solution_id": $(this).attr("data-id").trim(),
    };

    bootbox.confirm({
        message: "Confirm !! Do You Want to Delete.",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-warning'
            },
            cancel: {
                label: 'No',
                className: 'btn-dark'
            }
        },
        callback: function (result) {
            if (result == true) {
                ajax(url, 'POST', data)
                    .done(function (data) {
                        $('.txt_csrfname').val(data.token);
                        location.reload()
                    })
                    .fail(function (error) {
                        $('.txt_csrfname').val(error.token);
                    });
            }

        }
    });

});

// confirmation ask before delete the solutions files
$(document).on('click', '.solution_file', function () {
    csrfName = $('.txt_csrfname').attr('name');
    csrfHash = $('.txt_csrfname').val();
    image = $(this).attr('data-id');
    imageArr = image.split("_");
    url = baseUrl + 'user/deleteSolutionMedia'

    bootbox.confirm({
        message: "Confirm !! Do You Want to Delete?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-warning'
            },
            cancel: {
                label: 'No',
                className: 'btn-dark'
            }
        },
        callback: function (result) {
            if (result == true) {
                data = {
                    [csrfName]: csrfHash,
                    "solution_id": imageArr[1]
                };
                ajax(url, 'POST', data).done(function (data) {
                    $('.txt_csrfname').val(data.token);
                    $("#" + image).remove()
                }).fail(function (data) {
                    $('.txt_csrfname').val(data.token);

                })
            }
        }

    });
});


// admin side delete solution images solution_file_admin
$(document).on('click', '.solution_file_admin', function () {
    csrfName = $('.txt_csrfname').attr('name');
    csrfHash = $('.txt_csrfname').val();
    image = $(this).attr('data-id');
    imageArr = image.split("_");
    url = baseUrl + 'admin/deleteSolutionMedia'

    bootbox.confirm({
        message: "Confirm !! Do You Want to Delete?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-warning'
            },
            cancel: {
                label: 'No',
                className: 'btn-dark'
            }
        },
        callback: function (result) {
            if (result == true) {
                data = {
                    [csrfName]: csrfHash,
                    "solution_id": imageArr[1]
                };
                ajax(url, 'POST', data).done(function (data) {
                    $('.txt_csrfname').val(data.token);
                    $("#" + image).remove()
                }).fail(function (data) {
                    $('.txt_csrfname').val(data.token);

                })
            }
        }

    });
});


//change in monetized_since date is greater than established date
$(document).on('changeDate', '#monetized_since', function (e) {
    e.preventDefault();

    var newDate = $("#monetized_since").val();
    if (newDate !== "" && newDate !== undefined) {
        calculateDateDiff(newDate);
    }
    return;
});
// monetized_since is less than established_date
function calculateDateDiff(givenDate) {

    if ($('#monetized_since').length > 0) {
        $('#monetized_since').next().remove('span');
    }
    if ($('#established_date').length > 0) {
        $('#established_date').next().remove('span');
    }
    oldDate = $("#established_date").val();
    if (oldDate !== null && oldDate !== '') {
        if (givenDate < oldDate) {
            $('#monetized_since').datepicker('setDate', "");
            $("#monetized_since").after('<span for="monetized_since" class="error">Date must be greater than Established date</span>');
        }
    } else {
        $("#established_date").after('<span for="established_date" class="error">Select Established date </span>');
        $('#monetized_since').datepicker('setDate', '');

    }
}
// image formate check before upload.
$(document).ready(function () {
    $(document).on('change', "#uploadListingImage", function () {
        var ext = $("#uploadListingImage").val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['svg', 'png', 'jpg', 'jpeg']) == -1) {
            $("#uploadListingImage").after('<span for="uploadListingImage" class="error">Only image allowed</span>');
            $('.uploadButton-file-name-cover').html('');
            $("#uploadListingImage").val('');
        } else {
            $("#uploadListingImage").next().remove('span');

        }
    });

    $(document).on('change', "#uploadThumbnailImage", function () {
        var ext = $("#uploadThumbnailImage").val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['svg', 'png', 'jpg', 'jpeg']) == -1) {
            $("#uploadThumbnailImage").after('<span for="uploadListingImage" class="error">Only image allowed</span>');
            $('.uploadButton-file-name-thumb').html('')
            $("#uploadThumbnailImage").val('')
        } else {
            $("#uploadThumbnailImage").next().remove('span');
        }
    });
});



/*--------------------------------------------------*/
/*  Ajax pagination common
/*--------------------------------------------------*/
$(document).on('submit', '#membershipListingForm', function (e) {
    e.preventDefault();
    var form = $(this);
    form.validate({
        focusInvalid: false,
        invalidHandler: function (form, validator) {
            if (!validator.numberOfInvalids())
                return;
            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 2000);
        }
    });
    if (form.valid()) {
        form[0].submit();
    }
});

$(document).on('submit', '#permissionListingForm', function (e) {
    e.preventDefault();
    var form = $('#permissionListingForm');
    form.validate();
    if (form.valid()) {
        form[0].submit();
    }
});


$(document).on('submit', '#addCourseForm', function (e) {
    e.preventDefault();
    var form = $(this);
    form.validate();
    if (form.valid()) {
        form[0].submit();
    }
});
$(document).on('submit', '#addLessionForm', function (e) {
    e.preventDefault();
    var form = $(this);
    form.validate();
    if ($("#vimeo_id").val().trim() != "" && $("#vimeo_id").val().trim() != null) {
        $res = checkVimeoNumber().done(function (response) {
            $('.txt_csrfname').val(response.token);
            if (response.vimeo_id == 1) {
                $("#vimeo_id").after('<span for="vimeo_id" class="error">Vimeo-Id Already Exists.</span>');

            }
        }).fail(function (response) {
            $('.txt_csrfname').val(response.token);
        });
        //console.log($res.responseJSON); //
        if ($res.responseJSON.vimeo_id == 1) {
            // console.log("inside--"); 
            return false;
        }
    }


    if (form.valid()) {
        form[0].submit();

    }

});

/**
 * check vimeo id exit is same course
 */
function checkVimeoNumber() {

    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var url = baseUrl + "admin/checkVimeoNumber";
    var vimeoId = $("#vimeo_id").val().trim();
    var lesson_id = $("#lesson_id").val().trim();
    if (vimeoId !== null && vimeoId !== '') {
        var data = {
            [csrfName]: csrfHash,
            "vimeo_number": vimeoId,
            'lesson_id': lesson_id,
            "course_id": $("#course_id").val().trim(),
        };
        return ajax(url, "POST", data, false);
    }

}


function vimeoId() {
    var vimeoURL = $("#vimeo_id").val();
    if (vimeoURL !== null && vimeoURL !== '') {
        var vimeoId = getIdFromVimeoURL(vimeoURL);

        if (vimeoId !== false) {
            $("#vimeo_id").val(vimeoId);
        } else {
            $("#vimeo_id").after('<span for="vimeo_id" class="error">Invalide Vimeo URL</span>');
            $("#vimeo_id").val('');
        }

    }
}
/* console.log(getIdFromVimeoURL("https://vimeo.com/channels/staffpicks/272053388"))
 console.log(getIdFromVimeoURL("https://vimeo.com/272053388"))
 console.log(getIdFromVimeoURL("https://player.vimeo.com/video/272053388"))
 */

/* get vimeo id validation */
function getIdFromVimeoURL(url) {
    try {
        return /(vimeo(pro)?\.com)\/(?:[^\d]+)?(\d+)\??(.*)?$/.exec(url)[3];
    } catch (err) {
        return false;
    }
}





/*** To delete one by one lesson ****/
$(document).on('click', '#deleteLesson', function (e) {
    csrfName = $('.txt_csrfname').attr('name');
    csrfHash = $('.txt_csrfname').val();
    lesson_id = $(this).attr("data-id").trim(),
        name = $(this).attr("data-name").trim(),
        url = baseUrl + $("#deleteLesson").attr('data-url') + "/" + lesson_id;
    bootboxConfirm(url, csrfName, csrfHash, name)

});

/*** To delete Course with all lesson also */
$(document).on('click', '.deleteCourse', function (e) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var url = baseUrl + $(".deleteCourse").attr('data-url');
    var name = $(this).attr('data-name');

    var data = {
        [csrfName]: csrfHash,
        "course_id": $(this).attr("data-id").trim(),
    };

    bootbox.confirm({
        message: "<b>" + name + "</b>:  Course Will Delete, Then All Lessons  Associate Will also Delete... <br> Confirm !! Do You Want to Delete.",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-warning'
            },
            cancel: {
                label: 'No',
                className: 'btn-dark'
            }
        },
        callback: function (result) {
            if (result == true) {
                ajax(url, 'POST', data)
                    .done(function (data) {
                        $('.txt_csrfname').val(data.token);
                        if (data.response == "success") {
                            bootbox.alert("Record Deleted Successfully", function () {
                                location.reload()
                            });
                        } else if (data.response == "error") {
                            bootbox.alert("Something Went Wrong")
                        }
                    })
                    .fail(function (error) {
                        $('.txt_csrfname').val(error.token);
                    });
            }

        }
    });

});

$(document).on('change', '.chkbox', function () {
    var chkbox = $(this);
    console.log(chkbox.attr('data-id'));
    var chkboxId = "#" + chkbox.attr('data-id');
    if (chkbox.is(':checked') == true) {
        $((chkboxId)).prop('disabled', 'true');
    } else {
        $((chkboxId)).prop('disabled', false);
    }
});

$(document).on('click', '.course-category-edit', function () {
    $("#course-category").modal({
        show: true,
        backdrop: 'static',
        keyboard: false
    });
    csrfName = $('.txt_csrfname').attr('name');
    csrfHash = $('.txt_csrfname').val();
    url = baseUrl + 'admin/getCouseCategory';
    categoryId = $(this).attr('data-id');
    data = {
        [csrfName]: csrfHash,
        categoryId: categoryId,
    };
    ajax(url, 'POST', data).done(function (data) {
        $('.txt_csrfname').val(data.token);
        $('#course_category_id').val(data.category.id);
        $(".category_name").val(data.category.category);
        $("#category_status").val(data.category.status);
        var parentCategory = $("#course_parent_category");
        parentCategory.empty();
        parentCategory.append($("<option />").val('0').text('Optional Select Category'));
        $.each(data.categories, function () {
            if (data.category.parent == this.name) {
                parentCategory.append($("<option selected />").val(this.id).text(this.name));
            } else {

                if (data.category.parent == null && data.category.category != this.name) {
                    parentCategory.append($("<option />").val(this.id).text(this.name));
                }

            }
        })
    }).fail(function (data) {
        //console.log(data);
    })
});

$(document).on('click', '#addCourseCategory', function () {
    $("#course-category").modal({
        show: true,
        backdrop: 'static',
        keyboard: false
    });
    $("#category_name").val('');



});

$(document).on('submit', '#CourseCategoryForm', function (e) {
    e.preventDefault();
    var form = $('#CourseCategoryForm');
    form.validate();
    if (form.valid()) {
        form[0].submit();
    }
});

function forceNumeric() {
    var $input = $(this);
    // console.log($input.val().replace(/[^\d]+/g, ''));
    $input.val($input.val().replace(/[^\d]+/g, ''));
}
$('body').on('propertychange input', '.numeric_validation', forceNumeric);

/************************************************************************************/
$(document).on('click', '.deletLinkCommon', function () {

    csrfName = $('.txt_csrfname').attr('name');
    csrfHash = $('.txt_csrfname').val();
    membershipId = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    url = baseUrl + 'admin/membership_level_delete/' + membershipId;
    bootboxConfirm(url, csrfName, csrfHash, name)
});

$(document).on('click', '#course-category-delete', function () {
    csrfName = $('.txt_csrfname').attr('name');
    csrfHash = $('.txt_csrfname').val();
    course_category_id = $(this).attr('data-id');
    name = $(this).attr('data-name');
    url = baseUrl + 'admin/course_category_delete/' + course_category_id;
    bootboxConfirm(url, csrfName, csrfHash, name)
});

$(document).on('change', '#BusinessPrice', function () {
    var price = $("#BusinessPrice").val();
    $("#BusinessPrice").next().remove('span');
    if (price == 0) {
        $("#BusinessPrice").after('<span for="BusinessPrice" class="error d-block">Price Must be Greater than Zero</span>');
    }
});


/***
 * make permission default
 * 
 */


$(document).on('click', "#isDefault", function () {

    csrfName = $('.txt_csrfname').attr('name');
    csrfHash = $('.txt_csrfname').val();
    url = baseUrl + ('admin/defaultMembership');
    membership_id = $(this).attr('data-id');

    data = {
        [csrfName]: csrfHash,
        membership_id: membership_id,
    };

    bootbox.confirm({
        message: 'Do You Want To Make This Default Permission',
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-warning'
            },
            cancel: {
                label: 'No',
                className: 'btn-dark'
            }
        },
        callback: function (result) {
            if (result == true) {
                ajax(url, 'POST', data).done(function (data) {
                    $('.txt_csrfname').val(data.token);
                    location.reload();
                })
                    .fail(function (data) {
                        $('.txt_csrfname').val(data.token);
                    });
            }
        }

    });
});


/***
 * make permission guest 
 * 
 */


$(document).on('click', "#isGuest", function () {

    csrfName = $('.txt_csrfname').attr('name');
    csrfHash = $('.txt_csrfname').val();
    url = baseUrl + ('admin/guestMembership');
    membership_id = $(this).attr('data-id');

    data = {
        [csrfName]: csrfHash,
        membership_id: membership_id,
    };

    bootbox.confirm({
        message: 'Do You Want To Make This Guest Permission',
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-warning'
            },
            cancel: {
                label: 'No',
                className: 'btn-dark'
            }
        },
        callback: function (result) {
            if (result == true) {
                ajax(url, 'POST', data).done(function (data) {
                    $('.txt_csrfname').val(data.token);
                    location.reload();
                })
                    .fail(function (data) {
                        $('.txt_csrfname').val(data.token);
                    });
            }
        }

    });
});



/**
 * make course free view
 */
$(document).on('click', ".free-view", function () {

    csrfName = $('.txt_csrfname').attr('name');
    csrfHash = $('.txt_csrfname').val();
    url = $(this).attr('data-url');
    lessonId = $(this).attr('data-id');
    status = $(this).attr('data-status');

    data = {
        [csrfName]: csrfHash,
        lessonId: lessonId,
        status: status
    };
    if (status == 0) {
        msg = "Do You Want To Make This Lesson as Free View ?."
    } else if (status == 1) {
        msg = "Do You Want To Block This Lesson as Free View  ?."
    }
    bootbox.confirm({
        message: msg,
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-warning'
            },
            cancel: {
                label: 'No',
                className: 'btn-dark'
            }
        },
        callback: function (result) {
            if (result == true) {
                ajax(url, 'POST', data).done(function (data) {
                    $('.txt_csrfname').val(data.token);
                    location.reload();
                })
                    .fail(function (data) {
                        $('.txt_csrfname').val(data.token);
                    });
            }
        }

    });
});

/*
$(document).on('click', '.mypage,.pagination-arrow,.topMenu', function (e) {
    e.preventDefault();

    var url = "";
    // if page not then do nothing
    var page = $.trim($(this).children('a').attr('data-ci-pagination-page'));
    var query_data = '' ;
    if(localStorage.getItem('query') != undefined && localStorage.getItem('query') != null  ) {
        query_data = localStorage.getItem('query');
        query_data = '?sortBy='+query_data;
    }
    if(localStorage.getItem('page') != undefined && localStorage.getItem('page') != null ) {
        localStorage.setItem('page', page);
    } else {
        localStorage.removeItem('page');
        localStorage.setItem('page', page);
    }
    if (page !== '' && page !== undefined) {
        url = baseUrl + 'admin/membership-level-list/' + page+query_data;
    }
    columnName = $.trim($(this).attr('id'));
    sortBy = "";
    if (columnName !== '' && columnName !== undefined) {

        $(".topMenu").each(function () {
            if ($(this).attr('id') != columnName) {
                $(this).find('i').remove();
            }
        });
        if ($('#' + columnName + ' i').attr("class") == 'fas fa-angle-down') {
            $('#' + columnName).find('i').remove();
            $('#' + columnName).append('<i class="fas fa-angle-up"></i>');
            sortBy = columnName + ":asc";
        } else {
            $('#' + columnName).find('i').remove();
            $('#' + columnName).append('<i class="fas fa-angle-down"></i>');
            sortBy = columnName + ":desc";
        }

        if(localStorage.getItem('query') != undefined) {
            localStorage.setItem('query', sortBy);

        } else {
            localStorage.removeItem('query');
            localStorage.setItem('query', sortBy);
        }

        page = $.trim($(".current-page").text());
        url = baseUrl + 'admin/membership-level-list/' + page + "?sortBy=" + sortBy;

    }
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    data = {
        [csrfName]: csrfHash,
    };
    console.log(url);
    // return;
    ajax(url, 'POST', data)
        .done(function (response) {
            data = JSON.parse(response);
            $('.txt_csrfname').val(data.token);
            $("#customPaginate").html(data.response);
        })
        .fail(function (error) {
            $('.txt_csrfname').val(error.token);

        });
});

$(document).on('click', ".editLink", function (e) {
    e.preventDefault();
    $('#exampleModal').modal({
        show: true,
        backdrop: 'static',
        keyboard: false
    })
   var id = $(this).attr("data-id");
    if (id !== null && id !== undefined) {
        var url = baseUrl + 'admin/membership-level/' + id;
    } else {
        var url = baseUrl + 'admin/membership-level';
    }
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var pageNo = queryString = '';

    if(localStorage.getItem('page') != undefined && localStorage.getItem('page') != null) {
        pageNo = localStorage.getItem('page');
    }
    if(localStorage.getItem('query') != undefined && localStorage.getItem('query') != null) {
        queryString = localStorage.getItem('query');
    }

    data = {
        [csrfName]: csrfHash,
        id: id,
        pageNo: pageNo,
        queryString: queryString
    };
    ajax(url, 'POST', data)
        .done(function (response) {
            data = JSON.parse(response);
            $('.txt_csrfname').val(data.token);
            $("#body_content").html(data.response);
        })
        .fail(function (error) {
            $('.txt_csrfname').val(error.token);

        });

});
$(document).on('submit', '#membershipListingForm', function (e) {
    e.preventDefault();
    var form = $(this);
    form.validate();
    var formData = new FormData(this);
    if (form.valid()) {
        $('#loadingCategories').show();
        $.ajax({
            method: 'POST',
            url: baseUrl + 'admin/listing_membership_level',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#exampleModal').modal('hide');
                $('.txt_csrfname').val(data.token);
                $("#customPaginate").html(data.response);
            },

            error: function (data) {
                 console.log(data);
                $('.txt_csrfname').val(data.token);
            }
        });
    }
});

$(document).ready(function(){
    localStorage.removeItem('pageNo');
    localStorage.removeItem('query');
});

*/

// stop past in number field
// $(document).ready(function () {
//     $(document).keydown(function (event) {
//         if (event.ctrlKey == true && (event.which == '118' || event.which == '86')) {
//             alert('Not allowed PASTE!');
//             event.preventDefault();
//         }
//     });

// });


function activatePopup() {
    $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',

        fixedContentPos: false,
        fixedBgPos: true,

        overflowY: 'auto',

        closeBtnInside: true,
        preloader: false,

        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in',
        disableOn: function () {
            if (userID === '') {
                popnotificaton('<b> Please login to perform this action </b>', 'info');
                setTimeout(function () {
                    window.location.replace(baseUrl + "login");
                }, 2000);
                return false;
            }
            return true;
        }
    });
}

// Add user id to contac seller form
// only used in homepage and listing product page
$(document).on('click', '.custom_contact_seller', function () {
    var user_id = $(this).attr('data-user_id');
    $('.owner_id').val(user_id);
});

$(document).on('change', '#website_status_edit', function () {
    var val = $(this).val();
    if (val == "Established") {
        $('.website_status_established').removeClass('d-none');
        $('.website_status_starter').addClass('d-none');

        // $("._starter").attr( "disabled", true );
        // $(".    ").attr( "disabled", false );
        // console.log("---" + val);

    } else if (val == "Starter") {
        // console.log("---" + val);
        $('.website_status_starter').removeClass('d-none');
        $('.website_status_established').addClass('d-none');

        // $("._starter").attr( "disabled", false );
        // $("._establish").attr( "disabled", true );
    }

});


$(document).on('click', '.master', function () {
    var mainId = $(this).attr('data-main');

    // console.log(mainId);
    $childId = "s_" + mainId;
    // console.log('childId');
    //console.log($childId);
    $('.' + $childId).prop('checked', $(this).is(':checked')).trigger('change');
});

// check in membership level

function checkedMaster() {

    $('.master').each(function () {

        var mainId = $(this).attr('data-main');
        $childId = "s_" + mainId;
        var total = $('.' + $childId).length;
        var checked = $('.' + $childId + ':checked').length;
        if (total == checked) {
            $(this).prop('checked', true);
        }
    });

}
checkedMaster();

// solution tab changes
// $(document).on('click', '.tab0', function () {
//     var submit = $('.tabactive').attr('id')
//     $("#"+submit).trigger('click');
//    // console.log(submit);
//     $("#"+submit).removeClass('tabactive')
//     var id = $(this).attr('data-step')
//     $("#"+id).addClass('tabactive')
//     //console.log(id);
// });

// solution searching 
$(document).on('keyup', '#solutionSearch', function () {


    var url = baseUrl + "user/search_solutions";
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var search = $('#solutionSearch').val();
    //console.log(search);

    var data = {
        [csrfName]: csrfHash,
        'search': search,
    };
    //console.log(data);
    ajax(url, 'POST', data, asyncVal = false)
        .done(function (data) {
            //console.log(data);
            if (data.search.length > 0) {
                data = JSON.parse(data);
            }
            $('.txt_csrfname').val(data.token);
            $("#body_content").html(data.response);
        })
        .fail(function (data) {
            $('.txt_csrfname').val(data.token);
            // console.log(data);
        })

});
// searching any data
$(document).on('keyup', '#solutionSearch_admin', function () {

    var url = baseUrl + "admin/search_solutions";
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var search = $('#solutionSearch_admin').val();
    //  console.log(search);

    var data = {
        [csrfName]: csrfHash,
        'search': search,
    };
    //console.log(data);
    ajax(url, 'POST', data, asyncVal = false)
        .done(function (data) {
            //console.log(data);
            if (data.search.length > 0) {
                data = JSON.parse(data);
            }
            $('.txt_csrfname').val(data.token);
            $("#body_content").html(data.response);
        })
        .fail(function (data) {
            $('.txt_csrfname').val(data.token);
            // console.log(data);
        })

});



$(document).on('click', '.solution_select_page', function () {

    var url = baseUrl + "admin/solutionData";
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var sid = $(this).attr('data-sid');
    var select_name = $(this).attr('data-name');

    var data = {
        [csrfName]: csrfHash,
        'sid': sid,
    };

    ajax(url, 'POST', data, asyncVal = false)
        .done(function (data) {
            $("#select_solution_id").html('');
            $('.txt_csrfname').val(data.token);
            // console.log(data.solution_data.solution[0]);
            // console.log(data.frontend_section)
            var option = "";
            var option2 = "";
            if (data.solution_data.solution !== "" && data.solution_data.solution !== undefined) {
                $("#solution_id_page").val(data.solution_data.solution[0].id);
                $.each(data.solution_data.solution, function (i, v) {
                    if (v.display_on_page != "" && v.display_on_page != null) {
                        var arr = v.display_on_page.split(",");
                        // console.log(arr);
                        // section = [];
                        // $.each(data.section, function (l, m) {
                        //     section.push(l);
                        // });
                        var page = '';
                        var section1 = '';
                        $.each(arr, function (k, v) {

                            arr1 = v.split(':');
                            page = arr1[0];
                            section1 = arr1[1];
                            // console.log(v.split(':'));
                            option += "<div class='row'><div class='col-md-6 w_100px_a'>\
                        <div class='submit-field parent'>\
                        <h5>Show Product on page</h5>\
                        <select  name='display_on_page[]' class='js-example-basic-multiple123 with-border'>";
                            $.each(data.pageName, function (i, v2) {
                                if (v2 == page) {
                                    option += "<option selected value='" + page + "' >" + page + "</option>";
                                } else {
                                    option += "<option  value='" + v2 + "' >" + v2 + "</option>";
                                }
                            })
                            option += " </select></div></div> ";
                            option += " <div class='col-md-4 w_100px_a'>\
                        <div class='submit-field'> \
                        <h5>Show Product on page</h5> \
                        <select  name='frontend_section[]'>";
                            option += "<option selected value='' >Select Option</option>";
                            $.each(data.section, function (j, v3) {
                                if (v3 == section1) {
                                    option += "<option selected value='" + section1 + "' >" + section1 + "</option>";
                                } else {
                                    option += "<option  value='" + v3 + "' >" + v3 + "</option>";
                                }
                            })
                            option += "</select></div></div>";
                            option += " <div class='col-md-2 w_100px_a'> \
                        <div class='submit-field'> \
                        <span id='deleteListOption'  class='btn btn-danger btn-sm  mt-5 cursor_pointer_a'> <i class='fa fa-trash-o' aria-hidden='true'></i> <span></div></div></div>";
                        });
                        // console.log(page);
                        // console.log(section);
                        // console.log('-------------');
                        //console.log(data.pageName);
                    }
                })
            }

            $("#solution_select_page_a").modal('show');
            $("#select_solution_id").append(option);
            // $("#display_seciton_a").html(option2);
            $("#name_popup").attr('data-name-popup', select_name);
            $("#name_popup").html(select_name);


        })
        .fail(function (data) {
            $('.txt_csrfname').val(data.token);
            // console.log(data);
        })

});


$(document).on('click', '#addListOption', function (e) {
    e.preventDefault();
    option = "<div class='row  row_color mt-1'>";
    option += "<div class='col-md-6 w_100px_a'>\
                <div class='submit-field parent'>\
                  <h5>Show Product on page</h5>\
                  <select name='display_on_page[]' class='js-example-basic-multiple123 with-border'>";
    $.each(JSON.parse(PAGESNAME), function (i, v2) {
        option += "<option  value='" + v2 + "' >" + v2 + "</option>";
    })
    option += " </select></div></div>";

    // $.each(PAGESNAME_SECTION, function (k, v) {

    //     arr1 = v.split(':');
    //     page = arr1[0];
    //     section1 = arr1[1];
    //     console.log(page);
    //     console.log(section1);
    // })



    option += " <div class='col-md-4 w_100px_a'>\
                <div class='submit-field'>\
                  <h5>Show Product on page</h5>\
                  <select  name='frontend_section[]'>";
    option += "<option  value='' >Select Option</option>";
    $.each(JSON.parse(SECTION), function (j, v3) {
        option += "<option  value='" + v3 + "' >" + v3 + "</option>";
    })
    option += "</select></div></div>";
    option += " <div class='col-md-2 w_100px_a'> \
                <div class='submit-field'> \
                <span id='deleteListOption'  class='btn btn-danger btn-sm  mt-5 cursor_pointer_a' > <i class='fa fa-trash-o' aria-hidden='true'></i> <span></div></div></div>";
    $("#select_solution_id").prepend(option);
});

$(document).on('click', '#deleteListOption', function (e) {
    $(this).closest('.row').remove();
});

$(document).on('click', '#updateSolutionPageBtn', function (e) {

    e.preventDefault();
    $("#solution_select_page_a").modal('hide');
    var name = $('#name_popup').attr('data-name-popup');
    bootbox.confirm({
        message: "Confirm !! Do You Want to Update - <b>" + name + "<b>",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-warning'
            },
            cancel: {
                label: 'No',
                className: 'btn-dark'
            }
        },
        callback: function (result) {
            if (result == true) {
                $('#updateSolutionPage').submit();
            }

        }
    });

});


$(document).on('click', '#becomeExpertformBtn', function (e) {
    e.preventDefault();

    // var form = $("#becomeExpertform");
    // var formData = form.serialize();
    // console.log(formData);
    // $(".chb").next().remove('span');
    // if ($('.chb input[type=checkbox]:checked').length == 0) {
    //     $(".chb").after('<span for="slug-error" class="error">Please select at least one checkbox</span>');
    //     return false;
    // }

    var form = $("#becomeExpertform");
    form.validate({
        focusInvalid: false,
        invalidHandler: function (form, validator) {

            if (!validator.numberOfInvalids())
                return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 2000);
        }
    });
    if (form.valid()) {
        form.submit();
    }
});

$(document).on('click', '.updateExpertBtn', function () {
    var form = $("#becomeExpertform");

    form.validate({ // initialize the plugin
        rules: {
            city: {
                selectcheck: true
            }
        }
    });

    jQuery.validator.addMethod('selectcheck', function (value) {
        return (value != '0');
    }, "Required");

    form.validate({
        focusInvalid: false,
        invalidHandler: function (form, validator) {

            if (!validator.numberOfInvalids())
                return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 2000);
        }
    });
    if (form.valid()) {

        bootbox.confirm({
            message: "Confirm !! Do You Want to Update.",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-warning'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-dark'
                }
            },
            callback: function (result) {
                if (result == true) {
                    $("#becomeExpertform").submit();
                }

            }
        });
    }
});

$(document).on('keyup', '#expertSearch_admin', function () {

    var url = baseUrl + "admin/search_expert";
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var search = $('#expertSearch_admin').val();
    //  console.log(search);

    var data = {
        [csrfName]: csrfHash,
        'search': search,
    };
    console.log(data);
    ajax(url, 'POST', data, asyncVal = false)
        .done(function (data) {
            //console.log(data);
            if (data.search.length > 0) {
                data = JSON.parse(data);
            }
            $('.txt_csrfname').val(data.token);
            $("#body_content").html(data.response);
        })
        .fail(function (data) {
            $('.txt_csrfname').val(data.token);
            // console.log(data);
        })

});

/*--------------------------------------------------*/
/*  delte solutions 
/*--------------------------------------------------*/
$(document).on('click', '#deleteExpert', function (e) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var url = baseUrl + 'admin/delete-expert';

    var data = {
        [csrfName]: csrfHash,
        "expert_id": $(this).attr("data-id").trim(),
    };

    bootbox.confirm({
        message: "Confirm !! Do You Want to Delete.",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-warning'
            },
            cancel: {
                label: 'No',
                className: 'btn-dark'
            }
        },
        callback: function (result) {
            if (result == true) {

                ajax(url, 'POST', data)
                    .done(function (data) {
                        $('.txt_csrfname').val(data.token);
                        location.reload()
                    })
                    .fail(function (error) {
                        $('.txt_csrfname').val(error.token);
                    });
            }

        }
    });

});

$(document).on('change', '.zero_validity_allow', function () {

    if ($('.zero_validity_allow').prop('checked')) {

        bootbox.confirm({
            message: "Confirm !! Now Validation Never Expired ",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-warning'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-dark'
                }
            },
            callback: function (result) {
                if (result == false) {
                    $('.zero_validity_allow').prop('checked', false); // Checks it

                } else if (result == true) {
                    $("#membership_duration").removeClass('required');
                    $("#membership_duration").val("");
                }
            }
        });
    }
});

function forceNormalStringOnly() {
    var $input = $(this);
    $input.val($input.val().replace(/[^a-zA-Z ]/g, ''));
}
$('body').on('propertychange input', '.stringSpace', forceNormalStringOnly);



function forceNormalNumberOnly() {
    var $input = $(this);
    $input.val($input.val().replace(/[^0-9]/g, ''));
}
$('body').on('propertychange input', '.numberOnly', forceNormalNumberOnly);


// function StringWhiteSpace() {
//     $(document).on('change', '#profile_name ,#name', function () {

//         var regex = new RegExp("^[a-z][a-z0-9\s]*$");
//         var str = $(this).val();
//         $(this).next().remove('span');
//         if (regex.test(str)) {
//             return true;
//         }
//         $(this).next().remove('span');
//         $(this).after('<span for="slug-error" class="error">Name must have aphabet and whitespace</span>');
//         return false;
//     });
// }


/** 
 * terms and condition popup
 * 
 * terms_condition
 */
$(document).on('click', '#terms_condition', function () {
    $("#small-dialog-6").modal('hide');
    $("#term_condition_popup").modal('show');
});


$(document).on('click', '#business_stats', function () {
    $("#business_stats_id").removeClass('d-none');
});



// membership level
$(document).on('change', '.slave_child', function () {
    $(this).closest('.slave_row_start').find('.hidden_value').attr('disabled', $(this).is(':checked'));
});

$(document).on('change', '.master_class', function () {
    $(this).closest('.row_start').find('.slave_child').prop('checked', $(this).prop('checked')).trigger('change');
});

$(document).ready(function () {
    $(".master_class").each(function () {
        if ($(this).closest('.row_start').find('.slave_child:checked').length == $(this).closest('.row_start').find('.slave_child').length) {
            $(this).prop('checked', true);
        }
    });
});

/***
 * 
 * This is for app.domain,business,website.
 * 
 */
// admin level permission 
$(document).on('keyup', '.commission_amount_j', function () {

    showPriceCommission(1);

});
$(document).on('keyup', '.website_minimumoffer_j', function () {

    showPriceCommission(1);

});
$(document).on('keyup', '.website_buynowprice_j', function () {

    showPriceCommission(1);

});
$(document).on('keyup', '.website_discountprice_j', function () {

    showPriceCommission(1);

});
$(document).on('change', '.commission_type_j', function () {

    showPriceCommission(1);

});

/***
 * 
 * This is for Solutions.
 * 
 */
// admin level permission 
$(document).on('change', '#commission_base_soln', function () {

    var commission_base = $("#commission_base_soln").val();
    console.log("commission base_soln");
    console.log(commission_base);
    console.log("end commission base_soln");

    if (commission_base != '' && commission_base != null) {
        // product wise.
        if (commission_base == 2) {

            $("#commission_amount_soln").prop('readonly', false);
            $("#commission_amount_soln").val(' ');

            var csrfName = $('.txt_csrfname').attr('name');
            var csrfHash = $('.txt_csrfname').val();
            var url = baseUrl + 'admin/getUserProductCommissionSolution';

            var data = {
                [csrfName]: csrfHash,
                'listing_id': $('#solution_id').val()
            };

            var method = 'post';
            ajax(url, method, data).done(function (response) {
                // console.log(response);
                if (response['commission_type'] != '') {
                    if (response['commission_type'] == 1) {
                        // it means commission type is fixed
                        $("#commission_type_soln").empty();
                        var option = "<option value='1' selected >Fixed</option>";
                        option += "<option value='2' >Percentage</option>";
                        $("#commission_type_soln").html(option)
                        $("#commission_amount_soln").val(response['admin_commission'])
                        $('.txt_csrfname').val(response.token);
                    } else if (response['commission_type'] == 2) {
                        // it means commission type is percentage
                        $("#commission_type_soln").empty();
                        var option = "<option value='1'>Fixed</option>";
                        option += "<option value='2' selected >Percentage</option>";
                        $("#commission_type_soln").html(option)
                        $("#commission_amount_soln").val(response['admin_commission']);
                        $('.txt_csrfname').val(response.token);
                    } else {
                        $("#commission_type_soln").empty();
                        var option = "<option value='1'>Fixed</option>";
                        option += "<option value='2' >Percentage</option>";
                        $("#commission_type_soln").html(option)
                        $("#commission_amount_soln").val(response['admin_commission']);
                        $('.txt_csrfname').val(response.token);
                    }
                    $('.txt_csrfname').val(response.token);
                    showPriceCommissionSoln();
                }
            }).fail(function (response) {
                console.log(response);
                $('.txt_csrfname').val(response.token);
            });
        }
        // user wise
        if (commission_base == 1) {
            // first clear the commission amount then filled with ajax response
            $("#commission_amount_soln").val(' ')
            var csrfName = $('.txt_csrfname').attr('name');
            var csrfHash = $('.txt_csrfname').val();
            var url = baseUrl + 'admin/getUserCommissionSolution';

            var data = {
                [csrfName]: csrfHash,
                'listing_id': $('#solution_id').val()
            };
            // console.log(data);
            var method = 'post';
            ajax(url, method, data).done(function (response) {
                // console.log(response);
                $("#commission_amount_soln").prop('readonly', true);
                if (response['commission_type'] != '' && response['commission_type'] != null) {
                    // console.log(response['commission_type']);
                    if (response['commission_type'] == 1) {
                        $("#commission_type_soln").empty();
                        var option = "<option value='1' selected >Fixed</option>";
                        $("#commission_type_soln").html(option)
                        $("#commission_amount_soln").val(response['admin_commission'])
                        $('.txt_csrfname').val(response.token);
                    } else if (response['commission_type'] == 2) {
                        $("#commission_type_soln").empty();
                        var option = "<option value='2'selected >Percentage</option>";
                        $("#commission_type_soln").html(option)
                        $("#commission_amount_soln").val(response['admin_commission']);
                        $('.txt_csrfname').val(response.token);
                    }
                    $('.txt_csrfname').val(response.token);
                }
                $('.txt_csrfname').val(response.token);
                showPriceCommissionSoln();
            }).fail(function (response) {
                $('.txt_csrfname').val(response.token);
            });

        }

    }


});


function showPriceCommission(changed_amount_or_commission_type = 0) {
    console.log(changed_amount_or_commission_type);
    var $commission_type = 0;
    var $admin_commission = 0;
    var $original_minimumoffer = 0;
    var $original_buynowprice = 0;
    var $original_discountprice = 0;
    var $website_minimumoffer = 0;
    var $website_buynowprice = 0;
    var $website_discountprice = 0;

    $commission_type = parseInt($("#commission_type").val());
    if (isNaN($commission_type)) {
        $commission_type = 0;
    }
    $admin_commission = parseInt($("#commission_amount").val());
    if (isNaN($admin_commission)) {
        $admin_commission = 0;
    }
    // console.log("admin_commission:" + $admin_commission);
    $original_minimumoffer = parseInt($("#website_minimumoffer").val());

    if (isNaN($original_minimumoffer)) {
        $website_minimumoffer = $original_minimumoffer = 0;
    }
    $original_buynowprice = parseInt($("#website_buynowprice").val());
    if (isNaN($original_buynowprice)) {
        $website_buynowprice = $original_buynowprice = 0;
    }
    $original_discountprice = parseInt($("#website_discountprice").val());
    if (isNaN($original_discountprice)) {
        $website_discountprice = $original_discountprice = 0;
    }


    var commission_base = $("#commission_base").val(); // user profile or product
    console.log("commission_base:" + commission_base);
    if (commission_base != '' && commission_base != null) {

        // product wise.
        if (commission_base == 2) {

            $("#commission_amount").prop('readonly', false);
            if (changed_amount_or_commission_type == 0) {
                $("#commission_amount").val(0);
            }

            var csrfName = $('.txt_csrfname').attr('name');
            var csrfHash = $('.txt_csrfname').val();
            var url = baseUrl + 'admin/getUserProductCommission';

            var data = {
                [csrfName]: csrfHash,
                'listing_id': $('#listing_id').val()
            };

            var method = 'post';
            ajax(url, method, data).done(function (response) {
                if (response['commission_type'] != '') {
                    console.log("admin_commission:" + response['admin_commission']);
                    if (response['commission_type'] == 1) {
                        //fixed

                        var option = "<option value='1' selected >Fixed</option>";
                        option += "<option value='2' >Percentage</option>";
                    } else if (response['commission_type'] == 2) {
                        //percentage

                        var option = "<option value='1'>Fixed</option>";
                        option += "<option value='2' selected >Percentage</option>";
                    } else {

                        var option = "<option value='1'>Fixed</option>";
                        option += "<option value='2' >Percentage</option>";
                    }

                    $('.txt_csrfname').val(response.token);
                    if (changed_amount_or_commission_type == 0) {
                        $("#commission_type").empty();
                        $admin_commission = response['admin_commission'];
                        $("#commission_type").html(option);
                        $("#commission_amount").val(response['admin_commission']);
                        $commission_type = $("#commission_type").val(); //when we move from product level commission + commssion type fixed to user type commission then view asking price was not showing correct so that is why I implemented this so that we can update latest commission type value in variable
                    }

                }

                innerFunction($commission_type, $admin_commission, $original_minimumoffer, $original_buynowprice, $original_discountprice, $website_minimumoffer, $website_buynowprice, $website_discountprice);

            }).fail(function (response) {
                console.log(response);
                $('.txt_csrfname').val(response.token);
            });
        }
        // user wise
        if (commission_base == 1) {
            // first clear the commission amount then filled with ajax response
            if (changed_amount_or_commission_type == 0) {
                $("#commission_amount").val(0)
            }
            var csrfName = $('.txt_csrfname').attr('name');
            var csrfHash = $('.txt_csrfname').val();
            var url = baseUrl + 'admin/getUserCommission';

            var data = {
                [csrfName]: csrfHash,
                'listing_id': $('#listing_id').val()
            };
            // console.log(data);
            var method = 'post';
            ajax(url, method, data).done(function (response) {
                $("#commission_amount").prop('readonly', true);
                if (response['commission_type'] != '' && response['commission_type'] != null) {
                    // console.log(response['commission_type']);
                    if (response['commission_type'] == 1) {
                        var option = "<option value='1' selected >Fixed</option>";

                    } else if (response['commission_type'] == 2) {
                        var option = "<option value='2'selected >Percentage</option>";
                    } else {

                        var option = "<option value='1'>Fixed</option>";
                        option += "<option value='2' >Percentage</option>";
                    }

                    if (changed_amount_or_commission_type == 0) {
                        $("#commission_type").empty();
                        $("#commission_type").html(option);
                        $commission_type = $("#commission_type").val(); //when we move from product level commission + commssion type fixed to user type commission then view asking price was not showing correct so that is why I implemented this so that we can update latest commission type value in variable
                        $("#commission_amount").val(response['admin_commission']);
                        $admin_commission = response['admin_commission'];
                    }
                }
                $('.txt_csrfname').val(response.token);
                innerFunction($commission_type, $admin_commission, $original_minimumoffer, $original_buynowprice, $original_discountprice, $website_minimumoffer, $website_buynowprice, $website_discountprice);
            }).fail(function (response) {
                $('.txt_csrfname').val(response.token);
            });

        }

    }
}

function innerFunction($commission_type, $admin_commission, $original_minimumoffer, $original_buynowprice, $original_discountprice, $website_minimumoffer, $website_buynowprice, $website_discountprice) {
    // commission_type == 1 then fixed commission

    $commission_type = parseFloat($commission_type);
    $admin_commission = parseFloat($admin_commission);
    $original_minimumoffer = parseFloat($original_minimumoffer);
    $original_buynowprice = parseFloat($original_buynowprice);
    $original_discountprice = parseFloat($original_discountprice);
    $website_minimumoffer = parseFloat($website_minimumoffer);
    $website_buynowprice = parseFloat($website_buynowprice);
    $website_discountprice = parseFloat($website_discountprice);


    // console.log("#####################################");
    console.log("commission_type:" + $commission_type);
    console.log("admin_commission:" + $admin_commission);
    console.log("original_minimumoffer:" + $original_minimumoffer);
    console.log("original_buynowprice:" + $original_buynowprice);
    console.log("original_discountprice:" + $original_discountprice);
    console.log("website_minimumoffer:" + $website_minimumoffer);
    console.log("website_buynowprice:" + $website_buynowprice);
    console.log("website_discountprice:" + $website_discountprice);



    if ($commission_type != '' && $commission_type != null && $commission_type == 1) {

        if ($original_minimumoffer != "" && $original_minimumoffer != null && $original_minimumoffer != undefined) {
            $website_minimumoffer = $original_minimumoffer + $admin_commission;
        }
        if ($original_buynowprice != "" && $original_buynowprice != null && $original_buynowprice != undefined) {
            $website_buynowprice = $original_buynowprice + $admin_commission;
        }
        if ($original_discountprice != "" && $original_discountprice != null && $original_discountprice != undefined) {
            $website_discountprice = $original_discountprice + $admin_commission;
        }
    }

    // commission_type == 2 then percentage commission
    if ($commission_type != "" && $commission_type != null && $commission_type == 2) {

        if ($original_minimumoffer != "" && $original_minimumoffer != null && $original_minimumoffer != undefined) {
            $commission_amount1 = ($original_minimumoffer * ($admin_commission / 100));
            $website_minimumoffer = $original_minimumoffer + $commission_amount1;
        }
        if ($original_buynowprice != "" && $original_buynowprice != null && $original_buynowprice != undefined) {
            $commission_amount2 = ($original_buynowprice * ($admin_commission / 100));
            $website_buynowprice = $original_buynowprice + $commission_amount2;
        }
        if ($original_discountprice != "" && $original_discountprice != null && $original_buynowprice != undefined) {
            $commission_amount3 = ($original_discountprice * ($admin_commission / 100));
            $website_discountprice = $original_discountprice + $commission_amount3;
        }
    }

    if ($commission_type == 0) {
        $website_minimumoffer = $original_minimumoffer;
        $website_buynowprice = $original_buynowprice;
        $website_discountprice = $original_discountprice;

    }


    console.log("website_minimumoffer:" + $website_minimumoffer);
    console.log("website_buynowprice:" + $website_buynowprice);
    console.log("website_discountprice:" + $website_discountprice);

    $("#view_asking").val(parseFloat($website_minimumoffer).toFixed(2));
    $("#view_buynow").val(parseFloat($website_buynowprice).toFixed(2));
    $("#view_actual").val(parseFloat($website_discountprice).toFixed(2));
}

function checkPrice()
{
    let price = parseInt($('#website_buynowprice_soln').val());
    let view_price = parseInt($('#view_buynow').val());
    let obj_view_price = $('#view_buynow');
    // console.log(view_price < price);
    trueOrFalse = price < view_price ;
    if(price < view_price) {
        obj_view_price.removeClass('valid');
        obj_view_price.addClass('error');
        obj_view_price.addClass('required');
        // obj_view_price.attr("required", true);
        // console.log(obj_view_price);
        // obj_view_price[0].setCustomValidity('Required email addressasdasd');
        // obj_view_price.attr("oninvalid", "this.setCustomValidity('Required!')");
        // // obj_view_price.attr("oninput", "setCustomValidity('')");
        // obj_view_price[0].setCustomValidity('View Price value not more then Price value');
        // alert( obj_view_price[0].checkValidity());
                    // alert( obj_view_price[0].validationMessage);
        // obj_view_price[0].attr("oninput", "setCustomValidity('')");

    }
    else{
          obj_view_price.attr("oninput", "setCustomValidity('')");
    }
}

// $(document).on('click','#solution_step_edit_4',function(){
//     let price = parseInt($('#website_buynowprice_soln').val());
//     let view_price = parseInt($('#view_buynow').val());
//     let obj_view_price = $('#view_buynow');
//     // console.log(view_price < price);
//     trueOrFalse = price < view_price ;
//     if(price < view_price) {
//         obj_view_price.attr("oninvalid", "this.setCustomValidity('Required!')")
//     }
//     else{
//           obj_view_price.attr("oninput", "setCustomValidity('')");
//     }
// });

function showPriceCommissionSoln() {

    var $commission_type = 0;
    var $admin_commission = 0;
    var $original_buynowprice = 0;
    var $website_buynowprice = 0;

    $commission_type = parseFloat($("#commission_type_soln").val());
    if (isNaN($commission_type)) {
        $commission_type = 0;
    }
    $admin_commission = parseFloat($("#commission_amount_soln").val());
    if (isNaN($admin_commission)) {
        $admin_commission = 0;
    }
    $original_buynowprice = parseFloat($("#website_buynowprice_soln").val());
    if (isNaN($original_buynowprice)) {
        $website_buynowprice = $original_buynowprice = 0;
    }


    // commission_type == 1 then fixed commission
    // console.log("#####################################");
    // console.log("commission_type:" + $commission_type);
    // console.log("admin_commission:" + $admin_commission);
    // console.log("original_buynowprice:" + $original_buynowprice);

    // $str = "commission-type----" + $commission_type + "--- " + $admin_commission +
    //     "--- " + "--- " + $original_buynowprice;
    // console.log($str);
    // commission_type == 1 then fixed commission
    if ($commission_type != '' && $commission_type != null && $commission_type == 1) {
        if ($original_buynowprice != "" && $original_buynowprice != null && $original_buynowprice != undefined) {
            $website_buynowprice = $original_buynowprice + $admin_commission;
        }
    }
    // commission_type == 2 then percentage commission
    if ($commission_type != "" && $commission_type != null && $commission_type == 2) {
        if ($original_buynowprice != "" && $original_buynowprice != null && $original_buynowprice != undefined) {
            $commission_amount2 = ($original_buynowprice * ($admin_commission / 100));
            $website_buynowprice = $original_buynowprice + $commission_amount2;
        }
    }

    if ($commission_type == 0) {
        $website_buynowprice = $original_buynowprice;
    }
    //    console.log("website_buynowprice:" + $website_buynowprice);
    $("#view_buynow").val(parseFloat($website_buynowprice).toFixed(2));


}

// membership purchase listing
$(document).on('keyup', '#MemberShipearch_admin', function () {
    var url = baseUrl + "admin/membership_purchase_search";
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var search = $('#MemberShipearch_admin').val();
    console.log(search);

    var data = {
        [csrfName]: csrfHash,
        'search': search,
    };
    //console.log(data);
    ajax(url, 'POST', data, asyncVal = false)
        .done(function (data) {
            //console.log(data);
            if (data.search.length > 0) {
                data = JSON.parse(data);
            }
            $('.txt_csrfname').val(data.token);
            $("#body_content").html(data.response);
        })
        .fail(function (data) {
            $('.txt_csrfname').val(data.token);
            // console.log(data);
        })

});


// if clicked on check all the all checkbox will selected
// become expert directory

$(document).on('click', '.checkbox_monetize_all', function () {
    $(this).closest('.monetize_methods').find('.ckexp').not(this).prop('checked', this.checked);

});

$(document).on('click', '.ckexp', function () {

    if ($(this).closest('.monetize_methods').find('.ckexp:checked').length == 3) {
        $('.checkbox_monetize_all').prop('checked', true);
    } else {
        $('.checkbox_monetize_all').prop('checked', false);
    }
});




// ------------------ End Document ----------------------------------- //

// single page item
