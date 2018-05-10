
       
<div class="content_block">     
      
      <div class="top_title">
      <div class="wraper">
       <h2>   News<span>We think you'll love to work with us</span></h2>
       <ul>
        <li><a href="<?php echo site_url();?>">Home</a></li>
        <li><span class="orng">  News</span> </li>
        </ul>
      </div>
     </div>

  <div class="wraper">
   <?php  
     foreach($news as $data){
       ?>
   <div class="news" id="q<?php echo $data->id;?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%" valign="top"><img src="<?php echo site_url('includes/upload/news/'.$data->image); ?>" width="249" height="168"></td>
            <td width="70%" valign="top">
                <?php 
                $time=strtotime($data->date);
                $month=date("M",$time);
                $year=date("Y",$time);
                ?>
            <h1><?php echo $data->title;?><span><?php echo $month; ?>  <?php echo $year;?></span></h1>
<?php echo $data->details; ?>
             </td>
          </tr>
        </table>
    </div>
   <?php 
   
   } ?>
   
 
   

    
      
    
    
    
    
  </div>
 
<!-- /social block -->
  