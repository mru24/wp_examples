// ON SCROLL EVENTS

    let isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;

    $(window).on('load scroll', function() {
      if (isMobile) {

        // onScrollEvent(element, bottom-start, top-tr-start, class-name, one-time-or-repeat)

      } else {
        // onScrollEvent(element, bottom-start, top-tr-start, class-name, one-time-or-repeat)

        $(".anim").each(function() { // multiple elements of same type eg. class
          onScrollEvent($(this), 100, false, "go", false);
          onScrollEvent($(this), false, 150, "hide", false);
        });

        onScrollEvent(".page-hero-banner", false, 250, "hide", false); // single element on page
      };
    });

    function onScrollEvent(el, bottom, top, cls, one_time) {

      var el = $(el);

      if(el) {
        var el_pos_top_of_window = el.offset().top + el.outerHeight(true) - $(window).scrollTop(); // bottom position of element to top of window
        var el_pos_bottom_of_window = $(window).height() - (el.offset().top - $(window).scrollTop()); // top position of element to bottom of window

        if(bottom) {
          if(el_pos_bottom_of_window > bottom) {
            el.addClass(cls);  
          } else {
            if(!one_time) {
              el.removeClass(cls);
            }
          }
        }
        if(top) {
          if(el_pos_top_of_window < top) {
            el.addClass(cls);
          } else {
            if(!one_time) {
              el.removeClass(cls);
            }
          }
        }
      }
    };

// ON SCROLL EVENTS end
