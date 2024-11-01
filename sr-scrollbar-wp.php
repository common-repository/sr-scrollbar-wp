<?php
/*
Plugin Name: sr-scrollbar-wp
Plugin URI:http://sohelrazzaque.com/plugins/sr-scrollbar-wp

Description:This pluging will added nice and easy scroll .you can change Auto Hide Scrollbar,change Theme mode, set here your Theme Height mode,scroll bar Position mode,scroll Buttons mode,wheelSpeed,wheelPropagation,scroll Inertia & other setting from <a href="options-general.php?page=scroll_bar-option-page">option panel</a>

Author:<a href="http://sohelrazzaque.com">sohel razzaque</a>
Author URI:http://sohelrazzaque.com
Version:1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

     /* Adding Latest jQuery from Wordpress */
function bappi_scroll_bar_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'bappi_scroll_bar_latest_jquery');



   /*Some Set-up*/
define('bappi_scroll_bar', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );


wp_enqueue_script('bappi-mCustomScrollbar-jquery', bappi_scroll_bar.'js/jquery.mCustomScrollbar.concat.min.js', array('jquery'));




wp_enqueue_style('bappi-perfect-css', bappi_scroll_bar.'css/jquery.mCustomScrollbar.css');



                      /*setting api */

        /*manu option 1.1 */

    function scroll_bar_manu(){
	
	     add_options_page( 'scroll_bar_manu_title', 'scroll_bar_setting_manu', 'manage_options', 'scroll_bar-option-page', 'bappi_scroll_bar_options_page_function', plugins_url( 'myplugin/images/icon.png' ),10 );
	
	             
	}
	     add_action('admin_menu','scroll_bar_manu');
		 
	  
	// 2. Add default value array. 
$bappi_scroll_bar_options_default = array(
	'scroll_bar_items_mode' => true,
	'theme_items_mode' => "3d",
	'set_Height_mode' => "auto",
	'scroll_bar_Position_mode' => "inside",
	'scroll_Buttons_mode' =>"{enable:false}",
	'mouse_Wheel_mode' =>"{deltaFactor:400}",
	'scroll_Inertia_mode' => 400,
	
);

   /*radio bottom option */
	
	$scroll_bar_items_mode=array(
	  'scroll_bar_items_yes'=>array(
	    'value'=>'true',
	    'label'=>'Active your auto Hide Scrollbar'
	  ),  

	  'scroll_bar_items_no'=>array(
	    'value'=>'false',
	    'label'=>'Deactive your auto Hide Scrollbar'
	  ),
	
	);



    if ( is_admin() ) : // 3. Load only if we are viewing an admin page	

  // 4. Add setting option by used function. 
function bappiscroll_bar_register_settings() {
	// Register settings and call sanitation functions
	// 4. Add register setting. 
	register_setting( 'bappiscroll_bar_p_options', 'bappi_scroll_bar_options_default', 'bappiscroll_bar_validate_options' );
}

