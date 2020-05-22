<?php class GPUR_Elementor_Exploded_Textarea_Control extends Elementor\Base_Data_Control {

	public function get_type() {
		return 'gpur_exploded_textarea';
	}

    public function enqueue() {
	
	}
	
	protected function get_default_settings() {
		return [
			'label_block' => true,
			'rows' => 3,
		];
	}
	
	public function get_value( $control, $settings ) {

		if ( ! isset( $control['default'] ) ) {
			$control['default'] = $this->get_default_value();
		}
		if ( isset( $settings[ $control['name'] ] ) ) {
			$value = $settings[ $control['name'] ];
		} else {
			$value = $control['default'];
		}

		$list = '';
				
		if ( FALSE !== strpos( $value, 'Criterion 1,Criterion 2,Criterion 3,Criterion 4' ) ) {
		     $items = explode( ',', $value );
		} else {
		     $items = explode( "\n", $value );
		}
		     
		if ( $items ) {
			foreach( $items as $item ) {
				$list .= $item . "\n";
			}
		}
		return rtrim( $list, "\n" );
				
	}

	public function content_template() {
	
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<textarea id="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-tag-area" rows="{{ data.rows }}" data-setting="{{ data.name }}" placeholder="{{ data.placeholder }}"></textarea>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
		
	}

}