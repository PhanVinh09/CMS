<?php

/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<style>
		.primary-menu a {
			color: #6d6d6d !important;
		}

		.site-title a {
			color: #6d6d6d;
			display: block;
			text-decoration: none;
		}

		.header-inner {
			max-width: 168rem;
			padding: 0 !important;
			z-index: 100;
			background-color: #f8f8f8;
			border: 1px solid #e7e7e7;
			border-radius: 5px;
			height: 70px;
		}

		.header-titles-wrapper {
			margin-left: 10px;
		}

		.r-home-search {
			margin: 0;
			margin-left: 20px;
			background: none;
		}

		.r-home {
			text-align: center;
			background: #e7e7e7;
			padding: 20px 0;
		}

		.r-home a {
			color: #6d6d6d;
			text-decoration: none;
		}

		.r-search {
			display: flex;
			align-items: center;
		}

		.r-search input[type="search"] {
			padding: 8px 12px;
			border: 1px solid #ccc;
			border-radius: 4px;
			outline: none;
			background: #fff;
			font-size: 14px;
		}

		.r-search button {
			padding: 8px 16px;
			border: 1px solid #ccc;
			border-radius: 4px;
			font-size: 14px;
			background: transparent;
			color: #6d6d6d;
			cursor: pointer;
			text-decoration: none;
			text-transform: lowercase;
		}

		/* dropdown account */
		.account {
			margin-top: 7px;
			display: flex;
			flex-direction: column;
			align-items: center;
			font-family: Arial, sans-serif;
			color: #555;
			cursor: pointer;
		}

		.account-icon {
			font-size: 25px;
			color: #666;
		}

		.account-text {
			margin-top: 5px;
			font-size: 14px;
		}

		.account-text .arrow {
			font-size: 10px;
			margin-left: 4px;
		}

		.header-toggles {
			margin-right: 20px;
		}

		/* Menu ẩn mặc định */
		.account-menu {
			display: none;
			position: absolute;
			top: 70px;
			background: #fff;
			border: 1px solid #ccc;
			border-radius: 4px;
			padding: 5px 10px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
			min-width: 100px;
			text-align: center;
		}

		.account-menu a {
			display: block;
			padding: 6px;
			text-decoration: none;
			color: #333;
			font-size: 14px;
		}

		.account-menu a:hover {
			background: #f5f5f5;
		}

		/* Khi active thì hiện menu */
		.account.active .account-menu {
			display: block;
			animation: dropdown 0.2s ease-out forwards;
		}

		@keyframes dropdown {
			from {
				opacity: 0;
				transform: translateY(-10px);
			}

			to {
				opacity: 1;
				transform: translateY(0px);
			}
		}

		/* ẩn lỗi footer */
		.footer-top.has-footer-menu.has-social-menu {
			display: none !important;
		}
	</style>
</head>

<body <?php body_class(); ?>>

	<?php
	wp_body_open();
	?>

	<header id="site-header" class="header-footer-group">

		<div class="header-inner section-inner">

			<div class="header-titles-wrapper">

				<?php

				// Check whether the header search is activated in the customizer.
				$enable_header_search = get_theme_mod('enable_header_search', true);

				if (true === $enable_header_search) {

				?>

					<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
						<span class="toggle-inner">
							<span class="toggle-icon">
								<?php twentytwenty_the_theme_svg('search'); ?>
							</span>
							<span class="toggle-text"><?php _ex('Search', 'toggle text', 'twentytwenty'); ?></span>
						</span>
					</button><!-- .search-toggle -->


				<?php } ?>

				<div class="header-titles">

					<?php
					// Site title or logo.
					twentytwenty_site_logo();

					// Site description.
					twentytwenty_site_description();
					?>

				</div><!-- .header-titles -->
				<?php if (is_active_sidebar('header-search-widget')) : ?>
					<?php dynamic_sidebar('header-search-widget'); ?>
				<?php endif; ?>


				<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
					<span class="toggle-inner">
						<span class="toggle-icon">
							<?php twentytwenty_the_theme_svg('ellipsis'); ?>
						</span>
						<span class="toggle-text"><?php _e('Menu', 'twentytwenty'); ?></span>
					</span>
				</button><!-- .nav-toggle -->

			</div><!-- .header-titles-wrapper -->

			<div class="header-navigation-wrapper">

				<?php
				if (has_nav_menu('primary') || ! has_nav_menu('expanded')) {
				?>

					<nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x('Horizontal', 'menu', 'twentytwenty'); ?>">

						<ul class="primary-menu reset-list-style">

							<?php
							if (has_nav_menu('primary')) {

								wp_nav_menu(
									array(
										'container'  => '',
										'items_wrap' => '%3$s',
										'theme_location' => 'primary',
									)
								);
							} elseif (! has_nav_menu('expanded')) {

								wp_list_pages(
									array(
										'match_menu_classes' => true,
										'show_sub_menu_icons' => true,
										'title_li' => false,
										'walker'   => new TwentyTwenty_Walker_Page(),
									)
								);
							}
							?>

						</ul>

					</nav><!-- .primary-menu-wrapper -->

				<?php
				}

				if (true === $enable_header_search || has_nav_menu('expanded')) {
				?>

					<div class="header-toggles hide-no-js">

						<?php
						if (has_nav_menu('expanded')) {
						?>

							<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">

								<button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
									<span class="toggle-inner">
										<span class="toggle-text"><?php _e('Menu', 'twentytwenty'); ?></span>
										<span class="toggle-icon">
											<?php twentytwenty_the_theme_svg('ellipsis'); ?>
										</span>
									</span>
								</button><!-- .nav-toggle -->

							</div><!-- .nav-toggle-wrapper -->

						<?php
						}

						if (true === $enable_header_search) {
						?>

							<div class="toggle-wrapper search-toggle-wrapper">

								<button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
									<span class="toggle-inner">
										<?php twentytwenty_the_theme_svg('search'); ?>
										<span class="toggle-text"><?php _ex('Search', 'toggle text', 'twentytwenty'); ?></span>
									</span>
								</button><!-- .search-toggle -->

							</div>

						<?php
						}
						?>
						<div class="account" id="account">
							<div class="account-icon">
								<i class="fas fa-user-circle"></i>
							</div>
							<div class="account-text">
								Account <span class="arrow">&#9662;</span>
							</div>
							<div class="account-menu">
								<a href="#">Logout</a>
							</div>
						</div>
						<script>
							const account = document.getElementById("account");
							const arrow = account.querySelector(".arrow");

							account.addEventListener("click", () => {
								account.classList.toggle("active");

								if (account.classList.contains("active")) {
									arrow.innerHTML = "&#9652;"; //  ▲
								} else {
									arrow.innerHTML = "&#9662;"; //  ▼
								}
							});

							document.addEventListener("click", (e) => {
								if (!account.contains(e.target)) {
									account.classList.remove("active");
									arrow.innerHTML = "&#9662;"; //  ▼
								}
							});
						</script>


					</div><!-- .header-toggles -->
				<?php
				}
				?>

			</div><!-- .header-navigation-wrapper -->
		</div><!-- .header-inner -->

		<?php
		// Output the search modal (if it is activated in the customizer).
		if (true === $enable_header_search) {
			get_template_part('template-parts/modal-search');
		}
		?>

	</header><!-- #site-header -->
	<?php
	// Output the menu modal.
	get_template_part('template-parts/modal-menu');
