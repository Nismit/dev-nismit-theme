<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package archive_nislog
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="icon" href="<?php echo esc_url( home_url( '/' ) ); ?>favicon.ico">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="l-header clearfix">
		<h1 class="logo u-display-inline-block"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="title--logo"><svg class="icon--logo"><use xlink:href="#icon-logo"/></svg>DEV.NISMIT</a></h1>

		<?php
			$arg = array(
				'taxonomy' => 'category',
				'orderby' => 'term_id',
				'exclude' => 1
			);
			$categories = get_categories( $arg );

			if(!empty( $categories )) :
		?>

		<label for="globalNav" class="nav--button"><svg class="icon icon--small"><use xlink:href="#icon-bars"/></svg></label><input type="checkbox" name="toggle" id="globalNav" class="toggle" />

		<nav class="nav--global">
			<ul class="nav--parent">
				<li>
					<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input name="s" id="s" type="text" placeholder="キーワード検索" class="search__input">
						<button type="submit" class="search__submit" value=""><svg class="search__icon"><use xlink:href="#icon-search"/></svg></button>
					</form>
				</li>
				<?php
					foreach( $categories as $key => $category ) :
						echo '<li><label for="cat'. $key .'" class="button--nav">'. $category->name .'</label><input type="checkbox" name="toggle" id="cat'. $key .'" class="toggle" />';
						$tags = get_tags_from_category( $category );
						echo '<ul class="nav--child">';
							echo '<li><a href="'. esc_url( home_url( '/' ) ) .'category/'. $category->slug .'" class="button--nav sub">'. esc_html( $category->name ) .'一覧</a></li>';
							if( !empty($tags) ):
								foreach( $tags as $tag ):
									echo '<li><a href="'. esc_url( $tag->link ) .'" class="button--nav sub" rel="tag">'. esc_html( $tag->name ) .'</a></li>';
								endforeach;
							endif;
						echo '</ul>';
						echo '</li>';
					endforeach;
				?>
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>about" class="button--nav" rel="bookmark">About</a></li>
			</ul>
		</nav>
		<label for="globalNav" class="nav--close"></label>
	<?php endif; ?>
	</header><!-- header -->
