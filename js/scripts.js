'use strict';

(function($) {

  var o = {
    init : async function(jq) {

      console.log('WW Furniture Factors - OK');

      this.jq = jq;
      this.ajax_url = "ajax.php";

      this.mainBody = this.jq('body');
      this.mainWindow = this.jq(window);
      this.isMobile = window.matchMedia("only screen and (max-width: 900px)").matches;

  		// this.navbar = this.jq('header .navbar');
      // this.shortNav = this.jq('.short-nav', this.navbar);
  		// this.mainNav = this.jq('.main-nav', this.navbar);
  		// this.burger = this.jq('.hamburger', this.navbar);
//
  		this.slider = this.jq('.slider');
//
  		// this.fwbImage = this.jq('.slide-banner .image-container');
//
  		this.triggerBtn = this.jq('.trigger');
  		// this.slideUpBtn = this.jq('.slide-up');
//
      // this.rmContainer = this.jq('section.read-more');
      // this.rmButton = this.jq('a.btn',this.rmContainer);
//
      // this.cardSection = this.jq('.card-section');
//
      // this.form = this.jq('form.wpcf7-form');

  		(this.mainBody.length?this.initBody():false);
  		// (this.navbar.length?this.initNavbar():false);
  		(this.slider?this.initSlickSliders():false);
  		(this.triggerBtn.length?this.triggerAction():false);
      // (this.slideUpBtn.length?this.initSlideUp():false);
      // (this.rmContainer.length?this.initReadMore():false);
      // (this.cardSection.length?this.initCardSection():false);
      // (this.form.length?this.initForm():false);

  	},

		initBody : async function() {
		  setTimeout(() => { this.mainBody.addClass('active')}, 800);
		},

		initNavbar : async function() {
		  this.burger.on('click', () => {
		    this.shortNav.toggleClass('active');
		    this.mainNav.toggleClass('active');
		    this.jq('.phone-call', this.navbar).toggleClass('active');
		  });
		},

		initSlickSliders : async function() {
      this.jq('#hph-slider').slick({ dots: true, arrows: true, });
			this.jq('.menu-bar-item:nth-child(1)').addClass('active');

			this.jq('#hph-slider').on('beforeChange',()=>{
				this.jq('.menu-bar-item:nth-child('+this.jq('.image.slick-current',this.homePageSlider).index()+')').removeClass('active');
			});

			this.jq('#hph-slider').on('afterChange', () => {
				this.jq('.menu-bar-item:nth-child('+this.jq('.image.slick-current',this.homePageSlider).index()+')').addClass('active');
			});


      this.jq('#testimonials-slider').slick({ dots: true, arrows: false, adaptiveHeight: true, });
      this.jq('.fwb-slider').slick({ dots: true, arrows: false, adaptiveHeight: true, });
    },

    triggerAction : async function() {
      this.triggerBtn.each((i,el) => {
        var btn = this.jq(el);
        btn.on('click', (ev) => {
          ev.preventDefault();
          var target = this.jq(ev.currentTarget).attr('data-target');
          var action = this.jq(ev.currentTarget).attr('data-action');
					if(action == "slide") this.slideBody(target);
        })
      });
    },

    slideBody : function(target) {
      this.jq('html,body').animate({ scrollTop: this.jq('#'+target).offset().top }, 800);
    },

    initReadMore : function() {
      this.rmButton.on('click' ,(ev) => {
        ev.preventDefault();
        this.jq('.content', this.rmContainer).slideToggle();
        var btn = this.jq(ev.currentTarget);
        btn.toggleClass('active');
        btn.hasClass('active')?btn.html('HIDE'):btn.html('READ MORE');
      });
    },

    initCardSection: async function() {
      this.mainWindow.on('load resize', () => {
        let evenRow = this.jq('.row:nth-child(even)', this.cardSection);
        let prevRow = evenRow.prev();
        evenRow.each((i,el) => {
          let margin = this.jq('.image', this.jq(el).prev()).outerHeight() - this.jq('.text-content', this.jq(el).prev()).outerHeight();
          let height = margin + this.jq('.text-content', el).outerHeight();
          this.jq('.image', this.jq(el)).css(
            {
              'position' : 'relative',
              'margin-top' : margin * -1,
              'height' : height,
              'min-height' : height,
            }
          );
        })
      });
    },

    initForm : async function() {
      this.jq('input, textarea', this.form).each((i,el) => {
        var item = this.jq(el);
        item.val().length?item.parent().siblings('label').addClass('active'):item.parent().siblings('label').removeClass('active');

        item.focus(() => {
          item.parent().siblings('label').addClass('active');
          item.addClass('active');
        });

        item.focusout(() => {
          if(item.val().length == 0) {
            item.parent().siblings('label').removeClass('active');
            item.removeClass('active');
          }
        })
      })
    },
  }

  setTimeout(()=>{ o.init($); },300)

})( jQuery );
