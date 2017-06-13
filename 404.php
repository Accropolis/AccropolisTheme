<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div class="row">
	<div class="small-12 columns" role="main">

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<svg version="1.1" baseProfile="basic" id="svg-404"
						 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 359.7 337.9"
						 xml:space="preserve">
					<g id="svg-404-path1">
							<polyline class="svg-404-paths" id="svg-404-path1-1" fill="none" stroke="#E6097E" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="
		303.9,123.5 259.3,123.5 324,33.9 324,165.2 	"/>
							<polyline class="svg-404-paths" id="svg-404-path1-2" fill="none" stroke="#E6097E" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="
		78.9,123.5 34.3,123.5 99,33.9 99,165.2 	"/>
							<path class="svg-404-paths" id="svg-404-path1-3" fill="none" stroke="#E6097E" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
		M151.8,128.6c0,18.1,14.8,32.9,32.9,32.9s32.9-14.8,32.9-32.9V69.8c0-18.1-14.8-32.9-32.9-32.9s-32.9,14.8-32.9,32.9V128.6z"/>
					</g>
					<g id="svg-404-path2">
							<path class="svg-404-paths" id="XMLID_326_" fill="none" stroke="#E6097E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
			M324,182.9c-4.7,0-8.6,3.8-8.6,8.6v104.8l-39.3-54.6h27.8c4.7,0,8.6-3.8,8.6-8.6s-3.8-8.6-8.6-8.6h-44.6c-3.2,0-6.2,1.8-7.6,4.7
			c-1.5,2.9-1.2,6.3,0.7,8.9l64.7,89.7c2.2,3,6,4.3,9.6,3.1c3.5-1.1,5.9-4.4,5.9-8.2V191.5C332.6,186.7,328.7,182.9,324,182.9z"/>
							<path class="svg-404-paths" id="XMLID_325_" fill="none" stroke="#E6097E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
			M99,182.9c-4.7,0-8.6,3.8-8.6,8.6v104.8l-39.3-54.6h27.8c4.7,0,8.6-3.8,8.6-8.6s-3.8-8.6-8.6-8.6H34.3c-3.2,0-6.2,1.8-7.6,4.7
			c-1.5,2.9-1.2,6.3,0.7,8.9l64.7,89.7c2.2,3,6,4.3,9.6,3.1c3.5-1.1,5.9-4.4,5.9-8.2V191.5C107.6,186.7,103.7,182.9,99,182.9z"/>
							<path class="svg-404-paths" id="XMLID_322_" fill="none" stroke="#E6097E" stroke-width="2.5" stroke-linecap="round" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
			M227.7,228v58.9c0,23.7-19.3,42.9-42.9,42.9c-23.7,0-42.9-19.3-42.9-42.9V228c0-23.7,19.3-42.9,42.9-42.9
			C208.4,185.1,227.7,204.3,227.7,228z M207.7,286.9V228c0-12.6-10.3-22.9-22.9-22.9c-12.6,0-22.9,10.3-22.9,22.9v58.9
			c0,12.6,10.3,22.9,22.9,22.9C197.4,309.8,207.7,299.5,207.7,286.9z"/>
					</g>
				</svg>
				<h1 class="entry-title"><?php _e( 'File Not Found', 'foundationpress' ); ?></h1>
			</header>
			<div class="entry-content">
				<div class="error">
					<p class="bottom"><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'foundationpress' ); ?></p>
				</div>
				<p><?php _e( 'Please try the following:', 'foundationpress' ); ?></p>
				<ul>
					<li><?php _e( 'Check your spelling', 'foundationpress' ); ?></li>
					<li><?php printf( __( 'Return to the <a href="%s">home page</a>', 'foundationpress' ), home_url() ); ?></li>
					<li><?php _e( 'Click the <a href="javascript:history.back()">Back</a> button', 'foundationpress' ); ?></li>
				</ul>
			</div>
		</article>

	</div>
	<?php //get_sidebar(); ?>
</div>
<?php get_footer();
