<link type="text/css" rel="stylesheet" href="<?php echo site_url('includes/stylesheets/bvalidator.css'); ?>" />
    <script>
		$(document).ready(function(){
		
			// set the wrapper width and height to match the img size
			$('#wrapper').css({'width':$('#wrapper img').width(),
							  'height':$('#wrapper img').height()
			})
			
			//tooltip direction
			var tooltipDirection;
						 
			for (i=0; i<$(".pin").length; i++)
			{				
				// set tooltip direction type - up or down             
				if ($(".pin").eq(i).hasClass('pin-down')) {
					tooltipDirection = 'tooltip-down';
				} else {
					tooltipDirection = 'tooltip-up';
					}
			
				// append the tooltip
				$("#wrapper").append("<div style='left:"+$(".pin").eq(i).data('xpos')+"px;top:"+$(".pin").eq(i).data('ypos')+"px' class='" + tooltipDirection +"'>\
													<div class='tooltip'>" + $(".pin").eq(i).html() + "</div>\
											</div>");
			}    
			
			// show/hide the tooltip
			$('.tooltip-up, .tooltip-down').mouseenter(function(){
						$(this).children('.tooltip').fadeIn(100);
					}).mouseleave(function(){
						$(this).children('.tooltip').fadeOut(100);
					})
		});
    </script>
	<style>

		/* Relative positioning*/
		#wrapper {
			position: relative;
			margin:0 auto;
			
		}
		
		/* Hide the original tooltips contents */
		.pin {
			display: none;
		}
		
		/* Begin styling the tooltips and pins */
		.tooltip-up, .tooltip-down {
			position: absolute;
			background: url(<?php echo site_url('includes/images/arrow-up-down.png'); ?>);
			width: 26px;
			height: 34px;
		}
		
		.tooltip-down {
			background-position: 0 -34px;
		}
		
		.tooltip {
			display: none;
			width: 210px;
			cursor: help;
			text-shadow: 0 1px 0 #fff;
			position: absolute;
			top: 10px;
			left: 50%;
			z-index: 999;
			margin-left: -120px;
			padding:15px;
			color: #222;
			-moz-border-radius: 5px;
			-webkit-border-radius: 5px;
			border-radius: 5px;
			-moz-box-shadow: 0 3px 0 rgba(0,0,0,.7);
			-webkit-box-shadow: 0 3px 0 rgba(0,0,0,.7);
			box-shadow: 0 3px 0 rgba(0,0,0,.7);
			background: #ffffff;
			 font-family:Arial, Helvetica, sans-serif;
			 font-size:11px;
			 font-weight:normal;
			 color:#777;
			 border:1px solid #ccc;
 		}
		
		.tooltip::after {
			content: '';
			position: absolute;
			top: -10px;
			left: 50%;
			margin-left: -10px;
			border-bottom: 10px solid #ffffff;
			border-left: 10px solid transparent;
			border-right :10px solid transparent;
		}
		
		.tooltip-down .tooltip {
			bottom: 12px;
			top: auto;
		}
		
		.tooltip-down .tooltip::after {
			bottom: -10px;
			top: auto;
			border-bottom: 0;
			border-top: 10px solid #ffffff;
		}
		
		.tooltip h2 {
			font-family:Arial, Helvetica, sans-serif;
			font-size:12px;
			font-weight:bold;
			text-transform:capitalize; 
			margin: 0 0 0px;
		}
		
		.tooltip ul {
			margin: 0;
			padding: 0;
			list-style: none;
		}		
	</style> 
      
      
      
      
      
<div class="content_block">     
      
      <div class="top_title" style="margin:0px 0px 15px;">
      <div class="wraper">
       <h2> Contact Us <span> We're just an email or phone call away. Fill out the form below and we'll be right with you!</span></h2>
       <ul>
        <li><a href="<?php echo site_url(); ?>">Home</a></li>
        <li> <span class="orng">  Contact Us </span></li>
        </ul>
      </div>
     </div>

  <div class="wraper">
   <div style="width:990px; float:right; height:auto;border:3px solid rgb(246, 243, 243); margin:0px 0px 20px;">
        
    <div id="wrapper">
   <img src="<?php echo site_url('includes/images/map_afro.jpg'); ?>" width="990" height="450"  alt="World continents">
   
   <div class="pin pin-down" data-xpos="551" data-ypos="30">	  
	  <h2> <?php echo $contac_egppt->country; ?> </h2>	  
	  <ul>
		<li> <?php  echo $contac_egppt->address; ?> </li>
		<li> <?php  echo $contac_egppt->phone; ?>  </li>

	  </ul>
   </div>
 
   
   <div class="pin pin-down" data-xpos="587" data-ypos="285">	
       
	  <h2><?php echo $contac_malawi->country; ?></h2>	  
	  <ul>
		<li><?php echo $contac_malawi->address; ?></li>
		<li><?php echo $contac_malawi->phone; ?> </li>
 	  </ul>
   </div>
   
    
   <div class="pin pin-down" data-xpos="529" data-ypos="305">	  
	  <h2><?php echo $contac_zambia->country ?></h2>	
 	  <ul>
		<li><?php echo $contac_zambia->address; ?></li>
		<li><?php echo $contac_zambia->phone; ?></li>
 	  </ul> 
   </div>
   
   <div class="pin pin-down" data-xpos="617" data-ypos="197">	  
	   <h2><?php echo $contac_kenya->country ?></h2>	
 	  <ul>
		<li><?php echo $contac_kenya->address; ?></li>
		<li><?php echo $contac_kenya->phone; ?></li>
 	  </ul> 
   </div>
   
   <div class="pin pin-down" data-xpos="665" data-ypos="320">	  
	 <h2><?php echo $contac_madagascar->country ?></h2>	
 	  <ul>
		<li><?php echo $contac_madagascar->address; ?></li>
		<li><?php echo $contac_madagascar->phone; ?></li>
 	  </ul>  
   </div>
   
