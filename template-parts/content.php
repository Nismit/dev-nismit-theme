<?php
/**
 * Template part for displaying post
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package archive_nislog
 */

?>

<article class="post">
	<?php the_title( '<h1 class="title--post">', '</h1>' ); ?>

	<div class="post--meta">
		<ul class="nav u-text-right">
			<?php if ( get_the_modified_date('Y/n/j') != get_the_time('Y/n/j') ) : ?>
			<li class="nav__item"><time class="updated" datetime="<?php the_modified_date( 'c' ) ?>"><svg class="icon icon--small"><use xlink:href="#icon-refresh"/></svg>&nbsp;<?php the_modified_date( 'Y/m/d' ) ?></time>&nbsp;</li>
			<?php endif; ?>
			<li class="nav__item"><time class="published" datetime="<?php echo the_time( 'c' ) ?>"><svg class="icon icon--small"><use xlink:href="#icon-calendar"/></svg>&nbsp;<?php echo the_time( 'Y/m/d' ) ?></time></li>
		</ul>
		<p class="u-text-right"><span><svg class="icon icon--small"><use xlink:href="#icon-eye"/></svg>&nbsp;<?php echo get_post_meta( $post->ID, '_views_count', true ); ?></span></p>
	</div>

	<figure>
		<?php if ( has_post_thumbnail() ) :
			the_post_thumbnail();
		else :
			echo '<img src="https://placeholdit.imgix.net/~text?txtsize=75&txt=1500%C3%97400&w=1500&h=700" alt="Test" width="100%" height="auto">';
		endif; ?>
	</figure>

	<div>
		<?php get_sidebar('share'); ?>
	</div>

	<!--div class="table-contents">
		<h2 class="table-contents__title">目次</h2>
		<ol>
			<li><a href="#">PHPアクセラレーション等を駆使してWordPressの高速化を図る</a></li>
			<li><a href="#">PHPアクセラレーション等を駆使してWordPressの高速化を図る</a></li>
			<li><a href="#">PHPアクセラレーション等を駆使してWordPressの高速化を図る</a></li>
			<li><a href="#">PHPアクセラレーション等を駆使してWordPressの高速化を図る</a></li>
		</ol>
	</div-->

	<div class="sponsored">
		<p class="u-text-center">Sponsored</p>
		<div style="height: 120px; background-color: #ccc;">

		</div>
	</div>

	<div class="post__content">
		<!--div class="notice">
			<p>この記事は最終更新日から1年以上経過しています。<br>
			古くなっている場合、コメントもしくはTwitterまでご連絡いただけると幸いです。</p>
		</div-->

		<?php the_content(); ?>

	</div>
</article>
