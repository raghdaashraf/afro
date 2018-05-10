      <?php
	  	//include('header.php');
	  ?> 



<!-- one bt one slider -->
<div class="slide_img">
<div class="wrape homeone">
		<div id="obo_slider">  				
           
                    <?php foreach($sliders as $slider){?>
            <div class="oneByOne_item">
                <img src="<?php echo site_url('includes/upload/slider/'.$slider->image) ;?>">	            
               		
                <span class="txt3 short"><?php echo $slider->title;?> </span>												
             </div>
        
               <?php }?>
         
         
		</div>    
</div>
</div>
<!-- /one bt one slider -->
 
<div class="content_block">
 
 <div class="wraper">
  <!-- features_block -->
  <div class="features_block">
   <ul>
    <li class="design">
     <a class="circle_link" href="enterprise_solutions.php#q2">&nbsp;</a>
     <h4><span>Networking Solutions </span></h4>
    
    </li>
    <li class="flexible">
     <a class="circle_link" href="professional_services.php#q4">&nbsp;</a>
     <h4><span> Human Resources Outsourcing</span></h4>
      
    </li>
    <li class="support">
     <a class="circle_link" href="telecom.php#q1">&nbsp;</a>
     <h4><span> Roll-out Services </span></h4>
      
    </li>
    <li class="easy">
     <a class="circle_link" href="enterprise_solutions.php">&nbsp;</a>
     <h4><span> unified communication</span></h4>
     
    </li>
    <li class="seo">
     <a class="circle_link" href="supplying_equipment.php">&nbsp;</a>
     <h4><span> Equipment Supply Services</span></h4>
     
    </li>
   </ul>
  </div>
  <!-- /features_block -->
 </div>
</div>

<!-- footer -->
<!-- social block -->
<div class="social_block">
 <div class="wraper">
   
   <div class="why">
      <h1><span> Why</span> Choose Us?</h1>
      <?php echo $why->desc; ?>
   </div>
   
    <div class="client">
      <h1><span> What</span>  Client's Say ?</h1>
      <div class="client_bg">
      <div class="client_text">
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <?php echo $what->desc; ?>
            <?php foreach($city as $v)
{?>
	<div><?php echo $v->city;?></div>
	<?php }?>
          </tr>
        </table>

      </div>
      </div>
   </div>
   
   <div class="partners"> 
       <div id="content">

			<div id="info" class="block">
				<ul id="ticker">
            <?php 
            
            foreach($news as $data){?>                        
                    <li>						
						<span> 
                           <div class="nob">
                           <table width="100%" border="0" cellpadding="0">
                              <tr>
                                  <?php 
                                  $time=strtotime($data->date);
                                  $month=date("F",$time);
                                  $year=date("Y",$time);
                                  ?>
                                    <td valign="middle" width="40%"><span ><br><strong> <?php echo $month;?>  <br><?php echo $year;?></strong><br> </span></td>
                              </tr>
                            </table>
                            </div>
                             <div class="text_news"> 
                              <?php 
                              $time=strtotime($data->date);
                              $month=date("M",$time);
                              $year=date("Y",$time);
                              echo anchor('site/news/#q'.$data->id,$data->title);
                              
                              ?>   
                                
                               </div>
                          </span>
 					</li>
                    
                    <?php } ?>
               
    
  
				</ul>
			</div>

		</div>
   </div>
   
   
 </div>
</div>
<!-- /social block -->
    <?php
	  	//include('footer.php');
	  ?> 

