window.log=function(){log.history=log.history||[];log.history.push(arguments);if(this.console){console.log(Array.prototype.slice.call(arguments))}};

var aslanCarousel = {

	crossFadeDuration: 300,

	init: function(){
		if( ! $('.carousel').size() ){
			log('no carousel');
			return;
		}
		this.carouselsInit();
	},

	carouselsInit: function(){
		var ac = this;
		$('.carousel').each(function(){
			var carousel = $(this);
			setTimeout(function(){
				ac.nextSlide(carousel);
			},500);
		})
	},

	nextSlide: function( carouselObj ){

		var ac = this;

		// get the "outgoing horse" and make it go away
		var outHorse = carouselObj.find('.horse.active');

		// get the "next" one
		var inHorse = outHorse.next();

		// either we didn't find a "next" or we had no outHorse to start with
		if( inHorse.size() === 0 ){
			var inHorse = carouselObj.find('.horse').first();
		}

		ac.animateSlide( inHorse );

		// make the outgoing horse go away
		outHorse.animate({opacity:0},ac.crossFadeDuration,function(){
			outHorse.addClass('hide');
		})

	},

	animateSlide: function( slideObj ){

		var duration = slideObj.data('duration');
		var textAnimDuration = 300;
		var charCount = 0;
		var charAnimateDuration = 0;
		var curChar = 0;

		slideObj.find('.horse-content').addClass('on').lettering('words').find('span').lettering();

		var chars = slideObj.find('span[class*=char]');

		charCount = chars.size();

		charAnimateDuration = ( textAnimDuration / charCount );

		var charAnimate = setInterval(function(){

			//chars.eq(curChar).animate({opacity: "1"},200);
			chars.eq(curChar).addClass('on');

			curChar++;

			if( curChar > charCount ){
				clearInterval(charAnimate);
			}

		}, charAnimateDuration);


	}

}

aslanCarousel.init();