<?php

/**
 * Displays the featured image + excerpt summary
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
// KHÔNG hiển thị trong trang bài viết chi tiết (single post)
if ( is_singular( 'post' ) ) {
	return;
}
if (has_post_thumbnail() && ! post_password_required()) {

	$featured_media_inner_classes = '';

	// Make the featured media thinner on archive pages.
	if (! is_singular()) {
		$featured_media_inner_classes .= ' medium';
	}
?>

	<figure class="featured-media">

		<div class="featured-media-inner section-inner<?php echo $featured_media_inner_classes; ?>">

			<div class="featured-box-img">

				<?php the_post_thumbnail(); ?>

				<?php
				$caption = get_the_post_thumbnail_caption();

				if ($caption) :
				?>
					<figcaption class="wp-caption-text"><?php echo wp_kses_post($caption); ?></figcaption>
				<?php endif; ?>

			</div>
			<?php
			// 🔹 Hiển thị phần tóm tắt (excerpt) ngay dưới hình ảnh
			$excerpt = get_the_excerpt();
			if (! empty($excerpt)) :
			?>
				<div class="featured-summary">
					<?php echo wpautop(esc_html($excerpt)); ?>
				</div>
			<?php endif; ?><!-- .featured-box-img -->

		</div><!-- .featured-media-inner -->

	</figure><!-- .featured-media -->

<?php
}
?>