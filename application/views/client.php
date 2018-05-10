
      <?php
	  	//include('header.php');
	  ?> 
<div class="content_block">     
      
      <div class="top_title">
      <div class="wraper">
       <h2>Customers <span>We think you'll love to work with us</span></h2>
       <ul>
        <li><a href="#">Home</a></li>
        <li> <span class="orng">  Customers </span></li>
        </ul>
      </div>
     </div>

  <div class="wraper">
      <div class="customers1">
          <?php foreach($customers as $customer){ ?>
          <img src="<?php echo site_url('includes/upload/customers/'.$customer->image); ?>">     
    <?php } ?>
     </div> 
     
     
 </div>
 
<!-- /social block -->
    <?php
	  	//include('footer.php');
	  ?> 

