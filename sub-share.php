<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package archive_nislog
 */
?>

<ul class="nav nav--share">
	<li class="nav__item nav--share__item"><a href="https://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" target="_blank" class="button button--share button--twitter"><svg class="icon icon--share icon--white"><use xlink:href="#icon-twitter"/></svg><span>&nbsp;Twitter</span><span class="counter">123</span></a></li><li class="nav__item nav--share__item"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="button button--share button--facebook"><svg class="icon icon--share icon--white"><use xlink:href="#icon-facebook"/></svg><span>&nbsp;Facebook</span><span class="counter">12</span></a></li><li class="nav__item nav--share__item"><a href="https://getpocket.com/edit?url=<?php the_permalink(); ?>&title=<?php echo urlencode( get_the_title() ); ?>" target="_blank" class="button button--share button--pocket"><svg class="icon icon--share icon--white"><use xlink:href="#icon-get-pocket"/></svg><span>&nbsp;Pocket</span><span class="counter">12</span></a></li><li class="nav__item nav--share__item"><a href="https://b.hatena.ne.jp/entry/<?php the_permalink(); ?>" target="_blank" class="button button--share button--hatena"><svg class="icon icon--share icon--white"><use xlink:href="#icon-hatena"/></svg><span>&nbsp;Hatena</span><span class="counter">12</span></a></li><li class="nav__item nav--share__item"><a href="https://feedly.com/i/subscription/feed/<?php echo esc_url( home_url( '/' ) ); ?>feed" target="_blank" class="button button--share button--feedly"><svg class="icon icon--share icon--white"><use xlink:href="#icon-feedly"/></svg><span>&nbsp;Feedly</span><span class="counter">12</span></a></li>
</ul>
