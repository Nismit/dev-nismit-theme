<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package archive_nislog
 */

get_header(); ?>

	<main class="l-main">
		<div class="l-posts">

			<h1 class="title--taxonomy"><?php printf( esc_html__( 'Search: %s', 'archive_nislog' ), get_search_query() ); ?></h1>

			<div class="l-cards">
			<?php
			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'list' );

				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			</div><!-- /.l-cards -->

			<?php
				$args = array(
					'mid_size' => 3,
					'prev_text' => '&lt;',
					'next_text' => '&gt;',
					'type' => 'list'
				);

				echo paginate_links( $args );
			?>
		</div><!-- /.l-posts -->

	<?php get_sidebar(); ?>

	</main><!-- #main -->

	<?php
	get_footer();
