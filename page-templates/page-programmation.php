<?php
/*
Template Name: Page Programmation
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div id="page-programmation" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
      <header>
				<h1 class="entry-title animated-title">
					<div class="animated-title content__title__inner">
						<?php the_title(); ?>
					</div>
				</h1>
				<h3 class="cons-title">Page en construction</h3>
      </header>
			<!-- <div id="programmation--google-sheet">
				<iframe src="<?php //the_field('programmation-link-google') ?>"></iframe>
			</div> -->
			<!-- <div id="programmation--google-calendar">
				<?php //the_field('programmation-calendrier') ?>
			</div> -->
      <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
      <div class="entry-content">
          <?php the_content(); ?>
      </div>
			<section id="programmation--emission-wrapper" class="row">
				<?php do_action('list_emission') ?>
			</section>
  </article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>

</div>

<?php get_footer();
