// usage: log('inside coolFunc',this,arguments);
// http://paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function(){
  log.history = log.history || [];   // store logs to an array for reference
  log.history.push(arguments);
  if(this.console){
    console.log( Array.prototype.slice.call(arguments) );
  }
};

var aslanInstitute = {

	init: function(){
		this.bindUIFunctions();
	},

	bindUIFunctions: function(){

		jQuery('body')
			.on('click','.constant-contact a',function(e){
				e.preventDefault();
				aslanInstitute.modalOpen( jQuery(this).attr('href') );
			})
			.on('click','.modal-close',function(e){
				e.preventDefault();
				aslanInstitute.modalClose();
			})
			.on('click','.menu-toggle',function(e){
				e.preventDefault();
				aslanInstitute.menuToggle();
			})
			.on('click','.read-more a',function(e){
				e.preventDefault();
				aslanInstitute.readMore(jQuery(e.target));
			});

	},

	modalOpen: function( url ){

		jQuery('.modal-overlay').removeClass('hide');

		var iFrame = jQuery('<iframe />');
		iFrame.attr('src',url);
		jQuery('.modal-window').append(iFrame).removeClass('hide');

	},

	modalClose: function(){

		jQuery('.modal-window').addClass('hide').children(':not(.modal-close)').remove();
		jQuery('.modal-overlay').addClass('hide');

	},

	menuToggle: function() {

		jQuery('.nav-main').toggleClass('open');

	},

	readMore: function($targetObj) {

		var $el, $ps, $up, totalHeight;

		totalHeight = 0;

		$el = $targetObj;
		$p  = $el.parent();
		$up = $p.parent();
		$ps = $up.find("p:not('.read-more')");

		// measure how tall inside should be by adding together heights of all inside paragraphs (except read-more paragraph)
		$ps.each(function() {
			totalHeight += jQuery(this).outerHeight();
		});

		$up
			.css({
			  // Set height to prevent instant jumpdown when max height is removed
			  "height": $up.height(),
			  "max-height": 9999
			})
			.animate({
			  "height": totalHeight
			});

		// fade out read-more
		$p.fadeOut();

	}

};

var aslanCarousel = {

	crossFadeDuration: 300,

	init: function(){
		if( ! jQuery('.carousel').size() ){
			//log('no carousel');
			return;
		}
		this.carouselsInit();
	},

	carouselsInit: function(){
		var ac = this;
		jQuery('.carousel').each(function(){
			var carousel = jQuery(this);
			setTimeout(function(){
				ac.nextSlide( carousel );
			},500);
		});
	},

	nextSlide: function( carouselObj ){

		var ac = this;

		// get the "outgoing horse" so we can make it go away later
		var outHorse = carouselObj.find('.horse.active');

		// get the "next" one
		var inHorse = outHorse.next();

		// either we didn't find a "next" or we had no outHorse to start with
		if( inHorse.size() === 0 ){
			inHorse = carouselObj.find('.horse').first();
		}

		inHorse.addClass('active');
		outHorse.removeClass('active').find('.horse-content').removeClass('on');

		ac.animateSlide( carouselObj, inHorse );

	},

	animateSlide: function( carouselObj, slideObj ){

		var ac = this;

		var duration = parseInt( slideObj.data('duration'), 10 ) * 1000;

		// the fancy way the text shows up
		var textAnimDuration = 300;

		var curChar = 0;

		//slideObj.find('.horse-content').addClass('on').lettering('words').find('span').lettering();
		slideObj.find('.horse-content').addClass('on').lettering('words').find('span').lettering();

		var chars = slideObj.find('span[class*=char]');

		var charCount = chars.size();

		var	charAnimateDuration = ( textAnimDuration / charCount );

		var charAnimate = setInterval(function(){

			chars.eq(curChar).addClass('on');

			curChar++;

			if( curChar > charCount ){
				clearInterval(charAnimate);
			}

		}, charAnimateDuration);

		setTimeout(function(){
			ac.nextSlide( carouselObj );
		},duration);


	}

};

aslanCalendar = {

	init: function(){
		if( jQuery('#tribe-bar-event-type').size() > 0 ){
			jQuery('#tribe-bar-event-type').select2();
		}
	}

};

jQuery(document).ready(function(){
	aslanInstitute.init();
	aslanCarousel.init();
	aslanCalendar.init();
});