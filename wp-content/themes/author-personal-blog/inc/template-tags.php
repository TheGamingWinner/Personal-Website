<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Author Personal Blog
 */
if ( ! function_exists( 'author_personal_blog_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function author_personal_blog_posted_on($icon = false) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
		$timeIcon = '%1$s';
		$posted_on = sprintf(
			$timeIcon,
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
		$line = '<i class="dote"></i>&nbsp;';
		if ($icon === true) {
			$line = '<i class="fa fa-calendar-o"></i>';
		}
		echo '<span class="posted-on">'.$line.'' . $posted_on . '</span>'; // WPCS: XSS OK.
	}
endif;
if ( ! function_exists( 'author_personal_blog_time' ) ) {
	function author_personal_blog_time() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
		echo '<i class="blog-time">' . wp_kses_post( $time_string ) . '</i>';
	}
}

function author_personal_blog_reading_time() {
	// load the content
	$thecontent = $post->post_content;
	// count the number of words
	$words = str_word_count( strip_tags( $thecontent ) );
	// rounding off and deviding per 200 words per minute
	$m = floor( $words / 200 );
	// rounding off to get the seconds
	$s = floor( $words % 200 / ( 200 / 60 ) );
	// calculate the amount of time needed to read
	$estimate = $m . ' minute' . ( $m == 1 ? '' : 's' ) . ', ' . $s . ' second' . ( $s == 1 ? '' : 's' );
	// create output
	$output = '<span><i class="fa fa-clock-o" aria-hidden="true"></i>' . $estimate . '</span>';
	// return the estimate
	return $output;

}
if ( ! function_exists( 'author_personal_blog_posted_by' ) ) :
	function author_personal_blog_posted_by( $author_image = true ) {
		$posted_by_format = '<a href="%1$s">%2$s %3$s</a>';
		$post_author_id   = get_post_field( 'post_author', get_queried_object_id() );
		$get_author_image = '<span class="post-author-image"><i class="fa fa-user-o" aria-hidden="true"></i></span> ';
		if ( false === $author_image ) {
			$get_author_image = '';
		}
		$postedBy = sprintf(
			$posted_by_format,
			esc_url( get_author_posts_url( get_the_author_meta( $post_author_id ), get_the_author_meta( 'user_nicename' ) ) ),
			$get_author_image,
			'<i>' . esc_html( get_the_author_meta( 'display_name', $post_author_id ) ) . '</i>'
		);
		echo '<span class="posted_by">' . wp_kses_post( $postedBy ) . '</span>';
	}
endif;
if ( ! function_exists( 'author_personal_blog_comment_popuplink' ) ) {
	function author_personal_blog_comment_popuplink() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			// $commentIcon = ;
			echo '<span class="comments-link">';
			$css_class = 'zero-comments';
			$number    = (int) get_comments_number( get_the_ID() );
			if ( 1 === $number ) {
				$css_class = 'one-comment';
			} elseif ( 1 < $number ) {
				$css_class = 'multiple-comments';
			}
			comments_popup_link(
				__( 'Add Comment', 'author-personal-blog' ),
				__( '1 Comment', 'author-personal-blog' ),
				__( '% Comments', 'author-personal-blog' ),
				$css_class,
				__( 'Comments are Closed', 'author-personal-blog' )
			);
			echo '</span>';
		}
	}
}
function author_personal_blog_categories() {
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ' ' );
		if ( $categories_list ) {
			printf( '<span class="cat-links">' . '%1$s' . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	}
	return;
}
if ( ! function_exists( 'author_personal_blog_post_tag' ) ) {
	function author_personal_blog_post_tag() {
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', '' );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">%1$s</span>', wp_kses_post( $tags_list ) ); // Updated line
			}
		}
		return;
	}
}
if ( ! function_exists( 'author_personal_blog_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function author_personal_blog_post_thumbnail() {

		$sidebar_layouts = 'no';
		$get_post_column_layout = '3';
		if (is_home()) {
			$sidebar_layouts = get_theme_mod('blog_page_sidebar', 'no');
			$get_post_column_layout = get_theme_mod('blog_page_post_column', '3');
		}elseif(is_search()){
			$sidebar_layouts = get_theme_mod('search_page_sidebar', 'no');
			$get_post_column_layout = get_theme_mod('search_page_post_column', '3');
		}elseif(is_archive()){
			$sidebar_layouts = get_theme_mod('archive_page_sidebar', 'no');
			$get_post_column_layout = get_theme_mod('archive_page_post_column', '3');
		}
		$thumbnail_size = 'author-personal-blog-grid-thumbnail';
		if ('no' == $sidebar_layouts && '2' == $get_post_column_layout) {
			$thumbnail_size = 'author-personal-blog-thumbnail-medium';
		}elseif ('no' == $sidebar_layouts && '3' == $get_post_column_layout) {
			$thumbnail_size = 'author-personal-blog-grid-thumbnail';
		}elseif(('right' == $sidebar_layouts || 'left' == $sidebar_layouts) && '2' == $get_post_column_layout){
			$thumbnail_size = 'author-personal-blog-grid-thumbnail';
		}

		$post_thumnail = wp_get_attachment_image_url( get_post_thumbnail_id( get_the_ID() ), $thumbnail_size );
		if ( is_single() || is_page() ) {
			 the_post_thumbnail( 'author-personal-blog-thumbnail-large' );
		} else {
			if ( has_post_thumbnail() ) :
				?>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $thumbnail_size ); ?>
				</a>
				<?php
			elseif ( $post_thumnail ) :
				echo '<a href="' . esc_url( get_the_permalink() ) . '"><img src="' . esc_url( $post_thumnail ) . '" alt=""></a>';
			endif;
		}
	}
