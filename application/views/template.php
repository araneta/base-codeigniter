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
                    $('.ask').jConfirmAction();
            });

        </script>

        <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>/js/niceforms.js"></script>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>/css/niceforms-default.css" />    
    </head>
    <body>
        <div id="main_container">
            <?php $this->load->view($main);?>
                       
            <div class="footer_login">
            <?php $this->load->view('footer');?>
            </div>
        </div>
    </body>
</html>
