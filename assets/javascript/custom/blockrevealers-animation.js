(function() {
	setTimeout(init, 0);
	function init() {
		var rev1 = new RevealFx(document.querySelector('.animated-title'), {
			revealSettings : {
				bgcolor: '#e6077e',
				delay: 250,
				onCover: function(contentEl, revealerEl) {
					contentEl.style.opacity = 1;
				}
			}
		});
		rev1.reveal();
	}
})();
