<article class="home--equipe-wrapper column small-4">
	<a data-open="equipe-modal-<?php the_title(); ?>" class="home--equipe-membre">
		<?php the_post_thumbnail( 'thumbnail' ); ?>
		<!-- <div class="entry-content"> -->
		<?php // the_content(); ?>
		<!-- </div> -->
		<h3><?php the_title(); ?></h3>
	</a>

	<div class="reveal" id="equipe-modal-<?php the_title(); ?>" aria-labelledby="equipe-modal-<?php the_title(); ?>-header" data-reveal>
	  <h1 id="equipe-modal-<?php the_title(); ?>-header"><?php the_title(); ?></h1>
		<?php the_post_thumbnail( 'thumbnail' ); ?>
		<p class="lead"></p>
		<?php the_content(); ?>
	  <button class="close-button" data-close aria-label="Close Accessible Modal" type="button">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
</article>
