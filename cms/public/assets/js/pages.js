"use strict";

/**
 * JS Dùng chung cho toàn trang
 */
//loading page
function ui_loading_page() {
  setTimeout(function () {
    $("body").addClass("pre-loaded");
  }, 300);
} // Fixed top menu


function ui_fix_header_sticky() {
  var $header = $("header.header-page"),
      $w = $(window);

  if ($header.length < 1) {
    return;
  }

  var _scroll_header = function _scroll_header() {
    if ($w.scrollTop() > 0) {
      $header.addClass("fixed");
    } else {
      $header.removeClass("fixed");
    }
  };

  $(window).on("scroll", _scroll_header);

  _scroll_header();
} // Responsive navigation
// function ui_resnav() {
//     var element = document.getElementById("nav-links");
//     element.classList.toggle("nav-active");
//     $(".burger").toggleClass("open");
// }


function ui_checked_stage() {
  $("#checkall").change(function (e) {
    $(".fav-box .checked").prop("checked", $(e.target).is(":checked"));
  });
  $(".fav-box .checked").change(function (e) {
    if ($(e.target).is(":checked") == false) {
      $("#checkall").prop("checked", false);
    }
  });
} //Check state modal


function ui_checked_state_modal() {
  $("#checkallmodal").change(function (e) {
    $(".fav-box .checked").prop("checked", $(e.target).is(":checked"));
  });
  $(".fav-box .checked").change(function (e) {
    if ($(e.target).is(":checked") == false) {
      $("#checkallmodal").prop("checked", false);
    }
  });
} // Slider slick


function ui_triple_carousel() {
  var func_small2 = function func_small2() {
    if ($(window).width() < 768) {
      if ($(".triple-carousel").hasClass("slick-slider")) {
        $(".triple-carousel").slick("unslick");
      }
    } else {
      if ($(".triple-carousel").hasClass("slick-slider")) {
        return;
      }

      $(".triple-carousel").slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: false,
        arrows: true,
        responsive: [{
          breakpoint: 575,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }, {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        }, {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3
          }
        }]
      });
    }
  };

  func_small2();
  $(window).on("resize", function () {
    func_small2();
  });
}
/**
 * SWIPER SLIDE
 */


function slide_swiper() {
    //swiper Guides section
    const guide_slides = new Swiper($('.guides-section .swiper-container'), {
        slidesPerView: 'auto',
        effect: 'slide',
        // spaceBetween: 20,
        freeMode: true,
        navigation: {
            nextEl: '.guides-section .swiper-button-next',
            prevEl: '.guides-section .swiper-button-prev'
        },
        scrollbar: {
            el: '.guides-section .swiper-scrollbar'
            // draggable: true,
        },
        breakpoints: {
            640: {
                spaceBetween: 10,
            },
            768: {
                spaceBetween: 10,
            },
            1024: {
                spaceBetween: 10,
            },
        }
    }),
        //swiper Star buy section
        starbuy_slides = new Swiper($('.star-buy-section .swiper-container'), {
            slidesPerView: 'auto',
            effect: 'slide',
            // spaceBetween: 20,
            freeMode: true,
            navigation: {
                nextEl: '.star-buy-section .swiper-button-next',
                prevEl: '.star-buy-section .swiper-button-prev'
            },
            scrollbar: {
                el: '.star-buy-section .swiper-scrollbar',
                draggable: true
            },
            breakpoints: {
                640: {
                    spaceBetween: 10,
                },
                768: {
                    spaceBetween: 10,
                },
                1024: {
                    spaceBetween: 10,
                },
            }
        }),
        //swiper Testimonials section
        testimonials_slides = new Swiper($('.testimonials-section .swiper-container'), {
            slidesPerView: 'auto',
            effect: 'slide',
            freeMode: true,
            navigation: {
                nextEl: '.testimonials-section .swiper-button-next',
                prevEl: '.testimonials-section .swiper-button-prev'
            },
            scrollbar: {
                el: '.testimonials-section .swiper-scrollbar'
            },
            breakpoints: {
                640: {
                    spaceBetween: 10,
                },
                768: {
                    spaceBetween: 10,
                },
                1024: {
                    spaceBetween: 10,
                },
            }
        }),
        //swiper Pricing table section (Project detail page)
        pricing_slides = new Swiper($('.section-pricing .swiper-container'), {
            slidesPerView: 3,
            spaceBetween: 0,
            freeMode: true,
            effect: 'slide',
            navigation: {
                nextEl: '.section-pricing .swiper-button-next',
                prevEl: '.section-pricing .swiper-button-prev'
            },
            breakpoints: {
                1090: {
                    slidesPerView: 'auto'
                },
                2000: {
                    slidesPerView: 3
                },
                4000: {
                    slidesPerView: 5
                }
            },
            scrollbar: {
                el: '.section-pricing .swiper-scrollbar',
                draggable: true
            }
        });
}


function favbox_swiper_change() {
  var $favbox = false,
      _resize = function _resize() {
    if (!$("#modalPopovers").hasClass("show")) {
      return;
    }

    if ($(window).outerWidth() >= 992) {
      if ($favbox.isInitSwiper) {
        $favbox.destroy();
        $favbox.isInitSwiper = false;
      }

      if ($("#modalPopovers .list-item.scroll-ui").length > 0 && !$("#modalPopovers .list-item.scroll-ui").attr("data-simplebar")) {
        var html = $("#modalPopovers .scroll-ui").html();
        $("#modalPopovers .list-item.scroll-ui").remove();
        $("#modalPopovers .content-fav").append("<div class=\"list-item scroll-ui\"></div>");
        $("#modalPopovers .list-item.scroll-ui").html(html);
        new SimpleBar($("#modalPopovers .list-item.scroll-ui")[0], {
          forceVisible: true,
          autoHide: false,
          scrollbarMinSize: 5
        });
      }
    } else {
      if ($("#modalPopovers .list-item").attr("data-simplebar")) {
        $("#modalPopovers .list-item").html($("#modalPopovers .list-item .simplebar-content").html()).removeAttr("data-simplebar");
      }

      if (!$favbox.isInitSwiper) {
        $(".modal .content-fav .swiper-container .simple-bar").addClass("swiper-wrapper");
        $favbox = new Swiper($(".modal .content-fav .swiper-container"), {
          slidesPerView: "auto",
          spaceBetween: 0,
          effect: "slide",
          freeMode: true
        });
        $favbox.isInitSwiper = true;
        $(document.body).on('click', '.not-rp .fav-line .btn-close-modal-item', function () {
            setTimeout(() => {
                $favbox.updateSlides();
            }, 500);
        });
      }
    }
  };

  $(window).on("resize", _resize);

  _resize();
}

function change_swiper_modal() {
  var $favbox = false,
      _resize = function _resize() {
    if ($(window).outerWidth() >= 992) {
      if ($favbox.isInitSwiper) {
        $favbox.destroy();
        $favbox.isInitSwiper = false;
      }
    } else {
      if (!$favbox.isInitSwiper) {
        $favbox = new Swiper($("#modalPopovers .swiper-container"), {
          slidesPerView: "auto",
          spaceBetween: 0,
          effect: "slide",
          freeMode: true,
          pagination: {
            el: ".swiper-pagination"
          },
          scrollbar: {
            el: ".swiper-scrollbar"
          }
        });
        $favbox.isInitSwiper = true;
      }
    }
  };

  $(window).on("resize", _resize);

  _resize();
} // Swiper toggle turn off / on


function change_state_swiper_services() {
  var $services_slides = {
    isInitSwiper: false
  };

  if ($(".services-section .swiper-container").length < 1) {
    return;
  }

  var _change = function _change() {
    if ($(window).outerWidth() < 992) {
      //Services section slide swiper
      if (!$services_slides.isInitSwiper) {
        $services_slides = new Swiper($(".services-section .swiper-container"), {
          slidesPerView: "auto",
          effect: "slide",
          spaceBetween: 0,
          freeMode: true,
          scrollbar: {
            el: ".services-section .swiper-scrollbar"
          }
        });
        $services_slides.isInitSwiper = true;
      }
    } else {
      if ($services_slides.isInitSwiper) {
        $services_slides.destroy();
        $services_slides.isInitSwiper = false;
      }
    }
  };

  _change();

  $(window).on("resize.services-section", _change);
} //auto match height


function auto_match_height() {
  $(".gallery-item").matchHeight();
  $(".nl-grid-item .info").matchHeight(); // $(".inner-gallery-item").matchHeight();
  $(".tab-content .tab-pane").matchHeight();
  $(".info-inner-services .info .s-title, .info-inner-services-page").matchHeight();
  $(".star-buy-section .description-item").matchHeight();
  $(".rates-mobile .rates-item .block .img-logo").matchHeight();
  $(".testimonials-section .gallery-item .inner-item .info-item").matchHeight();
  $(".services-section .inner-services .info-inner-services .info .s-desc").matchHeight();
  $('.rated-section .rates-mobile .rates-item .block .info').matchHeight();
} //toggle responsive menu


