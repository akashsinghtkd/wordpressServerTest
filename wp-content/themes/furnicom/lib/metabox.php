<?php 
/*
	* Name: Metabox Page
	* Develope: Smartaddons
*/

/*
** Build array
*/
function furnicom_build_array( $case ){
	$build_arr = array();
	if( $case == 'page' ) :
		$build_arr = array( '' => esc_html__( 'Select Page', 'furnicom' ) );
		$pages = get_pages(); 
		foreach( $pages as $page ) {
			$build_arr[$page->ID] = $page->post_title;
		}
	elseif( $case == 'sidebar' ) :
		$wp_registered_sidebars = furnicom_widget_setup_args();
		$build_arr = array( '' => esc_html__( 'Select Sidebar', 'furnicom' ) );
		foreach( $wp_registered_sidebars as $sidebar ) {
			$build_arr[$sidebar['id']] = $sidebar['name'];
		}
	endif;
	return $build_arr;
}

/*
** Metabox array define
*/
function furnicom_metabox_init(){
	$furnicom_metabox_pages[] = array(
		'title' 	=> esc_html__( 'General', 'furnicom' ),
		'fields'	=> array(	
			array(
				'type'	=> 'upload',
				'title'	=> esc_html__( 'Custom Logo', 'furnicom' ),
				'id'	=> 'page_logo',
				'description' => esc_html__( 'Upload custom Logo for this page', 'furnicom' ),
				'std' => ''
			),		
			array(
				'type'	=> 'select',
				'title'	=> esc_html__( 'Home Template', 'furnicom' ),
				'id'	=> 'page_home_template',
				'description' => esc_html__( 'Select home template', 'furnicom' ),
				'std'	 => '',
				'values' => array( '' => esc_html__( 'Select Home Style', 'furnicom' ), 'page-home' => esc_html__( 'Home Style1', 'furnicom' ), 'page-home2' => esc_html__( 'Home Style2', 'furnicom' ), 'page-home3' => esc_html__( 'Home Style3', 'furnicom' ),
					'page-home4' => esc_html__( 'Home Style4', 'furnicom' ), 'page-home5' => esc_html__( 'Home Style5', 'furnicom' ), 'page-home6' => esc_html__( 'Home Style6', 'furnicom' ), 
					'page-home7' => esc_html__( 'Home Style7', 'furnicom' ), 'page-home8' => esc_html__( 'Home Style8', 'furnicom' ), 'page-home9' => esc_html__( 'Home Style9', 'furnicom' ), 'page-home10' => esc_html__( 'Home Style10', 'furnicom' ),	
				'page-home11' => esc_html__( 'Home Style11', 'furnicom' ),	
			    'page-home12' => esc_html__( 'Home Style12', 'furnicom' ),
			    'page-home13' => esc_html__( 'Home Style13', 'furnicom' ),
			    'page-home14' => esc_html__( 'Home Style14', 'furnicom' ),
			    'page-home15' => esc_html__( 'Home Style15', 'furnicom' ),
		     )
	           
			)
		)
	);
	
	return $furnicom_metabox_pages;
}
add_action( 'init', 'furnicom_metabox_init' );

add_action( 'admin_init', 'furnicom_page_init' );
function furnicom_page_init(){
	add_meta_box( 'furnicom_page_meta', esc_html__( 'Page Metabox', 'furnicom' ), 'furnicom_page_meta', array( 'page' ), 'normal', 'low' );
	add_action( 'save_post', 'furnicom_page_save_meta', 10, 1 );
}	

