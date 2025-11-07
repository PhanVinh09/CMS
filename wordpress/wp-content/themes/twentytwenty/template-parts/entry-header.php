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

<header class="entry-header entry-header-box<?php echo esc_attr($entry_header_classes); ?>">

	<div class="entry-header-inner section-inner medium">
		<?php if (is_singular('post')) : ?>
			<?php
			$day   = get_the_date('d');
			$month = get_the_date('m'); // 06
			$year  = get_the_date('y'); // 18 (2 chữ số)
			?>
			<div class="date-badge">
				<div class="date-badge__stack">
					<span class="date-badge__day"><?php echo esc_html($day); ?></span>
					<span class="date-badge__divider"></span>
					<span class="date-badge__month"><?php echo esc_html($month); ?></span>
				</div>
				<span class="date-badge__year"><?php echo esc_html($year); ?></span>
			</div>
		<?php endif; ?>


		<?php if (! is_singular('post')) : ?>
			<?php
			$day   = get_the_date('d');
			$month = strtoupper(sprintf(__('THÁNG %s', 'twentytwenty'), get_the_date('n')));
			$year  = get_the_date('Y');

			$show_categories = apply_filters('twentytwenty_show_categories_in_entry_header', true);

			echo '<div class="entry-date-box">';
			echo '  <div class="date-day">' . esc_html($day) . '</div>';
			echo '  <div class="date-month-year">';
			echo '    <div class="date-month">' . esc_html($month) . '</div>';
			echo '    <div class="date-year">' . esc_html($year) . '</div>';
			echo '  </div>';
			echo '</div>';

			echo '<div class="entry-meta-category">';
			if (true === $show_categories && has_category()) {
				$cats = get_the_term_list(get_the_ID(), 'category', '', ', ', '');
				if ($cats) {
					echo ' <span class="meta-sep">Category: </span> ';
					echo '<span class="meta-cats">' . wp_kses_post($cats) . '</span>';
				}
			}
			echo '</div>';
			?>
		<?php endif; ?>
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
			echo '<hr class="custom-title-line">';
		} else {
			the_title('<h2 class="entry-title heading-size-1"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
		}

		$intro_text_width = '';

		if (is_singular()) {
			$intro_text_width = ' small';
		} else {
			$intro_text_width = ' thin';
		}

		

		// Default to displaying the post meta.
		twentytwenty_the_post_meta(get_the_ID(), 'single-top');
		?>

	</div><!-- .entry-header-inner -->

</header><!-- .entry-header -->