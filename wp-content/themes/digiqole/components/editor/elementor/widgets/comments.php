<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Digiqole_Comment_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'newszone-comment';
    }

    public function get_title() {
        return esc_html__( 'Comments', 'digiqole' );
    }

    public function get_icon() { 
        return 'eicon-comments';
    }

    public function get_categories() {
        return [ 'digiqole-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Comment settings', 'digiqole'),
            ]
        );
      
        $this->add_control(
         'comment_count',
         [
           'label'         => esc_html__( 'Comment count', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default'       => '4',

         ]
       );
     
       $this->add_control(
         'commnet_limit',
         [
           'label'         => esc_html__( 'Comment crop', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default'       => '15',
         
         ]
       );
      
     $this->add_control(
         'comment_order',
         [
             'label'     =>esc_html__( 'Comment order', 'digiqole' ),
             'type'      => Controls_Manager::SELECT,
             'default'   => 'DESC',
             'options'   => [
                     'DESC'      =>esc_html__( 'Descending', 'digiqole' ),
                     'ASC'       =>esc_html__( 'Ascending', 'digiqole' ),
                 ],
         ]
     );
  
      $this->add_responsive_control(
			'comment_align', [
				'label'			 => esc_html__( 'Alignment', 'digiqole' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

               'left'		 => [
                  
                  'title'	 => esc_html__( 'Left', 'digiqole' ),
						'icon'	 => 'fa fa-align-left',
               
               ],
				'center'	     => [
                  
                  'title'	 => esc_html__( 'Center', 'digiqole' ),
						'icon'	 => 'fa fa-align-center',
               
               ],
				'right'		 => [

						'title'	 => esc_html__( 'Right', 'digiqole' ),
                  'icon'	 => 'fa fa-align-right',
                  
					],
				'justify'	 => [

						'title'	 => esc_html__( 'Justified', 'digiqole' ),
                  'icon'	 => 'fa fa-align-justify',
                  
					],
				],
            'default'		 => 'left',
            
                'selectors' => [
                     '{{WRAPPER}} .author-comments' => 'text-align: {{VALUE}};',

				],
			]
        );//Responsive control end


        $this->add_control(
         'ts_offset_enable',
            [
               'label' => esc_html__('Enable comment skip', 'digiqole'),
               'type' => Controls_Manager::SWITCHER,
               'label_on' => esc_html__('Yes', 'digiqole'),
               'label_off' => esc_html__('No', 'digiqole'),
               'default' => 'no',
               
            ]
      );
      
      $this->add_control(
         'ts_offset_item_num',
         [
           'label'         => esc_html__( 'Skip comment count', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default'       => '1',
           'condition' => [ 'ts_offset_enable' => 'yes' ]

         ]
       );
       
        $this->end_controls_section();

       
        
        //Title Style Section
		$this->start_controls_section(
			'section_title_style', [
				'label'	 => esc_html__( 'Comments', 'digiqole' ),
				'tab'	    => Controls_Manager::TAB_STYLE,
			]
        );
       
        $this->add_control(
			'comment_color', [

				'label'		 => esc_html__( 'Comments color', 'digiqole' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [

               '{{WRAPPER}} .ts-comments-row .comment a' => 'color: {{VALUE}};',
				],
			]
        );
        $this->add_control(
			'comment_hover_color', [

				'label'		 => esc_html__( 'Comments hover color', 'digiqole' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [

               '{{WRAPPER}} .ts-comments-row .comment a:hover' => 'color: {{VALUE}};',
				],
			]
        );

        $this->add_control(
			'author_color', [

				'label'		 => esc_html__( 'Author color', 'digiqole' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [

                 '{{WRAPPER}} .ts-author,
                 {{WRAPPER}} .ts-author a,
                 {{WRAPPER}} .author-comments .author a' => 'color: {{VALUE}};',
				],
			]
        );

        $this->add_control(
			'date_color', [

				'label'		 => esc_html__( 'Date color', 'digiqole' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [

               '{{WRAPPER}} .ts-author-meta' => 'color: {{VALUE}};',
				],
			]
        );




        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'comments_typography',
				'label' => esc_html__( 'Comments', 'digiqole' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
               'selector' => '{{WRAPPER}} .ts-comments-row .comment a',
			]
        );
        
  

        $this->add_responsive_control(
			'item_margin',
			[
				'label' =>esc_html__( 'Item Margin', 'digiqole' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 50,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 40,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 30,
					'unit' => 'px',
            ],
            'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .row.ts-comments-row.align-items-center.mb-50' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
      );
        
        

    } //Register control end

    protected function render( ) { 

		$settings = $this->get_settings();
      $comment_count    = $settings['comment_count'];
      $comment_order    = $settings['comment_order'];
      $commnet_limit    = $settings['commnet_limit'];
      
      $args = array(
         'orderby' => 'comment_ID',
         'order'  => $comment_order,
         'number' => $comment_count,
         'suppress_filters' => false,
        
     );
     if($settings['ts_offset_enable']=='yes'){
      $args['offset'] = $settings['ts_offset_item_num'];
    }

     $comments_query = new \WP_Comment_Query;
     $comments = $comments_query->query( $args );
    
    ?>
      <?php if ( $comments ):  ?> 
         <div class="ts-author-comments">
            <?php foreach ( $comments as $comment ) : ?>
               <div class="row ts-comments-row align-items-center mb-50">
                  <div class="col-lg-4 col-md-2"> 
                     <div class="ts-author-media">
                        <div class="ts-author-thumb"> 
                            <?php  echo get_avatar( $comment->comment_author_email, 'ID' ); ?>
                        </div> 
                        <div class="ts-author-meta"> 
                           <?php 	echo date( 'd M y', strtotime( $comment->comment_date ) );?>
                        </div>
                     </div>

                  </div> 
                  <div class="col-lg-8 col-md-10">
                      <div class="ts-author-content">
                            <div class="comment"> 
                                <a href="<?php echo esc_url(get_post_permalink($comment->comment_post_ID)); ?> ">
                                    <?php echo esc_html(wp_trim_words($comment->comment_content,$commnet_limit,'') ); ?> 
                                    </a>
                                </div>
                            <div class="ts-author">
                                <?php echo esc_html__('by','digiqole'); ?> 
                                <a href="<?php echo esc_url($comment->comment_author_url); ?>" > 
                                    <?php echo esc_html($comment->comment_author); ?> 
                                </a> 
                            </div> 
                      </div>
                  </div> 
               </div>  
            <?php endforeach; ?>
         </div><!-- author comments end -->		
     <?php endif; ?> 
     
    <?php  

    }
    
    protected function _content_template() { }
}