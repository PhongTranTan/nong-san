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
  var guide_slides = new Swiper($(".guides-section .swiper-container"), {
    slidesPerView: "auto",
    effect: "slide",
    // spaceBetween: 20,
    freeMode: true,
    navigation: {
      nextEl: ".guides-section .swiper-button-next",
      prevEl: ".guides-section .swiper-button-prev"
    },
    scrollbar: {
      el: ".guides-section .swiper-scrollbar" // draggable: true,

    },
    breakpoints: {
      640: {
        spaceBetween: 10
      },
      768: {
        spaceBetween: 10
      },
      1024: {
        spaceBetween: 10
      }
    }
  }),
      //swiper Star buy section
  starbuy_slides = new Swiper($(".star-buy-section .swiper-container"), {
    slidesPerView: "auto",
    effect: "slide",
    // spaceBetween: 20,
    freeMode: true,
    navigation: {
      nextEl: ".star-buy-section .swiper-button-next",
      prevEl: ".star-buy-section .swiper-button-prev"
    },
    scrollbar: {
      el: ".star-buy-section .swiper-scrollbar",
      draggable: true
    },
    breakpoints: {
      640: {
        spaceBetween: 10
      },
      768: {
        spaceBetween: 10
      },
      1024: {
        spaceBetween: 10
      }
    }
  }),
      //swiper Testimonials section
  testimonials_slides = new Swiper($(".testimonials-section .swiper-container"), {
    slidesPerView: "auto",
    effect: "slide",
    freeMode: true,
    navigation: {
      nextEl: ".testimonials-section .swiper-button-next",
      prevEl: ".testimonials-section .swiper-button-prev"
    },
    scrollbar: {
      el: ".testimonials-section .swiper-scrollbar"
    },
    breakpoints: {
      640: {
        spaceBetween: 10
      },
      768: {
        spaceBetween: 10
      },
      1024: {
        spaceBetween: 10
      }
    }
  }),
      //swiper Pricing table section (Project detail page)
  pricing_slides = new Swiper($(".section-pricing .swiper-container"), {
    slidesPerView: 3,
    spaceBetween: 0,
    freeMode: true,
    effect: "slide",
    navigation: {
      nextEl: ".section-pricing .swiper-button-next",
      prevEl: ".section-pricing .swiper-button-prev"
    },
    breakpoints: {
      1090: {
        slidesPerView: "auto"
      },
      2000: {
        slidesPerView: 3
      },
      4000: {
        slidesPerView: 5
      }
    },
    scrollbar: {
      el: ".section-pricing .swiper-scrollbar",
      draggable: true
    }
  });
} //Change state from Scroll ui to Swiper slide: Modal fav box


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
        $(".modal .content-fav .swiper-container .simple-bar-showflat").addClass("swiper-wrapper");
         $(".modal .content-fav .swiper-container .simple-bar-report").addClass("swiper-wrapper");
        $favbox = new Swiper($(".modal .content-fav .swiper-container"), {
          slidesPerView: "auto",
          spaceBetween: 0,
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
          },
          breakpoints: {
            640: {
              spaceBetween: 10
            },
            768: {
              spaceBetween: 10
            },
            992: {
              spaceBetween: 10
            }
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
      $(this).removeClass("added"); // animation

      $(".li-heart").removeClass("run-shake").stop().addClass("run-shake");
      setTimeout(function () {
        $(".li-heart").removeClass("run-shake");
      }, 700); // minus

      var total = parseInt($(".li-heart").attr("data-total")) - 1;
      $(".li-heart").attr("data-total", total);
      $(".li-heart .count-like").text(total > 5 ? "5+" : total);
    } else {
      $(this).addClass("added"); // animation

      $(".li-heart").removeClass("run-popout").stop().addClass("run-popout");
      setTimeout(function () {
        $(".li-heart").removeClass("run-popout");
      }, 700); // plus+

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
    ui_add_favorite_items();
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

/**
 * JS Chỉ dành riêng cho trang Homepage
 */
(function ($) {
  function home_slider_testimonial() {
    var func_small = function func_small() {
      if ($(window).width() < 768) {
        if ($(".testimonial-carousel").hasClass("slick-slider")) {
          $(".testimonial-carousel").slick("unslick");
        }
      } else {
        if ($(".testimonial-carousel").hasClass("slick-slider")) {
          return;
        }

        $(".testimonial-carousel").slick({
          infinite: true,
          slidesToShow: 4,
          slidesToScroll: 2,
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

    func_small();
    $(window).on("resize", function () {
      func_small();
    });
  } // like project


  function ui_like_items() {
    $(".heart-like").click(function () {
      $(this).toggleClass("liked");
    });
  } //auto match height


  function auto_match_height2() {
    $(".gallery-item").matchHeight();
    $(".tab-content .tab-pane").matchHeight();
  } // Explore Section: masonry


  function home_explore_section() {
    var $grid = $(".grid-cat"),
        _dotrecuacuocdoi = null;

    var _resize = function _resize() {
      if ($(window).outerWidth() >= 992) {
        if ($grid.isInitSwiper) {
          $grid.destroy();
          $grid.isInitSwiper = false;
        }

        if (!$grid.isInitMasonry) {
          $grid = $(".grid-cat").masonry({
            columnWidth: ".grid-sizer",
            percentPosition: true,
            horizontalOrder: false,
            gutter: 20
          });
          $grid.isInitMasonry = true;
        }
      } else {
        if ($grid.isInitMasonry) {
          $grid.masonry("destroy"); // turn off masonry

          $grid.isInitMasonry = false;
        }

        if (!$grid.isInitSwiper) {
          $grid = new Swiper($(".explore-section .swiper-container"), {
            slidesPerView: "auto",
            spaceBetween: 0,
            effect: "slide",
            freeMode: true,
            scrollbar: {
              el: ".explore-section .swiper-scrollbar",
              draggable: true
            },
            breakpoints: {
              640: {
                spaceBetween: 10
              },
              768: {
                spaceBetween: 10
              },
              992: {
                spaceBetween: 10
              }
            }
          });
          $grid.isInitSwiper = true;
        }
      }
    };

    $grid = $grid.imagesLoaded(function () {
      $(window).on("resize.explore_section", function () {
        if (_dotrecuacuocdoi) {
          clearTimeout(_dotrecuacuocdoi);
        }

        _dotrecuacuocdoi = setTimeout(_resize, 10);
      });

      _resize();
    });
  } //select multiple


  function select_multiple() {
    $(".select-ui-multi").each(function () {
      var $this = $(this);
      $this.multipleSelect({
        // width: "270px",
        animate: "fade",
        minimumCountSelected: "10",
        displayDelimiter: ",",
        onOpen: function onOpen() {
          setTimeout(function () {
            var $ul = $this.next().find("ul"); // $ul.wrap("<div class='scroll-ui'></div>");

            new SimpleBar($ul[0], {
              forceVisible: true,
              autoHide: false,
              scrollbarMinSize: 5
            });
          }, 50);
        }
      });
    });
  } //TEXT MENU DROPDOWN


  function text_menu() {
    var isMouseEnterTypeItem = false;
    $(".type-item").on("click", function (e) {
      e.preventDefault();

      if (!$(this).next().is(":visible")) {
        $(".type-sub").slideUp(500);
      }

      $(this).next().slideToggle();
    });
    $(".type-item, .type-sub").on("mouseenter", function () {
      isMouseEnterTypeItem = true;
    }).on("mouseleave", function () {
      isMouseEnterTypeItem = false;
    });
    $(window).on("click touchstart", function () {
      if (!isMouseEnterTypeItem) {
        $(".type-sub").slideUp(500);
      }
    });
  }

  $(function () {
    home_slider_testimonial();
    home_explore_section();
    ui_like_items();
    auto_match_height2();
    text_menu();
    select_multiple();
  });
})(jQuery);