/*
** Metabox HTML
*/
function furnicom_page_meta(){
global $post;
	$ya_metabox_pages = furnicom_metabox_init();
	$except_args = array( 'General', 'Typography' );
	$current_screen =  get_current_screen()->post_type;
	wp_nonce_field( 'furnicom_page_save_meta', 'ya_metabox_plugin_nonce' );
	if( in_array( $current_screen, array( 'page' ) ) ) : 
		wp_enqueue_style( 'metabox_style', get_template_directory_uri() . '/lib/admin/css/metabox.css', array(), null );
		wp_enqueue_script( 'tab_script', get_template_directory_uri() . '/lib/admin/js/tab.js', array(), null, true );
		wp_enqueue_script( 'shoppystore-opts-field-radio_img-js',	Furnicom_URL.'/options/fields/radio_img/field_radio_img.js',	array('jquery'), time(), true	);
	endif; 
?>
	<div class="furnicom-metabox" id="ya_metabox">
		<div class="furnicom-metabox-content">
			<ul class="nav nav-tabs">
			<?php 
				$i = 0;
				foreach( $ya_metabox_pages as $metabox ){ 				
					$active = ( $i == 0 ) ? 'active' : '';
					echo '<li class="' . esc_attr( $active ) . '"><a href="#ya_'. strtolower( $metabox['title'] ) .'" data-toggle="tab">' . $metabox['title'] . '</a></li>';
					$i ++;
				} 
			?>
			</ul>
			<div class="tab-content">
			<?php 
				$i = 0;
				foreach( $ya_metabox_pages as $metabox ){ 
					$active = ( $i == 0 ) ? 'active' : '';	
					if( ( $current_screen == 'post' || $current_screen == 'product' ) && ( in_array( $metabox['title'], $except_args ) ) ){
						continue;
					}
			?>
				<div class="tab-pane <?php echo esc_attr( $active ); ?>" id="ya_<?php echo strtolower( $metabox['title'] ) ; ?>">
					<?php if( isset( $metabox['fields'] ) && count( $metabox['fields'] ) > 0 ) {?>
						<?php 
							foreach( $metabox['fields'] as $meta_field ) { 
							$values = isset( $meta_field['values'] ) ? $meta_field['values'] : '';
						?>
							<div class="tab-inner clearfix">
								<div class="flytab-description pull-left">
								
									<!-- Title meta field -->
									<?php if( $meta_field['title'] != '' ) { ?>
									<div class="flytab-item-title">
										<?php echo $meta_field['title']; ?>
									</div>
									<?php } ?>
									
									<!-- Description -->
									<?php if( $meta_field['description'] != '' ) { ?>
									<div class="flytab-item-shortdes">
										<?php echo $meta_field['description']; ?>
									</div>
									<?php } ?>
								</div>
								<!-- Meta content -->
								<div class="flytab-content">
									<?php funicom_render_html( $meta_field['id'], $meta_field['type'], $values, $meta_field['std'] ); ?>									
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			<?php $i ++; } ?>
			</div>
		</div>
	</div>
<?php 
}

/*
** Function Render HTML
*/
function funicom_render_html( $id, $type, $values, $std ){
	global $post;
	$meta_value = '';
	if( get_post_meta( $post->ID, $id, true ) != '' ){
			$meta_value = get_post_meta( $post->ID, $id, true );
	}else if( isset( $std ) && $std != '' ){
		$meta_value = $std;
	}
	$html = '';
	switch( $type ) {
		case 'text' :
			$html .= '<input type="text" value="'. esc_attr( $meta_value ) .'" id="'. esc_attr( $id ) .'" name="'. esc_attr( $id ) .'"/>';
		break;
		
		case 'textarea' :
			$html .= '<texarea id="'. esc_attr( $id ) .'" name="'. esc_attr( $id ) .'"/>'. esc_attr( $meta_value ) .'</texarea>';
		break;
		
		case 'editor' :
			wp_editor( $meta_value, $id, array() );
		break;
		
		case 'select' :
			$html .= '<select id="'. esc_attr( $id ) .'" name="'. esc_attr( $id ) .'">';
				foreach( $values as $key => $value ) {
					$html .= '<option value="'. esc_attr( $key ) .'" '. selected( $meta_value, $key, false ) .'>'. $value .'</option>';
				}
			$html .= '</select>';
		break;
		
		case 'multiselect' :
			$multi_value = array();
			if( is_array( $meta_value ) ){
				$multi_value = $meta_value;
			}else{
				$multi_value[] = $meta_value;
			}
			$select_value = $multi_value;
			$html .= '<select id="'. esc_attr( $id ) .'" name="'. esc_attr( $id ) .'[]" multiple>';
				foreach( $values as $key => $value ) {
					$check = ( in_array( $key, $select_value ) ) ? 'selected="selected"' : '';
					$html .= '<option value="'. esc_attr( $key ) .'" '. $check .'>'. $value .'</option>';
				}
			$html .= '</select>';
		break;
		
		case 'checkbox' :
			$html .= '<input type="checkbox" name="'. esc_attr( $id ) .'" value="yes" '. checked( $meta_value, 'yes', false ) .'/>';
		break;
		
		case 'radio_img' :
			$i = 0;
			$html .= '<div class="page-metabox-radio-img">';
			foreach( $values as $key => $value ) {
				$selected = ( checked( $meta_value, $key, false ) != '' ) ? ' shoppystore-radio-img-selected' : '';
				$html .= '<label class="radio-label shoppystore-radio-img'.$selected.' shoppystore-radio-img-'. esc_attr( $id ) .'" for="'. esc_attr( $id ) .'_'. $i .'">';
				$html .= '<input type="radio" id="'. esc_attr( $id ) .'_'. $i .'" name="'. esc_attr( $id ) .'" value="'. esc_attr( $key ) .'" '.checked($meta_value, $key, false).'/>';
				$html .= '<div class="page-radio-color" style="background: '. esc_attr( $value ) .'" onclick="jQuery:ya_radio_img_select(\''. esc_attr( $id ) .'_'. $i .'\', \''. esc_attr( $id ) .'\');"></div>';
				$html .= '<br/><span>'. esc_attr( $key ) .'</span>';
				$html .= '</label>';
				$i ++;
			}
			$html .= '</div>';
		break;
		
		case 'radio' :
			$i = 0;
			$html .= '<div class="page-metabox-radio">';
			foreach( $values as $key => $value ) {
				$html .= '<label class="radio-label '. esc_attr( $id ) .'" for="'. esc_attr( $id ) .'_'. $i .'">';
				$html .= '<input type="radio" id="'. esc_attr( $id ) .'_'. $i .'" name="'. esc_attr( $id ) .'" value="'. esc_attr( $key ) .'" '.checked($meta_value, $key, false).'/>';
				$html .= '';
				$html .= '<br/><span>'. esc_attr( $value ) .'</span>';
				$html .= '</label>';
				$i ++;
			}
			$html .= '</div>';
		break;
		
		case 'multicheckbox' :
			$multi_value = array();
			if( is_array( $meta_value ) ){
				$multi_value = $meta_value;
			}else{
				$multi_value[] = $meta_value;
			}
			$checkbox_value = $multi_value;
			foreach( $values as $key => $value ) {
				$check = ( in_array( $key, $checkbox_value ) ) ? 'checked' : '';
				$html .= '<div class="metabox-multicheck pull-left"><input type="checkbox" name="'. esc_attr( $id ) .'[]" value="'. esc_attr( $key ) .'" '. $check .'/>';
				$html .= '<br/><label>'. $value .'</label></div>';
			}
		break;
		
		case 'upload' :
			$upload_img = wp_get_attachment_image_url( $meta_value, 'thumbnail' ) ? wp_get_attachment_image_url( intval($meta_value), 'thumbnail' ) : '';
			ob_start();
		?>
			<div class="upload-formfield">
				<div id="metabox_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $upload_img ); ?>" alt="" width="30" height="30" /></div>
				<div class="metabox-thumbnail-wrapper">
					<input type="hidden" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $id ); ?>" value="<?php echo esc_attr( $meta_value ) ?>"/>
					<button type="button" class="upload_image_button button"><?php echo esc_html__( 'Upload/Add image', 'furnicom' ) ?></button>
					<button type="button" class="remove_image_button button"><?php echo esc_html__( 'Remove image', 'furnicom' ) ?></button>
				</div>
				<script type="text/javascript">

					// Only show the "remove image" button when needed
					if ( ! jQuery( '#<?php echo esc_js( $id ); ?>' ).val() ) {
						jQuery( '.remove_image_button' ).hide();
					}

					// Uploading files
					var file_frame;

					jQuery( document ).on( 'click', '.upload_image_button', function( event ) {

						event.preventDefault();

						// If the media frame already exists, reopen it.
						if ( file_frame ) {
							file_frame.open();
							return;
						}

						// Create the media frame.
						file_frame = wp.media.frames.downloadable_file = wp.media({
							title: '<?php esc_html_e( "Choose an image", 'furnicom' ); ?>',
							button: {
								text: '<?php esc_html_e( "Use image", 'furnicom' ); ?>'
							},
							multiple: false
						});

						// When an image is selected, run a callback.
						file_frame.on( 'select', function() {
							var attachment = file_frame.state().get( 'selection' ).first().toJSON();
							
							jQuery( '#<?php echo esc_js( $id ); ?>' ).val( attachment.id );
							console.log('#<?php echo esc_js( $id ); ?>');
							jQuery( '#metabox_thumbnail > img' ).attr( 'src', attachment.sizes.thumbnail.url );
							jQuery( '.remove_image_button' ).show();
						});

						// Finally, open the modal.
						file_frame.open();
					});

					jQuery( document ).on( 'click', '.remove_image_button', function() {
						jQuery( '#metabox_thumbnail > img' ).attr( 'src', 'http://placehold.it/30x30' );
						jQuery( '#<?php echo esc_js( $id ); ?>' ).val( '' );
						jQuery( '.remove_image_button' ).hide();
						return false;
					});

				</script>
				<div class="clear"></div>
			</div>
	<?php
			$html .= ob_get_clean();
		break;
		
		case 'color' :
			$color_value = isset( $meta_value ) ? $meta_value : $std;			
			$html .= '<input type="text" id="'.esc_attr( $id ).'" name="'. esc_attr( $id ) .'" value="'.esc_attr( $color_value ).'" class="shoppystore-popup-colorpicker" style="width:70px;"/>';
		break;
	}
	echo $html;
}

function furnicom_page_save_meta(){
	if( !is_admin() ){
		return;
	}
	global $post;
	$ya_metabox_pages = funicom_metabox_init(); 
	$current_screen =  get_current_screen()->post_type;
	if ( ! isset( $_POST['ya_metabox_plugin_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['ya_metabox_plugin_nonce'], 'furnicom_page_save_meta' ) ) {
		return;
	}
	foreach( $ya_metabox_pages as $key => $metabox ){ 
		foreach( $metabox['fields'] as $meta_field ) {
			$checkbox_val = isset( $_POST[$meta_field['id']] ) ? $_POST[$meta_field['id']] : 'no';
			update_post_meta( $post_id, $meta_field['id'], $checkbox_val );
			
			if( isset( $_POST[$meta_field['id']] ) ){
				$data = $_POST[$meta_field['id']];
				switch( $meta_field['type'] ) {
					case 'text' :
						$data = sanitize_text_field( $_POST[$meta_field['id']] );
					break;
					
					case 'email' :
						$data = sanitize_email( $_POST[$meta_field['id']] );
					break;
					
					case 'number' :
						$data = intval( $_POST[$meta_field['id']] );
					break;
					
					case 'upload' :
						$data = intval( $_POST[$meta_field['id']] );
					break;
					
					case 'radio_img' :
						$data = $_POST[$meta_field['id']];
					break;

				}
				update_post_meta( $post_id, $meta_field['id'], $data );
			}else{
				if( $meta_field['std'] != '' ){
					update_post_meta( $post_id, $meta_field['id'], $meta_field['std'] );
				}
			}
		}
	}
}

