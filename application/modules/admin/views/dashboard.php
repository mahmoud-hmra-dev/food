
<div id="page-wrapper" class="bg-silver" >

            <div>
            	<?php if (DEMO) {?>
               <div class="row">
	               	<div class='col-md-6'>
						<div class='alert alert-info'>
							<strong>Info!</strong> CRUD operations disabled in DEMO
						</div>
					</div>
				</div>	
			<?php } ?>


				<div class="row">
			   
			   <?php echo $this->session->flashdata('message');?>
			   
                </div></div></div>
				
				
          
<div class="clearfix"></div>
     
               
                <div class="row">
				
			
			
	

				</div>

           </div>   

    </div>

             <!--/.PAGE INNER-->

            </div>

         <!--/.PAGE WRAPPER-->
		 


<script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/loader.js"></script>

<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script-->

<script type="text/javascript">
	// Load the Visualization API and the line package.
	google.charts.load('current', {'packages':['bar']});
	// Set a callback to run when the Google Visualization API is loaded.
	google.charts.setOnLoadCallback(drawChart);
	 
	function drawChart() {
	  $.ajax({
		type: 'POST',
		url: '<?php echo base_url();?>admin/orders_summary',
		success: function (data1) {
		  var data = new google.visualization.DataTable();
		  
		 
		  //Parse data into Json
		   var jsonData = $.parseJSON(data1);
			 
		   var curnt_year = jsonData[12];
		   
		  
		  // Add legends with data type
		  data.addColumn('string', 'Year-Month'+' '+curnt_year);
		  data.addColumn('number', 'Amount ('+'<?php echo $this->config->item('site_settings')->currency_symbol;?>'+')');
		  //data.addColumn('number', 'Expense');
		  
		  	 if (jsonData.length>0) {
				 for (var i = 0; i < 12; i++) {
				   data.addRow([jsonData[i].month, parseInt(jsonData[i].amount)]);
				 }
			 }
			 
			 
			 var options = {
        chart: {
          title: 'Orders Summary'
          //subtitle: 'Show Sales and Expense of Company'
        },
        width: 900,
        height: 600,
        axes: {
          x: {
            0: {side: 'bottom'}
          }
		  
        }
		
		
      };
      var chart = new google.charts.Bar(document.getElementById('bar_chart'));
      chart.draw(data, options);
	  
	  
				 
		}
	  });
	}
</script>		  