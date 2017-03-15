<section id="home--equipe">
	<h2 class="home--equipe-title"><?php the_field("home-equipe-title") ?></h2>
	<div class="row align-center">
		<?php do_action('home_page_equipe') ?>
	</div>
</section>

<section id="home--ilsontparledenous" class="show-for-large">
	<div class="accropo-divider">
		<div class="bille"></div>
	</div>
	<h2 class="home--medias-title">Ils ont parlé de nous</h2>
	<ul id="home--medias-list">
 		<?php do_action('home_page_medias') ?>
	</ul>
</section>

<section id="home--contact">
	<div class="home--contact-icon-wrapper">
		<i class="fa fa-envelope" aria-hidden="true"></i>
	</div>
	<?php the_field('home-contact-form') ?>
</section>

<section id="home--mobile-discord" class="show-for-small-only">
	<a href="<?php the_field('home-mobile-discord') ?>">Discord</a>
</section>