function collapse_menu() {
  $("#nav-links .has-child .drop-menu").click(function () {
    if ($(window).outerWidth() < 992) {
      $(this).toggleClass("collapsed");
      $(".drop-content").slideToggle("slow");
    }
  });

  var resize_menu = function resize_menu() {
    if ($(window).outerWidth() < 992) {
      $("#nav-links .has-child .drop-content").css({
        display: "none"
      });
      $("#nav-links .has-child ").removeClass("dropdown");
    } else {
      $("#nav-links .has-child .drop-content").css({
        display: ""
      });
      $("#nav-links .has-child").addClass("dropdown");
    }
  };

  $(window).on("resize", resize_menu);
  resize_menu();
} //carousel for 3 items show


function ui_triple_carousel_sidebar() {
  var func_small2 = function func_small2() {
    if ($(window).width() < 1400) {
      if ($(".triple-carousel-sidebar").hasClass("slick-slider")) {
        $(".triple-carousel-sidebar").slick("unslick");
      }
    } else {
      if ($(".triple-carousel-sidebar").hasClass("slick-slider")) {
        return;
      }

      $(".triple-carousel-sidebar").slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: false,
        arrows: true,
        responsive: [{
          breakpoint: 575,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }, {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        }, {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3
          }
        }]
      });
    }
  };

  func_small2();
  $(window).on("resize", function () {
    func_small2();
  });
  $(".gallery-item").matchHeight();
} //banner page small


function ui_banner_page_small() {
  var $slider = $(".banner-page-small .slider-slick");

  if ($slider.length < 1) {
    return;
  }

  $slider.on("init", function (e) {
    var $slick_edit_nav = $("<div class=\"slick-edit-nav\"><div class=\"container\"><div class=\"slick-navi\"></div></div></div>");
    $slider.find(".slick-dots").wrap($slick_edit_nav);
    $slider.find(".slick-prev").addClass("disabled").detach().prependTo(".slick-edit-nav .container .slick-navi");
    $slider.find(".slick-next").detach().appendTo(".slick-edit-nav .container .slick-navi");
  });
  $slider.on("afterChange", function (slick, currentSlide) {
    $slider.find(".slick-arrow.disabled").removeClass("disabled");

    if (currentSlide.currentSlide == 0) {
      $slider.find(".slick-prev").addClass("disabled");
    } else if (currentSlide.currentSlide == currentSlide.slideCount - 1) {
      $slider.find(".slick-next").addClass("disabled");
    }
  });
  $slider.slick({
    infinite: true,
    slidesToShow: 1,
    autoplay: true,
    speed: 500,
    draggable: false,
    dots: true
  });
} //DAY STREAM


function ui_daystream() {
  var isSlickday = false;
  $("#modalPopovers").on("shown.bs.modal", function () {
    if (isSlickday) {
      var $s = $("#modalPopovers .dayline-carousel .slick-carousel");
      $s.slick("setPosition", 0);
      $s.slick("slickGoTo", 0);
      return;
    } // change_swiper_modal();


    favbox_swiper_change();
    $(this).find(".dayline-carousel .slick-carousel").slick({
      slidesToShow: 3,
      slidesToScroll: 3,
      autoplay: false,
      arrows: true,
      infinite: false,
      responsive: [{
        breakpoint: 992,
        settings: {
          slidesToShow: 4
        }
      }, {
        breakpoint: 576,
        settings: {
          slidesToShow: 3
        }
      }]
    });
    $(this).find(".dayline-carousel .slick-carousel").slick("slickGoTo", 0);
    isSlickday = true;
    $("#modalPopovers a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
      $("#modalPopovers .dayline-carousel .slick-carousel").slick("setPosition", 0);
      $("#modalPopovers .dayline-carousel .slick-carousel").slick("slickGoTo", 0);
    });
    $("#modalPopovers .list-item").addClass("scroll-ui");
    new SimpleBar($("#modalPopovers .scroll-ui")[0], {
      forceVisible: true,
      autoHide: false,
      scrollbarMinSize: 5
    });
  });
}

function ui() {
  // Select UI
  $.fn.select2.defaults.set("width", "100%");
  $(".select-ui").each(function (i, e) {
    var $el = $(this),
        options_len = $el.find("option").length >= 6 && $el.data("not-find") == undefined,
        _simpleBar,
        selectUI = $el.select2({
      placeholder: $el.data("placeholder") ? $el.data("placeholder") : "",
      minimumResultsForSearch: options_len ? 1 : -1
    }); // Update UI Scroll - Open dropdown


    selectUI.on("select2:open", function (e) {
      var id = "custom-simplebar-" + i;
      $(".select2-results").attr({
        id: id + "-group"
      }).queue(function (next) {
        setTimeout(function () {
          _simpleBar = new SimpleBar($("#" + id + "-group")[[0]], {
            autoHide: false
          });
        }, 0);
        next();
      });
    });
  }); // LAZY image

  $(".lazy").Lazy({
    effect: "fadeIn",
    effectTime: 500
  });
  $(".scroll-ui").each(function (i, el) {
    new SimpleBar(el, {
      forceVisible: true,
      autoHide: false
    });
  });
  $(".scroll-text").each(function (i, el) {
    new SimpleBar(el, {
      forceVisible: false,
      autoHide: true
    });
  });
  $("#select-floor-plan").select2({
    width: "75%",
    minimumResultsForSearch: -1
  });
} // Open favorite project


function ui_open_favorite() {
  $(".li-heart").click(function (e) {
    $(".open-fav").toggleClass("disabled");
  });
  $(".close-fav-mobile").on("click", function () {
    $(".open-fav").addClass("disabled");
  });
}
/* ====================
*
*   CLICK OUTSIDE
*
======================= */


function ui_click_outside() {
  var isMouseOutside_favbox = true,
      $box_icon = $(".fav-box,  .li-heart"),
      isMouseOutside_nav = true,
      $res_nav = $(" .burger, #nav-links");
  $box_icon.on("mouseenter", function () {
    isMouseOutside_favbox = false;
  }).on("mouseleave", function () {
    isMouseOutside_favbox = true;
  });
  $res_nav.on("mouseenter", function () {
    isMouseOutside_nav = false;
  }).on("mouseleave", function () {
    isMouseOutside_nav = true;
  });
  $(window).click(function (e) {
    if (isMouseOutside_favbox) {
      $(".open-fav").addClass("disabled");
    }

    if (isMouseOutside_nav) {
      $("#nav-links").removeClass("nav-active");
      $(".burger").removeClass("open");
    }
  });
} // Image svg


function imgSVG() {
  $("img.svg").each(function () {
    var $img = $(this),
        imgID = $img.attr("id"),
        imgClass = $img.attr("class"),
        imgURL = $img.attr("src");
    $.get(imgURL, function (data) {
      // Get the SVG tag, ignore the rest
      var $svg = $(data).find("svg"); // Add replaced image's ID to the new SVG

      if (typeof imgID !== "undefined") {
        $svg = $svg.attr("id", imgID);
      } // Add replaced image's classes to the new SVG


      if (typeof imgClass !== "undefined") {
        $svg = $svg.attr("class", imgClass + " replaced-svg");
      } // Remove any invalid XML tags as per http://validator.w3.org


      $svg = $svg.removeAttr("xmlns:a"); // Replace image with new SVG

      $img.replaceWith($svg);
    }, "xml");
  });
}

function gotoTop() {
  // console.log($("#gotoTop"));
  $("#gotoTopMain").fadeOut();
  $(window).scroll(function () {
    if ($(this).scrollTop() >= 50) {
      $("#gotoTopMain").fadeIn();
    } else {
      $("#gotoTopMain").fadeOut();
    }
  });
  $("#gotoTopMain").click(function (e) {
    e.preventDefault();
    $("body,html").animate({
      scrollTop: 0
    }, 500);
  });
}

function ui_header_js() {
  $("#show-searchbox1").on("click", function (e) {
    e.preventDefault();
    $(this).closest(".box-searchbox").toggleClass("expand");
  });
  $("#button-toggle-menu").on("click", function (e) {
    e.preventDefault();
    $(".header-page .first-row, #button-toggle-menu").toggleClass("expand");
  });
} // add favorite project


function ui_add_favorite_items() {
  $("body").on('click', '.btn-like', function () {
    $(this).toggleClass("added");
  }); //favorite project detail

  $(".btn-favorite").click(function () {
    if ($(this).hasClass("added")) {
      $(this).removeClass("added"); 
      // animation

      $(".li-heart").removeClass("run-shake").stop().addClass("run-shake");
      setTimeout(function () {
        $(".li-heart").removeClass("run-shake");
      }, 700); 
      // minus

      var total = parseInt($(".li-heart").attr("data-total")) - 1;
      $(".li-heart").attr("data-total", total);
      $(".li-heart .count-like").text(total > 5 ? "5+" : total);
    } else {
      $(this).addClass("added"); 
      // animation

      $(".li-heart").removeClass("run-popout").stop().addClass("run-popout");
      setTimeout(function () {
        $(".li-heart").removeClass("run-popout");
      }, 700); 
      // plus+

      var total = parseInt($(".li-heart").attr("data-total")) + 1;
      $(".li-heart").attr("data-total", total);
      $(".li-heart .count-like").text(total > 5 ? "5+" : total);
    }
  });
  $(".like-checked").click(function () {
    $(this).toggleClass("unlike");
  });
}
/* ==================
 *   FAV LINE
 * =================== */


