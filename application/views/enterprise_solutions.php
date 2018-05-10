

      
<div class="content_block">     
      
      <div class="top_title">
      <div class="wraper">
       <h2> Enterprise Solutions  </h2> 
       <ul>
        <li><a href="#">Home</a></li>
        <li> Services & Solutions </li>
         <li> <span class="orng">Enterprise Solutions </span></li>
         </ul>
      </div>
     </div>

  
  
  <div class="wraper">
        <div class="services">
   
           <div > 
          
           <div id="div_1"  class="text_next">
           <div class="all_ser"> <?php echo $desc->desc; ?>
           
           </div>
           <div class="offer_2"> Offering include </div> 
           
            <!------------------services 1  ------------------>
            
            <?php 
          
            foreach($content as $sub){ ?>
            <?php if($sub->name == !""){ ?>
              <div class="offer" id="q<?php echo $sub->id_sub; ?>">  <?php echo $sub->name; ?>  </div>
              <?php echo $sub->details; ?>
              <?php }else{ ?>
				<?php echo $sub->details; ?>  
				  <?php }?>
          <?php  } ?>
         
      
       <!------------------services 1  ------------------> 
           
      <!------------------services 2  ------------------>     
    
    <!------------------services 2 ------------------>
    
    
    
      <!------------------services 3  ------------------>     
          
    <!------------------services 3 ------------------>
     
      <div class="offer_2" id="q4">  Success stories  </div> 
        
          <div class="success">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                               <tr bgcolor="#0b7e3c"> 		
                                <td width="55%"> <h1> Scope </h1> </td>
                                <td width="25%"><h1>Customer </h1></td>
                                <td width="20%"> <h1>Date </h1></td>
                              </tr>
       <?php foreach($success as $table){ ?>
                              <tr bgcolor="#f5f7f6">
                                <td><?php echo $table->scope; ?> </td>
                                <td> <strong><?php echo $table->customer; ?></strong> </td>
                                <td> <?php echo $table->date; ?></td>
                              </tr>
                              
                       <?php } ?>     
                              
                            </table>
                     </div>
                
           </div>
            
           </div>
    
         </div>       
  </div>
 
<!-- /social block -->
 
