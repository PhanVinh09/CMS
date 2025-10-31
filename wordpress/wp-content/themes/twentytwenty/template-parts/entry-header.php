<?php

/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$entry_header_classes = '';

if (is_singular()) {
	$entry_header_classes .= ' header-footer-group';
}

?>

<header class="entry-header has-text-align-center<?php echo esc_attr($entry_header_classes); ?>">

	<div class="entry-header-inner section-inner medium">

		<?php
		$day   = get_the_date('d');
		$month = strtoupper(sprintf(__('THÁNG %s', 'twentytwenty'), get_the_date('n')));
		$year  = get_the_date('Y');
		// Hiển thị dòng meta: Ngày đăng + Category
		$show_categories = apply_filters('twentytwenty_show_categories_in_entry_header', true);

		echo '<div class="entry-date-box">';
		echo '  <div class="date-day">' . esc_html($day) . '</div>';
		echo '  <div class="date-month-year">';
		echo '    <div class="date-month">' . esc_html($month) . '</div>';
		echo '    <div class="date-year">' . esc_html($year) . '</div>';
		echo '  </div>';
		echo '</div>'; // .entry-meta-simple
		echo '<div class="entry-meta-category">';
		// Category (có thì mới hiện)
		if (true === $show_categories && has_category()) {
			$cats = get_the_term_list(get_the_ID(), 'category', '', ', ', '');
			if ($cats) {
				echo ' <span class="meta-sep">Category: </span> ';
				echo '<span class="meta-cats">' . wp_kses_post($cats) . '</span>';
			}
		}
		echo '</div>';
		?>
		<?php
		/**
		 * Allow child themes and plugins to filter the display of the categories in the entry header.
		 *
		 * @since Twenty Twenty 1.0
		 *
		 * @param bool Whether to show the categories in header. Default true.
		 */
		$show_categories = apply_filters('twentytwenty_show_categories_in_entry_header', true);

		if (true === $show_categories && has_category()) {
		?>

			<div class="entry-categories">
				<span class="screen-reader-text">
					<?php
					/* translators: Hidden accessibility text. */
					_e('Categories', 'twentytwenty');
					?>
				</span>
				<div class="entry-categories-inner">
					<?php //the_category( ' ' ); 
					?>
				</div><!-- .entry-categories-inner -->
				<?php ?>
			</div><!-- .entry-categories -->

		<?php
		}

		if (is_singular()) {
			the_title('<h1 class="entry-title">', '</h1>');
		} else {
			the_title('<h2 class="entry-title heading-size-1"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
		}

		$intro_text_width = '';

		if (is_singular()) {
			$intro_text_width = ' small';
		} else {
			$intro_text_width = ' thin';
		}

		if (has_excerpt() && is_singular()) {
		?>

			<div class="intro-text section-inner max-percentage<?php echo $intro_text_width; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output 
																?>">
				<?php the_excerpt(); ?>
			</div>

		<?php
		}

		// Default to displaying the post meta.
		twentytwenty_the_post_meta(get_the_ID(), 'single-top');
		?>

	</div><!-- .entry-header-inner -->

</header><!-- .entry-header -->