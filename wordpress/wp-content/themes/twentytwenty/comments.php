<?php

/**
 * The template file for displaying the comments and comment form for the
 * Twenty Twenty theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if (post_password_required()) {
	return;
}

if ($comments) {
?>

	<div class="comments" id="comments">

		<?php
		$comments_number = get_comments_number();
		?>

		<div class="comments-header section-inner small max-percentage">

			<h2 class="comment-reply-title">
				<?php
				if (! have_comments()) {
					_e('Leave a comment', 'twentytwenty');
				} elseif ('1' === $comments_number) {
					/* translators: %s: Post title. */
					printf(_x('One reply on &ldquo;%s&rdquo;', 'comments title', 'twentytwenty'), get_the_title());
				} else {
					printf(
						/* translators: 1: Number of comments, 2: Post title. */
						_nx(
							'%1$s reply on &ldquo;%2$s&rdquo;',
							'%1$s replies on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'twentytwenty'
						),
						number_format_i18n($comments_number),
						get_the_title()
					);
				}

				?>
			</h2><!-- .comments-title -->

		</div><!-- .comments-header -->

		<div class="comments-inner section-inner thin max-percentage">

			<?php
			wp_list_comments(
				array(
					'walker'      => new TwentyTwenty_Walker_Comment(),
					'avatar_size' => 120,
					'style'       => 'div',
				)
			);

			$comment_pagination = paginate_comments_links(
				array(
					'echo'      => false,
					'end_size'  => 0,
					'mid_size'  => 0,
					'next_text' => __('Newer Comments', 'twentytwenty') . ' <span aria-hidden="true">&rarr;</span>',
					'prev_text' => '<span aria-hidden="true">&larr;</span> ' . __('Older Comments', 'twentytwenty'),
				)
			);

			if ($comment_pagination) {
				$pagination_classes = '';

				// If we're only showing the "Next" link, add a class indicating so.
				if (false === strpos($comment_pagination, 'prev page-numbers')) {
					$pagination_classes = ' only-next';
				}
			?>

				<nav class="comments-pagination pagination<?php echo $pagination_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output 
															?>" aria-label="<?php esc_attr_e('Comments', 'twentytwenty'); ?>">
					<?php echo wp_kses_post($comment_pagination); ?>
				</nav>

			<?php
			}
			?>

		</div><!-- .comments-inner -->

	</div><!-- comments -->

<?php
}

if (comments_open() || pings_open()) {

	if ($comments) {
		echo '<hr class="styled-separator is-style-wide" aria-hidden="true" />';
	}

	comment_form(
		array(
			'class_form'         => 'section-inner thin max-percentage',
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
		)
	);
} elseif (is_single()) {

	if ($comments) {
		echo '<hr class="styled-separator is-style-wide" aria-hidden="true" />';
	}

?>

	<div class="comment-respond" id="respond">

		<p class="comments-closed"><?php _e('Comments are closed.', 'twentytwenty'); ?></p>

	</div><!-- #respond -->

<?php
}
?>
<style>
	/* ========== COMMENTS COLOR STRIPES (background only) ========== */
	.comment-meta {
		margin: 0;
		min-height: 0;
	}

	/* === Arrow for .comment-author (speech bubble) === */
	.comments .comment .comment-author {
		position: relative;
		background: #dfdfdf;
		border: 1px solid #aaa4a4;
		display: block;
	}

	/* Lớp dưới: viền mũi tên (màu viền) */
	.comments .comment .comment-author::after {
		content: "";
		position: absolute;
		left: -10px;
		top: 50%;
		transform: translateY(-50%);
		width: 0;
		height: 0;
		border-top: 10px solid transparent;
		border-bottom: 10px solid transparent;
		border-right: 10px solid #dfdfdf;
	}

	/* Lớp trên: nền mũi tên (màu nền khối) */
	.comments .comment .comment-author::before {
		content: "";
		position: absolute;
		left: -8px;
		/* ít âm hơn để nằm trong lớp viền */
		top: 50%;
		transform: translateY(-50%);
		width: 0;
		height: 0;
		border-top: 9px solid transparent;
		border-bottom: 9px solid transparent;
		border-right: 9px solid #dfdfdf;
		/* trùng màu background khối */
	}


	/* 1) Khối tên tác giả (Author name) */
	.comments .comment .comment-author,
	.comments .comment .comment-author .fn,
	.comments .comment .comment-author .fn a {
		padding: 10px;
		background-color: #dfdfdf;
	}

	/* 2) Dòng meta: thời gian, link sửa… (date/time/meta) */
	.comments .comment .comment-metadata,
	.comments .comment .comment-metadata a {
		display: none;
		margin: 0;
		padding: 0;
	}

	/* 3) Nội dung bình luận (comment text) */
	.comments .comment .comment-content {
		border: 1px solid #aaa4a4;
		border-top: none;
		padding: 10px;
	}

	/* 4) Nút hành động: Trả lời/Bình luận (reply button) */
	.comments .comment .reply a,
	.comments .comment .comment-reply-link {
		/* hồng nhạt */
		display: inline-block;
		/* để background ôm nút */
	}

	/* 5) Nhãn “Bởi tác giả” (by post author badge) */
	.comments .comment .by-post-author-badge,
	.bypostauthor .comment .by-post-author-badge,
	.bypostauthor .comment .comment-author:after {
		display: inline-block;
	}

	/* 6) Ảnh đại diện (avatar) – nếu muốn cũng có nền */
	.comments .comment .avatar {

		border-radius: 4px;
	}
	.comment-footer-meta{
		margin: 10px 0 0 0;
	}
</style>