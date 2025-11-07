<?php

/**
 * The default template for displaying content
 * Used for both singular and index.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty (Child override)
 */
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php
	// Header + featured image giống theme gốc
	get_template_part('template-parts/entry-header');
	get_template_part('template-parts/featured-image');
	?>

	<?php if (is_singular()) : ?>
		<!-- ===== LAYOUT 3 CỘT CHO TRANG ĐƠN ===== -->
		<div class="layout-3cols">

			<!-- LEFT: Categories -->
			<aside class="layout-3cols__left">
				<?php
				if (is_active_sidebar('left-categories')) {
					dynamic_sidebar('left-categories');
				} else {
					the_widget('WP_Widget_Categories', ['title' => __('Categories', 'twentytwenty')]);
				}
				?>
			</aside>

			<!-- MAIN: Content -->
			<main class="layout-3cols__main">
				<div class="post-inner">
					<div class="entry-content">
						<?php the_content(__('Continue reading', 'twentytwenty')); ?>
					</div>
				</div>

				<div class="section-inner">
					<?php
					wp_link_pages([
						'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__('Page', 'twentytwenty') . '"><span class="label">' . __('Pages:', 'twentytwenty') . '</span>',
						'after'       => '</nav>',
						'link_before' => '<span class="page-number">',
						'link_after'  => '</span>',
					]);

					edit_post_link();

					// Meta cuối bài.
					twentytwenty_the_post_meta(get_the_ID(), 'single-bottom');

					// Bio tác giả nếu là single post.
					if (post_type_supports(get_post_type(get_the_ID()), 'author') && is_single()) {
						get_template_part('template-parts/entry-author-bio');
					}
					?>
				</div>
			</main>

			<!-- RIGHT: Recent Posts – hộp xanh custom -->
			<aside class="layout-3cols__right">
				<?php
				$rp = new WP_Query([
					'post_type'           => 'post',
					'posts_per_page'      => -1,
					'ignore_sticky_posts' => true,
				]);

				if ($rp->have_posts()) : ?>
					<div class="rp2-box">
						<ul class="rp2-list">
							<?php
							$i = 0;
							while ($rp->have_posts()) :
								$rp->the_post();
								$i++;
								$is_extra = $i > 3 ? ' is-extra' : '';
								$d = get_the_date('d');
								$m = get_the_date('m');
								$y = get_the_date('y');
							?>
								<li class="rp2-item<?php echo $is_extra; ?>">
									<div class="rp2-date">
										<span class="d"><?php echo esc_html($d); ?></span>
										<span class="m"><?php echo esc_html($m); ?></span>
										<span class="y"><?php echo esc_html($y); ?></span>
									</div>
									<a class="rp2-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</li>
							<?php endwhile; ?>
						</ul>

						<a class="rp2-more" href="#" data-expand-text="XEM TẤT CẢ TIN TỨC" data-collapse-text="THU GỌN">XEM TẤT CẢ TIN TỨC</a>

					</div>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</aside>
		</div>

		<?php
		// Điều hướng prev/next cho single
		if (is_single()) {
			get_template_part('template-parts/navigation');
		}

		// Comments
		if ((comments_open() || get_comments_number()) && ! post_password_required()) : ?>
			<div class="comments-wrapper section-inner-box">
				<?php comments_template(); ?>
			</div>
		<?php endif; ?>

	<?php else : ?>
		<!-- ===== TRANG DANH SÁCH: GIỮ NGUYÊN ===== -->
		<div class="post-inner <?php echo is_page_template('templates/template-full-width.php') ? '' : 'thin'; ?>">
			<div class="entry-content">
				
			</div>
		</div>

		<div class="section-inner">
			<?php
			wp_link_pages([
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__('Page', 'twentytwenty') . '"><span class="label">' . __('Pages:', 'twentytwenty') . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			]);

			edit_post_link();
			?>
		</div>
	<?php endif; ?>

</article>
<style>
	/* Ẩn các mục dư mặc định */
	.rp2-item.is-extra {
		display: none;
	}

	/* Khi mở rộng, hiển thị tất cả */
	.rp2-box.is-expanded .rp2-item.is-extra {
		display: grid;
	}


	/* hoặc block tùy layout */
</style>
<script>
	document.addEventListener('click', function(e) {
		const btn = e.target.closest('.rp2-more');
		if (!btn) return;

		e.preventDefault();
		const box = btn.closest('.rp2-box');
		box.classList.toggle('is-expanded');

		const expanded = box.classList.contains('is-expanded');
		btn.textContent = expanded ? btn.dataset.collapseText : btn.dataset.expandText;
	});
</script>