function ui_fav_line() {
  $.countSchedule = function () {
    var $count = $('.menu-right .not-rp .fav-line input[type="checkbox"]').filter(':checked').length;
    if ($count < 1) $('.btn-nlp span.count').addClass('d-none');else {
      $('.btn-nlp span.count').removeClass('d-none');
      $('.btn-nlp span.count').text('(' + $count + ')');
    }
    var textarea = 'I would like to know more about ';
    var $inputchecked = $('.menu-right .not-rp .fav-line input[type="checkbox"]').filter(':checked');
    $inputchecked.each(function (i) {
      var name = $(this).closest('.fav-line-right').find('.title').text();
      textarea += (i != 0 && i + 1 == $inputchecked.length ? ' and ' : i == 0 ? '' : ', ') + name;
    });
    textarea = $inputchecked.length > 0 ? textarea : '';
    $('#msg').val(textarea);
    $('#msg2').val(textarea);
    sessionStorage.setItem('textarea_contact', textarea);
  }; // if (sessionStorage.getItem('textarea_contact') && $('.contact-page-section textarea').val() == '') $('#msg, .contact-page-section textarea').val(sessionStorage.getItem('textarea_contact'));


  $(document.body).on('change', '.not-rp .fav-line input[type="checkbox"]', function (e) {
    var _classname = $(e.currentTarget).attr('class');

    $('.' + _classname.replace(' ', '.')).prop('checked', $(e.currentTarget).is(':checked'));
    $.countSchedule();
  }); //delete fav line

  $(document.body).on('click', '.not-rp .fav-line .btn-close-modal-item', function (e) {
    e.preventDefault();
    var $count = $('.menu-right .not-rp .fav-line input[type="checkbox"]').filter(':checked').length;
    if ($(e.currentTarget).parent().find('.info input[type="checkbox"]').is(':checked')) $count -= 1;
    if ($count < 1) $('.btn-nlp span.count').addClass('d-none');else {
      $('.btn-nlp span.count').removeClass('d-none');
      $('.btn-nlp span.count').text('(' + $count + ')');
    } // Get classname of input when you click

    var $input = $(this).closest('.fav-line').find('input[type="checkbox"]'),
        _classname = $input.attr('class'); // Fade out and slide up then remove same fav-line had same classname


    $('.' + _classname.replace(' ', '.')).closest('.fav-line').animate({
      height: 0,
      opacity: 0
    }, 350, function () {
      $(this).remove();
    }); // Show the empty noti when list item has empty.

    if ($('.not-rp .fav-line .btn-close-modal-item').length <= 2) {
      $('.not-rp .list-item .empty-noti').removeClass('d-none');
      $('.menu-right .not-rp .group-btn').addClass('d-none');
    }

    setTimeout(function () {
      $.countSchedule();
    }, 400);
  });
} // Pick only one item


function ui_choose_one() {
  // $('.date-item').click(function () {
  //     const isChoose = $(this).hasClass('choose');
  //     $('.date-item').removeClass('choose');
  //     if (isChoose)
  //         $(this).removeClass('choose');
  //     else
  //         $(this).addClass('choose');
  // });
  var $radioInput = $('.day-stream label.date-item input[type="radio"]');
  $('.date-item').on('click', function (e) {
    var $it = $(e.currentTarget); // console.log($it.find($radioInput).is(':checked'));

    $('.date-item').removeClass('choose');
    if ($it.find($radioInput).is(':checked')) $it.addClass('choose');

    if ($radioInput.filter(':checked').length > 0) {
      $('.scheduleForm .day-stream').removeClass('error-date');
      $('.scheduleForm .day-stream .msg-error').remove();
    }
  });
}


$("body").imagesLoaded(function () {
  $("body").addClass("loaded");
  $(".pageLoad").fadeOut();
}); //TIME PICKER

function timepicker() {
  $(".timepicker").datetimepicker({
    format: "LT",
    ignoreReadonly: true,
    stepping: 10
  });
} // dotdotdot


function ui_dotdotdot() {
  $(".dotdotdot").dotdotdot({
    height: 50,
    fallbackToLetter: true,
    watch: true,
    truncate: "word"
  });
  $(".guides-dotdotdot").dotdotdot({
    height: 75,
    fallbackToLetter: true,
    watch: true,
    truncate: "word"
  });
  $(".gd-dotdotdot").dotdotdot({
    height: 40,
    fallbackToLetter: true,
    watch: true,
    truncate: "letter"
  });
} //Choose detail items


function allnewlaunches_detail_item_click() {
  var $item = $(".nl-content-view  .item-detail");

  if ($item.length < 1) {
    return;
  }

  $item.activeItemIndex = $(".nl-content-view  .item-detail.active").index();
  $item.click(function () {
    var $this = $(this);

    if ($this.index() == $item.activeItemIndex) {
      return;
    }

    $item.removeClass("active");
    $this.addClass("active");
    $item.activeItemIndex = $this.index();
  });
} //detect mobile device


function ui_detect_device() {
  var detector = new MobileDetect(window.navigator.userAgent); // console.log("Mobile: " + detector.mobile());
  // console.log("Phone: " + detector.phone());
  // console.log("Tablet: " + detector.tablet());
}

function ui_smooth_scroll() {
  var Scrollbar = window.Scrollbar;
  Scrollbar.init(document.querySelector("#fullpage"), {
    damping: 0.12
  });
}
/* ====================
*
*   REMAKE Grid item
*
======================= */


function nl_grid_item() {
  $(".nl-grid-item .img .owl-carousel").owlCarousel({
    items: 1,
    lazyLoad: true,
    margin: 10,
    dots: false,
    nav: true,
    navText: [],
    mouseDrag: false,
    animateOut: "fadeOut",
    animateIn: "fadeIn",
    smartSpeed: 250
  });
} //toggle navigation main


function ui_nav_res() {
  $(".btn-toggle-center").on("click", function (e) {
    e.preventDefault();
    $(".wrap-sticky-header").addClass("expand");
    $.bodyDisableScroll();
  });
  $(".header-page .backdrop, .logo-center .close").on("click", function () {
    $(".wrap-sticky-header").removeClass("expand");
    $.bodyReturnScroll();
  });

  var isOutside = true;
  var $text = $('.toggle-down').find('span.text');
  $text.on('mouseenter', function () {
    isOutside = false;
  }).on('mouseleave', function () {
    isOutside = true;
  });
  $('.toggle-down').on('click', function (e) {
    var _this = this;

    var $w = $(window);

    var _resize = function _resize() {
      if ($w.outerWidth() < 992) if (isOutside) {
        e.preventDefault();
        $(_this).parent().toggleClass('expand');
      }
    };

    $(window).on('resize', _resize);

    _resize();
  });
}

function nl_body_handle_scroll() {
  $.bodyScrollTop = 0;

  $.bodyDisableScroll = function () {
    var $w = $(window);

    if ($w.width() > 768) {
      return;
    }

    $.bodyScrollTop = $w.scrollTop();
    $("#page").css({
      height: $w.height(),
      overflow: "hidden"
    });
  };

  $.bodyReturnScroll = function () {
    var $w = $(window);

    if ($w.width() > 768) {
      return;
    }

    $("#page").css({
      height: "",
      overflow: ""
    });
    $w.scrollTop($.bodyScrollTop);
  };

  $(".modal").on("shown.bs.modal", $.bodyDisableScroll);
  $(".modal").on("hide.bs.modal", $.bodyReturnScroll);
}

function form_func() {
  var msg = "This field is required!"; //Email validation
  var $radioInput = $('.day-stream label.date-item input[type="radio"]'); //Email validation

  $.validator.addMethod("nl_mail", function (value, element) {
    return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value);
  }, "Please enter a valid email address.");
  $('.form-validate').each(function () {
    var $form = $(this);
    $form.validate({
      rules: {
        name: {
          required: true
        },
        m_name: {
          required: true
        },
        m_name2: {
          required: true
        },
        phone: {
          required: true,
          minlength: 8,
          maxlength: 14
        },
        m_phone: {
          required: true,
          minlength: 8,
          maxlength: 14
        },
        m_phone2: {
          required: true,
          minlength: 8,
          maxlength: 14
        },
        email: {
          required: true,
          nl_mail: true
        },
        m_email: {
          required: true,
          nl_mail: true
        },
        m_email2: {
          required: false,
          nl_mail: true
        },
        message: {
          required: true
        },
        m_textarea2: {
          required: true
        }
      },
      messages: {
        name: {
          required: msg
        },
        m_name: {
          required: msg
        },
        m_name2: {
          required: msg
        },
        phone: {
          required: msg
        },
        m_phone: {
          required: msg
        },
        m_phone2: {
          required: msg
        },
        email: {
          required: msg
        },
        m_email: {
          required: msg
        },
        m_email2: {
          required: msg
        },
        message: {
          required: msg
        },
        m_textarea2: {
          required: msg
        }
      },
      errorElement: 'div',
      errorPlacement: function errorPlacement(error, element) {
        error.addClass('invalid-feedback');
        error.insertAfter(element);
      },
      highlight: function highlight(element) {
        $(element).addClass('is-invalid');
      },
      // (element, errorClass, validClass) {
      unhighlight: function unhighlight(element) {
        $(element).removeClass('is-invalid');
      }
    });

    if ($form.hasClass('scheduleForm')) {
      var _msg = 'This field is required!';
      var msgText = "<span class=\"msg-error\">".concat(_msg, " </span>");
      $form.on('submit', function (e) {
        if ($radioInput.filter(':checked').length < 1) {
          e.preventDefault();
          $form.find('.day-stream').addClass('error-date');
          if ($form.find('.day-stream .msg-error').length < 1) $form.find('.day-stream').append(msgText);
        } else {
          $form.find('.day-stream').removeClass('error-date');
          $form.find('.day-stream .msg-error').remove();
        }
      });
    }
  });
}

