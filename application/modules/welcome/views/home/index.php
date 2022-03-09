  <!-- Slide Banner Section -->
  <?php $this->load->view('slider'); ?>
  <!-- Slide Banner Section -->

  <!--ITEMS-->

  <!-- Title Section -->
  <section class="fc-identity">
  	<div class="container">
  		<div class="row">
  			<div class="col-sm-12">
  				<div class="section-header">
  					<h1 style="padding-top: 11%;"> <?php echo form_open(URL_MENU); ?> </h1>



  				</div>




  				<div class="row">
  					<div class="col-lg-8 col-lg-offset-2 col-sm-12">
  						<div class="">
  							<div class="input-group">

  								<input type="text" name="search_item" class="form-control" placeholder="Search " aria-describedby="basic-addon2" required>

  								<span class="input-group-addon cs-search-input-group">
  									<button type="submit" class=" cs-search-btn" id="basic-addon2">

  										<span class="hidden-xs"><?php echo get_languageword('search'); ?></span>
  										<span class="pe-7s-search visible-xs"></span>

  									</button>
  								</span>
  							</div>
  						</div>
  					</div>
  				</div>
  				<?php echo form_close(); ?></h1>

  			</div>
  		</div>
  	</div>
  	</div>
  </section>
  <!-- Title Section -->

  <?php
	if (isset($menus) && !empty($menus)) { ?>

  	<section class="relative">

  		<div class="container">

  			<div class="row">
  				<div class="col-sm-12">

  					<ul class="featured-list-ul">
  						<?php
							$n = 0;

							$element = array(
								'type' => 'hidden',
								'id' => 'fc_hme_first_menu',
								'value' => $menus[0]->menu_id
							);
							echo form_input($element);

							foreach ($menus as $menu) {
								$clas = '';
								$n++;
								if ($n == 1)
									$clas = 'active';

							?>

  							<li class="home-itms <?php echo $clas; ?>" onclick="get_home_menu_items_block('<?php echo $menu->menu_id; ?>')" id="<?php echo $menu->menu_id; ?>">

  								<a href="javascript:void(0);"><?php echo isset($menu->menu_name) ? $menu->menu_name : ''; ?></a>


  							</li>
  						


  						<?php } ?>
						  <li class="home-itms"  >

						  <a href="javascript:void(0);" class="list-group-item" onclick="get_popular_items_block()" id="popular_items">ALL</a>



  							</li>
  					</ul>
  				</div>
  			</div>


  			<div class="row fc-home-items-block items-block">

  			</div>

  		</div>
  	</section>
  <?php } else {

		echo '<h4 style="text-align:center;">' . get_languageword('no_items_available') . ' </h4>';
	} ?>
  <!--ITEMS-->





  <!--services section-->
  <?php $this->load->view('our_services'); ?>
  <!--services section-->














  <script>
  	// A $( document ).ready() block.
  	$(document).ready(function() {

  		<?php if (!empty($menus)) { ?>
  			var hm_menu = $("#fc_hme_first_menu").val();


  			if (hm_menu > 0) {

  				get_home_menu_items_block(hm_menu);
  			}
  		<?php } ?>
  	});

  	//get menu-items-block
  	function get_home_menu_items_block(menu_id) {


  		//attribute class need to change
  		$('.home-itms').removeClass("active");
  		$('#' + menu_id + '').addClass('active');


  		$(".fc-home-items-block").html('<img class="abs-loader pt-1" src="<?php echo LOADER_IMG; ?>" alt="Loader" align="middle">');

  		if (menu_id > 0) {
  			$.ajax({
  				url: '<?php echo base_url(); ?>welcome/get_home_menu_items_block',
  				type: 'POST',
  				data: '<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>&menu_id=' + menu_id,
  				success: function(response) {

  					$(".fc-home-items-block").empty();
  					$(".fc-home-items-block").html(response);

  				}
  			});

  		}
  	}
  </script>
  <script>
  	// A $( document ).ready() block.
  	$(document).ready(function() {

  		<?php if ($search_item != '') { ?>
  			$("#search-inp").val('<?php echo $search_item; ?>');
  			search_item();
  			<?php } else {

				if (!empty($menus)) : ?>
  				var menu = $("#first_menu").val();
  				var arr = menu.split('=');

  				if (arr.length > 0) {

  					var menu_id = arr[0];
  					var menu_name = arr[1];

  					get_menu_items_block(menu_id, menu_name);
  				}

  			<?php else : ?>
  				get_offers_block();
  			<?php endif; ?>

  		<?php } ?>


  		load_cart_div();



  	});


  	//get menu-items-block
  	function get_menu_items_block(menu_id, menu_name) {

  		//attribute class need to change
  		$(".list-group-item").removeClass("active");
  		$('#' + menu_id + '').addClass('active');


  		$(".items-block").html('<img  class="fixed-loader" src="<?php echo LOADER_IMG; ?>" alt="Loader" align="middle">');

  		if (menu_id > 0) {
  			$.ajax({
  				url: '<?php echo base_url(); ?>welcome/get_menu_items_block',
  				type: 'POST',
  				data: '<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>&menu_id=' + menu_id + '&menu_name=' + menu_name,
  				success: function(response) {

  					$(".items-block").empty();
  					$(".items-block").html(response);



  					var offset = $('#offset').val();
  					var total_items = $("#total_items").val();

  					if (parseInt(total_items) <= parseInt(offset)) {
  						$("#load_more").fadeOut();
  					} else {
  						$("#load_more").fadeIn();
  					}

  				}
  			});
  		}

  	}

  	function get_more_items(menu_id) {


  		var offset = $('#offset').val();

  		var new_offset = parseInt(offset) + parseInt('<?php echo MENU_ITEMS_PER_PAGE; ?>');

  		var total_items = $("#total_items").val();

  		$("body").addClass("ajax-load");

  		if (menu_id > 0) {

  			$.ajax({
  				url: '<?php echo base_url(); ?>welcome/get_menu_more_items_block',
  				type: 'POST',
  				data: '<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>&menu_id=' + menu_id + '&offset=' + offset,
  				success: function(response) {

  					$("body").removeClass("ajax-load");

  					$(".more-items-block").last().append(response);



  					$('#offset').val(new_offset);

  					if (total_items <= new_offset) {
  						$("#load_more").fadeOut();
  					}

  				}
  			});
  		}
  	}


  	function get_offers_block() {
  		//attribute class need to change
  		$(".list-group-item").removeClass("active");
  		$('#offers').addClass('active');


  		$(".items-block").html('<img class="fixed-loader" src="<?php echo LOADER_IMG; ?>" alt="Loader" align="middle">');


  		$.ajax({
  			url: '<?php echo base_url(); ?>welcome/get_offers_block',
  			type: 'POST',
  			data: '<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>',
  			success: function(response) {

  				$(".items-block").empty();
  				$(".items-block").html(response);



  				var offset = $('#offers_offset').val();
  				var total_offers = $("#total_offers").val();

  				if (parseInt(total_offers) <= parseInt(offset)) {
  					$("#load_more_offers").fadeOut();
  				} else {
  					$("#load_more_offers").fadeIn();
  				}

  			}
  		});
  	}

  	function get_more_offers() {

  		var offset = $('#offers_offset').val();

  		var new_offset = parseInt(offset) + parseInt('<?php echo MENU_ITEMS_PER_PAGE; ?>');

  		var total_offers = $("#total_offers").val();


  		$("body").addClass("ajax-load");
  		$.ajax({
  			url: '<?php echo base_url(); ?>welcome/get_more_offers',
  			type: 'POST',
  			data: {
  				offset: offset
  			},
  			success: function(response) {

  				$("body").removeClass("ajax-load");

  				$(".more-offers-block").last().append(response);

  				$('#offers_offset').val(new_offset);

  				if (total_offers <= new_offset) {
  					$("#load_more_offers").fadeOut();
  				}

  			}
  		});
  	}

  	function get_popular_items_block() {

  		//attribute class need to change
  		$(".list-group-item").removeClass("active");
  		$('#popular_items').addClass('active');


  		$(".items-block").html('<img class="fixed-loader" src="<?php echo LOADER_IMG; ?>" alt="Loader" align="middle">');

  		$.ajax({
  			url: '<?php echo base_url(); ?>welcome/get_popular_items_block',
  			type: 'POST',
  			data: '<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>',
  			success: function(response) {

  				$(".items-block").empty();
  				$(".items-block").html(response);



  				var offset = $('#popular_items_offset').val();
  				var total_items = $("#total_popular_items").val();

  				if (parseInt(total_items) <= parseInt(offset)) {
  					$("#popular_load_more").fadeOut();
  				} else {
  					$("#popular_load_more").fadeIn();
  				}

  			}
  		});
  	}

  	function get_more_popular_items() {

  		var offset = $('#popular_items_offset').val();

  		var new_offset = parseInt(offset) + parseInt('<?php echo MENU_ITEMS_PER_PAGE; ?>');

  		var total_items = $("#total_popular_items").val();

  		$("body").addClass("ajax-load");

  		$.ajax({
  			url: '<?php echo base_url(); ?>welcome/get_more_popular_items',
  			type: 'POST',
  			data: '<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>&offset=' + offset,
  			success: function(response) {

  				$("body").removeClass("ajax-load");

  				$(".popular-items-block").last().append(response);

  				$('#popular_items_offset').val(new_offset);

  				if (total_items <= new_offset) {
  					$("#popular_load_more").fadeOut();
  				}

  			}
  		});
  	}
  	//search item
  	function search_item() {

  		//attribute class need to change
  		$(".list-group-item").removeClass("active");
  		// $('#popular_items').addClass('active');


  		$(".items-block").html('<img class="fixed-loader" src="<?php echo LOADER_IMG; ?>" alt="Loader" align="middle">');


  		var search_strng = $("#search-inp").val();
  		// console.log(search_strng);

  		if (search_strng != '') {
  			$.ajax({
  				url: '<?php echo base_url(); ?>welcome/get_search_items_block',
  				type: 'POST',
  				data: '<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>&strng=' + search_strng,
  				success: function(response) {

  					// console.log(response);

  					$(".items-block").empty();
  					$(".items-block").html(response);



  					var offset = $('#search_items_offset').val();
  					var total_items = $("#total_search_items").val();

  					if (parseInt(total_items) <= parseInt(offset)) {
  						$("#search_load_more").fadeOut();
  					} else {
  						$("#search_load_more").fadeIn();
  					}

  				}
  			});
  		} else {

  			<?php if (!empty($menus)) : ?>
  				var menu = $("#first_menu").val();
  				var arr = menu.split('=');

  				if (arr.length > 0) {

  					var menu_id = arr[0];
  					var menu_name = arr[1];

  					get_menu_items_block(menu_id, menu_name);
  				}

  			<?php else : ?>
  				get_offers_block();
  			<?php endif; ?>


  			load_cart_div();
  		}
  	}



  	function get_more_search_items() {

  		var offset = $('#search_items_offset').val();

  		var new_offset = parseInt(offset) + parseInt('<?php echo MENU_ITEMS_PER_PAGE; ?>');

  		var total_items = $("#total_search_items").val();

  		var search_strng = $("#search-inp").val();

  		if (search_strng != '') {

  			$("body").addClass("ajax-load");

  			$.ajax({
  				url: '<?php echo base_url(); ?>welcome/get_more_search_items',
  				type: 'POST',
  				data: '<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>&strng=' + search_strng + '&offset=' + offset,
  				success: function(response) {

  					$("body").removeClass("ajax-load");

  					$(".search-items-block").last().append(response);

  					$('#search_items_offset').val(new_offset);

  					if (total_items <= new_offset) {
  						$("#search_load_more").fadeOut();
  					}

  				}
  			});

  		} else {
  			<?php if (!empty($menus)) : ?>
  				var menu = $("#first_menu").val();
  				var arr = menu.split('=');

  				if (arr.length > 0) {

  					var menu_id = arr[0];
  					var menu_name = arr[1];

  					get_menu_items_block(menu_id, menu_name);
  				}

  			<?php else : ?>
  				get_offers_block();
  			<?php endif; ?>


  			load_cart_div();
  		}
  	}
  </script>