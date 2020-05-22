<?php if ( post_password_required() ) {
	return;
}
	

/////////////////////////////////////// Comment Lists Template ///////////////////////////////////////

if ( ! function_exists( 'ghostpool_comment_template' ) ) {
	function ghostpool_comment_template( $comment, $args, $depth ) {

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

					<div class="comment-body">
						<p><?php esc_html_e( 'Pingback:', 'gpur' ); ?> <?php comment_author_link(); ?></p>
					</div>
	
			<?php break; 
	
			default :

				include( plugin_dir_path( __FILE__ ) . 'comments-list.php' );  

			break; 
	
		endswitch;

	}
}	

if ( comments_open() OR have_comments() ) { ?>
 
	<div id="comments" class="comments-area gpur-review-comments">
		
		<?php echo GPUR_Ajax_Comments::gpur_comment_rating_summary( get_the_ID() ); ?>
	
		<?php if ( have_comments() ) { ?>

			<!--<div class="gpur-divider-title-bg">
				<div class="gpur-divider-title"><?php comments_number( esc_html__( 'No Comments', 'gpur' ), esc_html__( '1 Comment', 'gpur' ), esc_html__( '% Comments', 'gpur' ) ); ?></div>
			</div>-->
			
			<?php echo GPUR_Ajax_Comments::gpur_comment_dropdown_filters( get_the_ID() ); ?>	
				
			<ol class="comment-list">
				<?php 
				
				echo GPUR_Ajax_Comments::gpur_display_comment_count( get_comments_number() );
				
				wp_list_comments( 'callback=ghostpool_comment_template' ); 
				
				?>
			</ol>
						
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
				<div class="gpur-pagination gpur-pagination-numbers gpur-standard-pagination">
					<?php paginate_comments_links( array( 'type' => 'list', 'next_text' => '&raquo;', 'prev_text' => '&laquo;' ) ); ?>
				</div>
			<?php } ?>	

			<?php if ( ! comments_open() && get_comments_number() ) { ?>
				<strong><?php esc_html_e( 'Comments are now closed for this post.', 'gpur' ); ?></strong>
			<?php } ?>
	
		<?php } ?>

		<?php

		$aria_req = ( $req ? " aria-required='true'" : '' );
		$required_text = sprintf( '' . esc_html__('Required fields are marked %s', 'gpur' ), '<span class="required">*</span>');
		
		$comment_args = array(

			'title_reply'       => esc_html__( 'Leave a Reply', 'gpur' ),
			'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'gpur' ),
			'cancel_reply_link' => esc_html__( 'Cancel Reply', 'gpur' ),
			'label_submit'      => esc_html__( 'Post Comment', 'gpur' ),

			'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'gpur' ) . ' ' . ( $req ? '*' : '' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',

			'must_log_in' => '<p class="must-log-in">' . sprintf( wp_kses( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'gpur' ), array( 'a' => array( 'href' => array() ) ) ), wp_login_url() ) . '</p>',

			'logged_in_as' => '<p class="logged-in-as">' .  sprintf( wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'gpur' ), array( 'a' => array( 'href' => array(), 'title' => array() ) ) ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',

			'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published. ', 'gpur' ) . ( $req ? $required_text : '' ) . '</p>',

			'comment_notes_after' => '<p class="form-allowed-tags">' . sprintf( wp_kses( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'gpur' ), array( 'abbr' => array( 'title' => array() ) ) ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',

			'fields' => apply_filters( 'comment_form_default_fields', array(

				'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_html__( 'Name', 'gpur' ) . ' ' . ( $req ? '*' : '' ) . '" ' . $aria_req . ' /></p>',

				'email' => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_html__( 'Email', 'gpur' ) . ' ' . ( $req ? '*' : '' ) . '" ' . $aria_req . ' /></p>',

				'url' => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . esc_html__( 'Website', 'gpur' ) . '" /></p>'

			) ),
	
		);
	
		comment_form( $comment_args );

		?>

	</div>
	
<?php } ?>