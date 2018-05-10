

 <!---------------------faq--------------------->
<link rel="stylesheet" href="<?php echo site_url('includes/stylesheets/jquery-ui.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo site_url('includes/stylesheets/bvalidator.css'); ?>" />
<script src="<?php echo site_url('includes/scripts/jquery-1.8.3.js'); ?>"></script>
<script src="<?php echo site_url('includes/scripts/jquery-ui.js'); ?>"></script>
 <script>
$(function() {
$( "#accordion" ).accordion({ active: false,collapsible: true });
});
</script>
<!--------------------faq------------------------> 
      
      
<div class="content_block">     
      
      <div class="top_title">
      <div class="wraper">
       <h2>Careers </h2>
       <ul>
        <li><a href="<?php echo site_url(); ?>">Home</a></li>
        <li> <span class="orng"> Careers</span> </li>
        </ul>
      </div>
     </div>

  
  
  <div class="wraper">
        <div id="accordion">
            <?php foreach($careers as $career){ ?>
         <h1> <?php echo $career->position; ?> </h1>
      <div> 
              <div class="text_next"> 
               <strong> Job Title : &nbsp;</strong>  <?php echo $career->position; ?> 
               </div>
           
           <div class="text_next">
   <?php echo $career->details; ?>     
           
           </div>
            </div>
         <?php } ?>
        </div>
         
        <div class="contact_form2"> 
                    <h1>Application Form </h1>
                     <div class="all">
   <?php

$attributes = array( "class" => "bvalidator");

echo form_open_multipart('info/careers', $attributes);

?>

                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td> 
                                   <h2> Your name * </h2><input name="name"  type="text" class="box_inpot" data-bvalidator="required" value="<?php echo set_value('name'); ?>" />
                                </td>
                              </tr>
                              
                              <tr>
                                <td> <h2> Adderss</h2><input name="address" type="text" class="box_inpot" data-bvalidator="required" value="<?php echo set_value('address'); ?>" /></td>
                              </tr>
                              
                               <tr>
                                <td> <h2> Email </h2><input name="email" type="text" class="box_inpot" data-bvalidator="required,email" value="<?php echo set_value('email'); ?>"/></td>
                              </tr>
                              
                             <tr>
                                <td> <h2>   position </h2><input name="position" type="text" class="box_inpot" data-bvalidator="required" value="<?php echo set_value('position'); ?>"/></td>
                              </tr>
                              
                              
                             <tr>
                                <td> <h2>  Upload CV </h2> <input name="cv" type="file" class="box_inpot"  data-bvalidator="required" value="<?php echo set_value('cv'); ?>"></td>
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