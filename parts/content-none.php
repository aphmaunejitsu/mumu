<section class="no-results not-found">
    <header class="mb1">
        <h1 class="page-title">Not Found</h1>
    </header>
    <div class="content mb1">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					'記事を作成してください <a href="%1$s">ここからスタートできます</a>.',
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url(admin_url('post-new.php'))
			);

		elseif (is_search()) : ?>
			<p>検索結果がありません。</p>
            <p><a href="/">hcm-nights.com トップへ</a></p>
			<?php
		else : ?>
			<p>指定されたURLは存在しませんでした</p>
            <p><a href="/">hcm-nights.com トップへ</a></p>
        <?php
        endif; ?>
    </div><!-- .content -->
</section>
