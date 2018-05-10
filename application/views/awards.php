
      
       
<script type="text/javascript"  src="<?php echo site_url('includes/scripts/highslide-with-gallery.js'); ?>"></script>
<link rel="stylesheet" type="text/css"  href="<?php echo site_url('includes/stylesheets/highslide.css'); ?>" />

<script type="text/javascript">
	hs.graphicsDir = '<?php echo site_url(); ?>/includes/highslide/graphics/';
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
      
      
      
      
      
<div class="content_block">     
      
      <div class="top_title">
      <div class="wraper">
       <h2> Awards& Recognitions <span>We think you'll love to work with us</span></h2>
       <ul>
        <li><a href="<?php echo site_url(); ?>">Home</a></li>
        <li> About Us </li>
        <li><span class="orng"> Awards & Recognitions </span></li>
       </ul>
      </div>
     </div>

  <div class="wraper">
  <div class="intro_text">
   <ul class="intro_slider">
    <li>
    
     
       
<?php foreach($awards as $award){ ?>
        
         <div class="photo"><a class='highslide' href="<?php echo site_url('includes/upload/awards/'.$award->image); ?>" onClick="return hs.expand(this)"><img src="<?php echo site_url('includes/upload/awards/'.$award->image); ?>" height="300" width="355"  alt='Product'/></a></div>
   <?php } ?>      
    </li>
    </ul>
  </div>
    
  </div>
 
<!-- /social block -->
