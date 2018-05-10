<div class="footer">
 <footer>
 <div class="footer_bg">
 <div class="bottom_about"><p> <img  src="<?php echo site_url('includes/images/logo_footer.png');?>" alt="" /></p>  </div>
 
  <div class="footer_map">
      <div class="footer_map_part">   
                   <h1> Who we are</h1>
                                         <?php echo anchor('cms/chairman','- Chairman Message');?>
                                         <?php echo anchor('cms/company_profile','- Company Profile');?>
                                         <?php echo anchor('cms/vision_mission','- Vision & Mission');?>
                                         <?php echo anchor('cms/core_value','- Core Values');?> 
                                         <?php echo anchor('site/awards','- Awards & Recognitions ');?>
                                         <?php echo anchor('cms/factsheet','- Factsheet');?> 
                                         <?php echo anchor('site/mangement_team','- Management Team');?>
                      
                   </div> 
                <div class="footer_map_part">
                   <h1> services & solutions</h1>
                     <a href="enterprise_solutions.php">- Enterprise Solutions</a> 
                    <a href="professional_services.php" >- Professional Services</a> 
                    <a href="telecom.php"> - Carrier Services</a>
                    <a href="supplying_equipment.php"> - Supplying Equipment</a>
                    <a href="logistic.php"> -  Logistic Services </a>
                   
                  </div> 
                 <div class="footer_map_part">
                  <h1>&nbsp; </h1>
                      <a href="<?php echo site_url(); ?>"> - Home </a>
                       <?php echo anchor('partners_customers/partners','- Partners');?> 
                      <?php echo anchor('partners_customers/customers','- Customers'); ?>
                                   
                     <?php echo anchor('info/careers','- careers'); ?>
                     <?php echo anchor('site/news','- News');?> 
                </div>
                
                <div class="footer_map_part" style="width:30% ;margin:0; padding:0px">
                  <h1> contact us</h1>
                <table width="100%" border="0" cellspacing="5" cellpadding="5">
                  <tr>
                    <td width="10%"><img src="<?php echo site_url('includes/images/addres.png'); ?>"></td>
                    <td width="90%">  <?php echo $contact_egypt->address;?>EGYPT</td>
                  </tr>
                  <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="90%">&nbsp; </td>
                  </tr>
                  <tr>
                      <td><img src="<?php echo site_url('includes/images/phone.png'); ?>"></td>
                    <td><?php echo $contact_egypt->first_phone;?></td>
                  </tr>
                    <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="90%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><img src="<?php echo site_url('includes/images/email.png'); ?>"></td>
                    <td><a href="mailto:<?php echo $contact_egypt->first_email;?>"><?php echo $contact_egypt->first_email;?></a> 
                      
                    </td>
                  </tr>
                  
                  <tr>
                    <td><img src="<?php echo site_url('includes/images/email.png'); ?>"></td>
                    <td> 
                      <a href="mailto:<?php echo $contact_egypt->second_email;?>"><?php echo $contact_egypt->second_email;?>t</a>
                    </td>
                  </tr>
                </table>
             </div>
                 
  </div>
 
  
  </div>
 </footer>
</div>

<!-- copyright -->
<div class="copyright">
 <div class="wraper">
  <p><span>© Copyright 2013 Afro All rights reserved.  I  Powered by <a href="http://www.clicknet-eg.com/" target="_blank" class="cc"> Clicknet</a></span>  </p>
  </div>
</div>
<!-- /copyright -->
<!-- /footer -->

</body>
</html> 