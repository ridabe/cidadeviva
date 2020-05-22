<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

function gpur_comment_template( $comment, $args, $depth ) {
	
	if ( gpur_option( 'comment_rating_comment_divider' ) )	{
		$border_color = 'border-color: ' . gpur_option( 'comment_rating_comment_divider' ) . ';';
	} else {
		$border_color = '';
	}
	
	switch ( $comment->comment_type ) :
	
		case 'pingback' :
		case 'trackback' :

		?>

			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>" itemscope itemtype="http://schema.org/Comment">

				<div class="comment-body" style="<?php echo esc_attr( $border_color ); ?>">
					<p><?php esc_html_e( 'Pingback:', 'gpur' ); ?> <?php comment_author_link(); ?></p>
				</div>
				
			</li>	
	
		<?php break; 
	
		default :

			include( plugin_dir_path( __FILE__ ) . 'comments-list.php' );  

		break; 
	
	endswitch;

}

if ( comments_open() OR have_comments() ) { ?>

	<div id="comments" class="comments-area gpur-default-comment-template gpur-review-comments">

		<?php echo GPUR_Ajax_Comments::gpur_comment_rating_summary( get_the_ID() ); ?>
	
		<?php if ( have_comments() ) : ?>
			<?php echo GPUR_Ajax_Comments::gpur_comment_dropdown_filters( get_the_ID() ); ?>
		<?php endif; ?>
				
		<ol class="comment-list">

			<?php
		
				echo GPUR_Ajax_Comments::gpur_display_comment_count( get_comments_number() );
			
				wp_list_comments( array(
					'type' => apply_filters( 'gpur_comment_list_type', 'all' ),
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => function_exists( 'twentyseventeen_get_svg' ) ? twentyseventeen_get_svg( array( 'icon' => 'mail-reply' ) ) : '' . esc_html__( 'Reply', 'gpur' ),
					'callback' => 'gpur_comment_template',
				) );
			
			?>
		
		</ol>
	
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<div class="gpur-pagination gpur-pagination-numbers gpur-standard-pagination">
				<?php paginate_comments_links( array( 'type' => 'list', 'next_text' => '&raquo;', 'prev_text' => '&laquo;' ) ); ?>
			</div>
		<?php }

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'gpur' ); ?></p>
		<?php
		endif;

		comment_form();
		?>

	</div><!-- #comments -->
	
<?php }