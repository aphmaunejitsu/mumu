<?php
/**
 * Recentry Posts with thumbnail widget
 *
 * @package Mumu Theme
 */

/**
 * Recentry Post Widget
 */
class RecentryPostsWidget extends WP_Widget {

	/**
	 * サムネイル付最近の投稿Widgetの登録
	 */
	public function __construct() {
		parent::__construct(
			'mumu_recentry_posts',
			__( 'Mumu: Recentry Posts with Thumbnail' ),
			array( 'description' => __( 'サムネイル付最近の投稿' ) )
		);
	}

	/**
	 * Widget
	 *
	 * @param array $args arguments.
	 * @param array $instance instance.
	 */
	public function widget( $args, $instance ) {
		_log( 'Start: ' . __METHOD__ );
		_log( $instance );
		$count            = $instance['count'] ?? 5;
		$is_posted_date   = $instance['is_posted_date'] ?? false;
		$is_updated_date  = $instance['is_updated_date'] ?? false;
		$is_order_updated = $instance['is_order_updated'] ? 'modified' : 'date';
		$is_thumbnail     = $instance['is_thumbnail'] ?? false;
		$size             = $instance['size'] ?? 'thumbnail';
		$title            = $instance['title'] ?? __( 'Recentry Posts' );

		echo wp_kses_post( $args['before_widget'] );
		echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		echo wp_kses_post( '<ul class="mumu_recentry_posts_list">' );
		$posts = get_posts(
			array(
				'posts_per_page' => $count,
				'orderby'        => $is_order_updated,
			)
		);
		foreach ( $posts as $post ) {
			if ( $is_thumbnail ) {
				$thum_id = get_post_thumbnail_id( $post->ID );
				$image   = wp_get_attachment_image_src( $thum_id, $size );
			} else {
				$image = null;
			}
			if ( $is_posted_date ) {
				$published   = get_the_date( 'c', $post->ID );
				$published_t = get_the_date( 'Y-m-d', $post->ID );
			}
			?>
			<li class="entry">
				<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="flex flex-column">
					<?php if ( $is_thumbnail ) : ?>
					<div class="entry-thumbnail">
						<amp-img src="<?php echo esc_attr( $image[0] ); ?>"
							src='<?php echo esc_attr( $image[0] ); ?>'
							layout="responsive"
							width='<?php echo esc_attr( $image[1] ); ?>'
							height='<?php echo esc_attr( $image[2] ); ?>'>
						</amp-img>
					</div>
					<?php endif; ?>
					<div class="entry-content">
						<div class="entry-title"><?php echo esc_html( $post->post_title ); ?></div>
						<?php
							mumu_published_post( $post->ID, $is_posted_date, $is_updated_date );
						?>
					</div>
				</a>
			</li>
			<?php
		}
			echo wp_kses_post( '</ul>' );
			echo wp_kses_post( $args['after_widget'] );
			_log( 'End: ' . __METHOD__ );
	}

