<?php
/*
Template Name: Front
*/
get_header(); ?>


<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
<section class="home--wrapper">
	<div class="fp-intro">
		<?php do_action( 'home_page_before_entry_content' ); ?>
	</div>
</section>
	<div id="home--bloc-graphique" class="show-for-large">
		<section class="parallax-container">
		  <div class="parallax" style="background: url(<?php the_post_thumbnail_url(); ?>) center center / cover no-repeat;"></div>
			<img id="home--bloc-animation" src="<?php the_field('home-bloc-animation') ?>" alt="l'image animée">
		</section>
		<!-- <div id="home-bloc-img-wrapper" class="rellax" data-rellax-speed="7">
			<?php the_post_thumbnail( 'full' ); ?>
		</div> -->
	</div>
<section class="home--wrapper home--wrapper-second">
	<div class="fp-content">

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
			<div class="entry-content show-for-large">
				<img id="logo--accropolis" src="<?= get_template_directory_uri(); ?>/assets/images/logo_accro.svg" alt="Logo Accropolis">
				<?php the_content(); ?>
			</div>
		</div>

	</div>
</section>
<section class="home--wrapper home--wrapper-second">
	<div class="fp-end">
		<?php do_action( 'home_page_after_entry_content' ); ?>
	</div>

</section>
<?php endwhile;?>
<?php do_action( 'foundationpress_after_content' ); ?>

<div class="section-divider show-for-large">
	<hr />
</div>






<?php get_footer();
