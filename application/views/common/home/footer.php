 
<footer class="ct-footer">

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                
                <img class="img-responsive footer-logo" src="<?php echo get_second_site_logo();?>" alt="FoodCourt">
                <p class="footer-text"><?php echo get_languageword('we_are_the_world_class_food_providers_with_the_highest_quality_of_food_services');?></p>

            </div>
            <?php $accepted_cards = get_accepted_cards(); 
                    $clg = 3;
                if(!empty($accepted_cards)) {
                    $clg = 2;
            ?>
        
        <?php } ?>
            <div class="col-lg-<?php echo $clg; ?> col-md-<?php echo $clg; ?> col-sm-6 col-xs-6">
                <h4 class="footer-head"><?php echo get_languageword('our_links');?></h4>
                <ul class="cs-footer-links">
                    <li><a href="<?php echo SITEURL;?>"><?php echo get_languageword('home');?></a>
                    </li>
					
                    <li><a href="<?php echo URL_CONTACT_US;?>"><?php echo get_languageword('contact_us');?></a>
                    </li>
                   
                </ul>
            </div>
           
            
        </div>

         </div>
      </footer>
      
    <!-- Accepted cards end -->
    
    
</div>

<!--  Bootstrap core JavaScript
    ============================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!--script src="<?php //echo JS_FRONT_JQUERY_MIN;?>"></script-->

<?php $this->load->view('common/popup_script');?>


<script src="<?php echo JS_FRONT_BOOTSTRAP_MIN;?>"></script>
<script src="<?php echo JS_FRONT_SEARCH_BOX;?>"></script>
<script src="<?php echo JS_FRONT_BOOTSTRAP_OFFCANVAS;?>"></script>

<!--CHOSEN JS-->
<script type="text/javascript" src="<?php echo JS_CHOSEN_JQUERY_MIN;?>"></script>

<!--PNOTIFY JS-->
<script type="text/javascript" src="<?php echo PNOTIFY_MIN_JS;?>"></script>
<script type="text/javascript" src="<?php echo PNOTIFY_ANIMATE_JS;?>"></script>
<script type="text/javascript" src="<?php echo PNOTIFY_BUTTON_JS;?>"></script>
<script type="text/javascript" src="<?php echo PNOTIFY_CALLBACK_JS;?>"></script>
<script type="text/javascript" src="<?php echo PNOTIFY_CONFIRM_JS;?>"></script>
<script type="text/javascript" src="<?php echo PNOTIFY_DESKTOP_JS;?>"></script>


<script src="<?php echo JS_FRONT;?>ResizeSensor.min.js" type="text/javascript"></script>
<script src="<?php echo JS_FRONT;?>theia-sticky-sidebar.min.js" type="text/javascript"></script>

<script>
jQuery(document).ready(function() {
    jQuery('#item-sidebar').theiaStickySidebar({
        additionalMarginTop: 30
    });
});
</script>

<script>
$(document).ready(function() {
     $(".chzn-select").chosen();
});

function checkNotify(title,text,type)
{
    var notification = new PNotify({
        title: title,
        text: text,
        type: type
    });

    notification.open();
}
</script>




<script src="<?php echo JS_FUNCTIONS;?>"></script>
<script>
var add_cart_target_url = '<?php echo base_url();?>cart/add_cart_item';

var update_cart_target_url = '<?php echo base_url();?>cart/update_cart_item';

var remove_cart_target_url = '<?php echo base_url();?>cart/remove_cart_item';

var currency_symbol = '<?php echo $this->config->item('site_settings')->site_title;?>';
</script>
</body>
</html>