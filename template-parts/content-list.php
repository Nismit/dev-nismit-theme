<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package archive_nislog
 */

?>

<article class="card">
	<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
		<div class="card__image">
			<figure>
				<?php if ( has_post_thumbnail() ) :
					the_post_thumbnail();
				else :
					echo '<img src="https://placeholdit.imgix.net/~text?txtsize=75&txt=1500%C3%97700&w=1500&h=700" alt="Test" width="100%" height="auto">';
				endif; ?>
			</figure>
		</div>
		<div class="card__description">
			<?php the_title( '<h1 class="title--card">', '</h1>' ); ?>

			<?php the_excerpt(); ?>

			<ul class="u-text-right">
				<?php
					$category = get_the_category();
					$cat_name = $category[0]->name;
					$cat_slug = $category[0]->slug;
				?>
				<li><svg class="icon icon--small"><use xlink:href="#icon-<?php echo $cat_slug; ?>"/></svg>&nbsp;<?php echo esc_html( $cat_name ); ?></li>
				<li><svg class="icon icon--small"><use xlink:href="#icon-calendar"/></svg>&nbsp;<?php echo the_time( 'Y/m/d' ) ?></li>
			</ul>
		</div>
	</a>
</article>
