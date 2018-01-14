$(document).ready(function() {

	let programmation_listing_TL

	function animations_programmation_listing_init() {
      /*
       ** VARS
       */

      /* ELEMENTS */
      var block = $("#page-programmation"),
	        blocks = $(".main-content > div", block);

      /* TIMELINES */
      programmation_listing_TL = new TimelineMax({
          paused: true,
          immediateRender: false
      });


      /*
       ** KEYFRAMES
       */

      programmation_listing_TL.staggerFrom(blocks, 1, {
          x: -250,
					opacity: 0,
          ease: Expo.easeInOut
      }, 0.25);
  }

	function animations_programmation_listing_play() {
    programmation_listing_TL.play();

  }

	function globalAnimationsInit() {
    if ($("#page-programmation").length) {
      animations_programmation_listing_init();
    }
  }


	if ($(window).width() > 1080) {

    globalAnimationsInit();

		setTimeout(function () {

			animations_programmation_listing_play();

    }, 1000);

  }

});
