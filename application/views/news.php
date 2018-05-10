
      
      
      
      <!----------------faq----------------------->
 <script src="<?php echo site_url('webroot/css/jquery-1.10.2.js');?>"></script>
 <script src="<?php echo site_url('webroot/js/jquery.ui.core.js');?>"></script>
 <script src="<?php echo site_url('webroot/js/jquery.ui.widget.js');?>"></script>
 <script src="<?php echo site_url('webroot/js/jquery.ui.accordion.js');?>"></script>
 <script>
		$(function() {
		$( "#accordion" ).accordion({ active: false,collapsible: true,heightStyle: "content" });
		});
 </script>
 <!-------------end-faq----------------------->
      
       
 <!----------------scollore--------->
 	<link href="<?php echo site_url('webroot/css/scrollbar.css');?>" rel="stylesheet" />
 <!----------------scollore--------->    


  <script type="text/javascript"  src="<?php echo site_url('webroot/js/highslide-with-gallery.js');?>"></script>
  <link rel="stylesheet" type="text/css"  href="<?php echo site_url('webroot/css/highslide.css');?>" />

  <script type="text/javascript">
	hs.graphicsDir = '<?php echo  site_url(); ?>/webroot/highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.fadeInOut = true;
	hs.dimmingOpacity = 0.8;
	hs.outlineType = 'rounded-white';
	hs.captionEval = 'this.thumb.alt';
	hs.marginBottom = 105 // make room for the thumbstrip and the controls
	hs.numberPosition = 'caption';

	// Add the slideshow providing the controlbar and the thumbstrip
	hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		overlayOptions: {
			className: 'text-controls',
			position: 'bottom center',
			relativeTo: 'viewport',
			offsetY: -60
		},
		thumbstrip: {
			position: 'bottom center',
			mode: 'horizontal',
			relativeTo: 'viewport'
		}
	});
   </script>      
      
      
<link rel="stylesheet" href="<?php echo site_url('webroot/css/demos.css');?>">	
<link rel="stylesheet" href="<?php echo site_url('webroot/css/jquery.ui.all.css');?>">   
      
      
      
      
 <div class="banner">
        <!-----Slider --------------->
         <div class="about_img">
           <img src="<?php echo site_url('webroot/images/news_ev.jpg');?>" width="743" height="260" border="0" />
         </div>
         <!-----end slider---------------->
         
             <!------------------login Form-----------------> 
       <?php
 	$this->load->view('login');	
	  ?> 
     <!------------------login Form-----------------> 
         
      </div>
 
 
 
  <!---------Layout---------------->
     <div class="layout">
      
       <div class="left_layout">
       <div class="box_bg_scroll">
            <div class="titel">Event Name</div>
         <div id="content_1" class="content">

         <div class="event_box" style="border-bottom:0px;">
          <table width="100%" border="0" cellspacing="10" cellpadding="5">
             <tr>
               <td valign="top" colspan="2">
               <?php echo $events->description;?>
               </td>
             </tr>
          
              <tr>
                <td  colspan="2">
                
                <div id="accordion">
                <h3>Event Video gallery</h3>
                    <div>
                        <p>
                        
                        <?php foreach($event_videos as $video){?>
                          <div class="flowplayer" data-swf="<?php echo site_url('webroot/images/flowplayer.swf');?>" data-ratio="0.4167" style="width:270px; margin:5px 15px ; ">
                                <video><source type="video/flv" src="<?php echo site_url('webroot/images/'.$video->name_video);?>"></video>
                           </div>  
                   
                          <?php } ?>  
                         </p>
                    </div>
                    
                    
                    
                    <h3>Event Photo gallery</h3>
                    <div>
                        <p>
                        
                        <?php foreach($event_gallery as $gallery){?>
                          <div class="photo"><a class='highslide' href="<?php echo site_url('webroot/images/'.$gallery->name_photo);?>" onclick="return hs.expand(this)"><img src="<?php echo site_url('webroot/images/'.$gallery->name_photo);?>" alt='Product' width="120" height="120"/></a></div> 
                         
                           <?php } ?> 
                                 
                                   
                                        
                                            
                         </p>
                    </div>
                    
                   
                </div>
                   
                    </td>
              </tr>
              
               <tr>
                <td colspan="2" height="20">&nbsp; </td>
                </tr>
            </table>
         </div>
              
            
              
              
     
          </div>
         
       </div>
         
          
         
       </div>
         <div class="right_layout">
         <?php
	  	$this->load->view('right');
	    ?> 
       </div>
       
     </div>
     <!---------Layout---------------->
     <script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo site_url('webroot/js/minified/jquery-1.9.1.min.js');?>"%3E%3C/script%3E'))</script>
	<!-- custom scrollbars plugin -->
	<script src="<?php echo site_url('webroot/js/scollor.js');?>"></script>
	<script>
		(function($){
			$(window).load(function(){
				$(".content").mCustomScrollbar({
					scrollButtons:{
						enable:true
					}
				});
				/* disable */
				$("#disable-scrollbar").click(function(e){
					e.preventDefault();
					$("#content_1").mCustomScrollbar("disable",true);
				});
				$("#disable-scrollbar-no-reset").click(function(e){
					e.preventDefault();
					$("#content_1").mCustomScrollbar("disable");
				});
				$("#enable-scrollbar").click(function(e){
					e.preventDefault();
					$("#content_1").mCustomScrollbar("update");
				});
				/* destroy */
				$("#destroy-scrollbar").click(function(e){
					e.preventDefault();
					$("#content_1").mCustomScrollbar("destroy");
				});
				$("#rebuild-scrollbar").click(function(e){
					e.preventDefault();
					$("#content_1").mCustomScrollbar({
						scrollButtons:{
							enable:true
						}
					});
				});
			});
		})(jQuery);
	</script>
    