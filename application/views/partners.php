

      <?php
	  	//include('header.php');
	  ?> 
        
       
       
<div class="content_block">     
      
      <div class="top_title">
      <div class="wraper">
       <h2> Partners <span>We think you'll love to work with us</span></h2>
       <ul>
        <li><a href="<?php echo site_url(); ?>">Home</a></li>
        <li><span class="orng">   Partners </span></li>
        </ul>
      </div>
     </div>

  <div class="wraper">
 
        
     
     <?php foreach($partners as $partner){ ?>
     <div class="customers">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="18%"><img src="<?php echo site_url('includes/upload/partners/'.$partner->image);?>"></td>
            <td width="82%" valign="top">
                <h1> <?php echo $partner->title; ?> </h1>
  <?php echo $partner->details;?>

            </td>
          </tr>
       </table>
     </div> 
     <?php } ?>

 
    
     
    
 
 
 
    
      
      
   </div>
 
<!-- /social block -->
    <?php
	  	//include('footer.php');
	  ?> 

