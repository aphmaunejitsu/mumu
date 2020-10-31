		<footer class="sgn-footerbar">
				<div class="site-info nowrap">
					<a href="<?php echo esc_attr( bloginfo( 'url' ) ); ?>" class="home-link text-decoration-none inline-block flex justify-center mx-auto">
						<div class="site-title-icon mx-auto flex items-center p1">
							<?php get_template_part( 'parts/header/logo' ); ?>
							<div class="site-title">
								<?php echo esc_attr( bloginfo( 'name' ) ); ?>
							</div>
						</div>
					</a>
				</div>
				<?php
					wp_nav_menu(
						array(
							'menu'           => 'global navi',
							'menu_class'     => 'list-reset nowrap',
							'container'      => 'nav',
							'theme_location' => 'sgn-footerbar',
						)
					);
					?>
				<div class="sgn-footer-bottom flex flex-column items-center justify-center">
					<div class="sgn-sns-page flex items-center justify-center">
					<?php get_template_part( 'parts/common/sns-page-icon' ); ?>
					</div>
					<div class="copy-right nowrap">
						&copy; 2019 Mumu
					</div>
				</div>
		</footer>
