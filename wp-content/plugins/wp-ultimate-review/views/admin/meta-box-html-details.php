<div class="xs-review-box details-xs-review wur-meta-box-container wur-login-main-wrapper" id="xs-review-box">
	<div class="content-xs-review-box">
		<!-- Review overview enable-->
		<div class="xs-wp-review-field">
			<div class="xs-wp-review-field-label">
				<label class="wur-sec-title" for="overview_enable"><?php echo esc_html__('Overview Enable', 'wp-ultimate-review'); ?></label>
			</div>
			<div class="xs-wp-review-field-option">
				<input class="review_switch_button" type="checkbox" id="overview_enable" name="<?php echo esc_attr($overview_setting_optionKey);?>[overview][enable]" value="Yes" <?php echo (isset($return_data_overview_setting->overview->enable) && $return_data_overview_setting->overview->enable == 'Yes') ? 'checked' : ''; ?> >	
				<label for="overview_enable" onclick="xs_review_show_hide(2);" class="review_switch_button_label"></label>
			</div>
		</div>
	</div>
	
	<div id="xs_review_tr__2" class="wur-meta-main-content content-xs-review-box deactive_tr  <?php echo isset($return_data_overview_setting->overview->enable) ? 'active_tr' : '';?>">
		<!-- Review Type-->
		
		<div class="xs-wp-review-field wur-single-item">
			<div class="xs-wp-review-field-label">
				<label class="wur-sec-title" for="review_score_style_id"> <?php echo esc_html__('Review Style', 'wp-ultimate-review'); ?></label>
			</div>
			<div class="xs-wp-review-field-option">
				<?php
					// global score styles
					$review_score_style = isset($return_data_global_setting['review_score_style']) ? $return_data_global_setting['review_score_style'] : 'star';
					
					// overview score style
					$selectReviewScoreStyle = isset($return_data_overview_setting->overview->style) ? $return_data_overview_setting->overview->style : $review_score_style;
					?>
				<div class="wur-global-select-wrapper">
					<select class="wur-global-select" name="<?php echo esc_attr($overview_setting_optionKey);?>[overview][style]" id="review_score_style_id" >					   
						<?php
						foreach($this->review_style AS $reviewStyleKey=>$reviewStyleValue):
						?>
						<option value="<?php echo esc_html($reviewStyleKey);?>" <?php if($selectReviewScoreStyle == $reviewStyleKey){ echo 'selected';}?> > <?php echo esc_html__($reviewStyleValue, 'wp-ultimate-review');?> </option>
						<?php endforeach;?>
					</select>
				</div>
			</div>
		</div>
		<!-- Overview Headding-->
		<div class="xs-wp-review-field wur-single-item">
			<div class="xs-wp-review-field-label">
				<label class="wur-sec-title" for="wp_review_heading"> <?php echo esc_html__('Heading', 'wp-ultimate-review'); ?></label>
			</div>
			<div class="xs-wp-review-field-option">
				<?php
					$selectOverviewHeading = isset($return_data_overview_setting->overview->heading) ? $return_data_overview_setting->overview->heading : 'Overview';
				?>
				<input id="wp_review_heading" class="wur-global-input" type="text" placeholder="Overview heading" value="<?php echo esc_attr($selectOverviewHeading);?>" name="<?php echo esc_attr($overview_setting_optionKey);?>[overview][heading]">
				
			</div>
		</div>
		
		<div class="xs-wp-review-field wur-single-item wur-single-item-top">
			<div class="xs-wp-review-field-label">
				<label for="overview_summary_enable" class="wur-sec-title"><?php echo esc_html__('Summary Enable', 'wp-ultimate-review'); ?></label>
			</div>
			<div class="xs-wp-review-field-option">
				<input class="review_switch_button" type="checkbox" id="overview_summary_enable" name="<?php echo esc_attr($overview_setting_optionKey);?>[overview][summary][enable]" value="Yes" <?php echo (isset($return_data_overview_setting->overview->summary->enable) && $return_data_overview_setting->overview->summary->enable == 'Yes') ? 'checked' : ''; ?> >	
				<label for="overview_summary_enable" class="review_switch_button_label"></label>
			
				<div class="wur-input-list">
					<?php
						$selectOverviewSummary = isset($return_data_overview_setting->overview->summary->data) ? $return_data_overview_setting->overview->summary->data : '';
					?>
					<textarea class="wur-global-text-area" type="text" placeholder="Overview summary" name="<?php echo esc_attr($overview_setting_optionKey);?>[overview][summary][data]"><?php echo esc_html($selectOverviewSummary);?></textarea>
				</div>
			</div>
		</div>

		<div class="xs-wp-review-field wur-single-item">
			<div class="xs-wp-review-field-label">
				<label for="overview_average_enable" class="wur-sec-title"><?php echo esc_html__('Average Enable', 'wp-ultimate-review'); ?></label>
			</div>
			<div class="xs-wp-review-field-option">
				<input class="review_switch_button" type="checkbox" id="overview_average_enable" name="<?php echo esc_attr($overview_setting_optionKey);?>[overview][average][enable]" value="Yes" <?php echo (isset($return_data_overview_setting->overview->average->enable) && $return_data_overview_setting->overview->average->enable == 'Yes') ? 'checked' : ''; ?> >	
				<label for="overview_average_enable" class="review_switch_button_label"></label>
			
			</div>
		</div>
		<div class="xs-wp-review-field wur-single-item wur-single-item-top">
			<div class="xs-wp-review-field-label">
				<label for="overview_ratting_enable" class="wur-sec-title"><?php echo esc_html__('Rating Enable', 'wp-ultimate-review'); ?></label>
			</div>
			<div class="xs-wp-review-field-option">
				<input class="review_switch_button" type="checkbox" id="overview_ratting_enable" name="<?php echo esc_attr($overview_setting_optionKey);?>[overview][ratting][enable]" value="Yes" <?php echo (isset($return_data_overview_setting->overview->ratting->enable) && $return_data_overview_setting->overview->ratting->enable == 'Yes') ? 'checked' : ''; ?> >	
				<label for="overview_ratting_enable" class="review_switch_button_label"></label>
				
				<div class="wur-input-list">
					<textarea class="wur-global-text-area">[wp-reviews-rating post-id="<?php echo esc_attr($post->ID);?>" ratting-show="yes" count-show="yes" vote-show="yes" vote-text="Votes" class=""]</textarea>
					<div class="wur-review-type-help-label"><?php echo esc_html__('Shortcode Rating ', 'wp-ultimate-review'); ?></div>
				</div>
			
			</div>
		</div>
		
		<div class="xs-wp-review-field overview-item">
			<div class="xs-wp-review-field-label">
				<label for="xs-wp_review_type" class="wur-sec-title"> <strong><?php echo esc_html__('Review Itam', 'wp-ultimate-review'); ?></strong></label>
			</div>
			<?php
			$review_score_style_input = isset($return_data_global_setting['review_score_input']) ? $return_data_global_setting['review_score_input'] : 'star';
			
			$review_score_limit = isset($return_data_global_setting['review_score_limit']) ? $return_data_global_setting['review_score_limit'] : 5;
			
			if(in_array($selectReviewScoreStyle, ['percentage', 'pie']) ):
				$review_score_style_input = 'slider';
			endif;
			?>
			
		</div>
		
		<div class="repater-overview-item" id="repater_review_item">
			<button type="button" class="xs-review-btnAdd xs-review-add-button xs-review-btn xs-btn btn-special small"><span class="dashicons dashicons-plus"></span><?php echo esc_html__('Add', 'wp-ultimate-review'); ?></button>
			<?php
				$selectOverviewReapter = isset($return_data_overview_setting->overview->item) ? count( $return_data_overview_setting->overview->item) : 3;
				$dataName = '';
				$dataRatting = '';
				for($rep = 0; $rep < $selectOverviewReapter; $rep++):
					$inceRep = $rep+1;
					
					$dynamiCkey = $rep;
					$dataName = isset($return_data_overview_setting->overview->item[$dynamiCkey]->name) ? $return_data_overview_setting->overview->item[$dynamiCkey]->name : '';
					
					$dataRatting = isset($return_data_overview_setting->overview->item[$dynamiCkey]->ratting) ? $return_data_overview_setting->overview->item[$dynamiCkey]->ratting : '3';
					
					$dataRattingRange = isset($return_data_overview_setting->overview->item[$dynamiCkey]->rat_range) ? $return_data_overview_setting->overview->item[$dynamiCkey]->rat_range : $review_score_limit;
			?>
			
			<div class="reapter-div-xs">
				<div class="xs-wp-review-field overview-item-repeater">
					<div class="xs-wp-review-field-label">
						<label for="xs_review_<?php echo esc_attr($rep);?>_name" data-pattern-text="Itam Name +=1" class="wur-sec-title"> <?php echo esc_html__('Itam Name', 'wp-ultimate-review'); ?> </label>
					</div>
					<div class="xs-wp-review-field-option">
						<input type="text" value="<?php echo esc_attr($dataName);?>" name="<?php echo esc_attr($overview_setting_optionKey);?>[overview][item][<?php echo esc_attr($rep);?>][name]" data-pattern-name="<?php echo esc_attr($overview_setting_optionKey);?>[overview][item][++][name]" id="xs_review_<?php echo esc_attr($rep);?>_name" data-pattern-id="xs_review_++_name" class="wur-global-input">
					</div>
				</div>
				<div class="xs-wp-review-field overview-item-repeater">
					<div class="xs-wp-review-field-label">
						<label for="xs_review_<?php echo esc_attr($rep);?>_ratting" data-pattern-text="Ratting +=1" class="wur-sec-title"> <?php echo esc_html__('Ratting', 'wp-ultimate-review'); ?></label>
					</div>
					<div class="xs-wp-review-field-option">
						
						<div class="xs-review xs-select" >
								<?php if( in_array($review_score_style_input, array('star', 'square','movie', 'bar', 'pill')) ):?>
								<div class="xs-review-rating-stars text-center">
									<ul id="xs_review_stars" class="xs_review_stars">
										<?php for($ratting = 1; $ratting <= $dataRattingRange; $ratting++ ):?>
										  <li class="star-li <?php echo esc_attr($review_score_style_input);?>  <?php if($ratting <= $dataRatting){echo 'selected';}?>" data-value="<?php echo esc_attr($ratting);?>" onclick="click_xs_review_data()">
											<?php if($review_score_style_input == 'star'){?>
											<i class="xs-star dashicons-before dashicons-star-filled"></i>
											<?php }else{ echo '<span>'.esc_html($ratting).'<span>';}?>
										  </li>
										  <?php endfor;?>
									</ul>
									 <input type="number" class="right-review-ratting wur-global-input wur-number-input" value="<?php echo esc_attr($dataRatting);?>" name="<?php echo esc_attr($overview_setting_optionKey);?>[overview][item][<?php echo esc_attr($rep);?>][ratting]" data-pattern-name="<?php echo esc_attr($overview_setting_optionKey);?>[overview][item][++][ratting]" id="xs_review_<?php echo esc_attr($rep);?>_ratting" data-pattern-id="xs_review_++_ratting" >
									
								</div>
								<?php endif;
								if($review_score_style_input == 'slider'):?>
								<div class="xs-review-rating-slider text-center">
									<div class="xs-slidecontainer">
									  <input type="range" min="1" max="<?php echo esc_html($dataRattingRange);?>" value="<?php echo esc_attr($dataRatting);?>"  name="<?php echo esc_attr($overview_setting_optionKey);?>[overview][item][<?php echo esc_attr($rep);?>][ratting]" class="xs-slider-range" id="xs_review_range" data-pattern-name="<?php echo esc_attr($overview_setting_optionKey);?>[overview][item][++][ratting]" id="xs_review_<?php echo esc_attr($rep);?>_ratting" data-pattern-id="xs_review_++_ratting" onchange="click_xs_review_data_slider(this)">
									  	
									</div>
									<div id="review_data_show"> <?php echo esc_html($dataRatting);?></div>
								</div>
								<?php 	
								 endif;
								?>
							</div>
							
					</div>
				</div>
				<button type="button" class="xs-review-btnRemove xs-review-remove-button xs-review-btn xs-btn btn-danger small"><span class="dashicons dashicons-no-alt"></span></button>
			</div>
			<?php endfor; ?>
		</div>
	
	</div>
</div>

<script type="text/javascript">
/*Reapter data*/
jQuery(document).ready(function($){
	
	var numberOfRowXs = '<?php echo esc_html(($selectOverviewReapter - 1));?>';
	var numberOfRowXsKey = '<?php echo esc_html($overview_setting_optionKey);?>';
	
	$('#repater_review_item').repeater({
		  btnAddClass: 'xs-review-btnAdd',
		  btnRemoveClass: 'xs-review-btnRemove',
		  groupClass: 'reapter-div-xs',
		  minItems: 1,
		  maxItems: 0,
		  startingIndex: parseInt(numberOfRowXs),
		  showMinItemsOnLoad: false,
		  reindexOnDelete: true,
		  repeatMode: 'append',
		  animation: 'fade',
		  animationSpeed: 400,
		  animationEasing: 'swing',
		  clearValues: true
	  }, [] 
	  );
});
</script>