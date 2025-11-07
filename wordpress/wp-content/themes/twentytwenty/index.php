<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<style>
	/* Layout 3 cột cho trang index/home */
	.home-3cols .home-3cols__inner {
		display: grid;
		grid-template-columns: 1fr minmax(0, 1300px) 1fr;
		/* trái | giữa | phải, cột giữa max 800px, 2 bên chia đều */
		gap: 5px;
		align-items: start;
		margin: 30px auto;
		max-width: 1700px;
	}

	/* Cột trái/phải sticky nhẹ */
	.home-3cols__left,
	.home-3cols__right {
		position: sticky;
		top: 70px;
	}

	/* Trang trí widget */
	.home-3cols__left .widget,
	.home-3cols__right .widget {
		padding: 0px;
	}

	.home-3cols__left .widget {
		width: 300px;
	}

	.home-3cols__right .widget {
		width: 300px;
	}


	/* Card + title */
	.home-3cols__left .widget_recent_entries {
		border: 1px solid #ececec;
		padding: 8px 10px 4px;
		background: #fff;
	}

	.home-3cols__left .widget_recent_entries .widget-title {
		margin: 6px 6px 10px;
	}

	/* Lưới 2 cột + đánh số thứ tự lớn */
	.home-3cols__left .widget_recent_entries ul {
		list-style: none;
		margin: 0;
		padding: 0;
		counter-reset: rank;
		/* bắt đầu bộ đếm */
	}

	/* Mỗi item */
	.home-3cols__left .widget_recent_entries li {
		position: relative;
		padding: 0px 0px 0px 36px;
		/* chừa chỗ bên trái cho số lớn */
		border-top: 2px solid #eee;
		/* kẻ ngang */
		min-height: 42p x;
	}

	/* Vạch dọc ngăn 2 cột: áp cho cột trái (odd) */
	.home-3cols__left .widget_recent_entries li:nth-child(odd) {
		border-right: 1px solid #eee;
	}

	/* Số thứ tự lớn */
	.home-3cols__left .widget_recent_entries li::before {
		counter-increment: rank;
		content: counter(rank);
		position: absolute;
		left: 8px;
		top: 0;
		font-size: 30px;
		font-weight: 700;
		color: #111;
		line-height: 1;
	}

	/* Link bài viết */
	.home-3cols__left .widget_recent_entries a {
		display: block;
		color: #111;
		text-decoration: none;
		font-size: 15px;
	}

	.home-3cols__left .widget_recent_entries a:hover {
		text-decoration: underline;
	}

	/* Mobile: về 1 cột, bỏ vạch dọc */
	@media (max-width: 900px) {
		.home-3cols__left .widget_recent_entries ul {
			grid-template-columns: 1fr;
		}

		.home-3cols__left .widget_recent_entries li:nth-child(odd) {
			border-right: none;
		}

		.home-3cols__left .widget_recent_entries li {
			padding-left: 38px;
		}
	}

	/* ===== RIGHT: Recent Comments kiểu tối giản như hình 2 ===== */
	.home-3cols__right .widget_recent_comments {
		border-radius: 8px;
		background: #fff;
		padding: 0px;
		margin: 0;
	}

	/* tiêu đề + gạch nhỏ dưới tiêu đề */
	.home-3cols__right .widget_recent_comments .widget-title {
		margin: 4px 0 10px;
		font-weight: 600;
		position: relative;
		padding-bottom: 6px;
	}

	.home-3cols__right .widget_recent_comments .widget-title:after {
		content: "";
		position: absolute;
		left: 0;
		bottom: 0;
		width: 48px;
		height: 2px;
		background: #3b7ddd;
		/* màu gạch */
	}

	/* danh sách phẳng, các dòng có gạch ngăn */
	.home-3cols__right .widget_recent_comments ul {
		list-style: none;
		margin: 0;
		padding: 0 4px;
	}

	/* Ẩn tất cả phần không cần thiết, chỉ giữ lại nội dung comment */
	.home-3cols__right .widget_recent_comments li a,
	.home-3cols__right .widget_recent_comments .url,
	.home-3cols__right .widget_recent_comments cite,
	.home-3cols__right .widget_recent_comments .avatar,
	.home-3cols__right .widget_recent_comments img,
	.home-3cols__right .widget_recent_comments .recentcomments>*:not(span) {
		display: none !important;
	}

	.home-3cols__right .widget_recent_comments li {
		display: inline;
		border-bottom: 1px solid #eee;
		font-size: 15px;
		color: #222;
		line-height: 1.5;
		font-style: normal;
		margin: 0;
		padding: 0;
		min-height: 0;
	}

	.home-3cols__right .widget_recent_comments li:last-child {
		border-bottom: none;
	}

	/* chỉ hiển thị link (tiêu đề bài) */
	.home-3cols__right .widget_recent_comments li a {
		display: block;
		text-decoration: none;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		font-size: 15px;
	}

	.home-3cols__right .widget_recent_comments li:hover {
		background: #f8f9fb;
		transition: 0.2s;
		padding-left: 6px;
	}

	.home-3cols__right .widget_recent_comments li a {
		display: none;
	}

	.home-3cols__right .widget_recent_comments li p {
		margin: 0;
		padding: 10px;
		color: #3b7ddd;
		border-bottom: 1px solid #3b7cdd81;
	}

	.has-avatars .wp-block-latest-comments__comment .wp-block-latest-comments__comment-meta {
		display: none;
	}

	.has-avatars .wp-block-latest-comments__comment .wp-block-latest-comments__comment-excerpt {
		margin: 0;
		padding: 0;
	}

	/* 1) Biến widget chứa .title-post-new thành tiêu đề trần (không hộp) */
	.home-3cols__left .widget:has(.title-post-new) {
		background: transparent;
		border: 0;
		padding: 0;
		margin: 0 0 8px;
		/* khoảng cách nhỏ xuống danh sách */
		box-shadow: none;
	}

	/* 2) Style tiêu đề + gạch mảnh bên dưới */
	.home-3cols__left .title-post-new {
		display: inline;
		margin: 0;
		padding: 0 0 6px;
		font-size: 16px;
		font-weight: 700;
		line-height: 1.2;
		text-transform: none;
		border-bottom: 1px solid #d0454b;
	}

	/* 3) Kéo danh sách sát tiêu đề, bỏ đệm trên */
	.home-3cols__left .widget_recent_entries {
		margin-top: 0;
		/* sát tiêu đề */
		padding-top: 0;
	}

	/* 4) Dòng đầu tiên không có khoảng thừa và kẻ ngang chuẩn */
	.home-3cols__left .widget_recent_entries ul {
		margin-top: 0;
	}

	.home-3cols__left .widget_recent_entries li {
		padding: 8px 0 8px 36px;
		/* chừa chỗ cho số thứ tự */
		border-top: 1px solid #eee;
	}

	.home-3cols__left .widget_recent_entries li:first-child {
		border-top: none;
		/* ngay dưới gạch của tiêu đề */
	}

	/* 5) Số thứ tự to bên trái (canh sát đầu dòng) */
	.home-3cols__left .widget_recent_entries li::before {
		top: 10px;
		/* thấp xuống chút cho cân */
		left: 8px;
		font-size: 24px;
		font-weight: 700;
		color: #222;
		line-height: 1;
	}

	/* 6) Link bài: chữ đậm vừa, giống báo */
	.home-3cols__left .widget_recent_entries a {
		color: #111;
		text-decoration: none;
		font-size: 15px;
		font-weight: 600;
		line-height: 1.4;
	}

	.home-3cols__left .widget_recent_entries a:hover {
		color: #3b7ddd;
		text-decoration: underline;
	}

	/* ===== RIGHT COLUMN — COMMENTS ===== */

	/* Tiêu đề “Bình Luận” (id bạn đang dùng) */
	#title-comment-list-blogs {
		margin: 0 0 10px;
		font-size: 16px;
		font-weight: 700;
		line-height: 1.2;
		color: #111;
		position: relative;
		padding-bottom: 6px;
	}

	#title-comment-list-blogs::after {
		content: "";
		position: absolute;
		left: 0;
		bottom: 0;
		width: 52px;
		height: 2px;
		background: #3b7ddd;
		/* màu gạch dưới */
	}

	.home-3cols__right ol.wp-block-latest-comments {
		margin: 0 !important;
		padding: 0 !important;
		list-style: none !important;
		border: none !important;
	}

	/* last post */
	/* ===== Latest News Timeline (middle column) ===== */
	.latest-news {
		position: relative;
		margin: 10px 0 24px;
		background: #fff;
		border: 1px solid #ececec;
		border-radius: 8px;
		padding: 12px 16px;
	}

	.latest-news__heading {
		margin: 0 0 8px;
		font-size: 20px;
		font-weight: 700;
		color: #111;
	}

	/* đường timeline bên trái */
	.latest-news__line {
		position: absolute;
		left: 63px;
		top: 64px;
		bottom: 16px;
		width: 2px;
		background: #e4e8f0;
	}

	.latest-news__list {
		list-style: none;
		margin: 0;
		padding: 0;
	}

	.latest-news__item {
		position: relative;
		padding: 10px 8px 12px 56px;
		/* chừa chỗ cho dot + line */
	}

	.latest-news__item+.latest-news__item {
		border-top: 1px solid #f0f2f6;
	}

	/* nút tròn */
	.latest-news__dot {
		position: absolute;
		left: 20px;
		top: 18px;
		width: 16px;
		height: 16px;
		border: 3px solid #3b7ddd;
		background: #fff;
		border-radius: 50%;
		box-shadow: 0 0 0 3px #ffffff;
	}

	/* hàng tiêu đề + ngày */
	.latest-news__row {
		display: grid;
		grid-template-columns: 1fr auto;
		align-items: baseline;
		gap: 10px;
	}

	.latest-news__title {
		font-size: 16px;
		font-weight: 700;
		color: #1b66c9;
		text-decoration: none;
	}

	.latest-news__title:hover {
		text-decoration: underline;
	}

	.latest-news__date {
		font-size: 14px;
		color: #5b6b82;
		white-space: nowrap;
	}

	.latest-news__excerpt {
		margin: 6px 0 0;
		color: #333;
		font-size: 15px;
		line-height: 1.5;
	}

	/* Responsive */
	@media (max-width: 768px) {
		.latest-news {
			padding: 10px 12px;
		}

		.latest-news__line {
			left: 24px;
		}

		.latest-news__item {
			padding-left: 48px;
		}

		.latest-news__dot {
			left: 16px;
		}

		.latest-news__row {
			grid-template-columns: 1fr;
		}

		.latest-news__date {
			order: 2;
		}
	}
