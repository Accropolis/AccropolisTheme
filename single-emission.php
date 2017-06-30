<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div id="single-emission" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		<header>
			<h1 class="entry-title animated-title">
				<div class="animated-title content__title__inner">
					<?php the_title(); ?>
				</div>
			</h1>
			<?php the_post_thumbnail(); ?>
		</header>
		<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				$playlistId = get_field("playlist_id");
				if($playlistId) :
			?>
				<iframe src="https://www.youtube.com/embed/videoseries?list=<?php the_field('playlist_id') ?>" allowfullscreen="" width="500" height="281" frameborder="0"></iframe>
			<?php endif; ?>
		</div>
		<footer>
			<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
			<p><?php the_tags(); ?></p>
		</footer>
	</article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>
<?php //get_sidebar(); ?>
</div>
<?php get_footer();
