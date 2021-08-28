"use strict";

/* global jQuery */
(function ($) {
  function ui_google_map() {
    var $mapdiv = $('#google-map-div'),
        json = $mapdiv.data('json'),
        dataKeep = {};
    var map,
        listMaker = [],
        latlng,
        infowindow,
        href;
    var directionsDisplay, directionsService, $positionA, $positionB, autocompleteA, autocompleteB;
    if ($mapdiv.length < 1) return;
    dataKeep['#scho'] = false;
    dataKeep['#trans'] = false; // console.log(json);

    var createMarker = function createMarker(data, iconurl) {
      var markerlocation = new google.maps.Marker({
        map: map,
        position: data.geometry.location,
        icon: iconurl
      });
      google.maps.event.addListener(markerlocation, 'click', function () {
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
        rankby: 'distance',
        location: latlng,
        radius: 2000,
        type: href == '#scho' ? ['school'] : ['subway_station']
      };
      var service = new google.maps.places.PlacesService(map);
      var icon_url = json[href == '#scho' ? 'schools' : 'stations'].icon_url;
      var $contain = $("".concat(href, "-contain"));

      if (dataKeep[href]) {
        for (var i = 0; i < dataKeep[href].length; i++) {
          listMaker.push(createMarker(dataKeep[href][i], icon_url));
        }

        return;
      }

      $contain.html('<h4 class="pt-3 pb-2 text-center">LOADING...</h4>');
      service.nearbySearch(request, function (results, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
          $contain.html(''); // CALC distance

          for (var _i = 0; _i < results.length; _i++) {
            var place = results[_i];
            var distance = google.maps.geometry.spherical.computeDistanceBetween(place.geometry.location, latlng);
            place.distance = Math.round(distance);
          } // sort distance


          results.sort(function (a, b) {
            return a.distance - b.distance;
          }); // append html

          for (var _i2 = 0; _i2 < results.length; _i2++) {
            var _place = results[_i2];
            listMaker.push(createMarker(_place, icon_url));
            var html = "<div class=\"group-direction\">\n                                        <div class=\"info\">\n                                            <a class=\"btn-nlp small red\" href=\"#\">".concat(_i2 + 1, "</a>\n                                            <p>").concat(_place.name, "</p>\n                                        </div>\n                                        <div class=\"tip\">").concat(_place.distance, " m</div>\n                                    </div>");
            $contain.append(html);
          }

          map.setZoom(15);
          dataKeep[href] = results;
          $contain.find('.group-direction').on('click', function (e) {
            e.preventDefault();
            google.maps.event.trigger(listMaker[$(this).index()], 'click');
          });
        } else if (status == 'ZERO_RESULTS') $("".concat(href, "-contain")).html('<h4 class="pt-3 pb-2 text-center text-info">NOT FOUND!</h4>');else $("".concat(href, "-contain")).html('<h4 class="pt-3 pb-2 text-center text-danger">SOMETHING WENT WRONG!</h4>');
      });
    };

    var directionRender = function directionRender() {
      var placeA = $positionA.data('json') ? {
        geometry: $positionA.data('json').location
      } : autocompleteA.getPlace();
      var placeB = autocompleteB.getPlace();
      if (!placeA || !placeB || !placeA.geometry || !placeB.geometry) return;
      var start = $positionA[0].value,
          end = $positionB[0].value,
          $contain = $("".concat(href, "-contain"));
      $contain.html('<h4 class="pt-3 pb-2 text-center">LOADING...</h4>');
      directionsService.route({
        origin: start,
        destination: end,
        travelMode: 'DRIVING'
      }, function (response, status) {
        if (status === 'OK') {
          directionsDisplay.setDirections(response); // console.log(response, status);

          $contain.html('');
          response.routes.map(function (dt, i) {
            var leg = dt.legs[0];
            var html = "<div class=\"group-direction\">\n                                        <div class=\"info\">\n                                            <a class=\"btn-nlp small red\" href=\"#\">".concat(i + 1, "</a>\n                                            <p><b>").concat(leg.end_address, "</b><br/>").concat(leg.duration.text, "</p>\n                                        </div>\n                                        <div class=\"tip\">").concat(leg.distance.text, "</div>\n                                    </div>");
            $contain.append(html);
          });
        } // console.log('Directions request failed due to ' + status);
        else if (status == 'ZERO_RESULTS') $contain.html('<h4 class="pt-3 pb-2 text-center text-danger">NOT FOUND!</h4>');else $contain.html('<h4 class="pt-3 pb-2 text-center text-danger">SOMETHING WENT WRONG!</h4>');
      });
    };

    var simulatorInput = function simulatorInput(input) {
      // store the original event binding function
      var _addEventListener = input.addEventListener ? input.addEventListener : input.attachEvent;

      function addEventListenerWrapper(type, listener) {
        if (type == 'keydown') {
          var orig_listener = listener;

          listener = function listener(event) {
            if (event.which == 13) {
              var simulated_downarrow = $.Event('keydown', {
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
          country: 'sg'
        }
      });
      autocomplete.addListener('place_changed', directionRender);
      return autocomplete;
    };

    var areaRender = function areaRender() {
      if (!json || !json.area) return; // console.log(json.area);

      var poly = new google.maps.Polygon({
        paths: json.area,
        strokeColor: '#8E8179',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#D0C7C1',
        fillOpacity: 0.6
      });
      poly.setMap(map);
    };

    var google_map = {
      toggleMarker: function toggleMarker() {
        if (!map.isShowToggleMarker) {
          for (var i = 0; i < listMaker.length; i++) {
            listMaker[i].setMap(null);
          }

          map.isShowToggleMarker = true;
        } else {
          for (var _i3 = 0; _i3 < listMaker.length; _i3++) {
            listMaker[_i3].setMap(map);
          }

          map.isShowToggleMarker = false;
        }
      }
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

      $('.map-info a[data-toggle="tab"]').on('click', function () {
        href = $(this).attr('href');
        clearMarker();
        if (href === '#trans' || href === '#scho') searchNearby(href);
      });
      searchNearby('#trans'); // Autocomplete & Direction

      directionsService = new google.maps.DirectionsService();
      directionsDisplay = new google.maps.DirectionsRenderer();
      directionsDisplay.setMap(map);
      $positionA = $('#positionA');
      $positionB = $('#positionB');
      autocompleteA = simulatorInput($positionA[0]);
      autocompleteB = simulatorInput($positionB[0]);
      window.google_map = google_map;
      $('.filter-form form').on('submit', function (e) {
        e.preventDefault();
      });
      $('.filter-form form button[type=submit]').on('click', function (e) {
        e.preventDefault();
        directionRender();
      });
    }; // run file googlemap


    $('#google-map').attr('src', $('#google-map').attr('data-src'));
    $('#google-map').on('load', initMap);
  }
  /**
   *  Help run fullpage.
   *
   *  And responsive with small devices
   */


  function ui_pdetail_fullpage() {
    var $fullpage = $('#fullpagev2');
    if ($fullpage.length < 1) return;
    window.oldHeight = window.innerHeight;
    window.oldWidth = window.innerWidth; // alert(window.oldWidth + " - " + window.oldHeight);

    var _resize = function _resize() {
      if ($(window).outerWidth() < 768) return;
      if (Math.abs(window.innerHeight - window.oldHeight) > 120 || window.oldWidth > 992) window.location.reload();
      if (Math.abs(window.innerWidth - window.oldWidth) > 0) window.location.reload();
    };

    $(window).on('resize', _resize);
    $fullpage.fullpage({
      sectionSelector: '.section-full, .footer-page',
      verticalCentered: false,
      fitToSection: false,
      css3: true,
      responsiveHeight: 689,
      responsiveWidth: 800,
      scrollingSpeed: 800,
      recordHistory: false,
      animateAnchor: false,
      lockAnchors: false,
      keyboardScrolling: false,
      menu: '#menuFullpage',
      afterLoad: function afterLoad() {
        // - console.log('afterLoad', anchorLink, index);
        $('.section-full.active .lazy, .footer-page.active .lazy').Lazy({
          effect: 'fadeIn',
          effectTime: 500
        }); // history.pushState(null, null, "project-detail.html");
      },
      // onLeave: function(index, newIndex, direction) {
      //     // - console.log('onLeave',index, newIndex, direction);
      // },
      afterRender: function afterRender() {
        // console.log("afterRender", window.isResponsive);
        setTimeout(function () {
          if (window.isResponsive) $('.fp-section').removeAttr('style').addClass('no-full');
        }, 700);
      },
      afterResponsive: function afterResponsive(isResponsive) {
        window.isResponsive = isResponsive; // console.log("Is responsive: " + isResponsive, $fullpage, $fullpage.data());

        if (isResponsive) $('.fp-section').removeAttr('style').addClass('no-full');else $('.fp-section').removeClass('no-full');
      } // afterResize: function() {
      //     window.location.reload();
      // }

    });
    var scrollContent_container = '',
        scrollContent_layout1 = false,
        scrollContent_layout2 = false;
    if ($(window).width() > 1200) $('.pdetail-s-floorplan .sidebar-filter').on('mouseenter', function () {
      $.fn.fullpage.setAllowScrolling(false);
      scrollContent_container = '.sidebar-filter .simplebar-content-wrapper';
      scrollContent_layout1 = true;
    }).on('mouseleave', function () {
      $.fn.fullpage.setAllowScrolling(true);
      scrollContent_layout1 = false;
    });
    $('.map-info').on('mouseenter', function () {
      $.fn.fullpage.setAllowScrolling(false);
      scrollContent_container = '.map-info .tab-pane.active .simplebar-content-wrapper';
      scrollContent_layout2 = true;
    }).on('mouseleave', function () {
      $.fn.fullpage.setAllowScrolling(true);
      scrollContent_layout2 = false;
    }); // Help scroll for Fullpage.js

    var scrollContent_timeout = false;
    $(document).on('mousewheel', function (e) {
      if (!scrollContent_container || !scrollContent_layout1 && !scrollContent_layout2) return;
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
    $('.pdetail-s-gallery .owl-carousel').owlCarousel({
      items: 1,
      smartSpeed: 500,
      dots: false,
      nav: true,
      margin: 20,
      navText: [],
      freeDrag: false
    });
    $('.grid-gallery').masonry({
      columnWidth: '.grid-sizer',
      percentPosition: true,
      horizontalOrder: false,
      gutter: 20
    });
    var $totalItemInner = $('.pdetail-s-pricing .owl-carousel .inner-item');
    var resItemInner = {
      0: {
        items: 2
      },
      480: {
        items: 2
      },
      992: {
        items: 2
      },
      1440: {
        items: 3
      },
      2200: {
        items: 4
      }
    };
    $totalItemInner.wrap('<div class="gallery-item"></div>');
    $('.pdetail-s-pricing .owl-carousel').owlCarousel({
      items: 3,
      smartSpeed: 800,
      dots: false,
      nav: false,
      navText: [],
      loop: false,
      // mouseDrag: dragGo,
      responsive: resItemInner
    });
    if ($(window).width() < 768) new Swiper('.pdetail-s-feature .swiper-container', {
      slidesPerView: 'auto',
      spaceBetween: 1
    });
    $('.form-product-v2-js .form-validate').validate();
  }

  function ui_pdetail_scrolltop() {
    if ($('.pdetail-control').length < 1) return;
    $(window).on('scroll', function () {
      if ($(window).scrollTop() > 200) $('.pdetail-control').addClass('expand');else $('.pdetail-control').removeClass('expand');
    });
    $('#gotoTop').on('click', function (e) {
      e.preventDefault();
      $('body,html').animate({
        scrollTop: 0
      }, 500);
    });
    $('.pdetail-s-location .open-map-info').on('click', function (e) {
      e.preventDefault();
      $(e.currentTarget).toggleClass('closed');
      $('.pdetail-s-location .map-info').toggleClass('d-none');
      if (window.google_map) window.google_map.toggleMarker();
    });
    $('.pdetail-navside-toogle, .mobile-close-nav').click(function (e) {
      e.preventDefault();
      $('.pdetail-sidebar').toggleClass('expand');
    });
    $('.navsidebar a').on('click', function () {
      $('.pdetail-sidebar').removeClass('expand');
    });
    $('.scroll-ui').each(function (i, el) {
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

      const zoom_el = () => {
        if ($(window).outerWidth() >= 768){
          $('.pdetail-s-floorplan .intro-plan a.img-bg').zoom({
                    url: $(this)
                        .find('img')
                        .attr('data-img'),
                    magnify: 1.8
                });
        }
      };
      $(window).on('resize', zoom_el);
      zoom_el();
    $('.pdetail-s-floorplan #select-floor-plan').change(function (e) {
      e.preventDefault();
      $('.pdetail-s-floorplan .tab-pane.active').removeClass('active show');
      if ($('#' + 'tab' + $(this).val()).length > 0) $('#' + 'tab' + $(this).val()).tab('show');
    });
    $('.pdetail-s-floorplan .sidebar-filter a').on('click', function (e) {
      e.preventDefault();
      var $this = $(e.currentTarget);
      if ($this.next().hasClass('collapse')) return;
      $('.pdetail-s-floorplan .tab-pane.active').removeClass('active show');
      if ($($(e.currentTarget).attr('href')).length > 0) $($(e.currentTarget).attr('href')).tab('show');
    });
    $('#select-floor-plan').select2({
      width: '75%',
      minimumResultsForSearch: -1
    });
  } //DAY STREAM


  function ui_daystream_inactive() {
    var _daystream = function _daystream(selector) {
      var isSlick = false;
      $(selector).on('shown.bs.modal', function () {
        if (isSlick) return;
        $("".concat(selector, " .dayline-carousel .slick-carousel")).slick({
          infinite: false,
          slidesToShow: 3,
          slidesToScroll: 3,
          autoplay: false,
          arrows: true
        });
        isSlick = true; // load slick on  inactive tab
      });
      $("".concat(selector, " a[data-toggle=\"tab\"]")).on('shown.bs.tab', function () {
        $("".concat(selector, " .dayline-carousel .slick-carousel")).slick('setPosition', 0);
        $("".concat(selector, " .dayline-carousel .slick-carousel")).slick('slickGoTo', 0);
      });
      if (selector === '#modalProject-detail')
        $(`${selector}`).on('shown.bs.modal', function () {
            $(`${selector} .dayline-carousel .slick-carousel`).slick('setPosition', 0);
            $(`${selector} .dayline-carousel .slick-carousel`).slick('slickGoTo', 0);
        });
    };

    _daystream('#modalProject-detail');

    _daystream('#modalProject-detail-contact');
  }
  /**
   * Fancybox
   */

  // function gallery old
  // function ui_pdetail_image_gallery() {
  //   if ($('.pdetail-control').length < 1) return;
  //   var _fancyBox = function _fancyBox(key) {
  //     $("[data-fancybox=\"".concat(key, "\"]")).fancybox({
  //       afterLoad: function afterLoad(instance, current) {
  //         var pixelRatio = window.devicePixelRatio || 1;

  //         if (pixelRatio > 1.5) {
  //           current.width = current.width / pixelRatio;
  //           current.height = current.height / pixelRatio;
  //         }
  //       },
  //       // beforeShow: _getOtherFancy,
  //       // beforeClose: function beforeClose() {
  //       //   $('.fancybox-other').fadeOut(200);
  //       // },
  //       animationEffect: 'fade',
  //       backFocus: false,
  //       thumbs: {
  //         autoStart: $(window).width() > 768,
  //         hideOnClose: false,
  //         axis: 'y'
  //       }
  //     });
  //   };

  //   $('a[data-fancybox]').each(function (i, e) {
  //     if($(e).data('fancybox-toggle') !== undefined)
  //       return _fancyBox($(e).data('fancybox-toggle'));
  //   });
  // }

  function nl_body_handle_scroll() {
    $.bodyScrollTop = 0;

    $.bodyDisableScroll = function () {
      var $w = $(window);
      if ($w.width() > 768) return;
      $.bodyScrollTop = $w.scrollTop();
      $('#page').css({
        height: $w.height(),
        overflow: 'hidden'
      });
    };

    $.bodyReturnScroll = function () {
      var $w = $(window);
      if ($w.width() > 768) return;
      $('#page').css({
        height: '',
        overflow: ''
      });
      $w.scrollTop($.bodyScrollTop);
    };

    $('.modal').on('shown.bs.modal', $.bodyDisableScroll);
    $('.modal').on('hide.bs.modal', $.bodyReturnScroll);
  }

  function select_ui() {
    // Select UI
    $.fn.select2.defaults.set('width', '100%');
    $('.select-ui').each(function () {
      var $el = $(this);
      $el.select2({
        placeholder: $el.data('placeholder') ? $el.data('placeholder') : '',
        // minimumResultsForSearch: options_len <= 6 ? -1 : 1,
        minimumResultsForSearch: -1
      });
    });
  } //TIME PICKER


  function timepicker() {
    $('.timepicker').datetimepicker({
      format: 'LT',
      ignoreReadonly: true,
      stepping: 10
    });
  } // Pick only one item Date time


  function ui_choose_date() {
    var $radioInput = $('.day-stream label.date-item input[type="radio"]');
    $('.date-item').on('click', function (e) {
      var $it = $(e.currentTarget);
      $('.date-item').removeClass('choose');
      if ($it.find($radioInput).is(':checked')) $it.addClass('choose');

      if ($radioInput.filter(':checked').length > 0) {
        $('.scheduleForm .day-stream').removeClass('error-date');
        $('.scheduleForm .day-stream .msg-error').remove();
      }
    });
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

    $('.form-validate-contact').validate({
      rules: {
        name: {
          required: true
        },
        phone: {
          required: true,
          number: true,
          minlength: 8,
          maxlength: 14
        },
        email: {
          required: true,
          nl_mail: true
        }
      },
      message: {
        name: {
          required: msg
        },
        phone: {
          required: msg
        },
        email: {
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
  }


  function ui_loading_page() {
    setTimeout(function () {
      $("body").addClass("pre-loaded");
    }, 300);
  } // add js

  function ui_hide_mapinfo_respo() {
    var $open = $('.pdetail-s-location .map-site .open-map-info');
    var $info = $('.pdetail-s-location .map-site .map-info');

    var _resize = function _resize() {
      if ($(window).outerWidth() < 992) {
        $open.addClass('closed');
        $info.addClass('d-none');
      } else {
        $open.removeClass('closed');
        $info.removeClass('d-none');
      }
    };

    $(window).on('resize', _resize());

    _resize();
  }

  // function gallary new
  function ui_pdetail_image_gallery() {
    if ($('.pdetail-control').length < 1) return;
    $('[data-fancybox="imageBox"]').fancybox({
        afterLoad: function (instance, current) {
            const pixelRatio = window.devicePixelRatio || 1;
            if (pixelRatio > 1.5) {
                current.width = current.width / pixelRatio;
                current.height = current.height / pixelRatio;
            }
        },
            autoFocus: false,
            backFocus: false,
            hash: false,
            share: {
                url: function (instance, item) {
                    if (item.type === 'inline' && item.contentType === 'video') return item.$content.find('source:first').attr('src');

                    return item.src;
                }
            },
            thumbs: {
                autoStart: true, // Display thumbnails on opening
                axis: 'y'
            },
            mobile: {
              thumbs: {
                autoStart: false,
              },
              buttons: [
                'zoom',
                'close'
              ],
              touch: {
                vertical: false
              }
            }
    });
  }

  $(function () {
    $('.pdetail-s-pricing .wrap-slider .inner-item h5.title').matchHeight();
    // ui_loading_page();
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
    // zoom_el(); // fix js
    ui_choose_date();
    ui_loading_page(); // add js
    form_func();
    ui_hide_mapinfo_respo();
  });
})(jQuery);