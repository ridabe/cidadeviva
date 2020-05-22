<li <?php comment_class( '', $comment ); ?> id="comment-<?php echo $comment->comment_ID; ?>" itemscope itemtype="http://schema.org/Comment">

	<div class="comment-body" style="<?php echo esc_attr( $border_color ); ?>">

		<?php echo get_avatar( $comment, 60 ); ?>

		<div class="gpur-comment-content">

			<?php if ( '0' === $comment->comment_approved ) { ?>
	
				<p class="gpur-comment-meta"><em><?php esc_html_e( 'Your comment is awaiting approval.', 'gpur' ); ?></em></p>
	
			<?php } else { ?>
								
				<p class="gpur-comment-meta">
	
					<strong itemprop="author">	
						<?php printf( '%s', get_comment_author_link( $comment ) ); ?>
					</strong>

					<time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>">
						<?php echo get_comment_date( get_option( 'date_format' ), $comment ); ?>, <?php echo get_comment_time( get_option( 'time_format' ), $comment ); ?>
					</time>

				</p>				

			<?php } ?>
	
			<div itemprop="description" class="gpur-comment-description"><?php comment_text( $comment ); ?></div>
	
			<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'gpur' ), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

		</div>	

	</div>