</div>
    </div>
     
        <div class="contact_text">
    <?php foreach($contact_us as $contact){
		if(($contact->first_email== !"")&&($contact->second_email== !"")){
		 ?>        
            <h1> <?php echo $contact->country; ?> </h1> 
            <span> 
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="29%"><font style="  "> Address</font></td>
    <td width="71%"><?php echo $contact->address; ?></td>
  </tr>
  <tr>
    <td width="29%">&nbsp;</td>
    <td width="71%">&nbsp;</td>
  </tr>
  <tr>
    <td><font style="  "> Tel </font> </td>
    <td> <?php echo $contact->first_phone; ?> </td>
  </tr>
  
  <tr>
    <td width="29%">&nbsp;</td>
    <td width="71%">&nbsp;</td>
  </tr>
  <tr>
        <td width="28%">&nbsp;  </td>
       <td width="72%"><a href="mailto: <?php echo $contact->first_email; ?>" target="_blank"> <?php echo $contact->first_email; ?> </a></td>
     </tr>
  
    <tr>
    <td width="29%">&nbsp;</td>
    <td width="71%">&nbsp;</td>
  </tr>
  
  <tr>
        <td width="28%">&nbsp;  </td>
       <td width="72%"><a href="mailto: <?php echo $contact->second_email; ?> " target="_blank"> <?php echo $contact->second_email; ?> </a></td>
     </tr>
     
  </table>
  
  
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
   <td width="31%">
     
   
   </td>
 </tr>
 </table>
            </span>
           <?php }else{ ?>
			         <h1> <?php echo $contact->country; ?> </h1> 
            <span> 
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="29%"><font style="  "> Address</font></td>
    <td width="71%"><?php echo $contact->address; ?></td>
  </tr>
  <tr>
    <td width="29%">&nbsp;</td>
    <td width="71%">&nbsp;</td>
  </tr>
  <tr>
    <td><font style="  "> Tel </font> </td>
    <td> <?php echo $contact->first_phone; ?> </td>
  </tr>
  
  <tr>
    <td width="29%">&nbsp;</td>
    <td width="71%">&nbsp;</td>
  </tr>
  </table>
  </span> 		   
			<?php   } ?> 
  <?php } ?>          
            
          
            
            
  
  
                	



         </div>
         
         
      <div class="contact_form"> 
                    <h1> Drop Us A Quick Line!</h1>
                     <div class="all">
                                               <?php

$attributes = array( "class" => "bvalidator");

echo form_open('info/contact_us', $attributes);

?>

                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="47%"> 
                                   <h2> Your name * </h2><input name="name" type="text" class="box_inpot" data-bvalidator="required" value="<?php echo set_value('name'); ?>"/>
                                </td>
                                <td width="7%">&nbsp;</td>
                                <td width="46%"> <h2>Your email address * </h2><input name="email" type="text" class="box_inpot" data-bvalidator="required,email" value="<?php echo set_value('email'); ?>"/></td>
                              </tr>
                              
                              <tr>
                                <td colspan="3"> <h2> Subject </h2><input name="subject" type="text" class="box_inpot" data-bvalidator="required" value="<?php echo set_value('subject'); ?>"/></td>
                              </tr>
                              
                              <tr>
                                <td colspan="3"> <h2>Message * </h2><textarea name="message" cols="" rows="" class="box_area" data-bvalidator="required" value="<?php echo set_value('message'); ?>"> </textarea></td>
                              </tr>
                              
                              <tr>
                                <td colspan="3">  <input name="" type="submit" class="sign_bg"  value="Submit" /></td>
                              </tr>
                              
                              
                          </table>
                         <?php echo form_close();?>
                      </div>
                   </div>   
         
         
     
   </div>
   

 
<!-- /social block -->
 <script src="<?php echo site_url('includes/scripts/jquery.bvalidator.js'); ?>"></script>     

       

<script type="text/javascript">

   $(document).ready(function() {

      $('.bvalidator').bValidator();

   });

</script> 