(function ($) {
  ui();
  imgSVG();
  nl_body_handle_scroll();
  $(function () {
    ui_nav_res();
    ui_header_js();
    auto_match_height();
    ui_banner_page_small();
    ui_triple_carousel();
    ui_fix_header_sticky();
    ui_open_favorite();
    ui_checked_stage();
    ui_daystream();
    ui_checked_state_modal();
    timepicker();
    // ui_add_favorite_items();
    ui_choose_one();
    gotoTop();
    ui_triple_carousel_sidebar();
    ui_click_outside();
    collapse_menu();
    slide_swiper();
    ui_fav_line();
    ui_loading_page();
    ui_detect_device();
    change_state_swiper_services();
    allnewlaunches_detail_item_click();
    ui_dotdotdot();
    nl_grid_item();
    form_func(); // ui_delete_item();
    // ui_smooth_scroll();
    // favbox_swiper_change();
  });
})(jQuery);
"use strict";

(function ($) {
  // back to previous page : project detail
  function back_to_previous() {
    $(".back-prev-page").on("click", function () {
      window.history.back();
    });
  } // expand-exclose detail


  function ui_expand_detailed() {
    $(".btn-expand").click(function () {
      $(this).toggleClass("expand");
      $(".content-detail .content-left").toggleClass("d-none");
      $(".content-grid-detail").toggleClass("col-lg-12");
      $(".filter-search").toggleClass("d-none");
      $(".footer-btn").toggleClass("d-none");
      $(".footer-page .container").toggleClass("mg-0");
      $(".content-detail .group-btn").toggleClass("changed");

      if ($("#ex").text() == "Collapse") {
        $("#ex").text("Expand");
      } else {
        $("#ex").text("Collapse");
      }
    });
  }

  function ui_res_detail() {
    var func_small = function func_small() {
      if ($(window).outerWidth() < 992) {
        if (!$(".slide-grid-res").hasClass("slick-slider")) {
          $(".slide-grid-res").slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            arrows: true,
            responsive: [{
              breakpoint: 575,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }, {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }, {
              breakpoint: 992,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            }]
          });
        }
      } else if ($(".slide-grid-res").hasClass("slick-slider")) {
        $(".slide-grid-res").slick("unslick");
      }
    };

    func_small();
    $(window).on("resize", function () {
      func_small();
    });
  } //MARQUEE  RES : Services pages


  function ui_marquee_ui() {
    $(".marquee").marquee({
      direction: "left",
      duration: 12000,
      duplicated: true,
      startVisible: true
    });
  } //SWIPER DETAIL VIEW MODE


  function detail_view_mode_swiper() {
    // var $detail = { isInitSwiper: false };
    var $detail = $(".detail-view-mode .nl-content-view .swiper-wrapper");

    if ($(".detail-view-mode .nl-content-view .swiper-container").length < 1) {
      return;
    }

    var _change = function _change() {
      if ($(window).outerWidth() < 992) {
        if (!$detail.isInitSwiper) {
          $detail = new Swiper($(".detail-view-mode .nl-content-view .swiper-container"), {
            slidesPerView: "auto",
            effect: "slide",
            spaceBetween: 0,
            freeMode: true
          });
          $detail.isInitSwiper = true;
        }
      } else {
        if ($detail.isInitSwiper) {
          $detail.destroy();
          $detail.isInitSwiper = false;
        }
      }
    };

    _change();

    $(window).on("resize", _change);
  } //SWIPER PROJECT DETAIL INFO : PROJECT DETAIL PAGE


  function project_detail_info_swiper() {
    var $info = {
      isInitSwiper: false
    };

    if ($(".section-project-info .swiper-container").length < 1) {
      return;
    }

    var _resize = function _resize() {
      if ($(window).outerWidth() < 768) {
        if (!$info.isInitSwiper) {
          $info = new Swiper($(".section-project-info .swiper-container"), {
            slidesPerView: "auto",
            spaceBetween: 0,
            effect: "slide",
            freeMode: true,
            scrollbar: {
              el: ".section-project-info .swiper-scrollbar",
              draggable: true
            }
          });
          $info.isInitSwiper = true;
        }
      } else {
        if ($info.isInitSwiper) {
          $info.destroy();
          $info.isInitSwiper = false;
        }
      }
    };

    _resize();

    $(window).on("resize", _resize);
  } //Swiper Rates: Mortgage Insurance page


  function rates_swiper() {
    var $info = {
      isInitSwiper: false
    };

    if ($(".rated-section .rates-mobile .swiper-container").length < 1) {
      return;
    }

    var _resize = function _resize() {
      if ($(window).outerWidth() < 768) {
        if (!$info.isInitSwiper) {
          $info = new Swiper($(".rated-section .rates-mobile .swiper-container"), {
            slidesPerView: "auto",
            spaceBetween: 5,
            effect: "slide",
            freeMode: true,
            scrollbar: {
              el: ".rated-section .rates-mobile .swiper-scrollbar",
              draggable: true
            }
          });
          $info.isInitSwiper = true;
        }
      } else {
        if ($info.isInitSwiper) {
          $info.destroy();
          $info.isInitSwiper = false;
        }
      }
    };

    $(window).on("resize", _resize);

    _resize();
  } // Slide detail item in Project detail page


  function ui_res_detail_item() {
    var func_small = function func_small() {
      if ($(window).width() > 992 && $(window).width() < 1200) {
        $(".slide-grid-res .item-detail").addClass("col-lg-12");
      } else {
        $(".slide-grid-res .item-detail").removeClass("col-lg-12");
      }
    };

    func_small();
    $(window).on("resize", function () {
      func_small();
    });
  } //slick slider


  function ui_slide_items() {
    $(".items-carousel").slick({
      infinite: true,
      slidesToShow: 1,
      autoplay: false,
      fade: true,
      slidesToScroll: 1,
      arrows: true,
      responsive: [{
        breakpoint: 575,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }, {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }, {
        breakpoint: 992,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }]
    });
  } // SCroll Page


  var indexSectionCurrent = -1;

  function scroll_page() {
    var $section = $("section").not(".section-detail");
    $("#nextpage").click(function () {
      indexSectionCurrent++;

      if ($section.eq(indexSectionCurrent).length < 1) {
        return;
      }

      $("html,body").animate({
        scrollTop: $section.eq(indexSectionCurrent).offset().top
      }, 800);
    });
    $(window).on("scroll", function () {
      $section.each(function (i, el) {
        if ($(window).scrollTop() + $(window).height() / 2 >= $section.eq(i).offset().top - 1) {
          indexSectionCurrent = i;
        } else if ($(window).scrollTop() < $section.eq(0).offset().top - 1) {
          indexSectionCurrent = -1;
        }
      }); // Hide button scroll last section

      if (indexSectionCurrent + 1 >= $section.length) {
        $("#nextpage").fadeOut();
      } else {
        $("#nextpage").fadeIn();
      } // indexSectionCurrent + 1 >= $section.length ? fullpage_api.destroy() : fullpage_api.Build();
      // Active nav sidebar


      $(".navSidebar li a").removeClass("active");

      if (indexSectionCurrent > -1) {
        $(".navSidebar li").eq(indexSectionCurrent).find("a").addClass("active");
      }
    });
  }

  function smooth_scroll_page() {
    // new SmoothScroll('#fullpage', {
    //     speed: 500,
    //     speedAsDuration: true,
    //     easing: 'easeInQuad',
    // })
    var Scrollbar = window.Scrollbar;
    Scrollbar.init(document.querySelector("#fullpage"), {
      damping: 0.12
    });
  } //Scroll full screen
  // function project_detail_scroll_full_screen() {
  //     var $full = $("#fullpage"), isInitFullPage = false;
  //     var _func_fullpage = function () {
  //         if ($(window).width() > 992 && screen.height >= 894) {
  //             if (!isInitFullPage && $("#fullpage").length > 0) {
  //                 $full.fullpage({
  //                     slideSelector: "section",
  //                     menu: "#menuFullpage",
  //                     scrollBar: true,
  //                     scrollingSpeed: 500,
  //                     scrollOverflow: true,
  //                     interlockedSlides: true
  //                 });
  //                 isInitFullPage = true;
  //             }
  //         } else {
  //             if (isInitFullPage) {
  //                 $.fn.fullpage.destroy('all');
  //                 isInitFullPage = false;
  //                 $full = $("#fullpage");
  //             }
  //         }
  //     };
  //     $(window).on("resize", _func_fullpage);
  //     _func_fullpage();
  // }
  //facncy-box


  function ui_image_gallery(img) {
    //facncy-box
    $("[data-fancybox=".concat(img, "]")).fancybox({
      afterLoad: function afterLoad(instance, current) {
        var pixelRatio = window.devicePixelRatio || 1; // console.log(window.devicePixelRatio);

        if (pixelRatio > 1.5) {
          current.width = current.width / pixelRatio;
          current.height = current.height / pixelRatio;
        }
      },
      hash: false,
      share: {
        url: function url(instance, item) {
          if (item.type === "inline" && item.contentType === "video") {
            return item.$content.find("source:first").attr("src");
          }

          return item.src;
        }
      },
      thumbs: {
        autoStart: true,
        // Display thumbnails on opening
        axis: "y"
      }
    });
  }

  function proj_detail_gallery_load_multi() {
    ui_image_gallery("images1");
    ui_image_gallery("images2");
    ui_image_gallery("images3");
    ui_image_gallery("images4");
    ui_image_gallery("images5");
    ui_image_gallery("images6");
  } //slide on page


  function ui_landing_page() {
    $(".navSidebar a").click(function (e) {
      e.preventDefault();
      var $element = $($(this).attr("href"));

      if ($element.length < 1) {
        return;
      }

      $("html,body").animate({
        scrollTop: $element.offset().top
      }, 800);
    });
    $(".logo-brand a").click(function (e) {
      e.preventDefault();
      var $element = $($(this).attr("href"));

      if ($element.length < 1) {
        return;
      }

      $("html,body").animate({
        scrollTop: $element.offset().top
      }, 800);
    });
  } //single item slide


  function single_slide() {
    $(".slider-slick-gallery").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true
    });
  } //open navigation sidebar


  function open_nav_sidebar() {
    $.bodyScrollTop = 0;

    $.bodyDisableScroll = function () {
      var $w = $(window);

      if ($w.width() > 768) {
        return;
      }

      $.bodyScrollTop = $w.scrollTop();
      $("#page").css({
        height: $w.height(),
        overflow: "hidden"
      });
    };

    $.bodyReturnScroll = function () {
      var $w = $(window);

      if ($w.width() > 768) {
        return;
      }

      $("#page").css({
        height: "",
        overflow: ""
      });
      $w.scrollTop($.bodyScrollTop);
    };

    var clicked = true;
    $(".open-navSide, .mobile-close-nav").click(function () {
      $(".block-sidebar").addClass("open");
      $(this).addClass("open");
      $(".project-detail .dark-layer").removeClass("d-none");
      $.bodyDisableScroll(); // TODO
    });
    $(" .mobile-close-nav, .project-detail .dark-layer").click(function () {
      $(".block-sidebar").removeClass("open");
      $(this).addClass("open");
      $(".project-detail .dark-layer").addClass("d-none");
      $.bodyReturnScroll();
    });
    $(".project-detail .block-sidebar .navSidebar a").on("click", function () {
      $.bodyReturnScroll();
    });
  } // CLICK OUTSIDE


  function close_click_outside() {
    var isMouseOutside_favbox = true;
    var $box_icon = $(".open-navSide");
    $box_icon.on("mouseenter", function () {
      isMouseOutside_favbox = false;
    }).on("mouseleave", function () {
      isMouseOutside_favbox = true;
    });
    $(window).click(function () {
      if (isMouseOutside_favbox) {
        $(".open-navSide").removeClass("open");
        $(".block-sidebar").removeClass("open");
        $(".project-detail .dark-layer").addClass("d-none"); // TODO
      }
    });
  } //open map info


  function open_map_info() {
    $(".open-map-info").click(function () {
      $(".map-info").toggleClass("d-none");
    });
  } //open group share


  function open_share() {
    var json = null;
    var id = null;
    var tw = null;
    var fb = null;
    var lkd = null;

    var _sharing = function _sharing(fbLink, twLink, lindLiink) {
      $(".group-share").jsSocials({
        shares: [{
          share: "facebook",
          url: fbLink
        }, {
          share: "twitter",
          url: twLink
        }, {
          share: "linkedin",
          url: lindLiink
        }],
        showLabel: false,
        showCount: false,
        shareIn: "popup"
      });
    };

    $(".icon-share-white").click(function (e) {
      var $this = $(this);

      if (!$this.hasClass("active")) {
        $(".open-share, .overlay-layer, .icon-share-white").removeClass("active open");
        $this.addClass("active");
        $(this).parent().find(".open-share").addClass("open");
        $(".overlay-layer").addClass("active");
      } else {
        $this.removeClass("active");
        $(this).parent().find(".open-share").removeClass("open");
        $(".overlay-layer").removeClass("active");
      } //js social


      json = $(e.currentTarget).find(".group-share").data("json"); // id = json[0].id;

      fb = json.url.fbLink;
      tw = json.url.twLink;
      lkd = json.url.lindLink;

      _sharing(fb, tw, lkd);
    });
    var isMouseOutside = true;
    var $share_group = $(".group-share, .icon-share-white");
    var $isCurrent = $(this).parent().find(".open-share");
    $share_group.on("mouseenter", function () {
      isMouseOutside = false;
    }).on("mouseleave", function () {
      isMouseOutside = true;
    });
    $(window).click(function () {
      if (isMouseOutside && $isCurrent) {
        $(".open-share").removeClass("open");
        $(".icon-share-white").removeClass("active");
        $(".overlay-layer").removeClass("active");
      } else {}
    });
  }

  function ui_resnav_sidebar_small() {
    $(".toggle-nav-filter").click(function () {
      $(this).toggleClass("active");
      $(".sidebar-filter").toggleClass("open");
    });
  } //Panning and zooming Elements
  //project detail page : Floor plan section


  function zoom_el() {
    $(".section-plan .img-desc a.img-bg").zoom({
      url: "images/project-detail/subtraction.png",
      magnify: 1.8
    });
  } //Masonry gallery project detail
  // gallery Section: masonry


  function gallery_swiper_res() {
    var $grid = {
      isInitSwiper: false
    },
        gallery,
        galleryAll;

    if ($(".section-gallery .swiper-container").length < 1) {
      return;
    }

    var _resize = function _resize() {
      if ($(window).outerWidth() > 768) {
        if (!$grid.isInitMasonry) {
          if (gallery) {
            gallery.destroy();
          }

          $(".swiper-wrapper-mobile").addClass("d-none").removeClass("swiper-wrapper").html("");
          $(".swiper-wrapper-pc").removeClass("d-none").addClass("swiper-wrapper");
          $grid = $(".grid-gallery ").masonry({
            columnWidth: ".grid-sizer",
            percentPosition: true,
            horizontalOrder: false,
            gutter: 20
          });
          $grid.isInitMasonry = true;
          gallery = new Swiper($(".block-content .section-gallery .swiper-container"), {
            slidesPerView: "auto",
            effect: "slide",
            freeMode: true,
            spaceBetween: 10,
            navigation: {
              nextEl: ".section-gallery .swiper-button-next",
              prevEl: ".section-gallery .swiper-button-prev"
            },
            scrollbar: {
              el: ".section-gallery .swiper-scrollbar",
              draggable: true
            }
          });
        }
      } else {
        if ($grid.isInitMasonry) {
          $grid.masonry("destroy");
          $grid.isInitMasonry = false;
          gallery.destroy();
        } // Restructure DOM slider


        if (!$grid || !$grid.isRestructrueDOM) {
          $(".swiper-wrapper-pc .grid-item").each(function (i, e) {
            $(this).clone().addClass("swiper-slide").appendTo(".swiper-wrapper-mobile");
          });
          $(".swiper-wrapper-pc").addClass("d-none").removeClass("swiper-wrapper");
          $(".swiper-wrapper-mobile").removeClass("d-none").addClass("swiper-wrapper");
          gallery = new Swiper($(".block-content .section-gallery .swiper-container"), {
            slidesPerView: "auto",
            effect: "slide",
            freeMode: true,
            spaceBetween: 10,
            navigation: {
              nextEl: ".section-gallery .swiper-button-next",
              prevEl: ".section-gallery .swiper-button-prev"
            },
            scrollbar: {
              el: ".section-gallery .swiper-scrollbar",
              draggable: true
            }
          });
          $grid = {
            isRestructrueDOM: true,
            isInitMasonry: false
          };
        }
      }
    };

    $(".gallery-project-detail .swiper-wrapper").addClass("swiper-wrapper-pc");
    $(".gallery-project-detail").append("<div class='swiper-wrapper-mobile grid-gallery'></div>");
    $(window).on("resize", _resize);

    _resize();
  } //resize overflow floor plan


  function overflow_floor_plan() {
    var _resizeMaxHeight = function _resizeMaxHeight() {
      var $logo = $(".section-plan .logo-brand"),
          $innerContent = $(".section-plan .inner-content-right");
      $(".section-plan .sidebar-filter").css({
        "max-height": $logo.outerHeight(true) + $innerContent.outerHeight(true)
      });
    };

    _resizeMaxHeight();

    $(window).on("resize", _resizeMaxHeight); // $(window).on('resize', function () {
    //     var $h = $(".section-plan .sidebar-filter").outerHeight();
    //     console.log($h);
    //     $(".section-plan .sidebar-filter").css({
    //         "max-height": $h
    //     })
    // });
  } //MULTILEVEL SELECT: project detail page - floor plan


  function multil_select_dropdown() {// $(".drop-mobile ul.drop-ul").dropdown();
  }

  function nl_project_detail_scroll() {
    var $fullpage = $("#fullpage"),
        $w = $(window);

    if ($fullpage.length < 1) {
      return;
    }

    var $section = $fullpage.find("section, footer"),
        isScrollDown = false;

    document.onwheel = function (tick) {
      isScrollDown = tick.deltaY > 0;
    }; // Get range


    var getRange = function getRange() {
      var $first,
          isKeep = true,
          $last,
          h = $(window).height(),
          force = false;
      $section.each(function () {
        var $this = $(this); // console.log($this.offset().top, $w.scrollTop() + $w.height(), $this.height(), $this.outerHeight(true));

        if ($this.offset().top + $this.outerHeight(true) < $w.scrollTop() + $w.height() && $this.offset().top >= $w.scrollTop()) {
          $last = $this;
        }

        if (!$last && $this.offset().top > $w.scrollTop() + 1 && $this.offset().top < $w.scrollTop() + $w.height()) {
          $last = $this.prev();
          force = true;
        }

        if ($this.offset().top + $this.outerHeight(true) >= $w.scrollTop()) {
          if (isKeep) {
            $first = $this;
            isKeep = false;
          }
        }
      });

      if (!isScrollDown) {
        if ($first.height() > $w.height()) {
          h = $w.height();
        } else {
          h = $first.outerHeight(true) - ($first.offset().top + $first.outerHeight(true) - $w.scrollTop());
        }
      } else {
        if (!$last || $last.height() > $w.height()) {
          h = $w.height();

          if (force) {
            force = false;
            h = $last.outerHeight(true) + $last.offset().top - $w.scrollTop();
          }
        } else {
          h = $last.outerHeight(true) + $last.offset().top - $w.scrollTop();
        }
      }

      return h;
    };

    $(window).impulse({
      range: getRange,
      delay: true,
      effect: "swing",
      tempo: 900
    });
    var $sidebar = $(".sidebar-filter");
    $sidebar.on("mouseover mouseenter", function () {
      if ($(".sidebar-filter ul.nav-filter").height() + parseInt($sidebar.css("padding-top").replace("px", "")) + parseInt($sidebar.css("padding-bottom").replace("px", "")) > parseInt($sidebar.css("max-height").replace("px", ""))) {
        $(".sidebar-filter").focus();
        $(window).amend({
          keen: false
        });
      }
    }).on("mouseleave", function () {
      $(window).amend({
        keen: true
      });
    });
    var $map = $(".project-detail .map-info .pane-direction");
    $map.on("mouseover mouseenter", function () {
      $(window).amend({
        keen: false
      });
    }).on("mouseleave", function () {
      $(window).amend({
        keen: true
      });
    });
  }

  function floor_plan_change_tab() {
    var _resize = function _resize() {
      if ($(window).outerWidth() < 1200) {
        $(".section-plan .tab-pane").hide();
        $(".section-plan #tab80").show();
        $(".section-plan #select-floor-plan").change(function () {
          var dropdown = $(".section-plan #select-floor-plan").val();
          $(".section-plan .tab-pane").hide();
          $("#" + "tab" + dropdown).show();
        });
      }
    };

    $(window).on("resize", _resize);

    _resize();
  } //CUSTOM REPORT PAGE


  function report_favbox_swiper_change() {
    var $favbox = {
      isInitSwiper: false
    };

    if ($(".manage-project .content-fav .swiper-container").length < 1) {
      return;
    }

    var _resize = function _resize() {
      if ($(window).outerWidth() >= 992) {
        if (!$(".manage-project.list-item").attr("data-simplebar")) {
          $(".scroll-ui").each(function (i, el) {
            new SimpleBar(el);
          });
        }

        if ($favbox.isInitSwiper) {
          $favbox.destroy();
          $favbox.isInitSwiper = false;
        }
      } else {
        if ($(".manage-project .list-item").attr("data-simplebar")) {
          $(".manage-project .list-item").html($(".manage-project .list-item .simplebar-content").html()).removeAttr("data-simplebar");
        }

        if (!$favbox.isInitSwiper) {
          $(".manage-project .content-fav .swiper-container .simple-bar").addClass("swiper-wrapper");
          $favbox = new Swiper($(".manage-project .content-fav .swiper-container"), {
            slidesPerView: "auto",
            spaceBetween: 0,
            effect: "slide",
            freeMode: true
          });
          $favbox.isInitSwiper = true;
        }
      }
    };

    $(window).on("resize", _resize);

    _resize();
  } //day stream


  function report_schedule_daystream() {
    $(".manage-project .dayline-carousel .slick-carousel").slick({
      slidesToShow: 3,
      slidesToScroll: 3,
      autoplay: false,
      arrows: true,
      responsive: [{
        breakpoint: 992,
        settings: {
          slidesToShow: 4
        }
      }, {
        breakpoint: 576,
        settings: {
          slidesToShow: 3
        }
      }]
    });
  } //rating star


  function report_ratings(r) {
    var f = ~~r;
    var id = "star" + f + (r % f ? "half" : "");

    if (id) {
      $(id).checked = !0;
    }
  } //delete recommended projects: Custom report


  function report_del_fav_line() {
    $(" .fav-line-rp input[type='checkbox']").on("change", function () {
      var _classname = $(this).attr("class");

      $("." + _classname.replace(" ", ".")).prop("checked", $(this).is(":checked"));
    });
    $(document.body).on("click", " .fav-line-rp .btn-close-report", function (e) {
      e.preventDefault(); // Get classname of input when you click

      var $input = $(this).closest(".fav-line-rp").find("input[type='checkbox']");

      var _classname = $input.attr("class"); // Fade out and slide up then remove same fav-line had same classname


      $("." + _classname.replace(" ", ".")).closest(".fav-line-rp").animate({
        height: 0,
        opacity: 0
      }, 350, function () {
        $(this).remove();
      }); // Show the empty noti when list item has empty.

      if ($(" .fav-line-rp .btn-close-report").length <= 1) {
        $(" .list-item .empty-noti").removeClass("d-none");
        $(" .menu-right .group-btn").addClass("d-none");
      }
    });
  } //outer height: Rotate screen mobile follow landscape


  function detach_landscape() {
    var _resize = function _resize() {
      if ($(window).outerHeight() < 500) {
        $(".full-screen-section").css({
          "min-height": "539px"
        });
        $(".project-detail .content-right").css({
          padding: "69px 100px"
        });
        $(".project-detail .scroll-page").css({
          display: "none"
        });
        $(".map-site .google-map-pdetail").css({
          height: "100vh"
        });
      } else {
        $(".full-screen-section").css({
          "min-height": ""
        });
        $(".project-detail .content-right").css({
          padding: ""
        });
        $(".project-detail .scroll-page").css({
          display: ""
        });
        $(".map-site .google-map-pdetail").css({
          height: ""
        });
      }
    };

    $(window).on("resize", _resize);

    _resize();
  }

  function droplist_selectbox_handle() {
    var $select = $(".nl-dropbox .nl-select");
    var $item = $(".nl-dropbox .nl-droplist .item-value");
    var result = null;
    $select.on("click", function (e) {
      var $this = $(this);

      if (!$this.hasClass("focusing")) {
        $select.removeClass("focusing");
        $this.addClass("focusing");
      } else {
        $this.removeClass("focusing");
      }
    });
    var isMouseOutside = false;
    $select.on("mouseenter", function () {
      isMouseOutside = false;
    }).on("mouseleave", function () {
      isMouseOutside = true;
    });
    $(window).on("click", function () {
      if (isMouseOutside) {
        $select.removeClass("focusing");
      }
    });
    $item.on("click", function (e) {
      result = null;
      var it = e.currentTarget;
      var itVal = $(it).attr("data-value");
      $item.removeClass("choosing");
      $(it).addClass("choosing");
      result = itVal;
      $(it).closest(".nl-dropbox").find(".nl-select").text(result); // console.log(itVal);
    });
  }

  $(function () {
    multil_select_dropdown();
    ui_slide_items();
    ui_expand_detailed();
    ui_res_detail();
    ui_landing_page();
    scroll_page();
    proj_detail_gallery_load_multi();
    project_detail_info_swiper();
    single_slide();
    open_nav_sidebar();
    close_click_outside();
    ui_resnav_sidebar_small();
    open_share();
    ui_res_detail_item(); // open_map_info();

    zoom_el();
    detail_view_mode_swiper();
    gallery_swiper_res();
    back_to_previous();
    ui_marquee_ui();
    floor_plan_change_tab();
    rates_swiper();
    report_favbox_swiper_change();
    report_schedule_daystream();
    report_ratings();
    report_del_fav_line();
    nl_project_detail_scroll();
    detach_landscape();
    overflow_floor_plan();
    droplist_selectbox_handle(); // project_detail_scroll_full_screen();
    // smooth_scroll_page();
  });
})(jQuery);
"use strict";

