<div class="content_block">     

      

      <div class="top_title">

      <div class="wraper">

       <h2>   search result<span>We think you'll love to work with us</span></h2>

       <ul>

        <li><a href="<?php echo site_url();?>">Home</a></li>

        <li><span class="orng">  News</span> </li>

        </ul>

      </div>

     </div>

    

     <div class="wraper">

     <?php if($search_cms){

	  foreach($search_cms as $cms){

		

		  ?> 

    <?php if($cms->title=='Chairman Message'){ ?>

	    <div style="float:right; width:100%;">

	    <?php echo anchor('cms/chairman','Chairman Message');?>  </div>

        <?php }if($cms->title=='Company Profile'){?>

              <div style="float:right; width:100%;">

             <?php echo anchor('cms/company_profile','Company Profile');?>  </div>

    

         <?php }if($cms->title=='Core Values '){ ?>

            <div style="float:right; width:100%;">

            <?php echo anchor('cms/core_value','Core Values');?>  </div>

     

         <?php }if($cms->title=='Vision & Mission'){ ?>

            <div style="float:right; width:100%;">

            <?php echo anchor('cms/vision_mission','Vision & Mission ');?>  </div>

      <?php }if($cms->title=='Factsheet'){ ?>

     <div style="float:right; width:100%;">

            <?php echo anchor('cms/factsheet','Factsheet');?>  </div>

         <?php } ?>

         

         

         

        <?php } ?>

    <?php }else if($services_solutions){?>

        <?php foreach($services_solutions as $service){?>

           <div style="float:right; width:100%;">

            <?php echo anchor('services_solutions/services/'.$service->id,$service->title);?>  </div>

         

         

        <?php } ?>

         

         <?php }else if($search_news){ ?>

         <?php 

        

         foreach($search_news as $news){ ?>

         

         <div style="float:right; width:100%;">

         <?php echo anchor('site/news/#q'.$news->id,$news->title);?>  </div>

         <?php  } ?>
             <?php }else if($search_mangement){ ?>

         <?php 

        

         foreach($search_mangement as $mangement){ ?>

         

         <div style="float:right; width:100%;">

         <?php echo anchor('site/mangement_team/#name'.$mangement->id,$mangement->name);?>  </div>

         <?php  } ?>
 

        <?php }else{?>

        

		<div><?php



		



		$search=$_POST['key'];



		

          echo '<p class="result"  style="color: black">there is no resualt for " '.$search .'"</p>' ; ?></div>

		



		<?php }?>                    

     

     </div>

     

     

     

     

     

        

        