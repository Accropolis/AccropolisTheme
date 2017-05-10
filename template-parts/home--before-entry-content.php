<section id="home--programmation-planning">
	<?php the_field( 'home-calendrier' ) ?>
</section>
<section id="home--live"></section>

<section id="home--livebuttons-mobile" class="expanded button-group show-for-small-only home-livebuttons">
	<!-- Mobile Only -->
  <a href="<?= $programmationLien ?>" id="home--button-programmation-mobile" class="button hollow home--button-programmation"><?= $programmationNom ?></a>
  <a href="<?php the_field('twitch-button-link') ?>" id="home--button-twitch-mobile" class="button home--button-twitch">
		<i class="fa fa-twitch"></i>
		<?php the_field('twitch-button-content') ?>
	</a>
</section>
<section id="home--livebuttons-tablet" class="expanded button-group show-for-medium-only home-livebuttons">
	<!-- Tablet -->
	<a href="<?php the_field('home-mobile-discord') ?>" id="home--button-discord-tablet" class="button home--button-discord">Discord</a>
  <a href="<?= $soutiensLien ?>" id="home--button-soutiens-tablet" class="button home--button-soutiens"><?= $soutiensNom ?></a>
  <a href="<?= $programmationLien ?>" id="home--button-programmation-tablet" class="button hollow home--button-soutiens"><?= $programmationNom ?></a>
  <a href="<?php the_field('twitch-button-link') ?>" id="home--button-twitch-tablet" class="button home--button-twitch">
		<i class="fa fa-twitch"></i>
		<?php the_field('twitch-button-content') ?>
	</a>
</section>
<section id="home--livebuttons-desktop" class="expanded button-group show-for-large home-livebuttons">
	<!-- Desktop -->
	<a href="<?php the_field('home-mobile-discord') ?>" id="home--button-discord-desktop" class="button home--button-discord">Discord</a>
  <a href="<?= $soutiensLien ?>" id="home--button-soutiens-desktop" class="button home--button-soutiens"><?= $soutiensNom ?></a>
	<button href="#" id="home--button-extensions-desktop" class="dropdown button" data-toggle="example-dropdown">Extensions</button>
  <a href="<?php the_field('twitch-button-link') ?>" id="home--button-twitch-desktop" class="button home--button-twitch">
		<i class="fa fa-twitch"></i>
		<?php the_field('twitch-button-content') ?>
	</a>
</section>

<!-- DROPDOWN FOR EXTENSIONS -->
<div class="dropdown-pane" id="example-dropdown" data-dropdown data-hover="true" data-hover-pane="true">
	<a href="<?php the_field('lien-application-chrome') ?>" class="button expanded">
		<i class="fa fa-chrome" aria-hidden="true"></i>
		Chrome
		<i class="fa fa-download" aria-hidden="true"></i>
	</a>
	<a href="<?php the_field('lien-application-firefox') ?>" class="button expanded">
		<i class="fa fa-firefox" aria-hidden="true"></i>
		Firefox
		<i class="fa fa-download" aria-hidden="true"></i>
	</a>
	<a href="<?php the_field('lien-application-opera') ?>" class="button expanded">
		<i class="fa fa-opera" aria-hidden="true"></i>
		Opera
		<i class="fa fa-download" aria-hidden="true"></i>
	</a>
</div>


<section id="home--youtube" class="home--section-wrapper">
	<header class="row show-for-medium">
		<h2>Derniers Replay</h2>
		<script src="https://apis.google.com/js/platform.js"></script>
		<div class="g-ytsubscribe" data-channelid="<?php the_field('home-youtube-channel') ?>" data-layout="default" data-count="default"></div>
	</header>
	<div id="youtube-videos" class="row">
	</div>
	<div class="show-for-small-only">
		<a href="https://youtube.com/channel/<?php the_field("home-youtube-channel") ?>" class="expanded button home--button-youtube">Chaine YouTube</a>
	</div>
	<div class="expanded button-group show-for-medium">
		<a href="https://youtube.com/channel/<?php the_field("home-youtube-channel") ?>" class="button home--button-youtube">
			<i class="fa fa-youtube"></i>
			Chaine YouTube
		</a>
		<a href="https://youtube.com/channel/<?php the_field("home-youtube-channel2") ?>" class="button home--button-youtube">
			<i class="fa fa-youtube-play"></i>
			Replay
		</a>
	</div>
</section>
