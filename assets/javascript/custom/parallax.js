var parallaxElements = $('.parallax'),
    parallaxQuantity = parallaxElements.length;

var animateBlock = $('#home--bloc-graphique');
var animatePart = $('#home--bloc-animation');
var distanceToTop = animateBlock.offset().top;
var wHeight = $(window).height();

$(window).on('scroll', function () {
	var distanceToActivate = distanceToTop - ($(window).scrollTop());
  window.requestAnimationFrame(function () {
		if (distanceToActivate < 0) {
			animatePart.css({
				'right': '25vw',
				'opacity': '1'
			});
		} else {
			animatePart.css({
				'right': '0vw',
				'opacity': '0'
			});
		}


    for (var i = 0; i < parallaxQuantity; i++) {
      var currentElement =  parallaxElements.eq(i);
      var scrolled = ($(window).scrollTop() / 2);

        currentElement.css({
          'transform': 'translate3d(0,' + scrolled * -0.3 + 'px, 0)'
        });

    }
  });

});