	/**
	 * Widget form
	 *
	 * @param array $instance データベースの保存値.
	 */
	public function form( $instance ) {
		_log( 'Start: ' . __METHOD__ );
		_log( $instance );
		$title            = $instance['title'] ?? '';
		$count            = $instance['count'] ?? 5;
		$is_posted_date   = $instance['is_posted_date'] ?? null;
		$is_updated_date  = $instance['is_updated_date'] ?? null;
		$is_order_updated = $instance['is_order_updated'] ?? false;
		$is_thumbnail     = $instance['is_thumbnail'] ?? null;
		$size             = $instance['size'] ?? 'thumbnail';
		$sizes            = get_image_sizes();
		?>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">タイトル:</label>
<input
	type="text" class="widefat"
	id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
	name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
	value="<?php echo esc_attr( $title ); ?>">
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>">表示する投稿数:</label>
<input
	type="number" class="tiny-text"
	id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"
	name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>"
	value="<?php echo esc_attr( $count ); ?>">
</p>
<p>
<input
	type="checkbox" class="checkbox"
	id="<?php echo esc_attr( $this->get_field_id( 'is_order_updated' ) ); ?>"
	name="<?php echo esc_attr( $this->get_field_name( 'is_order_updated' ) ); ?>"
	value="1"
		<?php
		if ( $is_order_updated ) :
			?>
			checked<?php endif; ?>>
<label for="<?php echo esc_attr( $this->get_field_id( 'is_order_updated' ) ); ?>">更新日順で表示する</label>
</p>
<p>
<input
	type="checkbox" class="checkbox"
	id="<?php echo esc_attr( $this->get_field_id( 'is_posted_date' ) ); ?>"
	name="<?php echo esc_attr( $this->get_field_name( 'is_posted_date' ) ); ?>"
	value="1"
		<?php
		if ( $is_posted_date ) :
			?>
			checked<?php endif; ?>>
<label for="<?php echo esc_attr( $this->get_field_id( 'is_posted_date' ) ); ?>">投稿日を表示する</label>
</p>
<p>
<input
	type="checkbox" class="checkbox"
	id="<?php echo esc_attr( $this->get_field_id( 'is_updated_date' ) ); ?>"
	name="<?php echo esc_attr( $this->get_field_name( 'is_updated_date' ) ); ?>"
	value="1"
		<?php
		if ( $is_updated_date ) :
			?>
			checked<?php endif; ?>>
<label for="<?php echo esc_attr( $this->get_field_id( 'is_updated_date' ) ); ?>">更新日を表示する</label>
</p>
<p>
<input
	type="checkbox" class="checkbox"
	id="<?php echo esc_attr( $this->get_field_id( 'is_thumbnail' ) ); ?>"
	name="<?php echo esc_attr( $this->get_field_name( 'is_thumbnail' ) ); ?>"
	value="1"
		<?php
		if ( $is_thumbnail ) :
			?>
			checked<?php endif; ?>
>
<label for="<?php echo esc_attr( $this->get_field_id( 'is_thumbnail' ) ); ?>">アイキャッチ画像を表示する</label>
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>">サムネイルサイズ:</label>
<select
	id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"
	name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>">
				<?php foreach ( $sizes as $key => $v ) : ?>
		<option value= "<?php echo esc_attr( $key ); ?>" <?php selected( $key, $size ); ?>>
					<?php echo wp_kses_post( $key ); ?> (<?php echo esc_html( $v['width'] ); ?> x <?php echo esc_html( $v['height'] ); ?>)
		</option>
		<?php endforeach; ?>
</select>
</p>
				<?php

				_log( 'End: ' . __METHOD__ );
	}

	/**
	 * ウィジェットフォームの値を保存用にサニタイズ
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance 保存用に送信された値.
	 * @param array $old_instance データベースからの以前保存された値.
	 *
	 * @return array 保存される更新された安全な値.
	 */
	public function update( $new_instance, $old_instance ) {
		_log( 'Start: ' . __METHOD__ );
		_log( $new_instance );
		$inctance                     = $old_instance;
		$instance['title']            = $new_instance['title'] ? strip_tags( $new_instance['title'] ) : null;
		$instance['count']            = is_numeric( $new_instance['count'] ) ? $new_instance['count'] : 5;
		$instance['is_posted_date']   = $new_instance['is_posted_date'] ?? null;
		$instance['is_updated_date']  = $new_instance['is_updated_date'] ?? null;
		$instance['is_order_updated'] = $new_instance['is_order_updated'] ?? null;
		$instance['is_thumbnail']     = $new_instance['is_thumbnail'] ?? null;
		$instance['size']             = strip_tags( $new_instance['size'] ) ?? 'thumbnail';

		_log( $instance );

		_log( 'end: ' . __METHOD__ );
		return $instance;
	}
}

add_action(
	'widgets_init',
	function() {
		register_widget( RecentryPostsWidget::class );
	}
);
