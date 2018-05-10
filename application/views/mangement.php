
 
<div class="content_block">     
      
      <div class="top_title">
      <div class="wraper">
       <h2> Management Team <span>We think you'll love to work with us</span></h2>
       <ul>
        <li><a href="#">Home</a></li>
        <li> About Us </li>
        <li><span class="orng">  Management Team </span></li>
       </ul>
      </div>
     </div>

  <div class="wraper">
  <div class="intro_text">
   <ul class="intro_slider">
    <li>
      <div class="desc" style="width:100%">
        <h4>  Management Team</h4>
        <?php foreach($mangement as $team){?>
      <p> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="17%" align="center"><img src="<?php echo site_url('includes/upload/mangement/'.$team->image); ?>" class="person"></td>
    <td width="83%" valign="top"><strong style="color:#27741d;"><?php echo $team->name; ?></strong><br>
<?php echo $team->details; ?>
</td>
  </tr>
</table>
 </p>
<p>&nbsp;</p>

<?php } ?>
 
 
   </div>
    </li>
    </ul>
  </div>
    
  </div>
 
<!-- /social block -->
 