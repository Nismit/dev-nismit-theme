<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package archive_nislog
 */
?>

<aside class="l-aside">

	<div class="block">
		<h3 class="block__title">Follow Me</h3>

		<ul class="nav">
			<li class="nav__item nav__item--half"><a href="<?php echo esc_url( home_url( '/' ) ); ?>feed" target="_blank" class="button button--subscribe button--rss"><svg class="icon icon--white"><use xlink:href="#icon-feed"/></svg><br>RSS</a></li><li class="nav__item nav__item--half"><a href="https://feedly.com/i/subscription/feed/https://dev.nismit.me/feed" target="_blank" class="button button--subscribe  button--feedly"><svg class="icon icon--white"><use xlink:href="#icon-feedly"/></svg><br>Feedly</a></li>
			<li class="nav__item nav__item--half"><a href="https://twitter.com/nismit_" target="_blank" class="button button--subscribe  button--twitter"><svg class="icon icon--white"><use xlink:href="#icon-twitter"/></svg><br>Twitter</a></li><li class="nav__item nav__item--half"><a href="https://github.com/Nismit" target="_blank" class="button button--subscribe  button--github"><svg class="icon icon--white"><use xlink:href="#icon-github"/></svg><br>Github</a></li>
		</ul>
	</div>

	<div class="block">
		<h3 class="block__title">Ads</h3>

		<div style="width: 300px;height: 250px;background-color: #ddd;"></div>
	</div>

	<div class="block">
		<h3 class="block__title">Popular Articles</h3>

		<?php
	    $args = array(
	      'posts_per_page' => 5,
				'meta_key' => '_views_count',
				'orderby' => 'meta_value_num'
				//'year' => date('Y'), // Current year
				//'w' => date('W') // Current week
				//'monthnum' => date('n') // Current month
	    );
	    $posts_array = get_posts( $args );
	    if( $posts_array != null ) :
	  ?>
		<ul class="list">
			<?php foreach($posts_array as $post ) : setup_postdata( $post ); ?>
			<li class="list__item clearfix">
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
					<img src="https://placeholdit.imgix.net/~text?txtsize=75&txt=1500%C3%97700&w=150&h=150" width="70" alt="">
					<p><?php the_title(); ?><br>
					<span><?php echo get_post_meta( $post->ID, '_views_count', true ); ?> Views</span></p>
				</a>
			</li>
			<?php endforeach; wp_reset_postdata(); ?>
		</ul>
		<?php endif; ?>
	</div>

	<div class="block">
		<h3 class="block__title">Updated Articles</h3>

		<?php
	    $args = array(
	      'posts_per_page' => 4,
	      'orderby' => 'modified',
	      'order' => 'DESC'
	    );
	    $posts_array = get_posts( $args );
	    if( $posts_array != null ) :
	  ?>
		<ul>
			<?php foreach($posts_array as $post ) : setup_postdata( $post ); ?>
			<li class="list__item clearfix">
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
					<img src="https://placeholdit.imgix.net/~text?txtsize=75&txt=1500%C3%97700&w=150&h=150" width="70" alt="">
					<p><?php the_title(); ?><br>
					<span>Updated: <?php the_modified_date( 'Y/m/d' ) ?></span></p>
				</a>
			</li>
			<?php endforeach; wp_reset_postdata(); ?>
		</ul>
		<?php endif; ?>
	</div>

	<div class="block">
		<h3 class="block__title">Ads</h3>

		<div style="width: 300px;height: 250px;background-color: #ddd;"></div>
	</div>
</aside>