add_action( 'admin_init', 'bappiscroll_bar_register_settings' );


 
	
	
   


 //1.2
	 function bappi_scroll_bar_options_page_function(){?>
	 
	 <?php // 5.1. Add settings API hook under form action.  ?>
	<?php global $bappi_scroll_bar_options_default,$scroll_bar_items_mode ;

	
	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. 

	?>
	 
	 
   <div class="wrap">
			      <h2>scrollbar setting</h2>
							  <?php if ( false !== $_REQUEST['updated'] ) : ?>
					<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
					<?php endif; // 5.2. If the form has just been submitted, this shows the notification ?>	
				  
				<form action="options.php" method="post">  
				  
				  
		
				<?php // 6.1 Add settings API hook under form action.  ?>
			<?php $settings = get_option( 'bappi_scroll_bar_options_default', $bappi_scroll_bar_options_default ); ?>
			
			
			<?php settings_fields( 'bappiscroll_bar_p_options' );
			/* 6.2  This function outputs some hidden fields required by the form,
			including a nonce, a unique number used to ensure the form has been submitted from the admin page and not somewhere else, very important for security */ ?>
		
		
		
					
	<table class="form-table">
		<tbody>
		               
			<tr valign="top">
					<th scope="row"><label for="scroll_bar_items_mode">Auto Hide Scrollbar mode</label></th>
						<td>
					    <?php foreach ( $scroll_bar_items_mode as $activate): ?>
						<input type="radio" id="<?php echo $activate['value']; ?>" name="bappi_scroll_bar_options_default[scroll_bar_items_mode]"  value="<?php esc_attr_e($activate['value']); ?>"<?php checked($settings['scroll_bar_items_mode'],$activate['value']); ?>  />
						<label for="<?php echo $activate['value']; ?>"><?php echo $activate ['label']; ?></label>
						<p class="description">You can add Auto Hide Scrollbar true or false</p><br/>
						<?php endforeach; ?>
					</td>
			</tr> 
			<tr valign="top">
				<th scope="row"><label for="theme_items_mode">Theme mode</label></th>
					<td>
						<input type="text" class="" value="<?php echo stripslashes($settings['theme_items_mode']); ?>" id="theme_items_mode" name="bappi_scroll_bar_options_default[theme_items_mode]"/><p class="description">You can change Theme mode like(none,minimal,rounded-dark,3d,3d-thick,inset-2-dark,dark-3,minimal-dark).</p>
					</td>
			</tr>
		
		
			<tr valign="top">
				<th scope="row"><label for="set_Height_mode">Set Height mode</label></th>
					<td>
						<input type="text" class="" value="<?php echo stripslashes($settings['set_Height_mode']); ?>" id="set_Height_mode" name="bappi_scroll_bar_options_default[set_Height_mode]"/><p class="description">you can set here your Theme Height mode.Example:= auto,800,1000,1500 etc</p>
					</td>
			</tr>
			
			
			<tr valign="top">
				<th scope="row"><label for="scroll_bar_Position_mode">scroll bar Position mode</label></th>
					<td>
						<input type="text" class="" value="<?php echo stripslashes($settings['scroll_bar_Position_mode']); ?>" id="scroll_bar_Position_mode" name="bappi_scroll_bar_options_default[scroll_bar_Position_mode]"/><p class="description">scroll bar Position mode linke; inside/outside</p>
					</td>
			</tr>
			
			
			<tr valign="top">
				<th scope="row"><label for="scroll_Buttons_mode">scroll Buttons mode</label></th>
					<td>
						<input type="text" class="" value="<?php echo stripslashes($settings['scroll_Buttons_mode']); ?>" id="scroll_Buttons_mode" name="bappi_scroll_bar_options_default[scroll_Buttons_mode]"/><p class="description">You can add scroll Buttons mode,like true/false</p>
					</td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><label for="mouse_Wheel_mode">mouse Wheel speed</label></th>
					<td>
						<input type="text" class="" value="<?php echo stripslashes($settings['mouse_Wheel_mode']); ?>" id="mouse_Wheel_mode" name="bappi_scroll_bar_options_default[mouse_Wheel_mode]"/><p class="description">You can add increase and decrease mouse wheel speed.when you increase number mouse wheel speed will be increase and decrease<br/> number mouse wheel speed will be decrease but the best position is 400 </p>
					</td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><label for="scroll_Inertia_mode">scroll Inertia mode</label></th>
					<td>
						<input type="text" class="" value="<?php echo stripslashes($settings['scroll_Inertia_mode']); ?>" id="scroll_Inertia_mode" name="bappi_scroll_bar_options_default[scroll_Inertia_mode]"/><p class="description">You can add increase and decrease scroll Inertia.when you increase number scroll Inertia will be increase and decrease<br/> number scroll Inertia will be decrease but the best position is 500</p>
					</td>
			</tr>
			
		
	</tbody>

</table>


		<p class="submit">
			<input type="submit" value="Save Changes" class="button button-primary" id="submit" name="submit">
		</p>

</form>
			   
			   </div>
	 
	 
	<?php 
	 }
	 

  // 7. Add validate options. 
function bappiscroll_bar_validate_options( $input ) {
	global $bappi_scroll_bar_options_default,$scroll_bar_items_mode;

	$settings = get_option( 'bappi_scroll_bar_options_default', $bappi_scroll_bar_options_default );
	
	
	$input['theme_items_mode']=wp_filter_post_kses($input['theme_items_mode']);
	$input['set_Height_mode']=wp_filter_post_kses($input['set_Height_mode']);
	$input['scroll_bar_Position_mode']=wp_filter_post_kses($input['scroll_bar_Position_mode']);
	$input['scroll_Buttons_mode']=wp_filter_post_kses($input['scroll_Buttons_mode']);
	$input['mouse_Wheel_mode']=wp_filter_post_kses($input['mouse_Wheel_mode']);
	$input['scroll_Inertia_mode']=wp_filter_post_kses($input['scroll_Inertia_mode']);
	
	
	
	$prev=$settings['layout_only'];
	if(!array_key_exists($input['layout_only'],$scroll_bar_items_mode))
	$input['layout_only']=$prev;
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS

	
	
	
	
	return $input;
}

 
	endif;  //3. EndIf is_admin()	


	 
	    
		
	 // 8.data danamic
		
	            function scroll_bar_activator(){?>
				
				<?php global $bappi_scroll_bar_options_default;
	
	$bappiscroll_bar_settings=get_option('bappi_scroll_bar_options_default','$bappi_scroll_bar_options_default'); ?>
		<script type="text/javascript">
				(function(jQuery){                                              
		
			jQuery(window).load(function(){
				
				jQuery("html").mCustomScrollbar({
					autoHideScrollbar:<?php echo $bappiscroll_bar_settings['scroll_bar_items_mode']; ?>,
					theme:"<?php echo $bappiscroll_bar_settings['theme_items_mode']; ?>",
					setHeight:"<?php echo $bappiscroll_bar_settings['set_Height_mode']; ?>",
					scrollbarPosition:"<?php echo $bappiscroll_bar_settings['scroll_bar_Position_mode']; ?>",
					scrollButtons:{enable:<?php echo $bappiscroll_bar_settings['scroll_Buttons_mode']; ?>},
					mouseWheel:{deltaFactor:<?php echo $bappiscroll_bar_settings['mouse_Wheel_mode']; ?>},
					scrollInertia:<?php echo $bappiscroll_bar_settings['scroll_Inertia_mode']; ?>,
					snapAmount:4,
					keyboard:{scrollAmount:400},
					
					
				});
				
			});
		})(jQuery);
			</script>     		 
			<?php
	}
	
    add_action('wp_head','scroll_bar_activator');
  
  
  
  
  

?>