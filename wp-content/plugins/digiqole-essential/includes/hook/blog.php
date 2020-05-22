<?php 

function digiqole_custom_feature_post_meta() {
   add_meta_box( 'digiqole_feature_post_meta', __( 'Featured Posts', 'digiqole-essential' ), 'digiqole_meta_callback', 'post' );
}

function digiqole_meta_callback( $post ) {
   $featured = get_post_meta( $post->ID );
   ?>

  <p>
      <div class="digiqole-row-content">
         <label for="digiqole_featured_post">
            <input type="checkbox" name="digiqole_featured_post" id="digiqole_featured_post" value="yes" <?php if ( isset ( $featured['digiqole_featured_post'] ) ) checked( $featured['digiqole_featured_post'][0], 'yes' ); ?> />
            <?php _e( 'Featured this post', 'digiqole-essential' )?>
         </label>
      </div>
   </p>

   <?php
}

add_action( 'add_meta_boxes', 'digiqole_custom_feature_post_meta' );

function digiqole_feature_post_meta_save( $post_id ) {
 
   $is_autosave = wp_is_post_autosave( $post_id );
   $is_revision = wp_is_post_revision( $post_id );
   $is_valid_nonce = ( isset( $_POST[ 'digiqole_nonce' ] ) && wp_verify_nonce( $_POST[ 'digiqole_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

   if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
       return;
   }

   if( isset( $_POST[ 'digiqole_featured_post' ] ) ) {
      update_post_meta( $post_id, 'digiqole_featured_post', 'yes' );
   } else {
      update_post_meta( $post_id, 'digiqole_featured_post', 'no' );
   }

}
add_action( 'save_post', 'digiqole_feature_post_meta_save' );