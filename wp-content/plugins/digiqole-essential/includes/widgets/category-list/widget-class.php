<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

/**************************************************************
                START CLASSS WpCategoriesWidget 
**************************************************************/
class Digiqole_Category_List extends WP_Widget {


	function __construct() {
        $widget_opt = array(
            'classname'		 => 'digiqole-category-list',
            'description'	 => esc_html__('Digiqole category list','digiqole-essential')
        );

        parent::__construct( 'digiqole-category-list', esc_html__( 'Digiqole category list', 'digiqole-essential' ), $widget_opt );
    }

	
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		$va_category_HTML ='<div class="widgets_category ts-category-list-item">';
		if ( ! empty( $instance['digiqole_title'] ) && !$instance['digiqole_hide_title']) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['digiqole_title'] ) . $args['after_title'];
		}
		
		if($instance['digiqole_taxonomy_type']){
			$va_category_HTML .='<ul class="ts-category-list">';
				$args_val = array( 'hide_empty=0' );				
				$excludeCat= $instance['digiqole_selected_categories'] ? $instance['digiqole_selected_categories'] : '';
				$digiqole_action_on_cat= $instance['digiqole_action_on_cat'] ? $instance['digiqole_action_on_cat'] : '';
				if($excludeCat && $digiqole_action_on_cat!='')
				$args_val[$digiqole_action_on_cat] = $excludeCat;
				
				$terms = get_terms( $instance['digiqole_taxonomy_type'], $args_val );
				
				if ( $terms ) {	

					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term );
						
						if ( is_wp_error( $term_link ) ) {
						continue;
						}
						
					$carrentActiveClass='';	
					$category_image = '';
					if($term->taxonomy=='category' && is_category())
					{
                 $thisCat = get_category(get_query_var('cat'),false);
              
                
					  if($thisCat->term_id == $term->term_id)
						$carrentActiveClass='class="active-cat"';
				    }
					 
					if(is_tax())
					{
					    $currentTermType = get_query_var( 'taxonomy' );
					    $termId= get_queried_object()->term_id;
						 if(is_tax($currentTermType) && $termId==$term->term_id)
                    $carrentActiveClass='class="active-cat"';
                    
					}
                  
                  if ( defined( 'FW' ) ) {
                  $category_featured_image = fw_get_db_term_option($term->term_id, 'category', 'featured_upload_img');
                     if(isset($category_featured_image['url'])){
                        $category_image = $category_featured_image['url'];
                        $category_image = 'style="background-image:url('.esc_url( $category_image ).');"';
                     } 

                  }   
						$va_category_HTML .='<li '.$carrentActiveClass.'><a '.wp_kses_post($category_image).' href="' . esc_url( $term_link ) . '"><span>' . $term->name ;
						if (empty( $instance['digiqole_hide_count'] )) {

						$va_category_HTML .='</span><span class="bar"></span> <span class="category-count">'.$term->count.'</span>';
						}
						$va_category_HTML .='</a></li>';
					}
				}
			$va_category_HTML .='</ul>';
			
			}	
		$va_category_HTML .='</div>';

		echo wp_kses_post($va_category_HTML);
		echo $args['after_widget'];
	}


	public function form( $instance ) {
		$digiqole_title 				= ! empty( $instance['digiqole_title'] ) ? $instance['digiqole_title'] : esc_html__( 'WP Categories', 'digiqole-essential' );
		$digiqole_hide_title 			= ! empty( $instance['digiqole_hide_title'] ) ? $instance['digiqole_hide_title'] : '';
		$digiqole_taxonomy_type 			= ! empty( $instance['digiqole_taxonomy_type'] ) ? $instance['digiqole_taxonomy_type'] : esc_html__( 'category', 'digiqole-essential' );
		$digiqole_selected_categories 	= (! empty( $instance['digiqole_selected_categories'] ) && ! empty( $instance['digiqole_action_on_cat'] ) ) ? $instance['digiqole_selected_categories'] : '';
		$digiqole_action_on_cat 			= ! empty( $instance['digiqole_action_on_cat'] ) ? $instance['digiqole_action_on_cat'] : '';
		$digiqole_hide_count 			= ! empty( $instance['digiqole_hide_count'] ) ? $instance['digiqole_hide_count'] : '';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'digiqole_title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'digiqole_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'digiqole_title' ) ); ?>" type="text" value="<?php echo esc_attr( $digiqole_title ); ?>">
		</p>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'digiqole_hide_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'digiqole_hide_title' ) ); ?>" type="checkbox" value="1" <?php checked( $digiqole_hide_title, 1 ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id( 'digiqole_hide_title' ) ); ?>"><?php _e( esc_attr( 'Hide Title' ) ); ?> </label> 
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'digiqole_taxonomy_type' ) ); ?>"><?php _e( esc_attr( 'Taxonomy Type:' ) ); ?></label> 
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'digiqole_taxonomy_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'digiqole_taxonomy_type' ) ); ?>">
					<?php 
					$args = array(
					  'public'   => true,
					  '_builtin' => false
					  
					); 
					$output = 'names'; // or objects
					$operator = 'and'; // 'and' or 'or'
					$taxonomies = get_taxonomies( $args, $output, $operator ); 
					array_push($taxonomies,'category');
					if ( $taxonomies ) {
					foreach ( $taxonomies as $taxonomy ) {

						echo '<option value="'.$taxonomy.'" '.selected($taxonomy,$digiqole_taxonomy_type).'>'.$taxonomy.'</option>';
					}
					}

				?>    
		</select>
		</p>
		<p>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'digiqole_action_on_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'digiqole_action_on_cat' ) ); ?>">
           <option value="" <?php selected($digiqole_action_on_cat,'' )?> > <?php echo esc_html__('Show All Category','digiqole-essential').' :'; ?> </option>       
           <option value="include" <?php selected($digiqole_action_on_cat,'include' )?> > <?php echo esc_html__("Include Selected Category:","digiqole-essential"); ?> </option>       
           <option value="exclude" <?php selected($digiqole_action_on_cat,'exclude' )?> > <?php echo esc_html__("Exclude Selected Category","digiqole-essential").' :'; ?> </option>
		</select> 
		<select class="widefat digiqole-category-widget" id="<?php echo esc_attr( $this->get_field_id( 'digiqole_selected_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'digiqole_selected_categories' ) ); ?>[]" multiple>
					<?php 			
					if($digiqole_taxonomy_type){
					$args = array( 'hide_empty=0' );
					$terms = get_terms( $digiqole_taxonomy_type, $args );
			        echo '<option value="" '.selected(true, in_array('',$digiqole_selected_categories), false).'>'.esc_html('None ','digiqole-essential').'</option>';
					if ( $terms ) {
					foreach ( $terms as $term ) {
						echo '<option value="'.$term->term_id.'" '.selected(true, in_array($term->term_id,$digiqole_selected_categories), false).'>'.$term->name.'</option>';
					}
				    	
					}
				}

				?>    
		</select>
		</p>
		<p>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'digiqole_hide_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'digiqole_hide_count' ) ); ?>" type="checkbox" value="1" <?php checked( $digiqole_hide_count, 1 ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id( 'digiqole_hide_count' ) ); ?>"><?php echo esc_attr__( 'Hide Count','digiqole-essential' ) ; ?> </label> 
		</p>
		<p><a href="mailto:tripples@gmail.com"> <?php echo esc_html__('Contact to Author','digiqole-essential'); ?> </a></p>
		<?php 
	}

	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['digiqole_title'] 					= ( ! empty( $new_instance['digiqole_title'] ) ) ? strip_tags( $new_instance['digiqole_title'] ) : '';
		$instance['digiqole_hide_title'] 			= ( ! empty( $new_instance['digiqole_hide_title'] ) ) ? strip_tags( $new_instance['digiqole_hide_title'] ) : '';
		$instance['digiqole_taxonomy_type'] 			= ( ! empty( $new_instance['digiqole_taxonomy_type'] ) ) ? strip_tags( $new_instance['digiqole_taxonomy_type'] ) : '';
		$instance['digiqole_selected_categories'] 	= ( ! empty( $new_instance['digiqole_selected_categories'] ) ) ? $new_instance['digiqole_selected_categories'] : '';
		$instance['digiqole_action_on_cat'] 			= ( ! empty( $new_instance['digiqole_action_on_cat'] ) ) ? $new_instance['digiqole_action_on_cat'] : '';
		$instance['digiqole_hide_count'] 			= ( ! empty( $new_instance['digiqole_hide_count'] ) ) ? strip_tags( $new_instance['digiqole_hide_count'] ) : '';
		return $instance;
	}
}