<!--About Us Page-->
<section class="fc-identity fc-bottom fc-menu-wrapper">
   <div class="container">
	
       <div class="row">
 
       		<div class="col-sm-12">
       			<div class="section-header text-left">
             <h1><?php if (isset($pagetitle)) echo $pagetitle; ?></h1>
            
         </div>
         <div class="about-text-more">
         		<?php if (isset($record->description)) echo $record->description;?>
        </div>
       		</div>
       </div>
<!--        
       <?php $this->load->view('dishes-block');?> -->
  </div>
</section>

<?php $this->load->view('home/our_services');?>