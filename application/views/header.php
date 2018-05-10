<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>.:: Afro ::.</title>
        <link rel="icon" type="image/png" href="<?php echo site_url(); ?>/includes/images/logo.ico" />
        <link rel="apple-touch-icon" href="<?php echo site_url(); ?>/includes/images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo site_url(); ?>/includes/images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo site_url(); ?>/includes/images/apple-touch-icon-114x114.png">
        <!--[if lt IE 9]>
        <script src="scripts/ie9.js">IE7_PNG_SUFFIX=".png";</script>
        <![endif]-->
        <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo site_url(); ?>/includes/stylesheets/style.css"> 
        <link rel="stylesheet" href="<?php echo site_url(); ?>/includes/stylesheets/responsive.css"> 
        <link rel="stylesheet" href="<?php echo site_url(); ?>/includes/stylesheets/jquery.onebyone.css">
        <script src="<?php echo site_url(); ?>/includes/scripts/jquery.min.js"></script> 
        <script src="<?php echo site_url(); ?>/includes/scripts/jquery.onebyone.min.js"></script>              
        <script src="<?php echo site_url(); ?>/includes/scripts/jquery.touchwipe.min.js"></script> 
        <script src="<?php echo site_url(); ?>/includes/scripts/js_func.js"></script>
        <script>
            $(function() {
                $('#obo_slider').oneByOne({
                    className: 'oneByOne1',
                    easeType: 'random',
                    slideShow: true
                });

            })
        </script>


        <!------------------news---------------->
        <script type="text/javascript" src="<?php echo site_url(); ?>/includes/scripts/common.js"></script>
        <link rel="stylesheet" href="<?php echo site_url(); ?>/includes/stylesheets/screen.css" type="text/css" media="all" />
        <!------------------news----------------> 
        <!----------menu---------------->
        <link rel="stylesheet" href="<?php echo site_url(); ?>/includes/stylesheets/menu.css" type="text/css" media="screen, projection"/>
        <script type="text/javascript" language="javascript" src="<?php echo site_url(); ?>/includes/scripts/jquery.dropdownPlain.js"></script>
        <!-------------menu---------------->



    </head>
    <body>
        <div class="wraper">
            <header class="header">
                <div class="top_header"> 
                    <a href="<?php echo site_url(); ?>"><img src="<?php echo site_url('includes/images/logo.png'); ?>" width="129" height="67" border="0"> </a>
                    <?php echo form_open('site/search'); ?>
                    <div class="search"> <input name="key" type="text" class="inpout_search" value="Search"> <input name="" type="button" class="search_bu" value=""> </div> 
                    <?php echo form_close(); ?>
                    <?php 
                    $phone=$contact_egypt->first_phone;
                    $data=explode('/',$phone );?>
                    <div class="telphone"> <?php echo $data[0]; ?> </div>
                    <div class="fac">
                        <?php foreach ($social_media as $media) { ?>
                            <a href="<?php echo $media->link; ?>" target="_blank"> <img src="<?php echo site_url('includes/upload/social/' . $media->image); ?>"></a>
                        <?php } ?>
                    </div>
                </div>

                <div class=" menu_bar">
                    <div id="page-wrap">
                        <ul class="dropdown">
                            <li><a href="<?php echo site_url(); ?>">Home</a></li>                                           
                            <div class="fasel_c">&nbsp;</div>

                            <li><a href="#">About us</a>  
                                <ul class="sub_menu">
                                    <li><?php echo anchor('cms/chairman', 'Chairman Message'); ?></li>
                                    <li><?php echo anchor('cms/company_profile', 'Company Profile'); ?></li>
                                    <li><?php echo anchor('cms/vision_mission', 'Vision & Mission'); ?></li>
                                    <li><?php echo anchor('cms/core_value', 'Core Values'); ?> </li>
                                    <li><?php echo anchor('site/awards', 'Awards & Recognitions '); ?></li>
                                    <li><?php echo anchor('cms/factsheet', 'Factsheet'); ?> </li>
                                    <li><?php echo anchor('site/mangement_team', 'Management Team'); ?></li>

                                </ul>
                            </li>
                            <div class="fasel_c">&nbsp;</div> 


                            <li><a href="#">services & solutions  </a> 
                                <ul class="sub_menu">
                                    <?php foreach ($services as $value) { ?>


                                        <li><?php
                                    echo anchor('services_solutions/services/'.$value->id, $value->title);
                                    if ($value->sub_name) {
                                        $arr_id = explode(',', $value->id_sub);
                                        $arr_name = explode(',', $value->sub_name);
                                            ?>

                                                <ul>
                                                    <?php for ($i = 0; $i < count($arr_name); $i++) { ?>
                                                        <li><?php echo anchor('services_solutions/services/'.$value->id.'#q'.$arr_id[$i], $arr_name[$i]); ?></li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>

                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <div class="fasel_c">&nbsp;</div> 


                            <li><a href="#">Partners & customers   </a> 
                                <ul class="sub_menu">
                                    <li><?php echo anchor('partners_customers/partners', 'Partners'); ?> </li>
                                    <li><?php echo anchor('partners_customers/customers', 'Customers'); ?></li>
                                </ul>

                            </li>
                            <div class="fasel_c">&nbsp;</div>


                            <li><?php echo anchor('site/news', 'News'); ?> </li>

                            <div class="fasel_c">&nbsp;</div>
                            <li><?php echo anchor('info/contact_us', 'contact us'); ?></li>

                            <div class="fasel_c">&nbsp;</div>
                            <li><?php echo anchor('info/careers', ' careers'); ?></li>
                        </ul>

                    </div>
                </div>

            </header>
        </div> 