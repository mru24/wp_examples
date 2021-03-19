// SCROLL TO TOP
      const btt = $("#scrollTop");
      
      btt.click(function(e) {
        e.preventDefault();
        $([document.documentElement, document.body]).animate({
            scrollTop: 0
        }, 500);         
      });
      
      var timeout;
      $(window).on('scroll', function() {
        onScrollEvent(btt, 500, 'active');
        clearTimeout(timeout);
        timeout = setTimeout(function() {
          btt.removeClass('active');
        }, 2000);
      });
      $(window).on('mousemove', function(e) {
        console.log(e.clientX, $(window).width());
        console.log(e.clientY, $(window).height());
        if((e.clientX > $(window).width() - 200) && e.clientY > $(window).height() - 200) {
          btt.addClass('active');
        } else {
          btt.removeClass('active');
        }
      });
// SCROLL TO TOP end

// ON SCROLL EVENTS  
      function onScrollEvent(el, pos, cls) {
        // console.log($(this).scrollTop());
        if($(window).scrollTop() > pos) {
          el.addClass(cls);
        } else {
          el.removeClass(cls);
        }    
      };  
// ON SCROLL EVENTS end
