<?php
if(!'ABSPATH'){
	exit();
}


function njl_sd_options_page () {
?>
<div>

</div class='wrap'>
    <div class='card'>
    <?php
     $sd_opts = get_option( 'njl_sd_opts' );

     $sd_only_property = esc_html__("Only property", 'njl-sd');    
     if(isset($sd_opts['sd_only_property'])){
         $sd_only_property = esc_html(stripslashes_from_strings_only($sd_opts['sd_only_property']),'njl-sd');
     }
     $sd_additional_property = esc_html__("Additional property", 'njl-sd');    
     if(isset($sd_opts['sd_additional_property'])){
         $sd_additional_property = esc_html(stripslashes_from_strings_only($sd_opts['sd_additional_property']),'njl-sd');
     }
     $sd_first_time_property = esc_html__("First time buyer", 'njl-sd');    
     if(isset($sd_opts['sd_first_time_property'])){
         $sd_first_time_property =  esc_html(stripslashes_from_strings_only($sd_opts['sd_first_time_property']),'njl-sd');
     }

     $sd_sc_title= esc_html__("House price (&pound;)", 'njl-sd');    
     if(isset($sd_opts['sd_sc_title'])){
         $sd_sc_title = esc_html(stripslashes_from_strings_only($sd_opts['sd_sc_title']),'njl-sd');
     }


    ?>
   
    <div class='card-body'>
    <h3 class='card-title'><?php _e('Alter The Displayed Stamp Duty Text','njl-sd'); ?></h3>
    <form method='post' action='admin-post.php'>
        <input type='hidden' name='action' value='njl_sd_save_options'>
        <?php  wp_nonce_field( 'njl_sd_verify_options' ) ?>

        <table  class='form-table'>

        <tr>
            <td><label><?php _e('Title','njl-sd');?> </label></td>
            <td><input type='text' value='<?php echo $sd_sc_title ?>' name='sd_sc_title'></td>
            
        </tr>

        <tr>
        <td><label><?php _e('Only Property','njl-sd');?> </label></td>
        <td><input type='text' value='<?php echo $sd_only_property ?>' name='sd_only_property'></td>
           
        </tr>

        
        <tr>
        <td><label><?php _e('Additional property','njl-sd');?> </label></td>
        <td><input type='text' value='<?php echo $sd_additional_property ?>' name='sd_additional_property'></td>
            
        </tr>

        <tr>
        <td><label><?php _e('First Time Buyer','njl-sd');?> </label></td>
        <td><input type='text' value='<?php echo $sd_first_time_property ?>' name='sd_first_time_property'></td>
            
        </tr>

       <tr>
       <td>&nbsp;</td>
       <td><input type='submit' name='submit' value='Submit'></td>
        </tr>
      
     </table>

    </form>
    </div>
    </div>
</div>
<?php
}

function njl_sd_add_menu (){
    
    add_menu_page( "Stamp Duty Settings", 
        "Stamp Duty", 
        "manage_options", 
        'njl-sd-options', 
        'njl_sd_options_page', '
        dashicons-tickets', 
        10 );
}

function njl_sd_save_options(){

    if(! current_user_can( 'manage_options')){
        wp_die( "You do not have privileges to do this" );
    }
    check_admin_referer('njl_sd_verify_options' );

    $sd_opts = get_option( 'njl_sd_opts' );
    $sd_opts['sd_only_property'] = sanitize_text_field($_POST['sd_only_property']);
    $sd_opts['sd_additional_property'] = sanitize_text_field($_POST['sd_additional_property']);
    $sd_opts['sd_first_time_property'] = sanitize_text_field($_POST['sd_first_time_property']);
    $sd_opts['sd_sc_title'] = sanitize_text_field($_POST['sd_sc_title']);

    update_option('njl_sd_opts',   $sd_opts);
    wp_redirect('admin.php?page=njl-sd-options&status=1' );
    exit();
}