<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package archive_nislog
 */

?>

<div class="l-page">
	<?php
		the_title( '<h1 class="title--page">', '</h1>' );

		the_content();
	?>
</div><!-- /.l-page -->