endif;

/**
 * Author Personal Blog Navigation
 */
function author_personal_blog_navigation() {
	$next_icon            = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
	$prev_icon            = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
	$pagination_alignment = get_theme_mod( 'blog_page_pagination', 'center' );
	echo '<div class="pagination-' . esc_attr( $pagination_alignment ) . '">';
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => $prev_icon,
				'next_text' => $next_icon,
			)
		);
	echo '</div>';
}

function author_personal_blog_post_page_navigation(){
	if (get_next_post_link() || get_previous_post_link()):
		?>
		<div class="d-flex single-post-navigation justify-content-between">
			<?php if (get_previous_post_link()): ?>
				<div class="previous-post">
					<div class="postarrow"><i class="fa fa-long-arrow-left"></i><?php echo esc_html_e( 'Previous Post', 'author-personal-blog' ); ?></div>
					<?php echo get_previous_post_link('%link');?>
				</div>
			<?php endif;
			if(get_next_post_link()):
			?>
			<div class="next-post">
				<div class="postarrow"><?php echo esc_html_e( 'Next Post', 'author-personal-blog' ); ?><i class="fa fa-long-arrow-right"></i></div>
				<?php echo get_next_post_link('%link'); ?>
			</div>
			<?php endif; ?>
		</div>
		<?php
	endif;
}

function author_personal_blog_postedby(){
	?>
	<div class="post-author">
		<div class="d-block d-md-flex">
			<div class="author-image">
				<?php
				echo get_avatar( get_the_author_meta( 'ID' ), 200, '', '', null );
				?>
			</div>
			<div class="author-about">
				<h4><?php echo esc_html( get_the_author_meta( 'nickname' ) ); ?></h4>
				<p><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
			</div>
		</div>
	</div>
	<?php
}

function author_personal_blog_theme_by(){
	?>
	<div class="theme-by-wrapper">
		<div class="theme-by-inner">
			<strong><?php esc_html_e( 'Proudly powered by ', 'author-personal-blog' );?></strong><a href="<?php echo esc_url('https://rswpthemes.com/');?>"><?php esc_html_e( 'RS WP THEMES', 'author-personal-blog' );?></a>
		</div>
	</div>
	<?php
}

/**
 * Lazy Load Control
 */
add_filter( 'wp_lazy_loading_enabled', function(){
	$get_lazy_load = get_theme_mod( 'wp_lazy_load_control', false );
	$lazy_load = false;
	if (true == $get_lazy_load) {
		$lazy_load = true;
	}else{
		$lazy_load = false;
	}
} );