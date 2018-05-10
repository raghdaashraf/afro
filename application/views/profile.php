 
<div class="content_block">     
      
      <div class="top_title">
      <div class="wraper">
       <h2> Company Profile <span>We think you'll love to work with us</span></h2>
       <ul>
        <li><a href="<?php echo site_url();?>">Home</a></li>
        <li> About Us </li>
        <li>	<span class="orng"> Company Profile</span></li>
       </ul>
      </div>
     </div>

  <div class="wraper">
  <div class="intro_text">
   <ul class="intro_slider">
    <li>
     <?php echo $profile->desc; ?>
          <div class="profile"> 
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="51%">profile pdf </td>
                    <td width="21%"  valign="middle" align="center"><?php echo anchor('cms/download/'.$pdf->profile_pdf,'<img src="'.site_url().'includes/images/down.jpg" >'); ?></td>
                    <td width="28%"  valign="middle" align="center"><a href="<?php echo site_url(); ?>includes/upload/pdf/<?php echo $pdf->profile_pdf; ?>" target="_blank"><img src="<?php echo site_url();?>/includes/images/view.jpg"  title="view"></a></td>
                  </tr>
                </table>
           </div>
      </p>
     </div>
    </li>
    </ul>
  </div>
    
  </div>
 
<!-- /social block -->
 