<a href="<?php the_permalink(); ?>" class="programmation--emission columns small-12 medium-6 large-4">
	<div class="programmation--emission-wrapper">
		<img src="<?php the_field( 'emission-background-img' ); ?>" alt="Background">
		<?php the_post_thumbnail( 'full' ); ?>
		<h3><?php the_title(); ?></h3>
		<?php // the_content(); ?>
	</div>
</a>
