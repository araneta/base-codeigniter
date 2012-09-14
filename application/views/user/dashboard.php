<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <script type="text/javascript">
            //<![CDATA[
            base_url = '<?= base_url();?>';
            //]]>
        </script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/style.css" />
        <?php
        if (isset($cssfiles) && count($cssfiles)){		
			foreach ($cssfiles as $css){
				echo "<link href=\"". base_url(). "css/$css\" rel=\"stylesheet\" type=\"text/css\" />\r\n";			
			}		
		} 
        ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>/js/clockp.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>/js/clockh.js"></script> 
        <script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>/js/ddaccordion.js"></script>
        <script type="text/javascript">
            ddaccordion.init({
                    headerclass: "submenuheader", //Shared CSS class name of headers group
                    contentclass: "submenu", //Shared CSS class name of contents group
                    revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
                    mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
                    collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
                    defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
                    onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
                    animatedefault: false, //Should contents open by default be animated into view?
                    persiststate: true, //persist state of opened contents within browser session?
                    toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
                    togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
                    animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
                    oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
                        //do nothing
                    },
                    onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
                        //do nothing
                    }
            })
        </script>

        <script type="text/javascript" src="<?php echo base_url(); ?>/js/jconfirmaction.jquery.js"></script>
        <script type="text/javascript">

            $(document).ready(function() {
                    //$('.ask').jConfirmAction();
            });

        </script>

        <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>/js/niceforms.js"></script>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>/css/niceforms-default.css" />  
    </head>
    <body>
        <div id="main_container">
            <div class="header">
                <div class="logo"><a href="#"><img src="<?php echo base_url(); ?>/images/logo.gif" alt="" title="" border="0" /></a></div> 
                <div class="right_header">Welcome Admin, <a href="<?= base_url();?>user/profile" target="_self">Profile</a> | <a href="#" class="messages">(3) Messages</a> | <a href="<?= base_url();?>user/dashboard/logout/" target="_self" class="logout">Logout</a></div>
                <div id="clock_a"></div>
            </div>

            <div class="main_content">
                <?php $this->load->view("user/user_header");?>
                <div class="center_content">
                    <div id="ad">
                        <?php $this->load->view("ads");?>
                    </div>      
                    <div class="left_content">Left</div>
                    <div class="right_content">
						<div id="status">
							<?php $this->load->view('status'); ?>
						</div>
                        <?php $this->load->view($main);?>
                    </div>                    
                </div>
                <div class="clear"></div>
            </div>  
            <?php $this->load->view("user/user_footer");?>            
        </div> <!--end of main content-->

        <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.4.4.min.js"></script>
        <?php
            if(isset($jslang))
            {
            ?>
            <script type="text/javascript" src="<?php echo base_url();?>javalang/f/<?php echo $jslang; ?>"></script>
            <?php
            }
            if (isset($jsfiles) && count($jsfiles)){		
                foreach ($jsfiles as $js){
                    echo "<script type=\"text/javascript\" src=\"".base_url()."js/$js\"></script>\r\n";			
                }		
            } 	
        ?>
    </body>
</html>