</style>
<main id="site-content">

	<?php

	$archive_title    = '';
	$archive_subtitle = '';

	if (is_search()) {
		/**
		 * @global WP_Query $wp_query WordPress Query object.
		 */
		global $wp_query;

		$archive_title = sprintf(
			'%1$s %2$s',
			'<span class="color-accent">' . __('Search:', 'twentytwenty') . '</span>',
			'&ldquo;' . get_search_query() . '&rdquo;'
		);

		if ($wp_query->found_posts) {
			$archive_subtitle = sprintf(
				/* translators: %s: Number of search results. */
				_n(
					'We found %s result for your search.',
					'We found %s results for your search.',
					$wp_query->found_posts,
					'twentytwenty'
				),
				number_format_i18n($wp_query->found_posts)
			);
		} else {
			$archive_subtitle = __('We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty');
		}
	} elseif (is_archive() && ! have_posts()) {
		$archive_title = __('Nothing Found', 'twentytwenty');
	} elseif (! is_home()) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
	}

	if ($archive_title || $archive_subtitle) {
	?>

		<header class="archive-header has-text-align-center header-footer-group">

			<div class="archive-header-inner section-inner medium">

				<?php if ($archive_title) { ?>
					<h1 class="archive-title"><?php echo wp_kses_post($archive_title); ?></h1>
				<?php } ?>

				<?php if ($archive_subtitle) { ?>
					<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post(wpautop($archive_subtitle)); ?></div>
				<?php } ?>

			</div><!-- .archive-header-inner -->

		</header><!-- .archive-header -->

	<?php
	}
	?> <div class="home-3cols container">
		<div class="home-3cols__inner">

			<!-- Cột trái: ARCHIVE -->
			<aside class="home-3cols__left">
				<?php
				if (is_active_sidebar('archive-sidebar')) {
					dynamic_sidebar('archive-sidebar');
				} else {
					the_widget('WP_Widget_Archives', ['title' => __('Lưu trữ', 'twentytwenty')]);
				}
				?>
			</aside>

			<!-- Cột giữa: CONTENT (loop) -->
			<main class="home-3cols__main">
				<?php
				if (have_posts()) {
					$i = 0;
					while (have_posts()) {
						++$i;
						if ($i > 1) {
							echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
						}
						the_post();
						get_template_part('template-parts/content', get_post_type());
					}
					get_template_part('template-parts/pagination');
				} elseif (is_search()) {
				?>
					<div class="no-search-results-form section-inner thin">
						<?php get_search_form(['aria_label' => __('search again', 'twentytwenty')]); ?>
					</div>
				<?php
				}
				// Hiển thị Last posts dạng timeline ở đầu cột giữa
				// Chỉ hiển thị ở trang TÌM KIẾM
				if (is_search()) {
					tt_latest_news_timeline(6, 'Latest News');
				}


				?>
			</main>

			<!-- Cột phải: COMMENTS -->
			<aside class="home-3cols__right">
				<?php
				if (is_active_sidebar('comments-sidebar')) {
					dynamic_sidebar('comments-sidebar');
				} else {
					the_widget('WP_Widget_Recent_Comments', ['title' => __('Bình luận mới', 'twentytwenty')]);
				}
				?>
			</aside>

		</div>
	</div>

</main><!-- #site-content -->

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php
get_footer();
