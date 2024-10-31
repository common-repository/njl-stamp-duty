<?php
if(!'ABSPATH'){
	exit();
}

function njl_stamp_duty_shortcode($atts, $content=null){

  $sd_opts = get_option( 'njl_sd_opts' );
 

  $sd_nav_title = esc_html__("Stamp Duty", 'njl-sd');    
  if(isset($sd_opts['sd_nav_title'])){
         $sd_nav_title = esc_html(stripslashes_from_strings_only($sd_opts['sd_nav_title']),'njl-sd');
  }

  $sd_only_property = esc_html__("Only property", 'njl-sd');  
  if(isset($sd_opts['sd_only_property'])){
      $sd_only_property = esc_html(stripslashes_from_strings_only($sd_opts['sd_only_property']));
  }
  $sd_additional_property = esc_html__("Additional property", 'njl-sd');     
  if(isset($sd_opts['sd_additional_property'])){
      $sd_additional_property = esc_html(stripslashes_from_strings_only($sd_opts['sd_additional_property']) );
  }
  $sd_first_time_property = esc_html__("First time buyer", 'njl-sd');     
  if(isset($sd_opts['sd_first_time_property'])){
      $sd_first_time_property = esc_html(stripslashes_from_strings_only($sd_opts['sd_first_time_property']));
  }
  $sd_sc_title= esc_html__("House price (&pound;)", 'njl-sd');     
     if(isset($sd_opts['sd_sc_title'])){
         $sd_sc_title = esc_html(stripslashes_from_strings_only($sd_opts['sd_sc_title']));
     }

     ob_start();
?>

<div id="njl-sd-container">



<nav id='sd-nav' class="navbar navbar-expand-md  navbar-light navbar-light">
  <!-- Brand -->
  <a class="navbar-brand" href="#"><?php echo  $sd_nav_title ?></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav   navbar-light njl-sd-ul">
    <li id='njl-fp' class=' nav-item njl-sd-li' data-id="1">
      <a id='njl-btn-fp' class="btn  btn-outline-secondary mr-2 njl-sd-btn active" href="#"  ><?php echo $sd_only_property ?></a>
    </li>
    <li id='njl-ap' class='nav-item njl-sd-li'  data-id="2">
      <a id='njl-btn-ap' class="btn  btn-outline-secondary mr-2 njl-sd-btn" href="#" ><?php echo $sd_additional_property  ?></a>
    </li>
    <li id='njl-ftb' class='nav-item njl-sd-li'  data-id="3">
      <a id='njl-btn-ftb' class="btn  btn-outline-secondary njl-sd-btn" href="#" ><?php echo $sd_first_time_property ?></a>
    </li>
    </ul>
  </div>
</nav >


<form id="njl-contact-form" method="post" action="#" role="form" class='mt-0'>
	
	<div class="form-group">
        <label for="house-price"><?php echo $sd_sc_title ?></label>
        <input id="house-price" class='njl-sd-hp form-control form-control-md'   type="text" name="house_price" >
     </div>

     <div class="form-group">
    	<div class='form-submit'>
 			<input type='button' onclick=""  class = "btn btn-outline-secondary njl-sd-btn" id='njl-sd-btn' value="Calculate">
		</div>
    </div>
</form>
</div>
<div id='njl-sd-results-container' class='njl-sd-results-container'>

<p id ='njl-sd-results' class=''>

	&pound; 
</p>
</div>
<?php
 $content = ob_get_contents();
 ob_end_clean();
 return $content;

}
add_shortcode('njl-stamp-duty', 'njl_stamp_duty_shortcode');
