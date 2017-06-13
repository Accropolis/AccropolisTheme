<?php

	// Custom Post Type (Les émission + l'équipe)
	function create_post_type() {
		register_post_type(
			'emission',
			array(
				'label' => 'Émissions',
				'labels' => array(
					'name' => 'Émissions',
					'singular_name' => 'Émission',
					'all_items' => 'Toutes les émissions',
					'add_new_item' => 'Ajouter une émission',
					'edit_item' => "Éditer l'émission",
					'new_item' => 'Nouvelle émission',
					'view_item' => 'Voir émission',
					'search_items' => 'Chercher émission',
					'not_found' => "Pas d'émission trouvée",
					'not_found_in_trash'=> "Pas d'émission dans la corbeille"
					),
				'public' => true,
				// 'capability_type' => 'post',
				'supports' => array(
					'title',
					'editor',
					'thumbnail'
				),
				'has_archive' => true,
			'menu_icon' => 'dashicons-video-alt3'
			)
		);
		register_post_type(
			'equipe',
			array(
				'label' => 'Équipe',
				'labels' => array(
					'name' => "L'équipe",
					'singular_name' => "Membre de l'équipe",
					'all_items' => 'Tous les membres',
					'add_new_item' => 'Ajouter un nouveau membre',
					'edit_item' => "Éditer le membre",
					'new_item' => 'Nouveau membre',
					'view_item' => 'Voir membre',
					'search_items' => 'Chercher membre',
					'not_found' => "Pas de membre trouvé",
					'not_found_in_trash'=> "Pas de membre dans la corbeille"
					),
				'public' => true,
				// 'capability_type' => 'post',
				'supports' => array(
					'title',
					'editor',
					'thumbnail'
				),
				'has_archive' => true,
			'menu_icon' => 'dashicons-groups'
			)
		);
		register_post_type(
			'medias',
			array(
				'label' => 'Ils ont parlé de nous',
				'labels' => array(
					'name' => "Ils ont parlé de nous",
					'singular_name' => "Média à citer",
					'all_items' => 'Tous les médias',
					'add_new_item' => 'Ajouter un nouveau média',
					'edit_item' => "Éditer le média",
					'new_item' => 'Nouveau média',
					'view_item' => 'Voir média',
					'search_items' => 'Chercher média',
					'not_found' => "Pas de média trouvé",
					'not_found_in_trash'=> "Pas de média dans la corbeille"
					),
				'public' => true,
				// 'capability_type' => 'post',
				'supports' => array(
					'title',
					'editor',
					'thumbnail'
				),
				'has_archive' => true,
			'menu_icon' => 'dashicons-format-quote'
			)
		);
		register_post_type(
			'soutien',
			array(
				'label' => 'Nous soutenir',
				'labels' => array(
					'name' => "Nous soutenir",
					'singular_name' => "Soutien",
					'all_items' => 'Tous les soutiens',
					'add_new_item' => 'Ajouter un nouveau soutien',
					'edit_item' => "Éditer le soutien",
					'new_item' => 'Nouveau soutien',
					'view_item' => 'Voir soutien',
					'search_items' => 'Chercher un soutien',
					'not_found' => "Pas de soutien trouvé",
					'not_found_in_trash'=> "Pas de soutien dans la corbeille"
					),
				'public' => true,
				// 'capability_type' => 'post',
				'supports' => array(
					'title',
					'editor',
					'thumbnail'
				),
				'has_archive' => true,
			'menu_icon' => 'dashicons-heart'
			)
		);
	}
	add_action( 'init', 'create_post_type' );
	/////////////////////////////////////////////////////////////////////////////////////////
	// Custom Post Types (Les émission + l'équipe + ils ont parlé de nous)
	function GetEquipe() {
		$args = array(
			'post_type' => 'equipe',
			'posts_per_page' => 10,
			'order' => asc
		);
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			require(TEMPLATEPATH.'/template-parts/home--equipe.php');
		endwhile;
		wp_reset_query();
	}
	add_action('home_page_equipe','GetEquipe',1,0);

	function GetMedias() {
		$args = array(
			'posts_per_page' => 100,
			'post_type' => 'medias',
			'order' => ASC
		);
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			require(TEMPLATEPATH.'/template-parts/home--medias.php');
		endwhile;
		wp_reset_query();
	}
	add_action('home_page_medias','GetMedias',1,0);

	function GetEmission() {
		$args = array(
			'post_type' => 'emission',
			'order' => ASC
		);
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			require(TEMPLATEPATH.'/template-parts/list-emissions.php');
		endwhile;
		wp_reset_query();
	}
	add_action('list_emission','GetEmission',1,0);


	function GetSoutien() {
		$args = array(
			'post_type' => 'soutien',
			'order' => DESC
		);
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			require(TEMPLATEPATH.'/template-parts/list-soutien.php');
		endwhile;
		wp_reset_query();
	}
	add_action('list_soutien','GetSoutien',1,0);

	/////////////////////////////////////////////////////////////////////////////////////////

	// Gallerie de héro HOMEPAGE ////////////////////////////////////////////////////////////////
	function BeforeHomeContent() {
		// Chopper le nom + lien de la page Programmation
		$progra_id = get_field('programmation-button', false, false);
		if($progra_id):
			$programmationLien = get_the_permalink($progra_id);
			$programmationNom = get_the_title($progra_id);
		endif;
		// Chopper le nom + lien de la page Je Soutiens
		$soutiens_id = get_field('jesoutiens-button', false, false);
		if($soutiens_id):
			$soutiensLien = get_the_permalink($soutiens_id);
			$soutiensNom = get_the_title($soutiens_id);
		endif;

		// Require part
		require(TEMPLATEPATH.'/template-parts/home--before-entry-content.php');
	}
	add_action('home_page_before_entry_content','BeforeHomeContent',1,0);
	function AfterHomeContent() {
		require(TEMPLATEPATH.'/template-parts/home--after-entry-content.php');
	}
	add_action('home_page_after_entry_content','AfterHomeContent',1,0);
	function BeforeFooter() {
		require(TEMPLATEPATH.'/template-parts/footer--before.php');
	}
	add_action('foundationpress_before_footer','BeforeFooter',1,0);
	// 	NOM DE L'ACTION / FUNCTION / PRIORITE / NOMBRE DE PARAMETRE
/////////////////////////////////////////////////////////////////////////////////////////
