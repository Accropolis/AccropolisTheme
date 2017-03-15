<?php if(get_field( 'soutien-link' ) != null)  : ?>
	<a href="<?= get_field( 'soutien-link' ); ?>" class="soutien--soutien columns small-12 medium-6">
<?php else : ?>
	<div class="soutien--soutien columns show-for-large large-6">
		<div class="soutien--socials-wrapper">
			<a href="<?php the_field( 'soutien-partager-facebook' ) ?>"><i class="fa fa-facebook"></i></a>
			<a href="<?php the_field( 'soutien-partager-twitter' ) ?>"><i class="fa fa-twitter"></i></a>
			<a href="<?php the_field( 'soutien-partager-youtube' ) ?>"><i class="fa fa-youtube"></i></a>
			<a href="<?php the_field( 'soutien-partager-twitch' ) ?>"><i class="fa fa-twitch"></i></a>
		</div>
<?php endif; ?>


		<div <?php post_class( 'soutien--soutien-wrapper' ); ?>>
			<?php the_post_thumbnail( 'full' ); ?>
			<h3><?php the_title(); ?></h3>
		</div>


<?php if(get_field( 'soutien-link' ) == null)  : ?>
</div>
<?php else : ?>
	</a>
<?php endif; ?>