/* global jQuery */
(function ($) {
  function ui_google_map() {
    var $mapdiv = $("#google-map-div"),
        map,
        json = $mapdiv.data("json"),
        dataKeep = {},
        listMaker = [],
        latlng,
        infowindow,
        href;
    var directionsDisplay, directionsService, $positionA, $positionB, autocompleteA, autocompleteB;

    if ($mapdiv.length < 1) {
      return;
    }

    dataKeep["#scho"] = false;
    dataKeep["#trans"] = false; // console.log(json);

    var createMarker = function createMarker(data, iconurl) {
      var markerlocation = new google.maps.Marker({
        map: map,
        position: data.geometry.location,
        icon: iconurl
      });
      google.maps.event.addListener(markerlocation, "click", function () {
        infowindow.setContent("<div class=\"info-window-pdetail\">\n                            <h5 class=\"bm-3\">".concat(data.name, "</h5>\n                            <div>").concat(data.vicinity, "</div>\n                            <div>Distance: ").concat(data.distance, "m</div>\n                        </div>"));
        infowindow.open(map, markerlocation);
      });
      return markerlocation;
    };

    function clearMarker() {
      for (var i = 0; i < listMaker.length; i++) {
        listMaker[i].setMap(null);
      }

      listMaker = [];
    }

    var searchNearby = function searchNearby(href) {
      var request = {
        rankby: "distance",
        location: latlng,
        radius: 2000,
        type: href == "#scho" ? ["school"] : ["subway_station"]
      };
      var service = new google.maps.places.PlacesService(map);
      var icon_url = json[href == "#scho" ? "schools" : "stations"].icon_url;
      var $contain = $("".concat(href, "-contain"));

      if (dataKeep[href]) {
        for (var i = 0; i < dataKeep[href].length; i++) {
          listMaker.push(createMarker(dataKeep[href][i], icon_url));
        }

        return;
      }

      $contain.html("<h4 class='pt-3 pb-2 text-center'>LOADING...</h4>");
      service.nearbySearch(request, function (results, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
          $contain.html(""); // CALC distance

          for (var i = 0; i < results.length; i++) {
            var place = results[i];
            var distance = google.maps.geometry.spherical.computeDistanceBetween(place.geometry.location, latlng);
            place.distance = Math.round(distance);
          } // sort distance


          results.sort(function (a, b) {
            return a.distance - b.distance;
          }); // append html

          for (var i = 0; i < results.length; i++) {
            var place = results[i];
            listMaker.push(createMarker(place, icon_url));
            var html = "<div class=\"group-direction\">\n                                        <div class=\"info\">\n                                            <a class=\"btn-nlp small red\" href=\"#\">".concat(i + 1, "</a>\n                                            <p>").concat(place.name, "</p>\n                                        </div>\n                                        <div class=\"tip\">").concat(place.distance, " m</div>\n                                    </div>");
            $contain.append(html);
          }

          map.setZoom(15);
          dataKeep[href] = results;
          $contain.find(".group-direction").on("click", function (e) {
            e.preventDefault();
            google.maps.event.trigger(listMaker[$(this).index()], "click");
          });
        } else if (status == "ZERO_RESULTS") {
          $("".concat(href, "-contain")).html("<h4 class='pt-3 pb-2 text-center text-info'>NOT FOUND!</h4>");
        } else {
          $("".concat(href, "-contain")).html("<h4 class='pt-3 pb-2 text-center text-danger'>SOMETHING WENT WRONG!</h4>");
        }
      });
    };

    var directionRender = function directionRender() {
      var placeA = autocompleteA.getPlace();
      var placeB = autocompleteB.getPlace();

      if (!placeA || !placeB || !placeA.geometry || !placeB.geometry) {
        return;
      }

      var start = $positionA[0].value,
          end = $positionB[0].value,
          $contain = $("".concat(href, "-contain"));
      $contain.html("<h4 class='pt-3 pb-2 text-center'>LOADING...</h4>");
      directionsService.route({
        origin: start,
        destination: end,
        travelMode: "DRIVING"
      }, function (response, status) {
        if (status === "OK") {
          directionsDisplay.setDirections(response); // console.log(response, status);

          $contain.html("");
          response.routes.map(function (dt, i) {
            var leg = dt.legs[0];
            var html = "<div class=\"group-direction\">\n                                        <div class=\"info\">\n                                            <a class=\"btn-nlp small red\" href=\"#\">".concat(i + 1, "</a>\n                                            <p><b>").concat(leg.end_address, "</b><br/>").concat(leg.duration.text, "</p>\n                                        </div>\n                                        <div class=\"tip\">").concat(leg.distance.text, "</div>\n                                    </div>");
            $contain.append(html);
          });
        } else {
          // console.log('Directions request failed due to ' + status);
          if (status == "ZERO_RESULTS") {
            $contain.html("<h4 class='pt-3 pb-2 text-center text-danger'>NOT FOUND!</h4>");
          } else {
            $contain.html("<h4 class='pt-3 pb-2 text-center text-danger'>SOMETHING WENT WRONG!</h4>");
          }
        }
      });
    };

    var simulatorInput = function simulatorInput(input) {
      // store the original event binding function
      var _addEventListener = input.addEventListener ? input.addEventListener : input.attachEvent;

      function addEventListenerWrapper(type, listener) {
        if (type == "keydown") {
          var orig_listener = listener;

          listener = function listener(event) {
            if (event.which == 13) {
              var simulated_downarrow = $.Event("keydown", {
                keyCode: 40,
                which: 40
              });
              orig_listener.apply(input, [simulated_downarrow]);
            }

            orig_listener.apply(input, [event]);
          };
        }

        _addEventListener.apply(input, [type, listener]);
      }

      input.addEventListener = addEventListenerWrapper;
      input.attachEvent = addEventListenerWrapper;
      var autocomplete = new google.maps.places.Autocomplete(input, {
        componentRestrictions: {
          country: "sg"
        }
      });
      autocomplete.addListener("place_changed", directionRender);
      return autocomplete;
    };

    var areaRender = function areaRender() {
      if (!json || !json.area) {
        return;
      } // console.log(json.area);


      var poly = new google.maps.Polygon({
        paths: json.area,
        strokeColor: "#8E8179",
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: "#D0C7C1",
        fillOpacity: 0.6
      });
      poly.setMap(map);
    };

    var initMap = function initMap() {
      // Init Map
      var zZoom = $(window).width() < 768 ? 10 : 12;
      latlng = new google.maps.LatLng(json.location);
      var myOptions = {
        zoom: zZoom,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        draggable: true,
        zoomControl: true,
        scrollwheel: false,
        disableDoubleClickZoom: false
      };
      map = new google.maps.Map($mapdiv[0], myOptions);
      infowindow = new google.maps.InfoWindow();
      areaRender(); // Event Click Tab

      $(".map-info a[data-toggle='tab']").on("click", function () {
        href = $(this).attr("href");
        clearMarker();

        if (href === "#trans" || href === "#scho") {
          searchNearby(href);
        }
      });
      searchNearby("#trans"); // Autocomplete & Direction

      directionsService = new google.maps.DirectionsService();
      directionsDisplay = new google.maps.DirectionsRenderer();
      directionsDisplay.setMap(map);
      $positionA = $("#positionA");
      $positionB = $("#positionB");
      autocompleteA = simulatorInput($positionA[0]);
      autocompleteB = simulatorInput($positionB[0]);
      $(".filter-form form").on("submit", function (e) {
        e.preventDefault();
      });
      $(".filter-form form button[type=submit]").on("click", function (e) {
        e.preventDefault();
        directionRender();
      });
    }; // run file googlemap


    $("#google-map").attr("src", $("#google-map").attr("data-src"));
    $("#google-map").on("load", initMap);
  }
  /**
   *  Help run fullpage.
   *
   *  And responsive with small devices
   */


  function ui_pdetail_fullpage() {
    var $fullpage = $("#fullpagev2");

    if ($fullpage.length < 1) {
      return;
    }

    window.oldHeight = window.innerHeight;
    window.oldWidth = window.innerWidth; // alert(window.oldWidth + " - " + window.oldHeight);

    $(window).on("resize", function () {
      if (Math.abs(window.innerHeight - window.oldHeight) > 120 || window.oldWidth > 992) {
        window.location.reload();
      }

      if (Math.abs(window.innerWidth - window.oldWidth) > 0) {
        window.location.reload();
      }
    });
    $fullpage.fullpage({
      sectionSelector: ".section-full, .footer-page",
      verticalCentered: false,
      fitToSection: false,
      css3: true,
      responsiveHeight: 689,
      responsiveWidth: 800,
      scrollingSpeed: 800,
      recordHistory: false,
      animateAnchor: false,
      lockAnchors: false,
      menu: "#menuFullpage",
      afterLoad: function afterLoad() {
        // - console.log('afterLoad', anchorLink, index);
        $(".section-full.active .lazy, .footer-page.active .lazy").Lazy({
          effect: "fadeIn",
          effectTime: 500
        }); // history.pushState(null, null, "project-detail.html");
      },
      // onLeave: function(index, newIndex, direction) {
      //     // - console.log('onLeave',index, newIndex, direction);
      // },
      afterRender: function afterRender() {
        // console.log("afterRender", window.isResponsive);
        setTimeout(function () {
          if (window.isResponsive) {
            $(".fp-section").removeAttr("style").addClass("no-full");
          }
        }, 700);
      },
      afterResponsive: function afterResponsive(isResponsive) {
        window.isResponsive = isResponsive; // console.log("Is responsive: " + isResponsive, $fullpage, $fullpage.data());

        if (isResponsive) {
          $(".fp-section").removeAttr("style").addClass("no-full");
        } else {
          $(".fp-section").removeClass("no-full");
        }
      } // afterResize: function() {
      //     window.location.reload();
      // }

    });
    var scrollContent_container = "",
        scrollContent_layout1 = false,
        scrollContent_layout2 = false;

    if ($(window).width() > 1200) {
      $(".pdetail-s-floorplan .sidebar-filter").on("mouseenter", function () {
        $.fn.fullpage.setAllowScrolling(false);
        scrollContent_container = ".sidebar-filter .simplebar-content-wrapper";
        scrollContent_layout1 = true;
      }).on("mouseleave", function () {
        $.fn.fullpage.setAllowScrolling(true);
        scrollContent_layout1 = false;
      });
    }

    $(".map-info").on("mouseenter", function () {
      $.fn.fullpage.setAllowScrolling(false);
      scrollContent_container = ".map-info .tab-pane.active .simplebar-content-wrapper";
      scrollContent_layout2 = true;
    }).on("mouseleave", function () {
      $.fn.fullpage.setAllowScrolling(true);
      scrollContent_layout2 = false;
    }); // Help scroll for Fullpage.js

    var scrollContent_timeout = false;
    $(document).on("mousewheel", function (e) {
      if (!scrollContent_container || !scrollContent_layout1 && !scrollContent_layout2) {
        return;
      }

      clearTimeout(scrollContent_timeout);
      scrollContent_timeout = setTimeout(function () {
        var $scrollContent = $(scrollContent_container);
        $scrollContent.stop().animate({
          scrollTop: $scrollContent.scrollTop() - e.deltaY * 4
        });
      }, 10);
    });
  }
  /**
   * PRODUCT DETAIL: Slider carousel
   */


  function ui_pdetail_slider() {
    $(".pdetail-s-gallery .owl-carousel").owlCarousel({
      items: 1,
      smartSpeed: 500,
      dots: false,
      nav: false,
      margin: 20,
      navText: []
    });
    $(".grid-gallery").masonry({
      columnWidth: ".grid-sizer",
      percentPosition: true,
      horizontalOrder: false,
      gutter: 20
    });
    $(".pdetail-s-pricing .owl-carousel").owlCarousel({
      items: 3,
      smartSpeed: 800,
      dots: false,
      nav: false,
      navText: [],
      responsive: {
        0: {
          items: 1
        },
        480: {
          items: 2
        },
        992: {
          items: 3
        },
        1440: {
          items: 4
        },
        2200: {
          items: 5
        }
      }
    });

    if ($(window).width() < 768) {
      new Swiper(".pdetail-s-feature .swiper-container", {
        slidesPerView: "auto",
        spaceBetween: 1
      });
    }

    $(".form-product-v2-js .form-validate").validate();
  }

  function ui_pdetail_scrolltop() {
    if ($(".pdetail-control").length < 1) {
      return;
    }

    $(window).on("scroll", function () {
      if ($(window).scrollTop() > 200) {
        $(".pdetail-control").addClass("expand");
      } else {
        $(".pdetail-control").removeClass("expand");
      }
    });
    $("#gotoTop").on("click", function (e) {
      e.preventDefault();
      $("body,html").animate({
        scrollTop: 0
      }, 500);
    });
    $(".pdetail-s-location .open-map-info").on("click", function (e) {
      e.preventDefault();
      $(e.currentTarget).toggleClass("closed");
      $(".pdetail-s-location .map-info").toggleClass("d-none");
    });
    $(".pdetail-navside-toogle, .mobile-close-nav").click(function (e) {
      e.preventDefault();
      $(".pdetail-sidebar").toggleClass("expand");
    });
    $(".navsidebar a").on("click", function () {
      $(".pdetail-sidebar").removeClass("expand");
    });
    $(".scroll-ui").each(function (i, el) {
      new SimpleBar(el, {
        forceVisible: true,
        autoHide: false
      });
    });
  }
  /**
   * Panning and zooming Elements.
   *
   * Floor plan section
   */


  function ui_pdetail_floor() {
    $(".pdetail-s-floorplan a.img-bg").each(function () {
      $(this).zoom({
        url: $(this).find("img").attr("src"),
        magnify: 1.8
      });
    });
    $(".pdetail-s-floorplan #select-floor-plan").change(function (e) {
      e.preventDefault();
      $(".pdetail-s-floorplan .tab-pane.active").removeClass("active show");

      if ($("#" + "tab" + $(this).val()).length > 0) {
        $("#" + "tab" + $(this).val()).tab("show");
      }
    });
    $(".pdetail-s-floorplan .sidebar-filter a").on("click", function (e) {
      e.preventDefault();
      var $this = $(e.currentTarget);

      if ($this.next().hasClass("collapse")) {
        return;
      }

      $(".pdetail-s-floorplan .tab-pane.active").removeClass("active show");

      if ($($(e.currentTarget).attr("href")).length > 0) {
        $($(e.currentTarget).attr("href")).tab("show");
      }
    });
    $("#select-floor-plan").select2({
      width: "75%",
      minimumResultsForSearch: -1
    });
  } //DAY STREAM


  function ui_daystream_inactive() {
    var _daystream = function _daystream(selector) {
      var isSlick = false;
      $(selector).on("shown.bs.modal", function () {
        if (isSlick) {
          return;
        }

        $("".concat(selector, " .dayline-carousel .slick-carousel")).slick({
          infinite: true,
          slidesToShow: 3,
          slidesToScroll: 3,
          autoplay: false,
          arrows: true
        });
        isSlick = true; // load slick on  inactive tab
      });
      $("".concat(selector, " a[data-toggle=\"tab\"]")).on("shown.bs.tab", function () {
        $("".concat(selector, " .dayline-carousel .slick-carousel")).slick("setPosition", 0);
        $("".concat(selector, " .dayline-carousel .slick-carousel")).slick("slickGoTo", 0);
      });
    };

    _daystream("#modalProject-detail");

    _daystream("#modalProject-detail-contact");
  }
  /**
   * Fancybox
   */


  function ui_pdetail_image_gallery() {
    if ($(".pdetail-control").length < 1) {
      return;
    }

    var _fancyBox = function _fancyBox(key) {
      $("[data-fancybox=\"".concat(key, "\"]")).fancybox({
        afterLoad: function afterLoad(instance, current) {
          var pixelRatio = window.devicePixelRatio || 1;

          if (pixelRatio > 1.5) {
            current.width = current.width / pixelRatio;
            current.height = current.height / pixelRatio;
          }
        },
        thumbs: {
          autoStart: true,
          hideOnClose: false,
          axis: "y"
        }
      });
    };

    _fancyBox("images1");

    _fancyBox("images2");
  }

  function nl_body_handle_scroll() {
    $.bodyScrollTop = 0;

    $.bodyDisableScroll = function () {
      var $w = $(window);

      if ($w.width() > 768) {
        return;
      }

      $.bodyScrollTop = $w.scrollTop();
      $("#page").css({
        height: $w.height(),
        overflow: "hidden"
      });
    };

    $.bodyReturnScroll = function () {
      var $w = $(window);

      if ($w.width() > 768) {
        return;
      }

      $("#page").css({
        height: "",
        overflow: ""
      });
      $w.scrollTop($.bodyScrollTop);
    };

    $(".modal").on("shown.bs.modal", $.bodyDisableScroll);
    $(".modal").on("hide.bs.modal", $.bodyReturnScroll);
  }

  function select_ui() {
    // Select UI
    $.fn.select2.defaults.set("width", "100%");
    $(".select-ui").each(function () {
      var $el = $(this);
      $el.select2({
        placeholder: $el.data("placeholder") ? $el.data("placeholder") : "",
        // minimumResultsForSearch: options_len <= 6 ? -1 : 1,
        minimumResultsForSearch: -1
      });
    });
  } //TIME PICKER


  function timepicker() {
    $(".timepicker").datetimepicker({
      format: "LT",
      ignoreReadonly: true,
      stepping: 10
    });
  }

  $(function () {
    nl_body_handle_scroll();
    ui_daystream_inactive(); // back_to_previous();

    ui_google_map();
    ui_pdetail_fullpage();
    ui_pdetail_slider();
    ui_pdetail_scrolltop();
    ui_pdetail_floor();
    ui_pdetail_image_gallery();
    select_ui();
    timepicker();
  });
})(jQuery);