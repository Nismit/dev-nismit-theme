<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package archive_nislog
 */

get_header(); ?>

<main class="l-main">
	<div class="l-posts">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			//the_post_navigation();

		endwhile; // End of the loop.

		get_sidebar('article');

		?>

	</div><!-- /.l-posts -->

<?php get_sidebar(); ?>

</main><!-- #main -->

<?php
get_footer();
