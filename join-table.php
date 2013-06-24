<?php require_once('php/join-table.php'); ?>
<!DOCTYPE html>
<html>
<head>

	<title>Meet Me, Feed Me</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
	<link href="css/style.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="assets/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
	
	$(document).ready(function() {
	
		$(".appetizer").click(function() {
			
			var main = $(this).val();
			var title = $(this).attr("title");
			
			$("#appetizer").attr("title", main);
			$("#appetizer").html(title);
			
			//alert('Main Clicked : '+ main + 'title: '+title);
		});	
		
		$(".main").click(function() {
			
			var main = $(this).val();
			var title = $(this).attr("title");
			
			$("#main").attr("title", main);
			$("#main").html(title);
			//alert('Main Clicked : '+ main + 'title: '+title);
		});	
		
		$(".dessert").click(function() {
			
			var main = $(this).val();
			var title = $(this).attr("title");
			
			$("#dessert").attr("title", main);
			$("#dessert").html(title);
			//alert('Main Clicked : '+ main + 'title: '+title);
		});	
		
		
		
		$("#join-table").click(function() {
			
			$('.error').hide();
			
			var error=false;
			
			var appetizer	= $("#appetizer").attr("title");
			var main		= $("#main").attr("title");
			var dessert		= $("#dessert").attr("title");
			
			//alert('app: '+appetizer+' main: '+main+' dessert: '+dessert);
			
			if(!appetizer){
				
				$(".appetizer:first").before('<span class="error">Choose One</span><br />');
				
				error=true;
				
			}
			
			if(!main){
				
				$(".main:first").before('<span class="error"">Choose One</span><br />');
				
				error=true;
				
			}
			
			if(!dessert){
				
				
				$(".dessert:first").before('<span class="error"">Choose One</span><br />');
				error=true;
				
			}
			
			if(error == true){
			
				//alert('There is an error:');
				
				
			
			}else{
			
				$.ajax({  
					type: "POST",  
					url: "/php/join-table-submit.php",  
					data: {
						"res_id" : "<?php echo $reservation_id;?>",
						"appetizer" : appetizer,
						"main" : main,
						"dessert" : dessert
					
					},  
					success: function(responseHTML){// Success
						//alert(responseHTML);
						
						
						if(responseHTML == "TRUE"){
							//alert('Added to table');
							window.location = '/table.php';
						}
						if(responseHTML == "ALREADY"){
							//alert('Already added');
							window.location = '/table.php';
						}
						
						
					},
					error:function (){// Error
					
					}    
				});  
				
			
			}
			
			
		});	
		
		
	
	});
	
	</script>

</head>

<body class="table-join-body">
	
	<div class="wrap">
	
		<div class="table-join-page">
			
			<div class="table-join-restaurant-info">
				<?php echo $restaurant_name; ?>
				<br />
				Date: <?php echo $reservation_date; ?>
				<br />
				Price Fix: <?php echo $price_fix; ?>
				<br />
				Corking Fee: <?php echo $corking_fee; ?>
				<br />
				Parking: <?php echo $parking; ?>
				<br />
				<br />
				
				<div id="appetizer"></div>
				<div id="main"></div>
				<div id="dessert"></div>
				
			
			</div>

			<div class="table-join-restaurant-join">
				<a href="#" id="join-table" >Click here</a><br />
				TO CONFIRM YOUR MENU SELECTION AND  SEAT. AN EMAIL WILL BE SENT PRIOR TO THE EVENT.  ENJOY!
			
			</div>
			
			<div class="table-join-restaurant-image">
				<img src="/img/restaurant_images/<?php echo $restaurant_image; ?>"/>
			
			</div>


			<div class="table-join-restaurant-back">
				<a href="table.php">BACK</a>
			
			</div>
			
			<div class="table-join-restaurant-choices">
			
				<div>
					<img src="/img/appetizer.png" title="Appetizer" />
				</div>
				
				<div>
				<?php while($a= mysql_fetch_array($query)){?>
					<p>
						<input type="radio" name="appetizer" class="appetizer" value="<?php echo $a['appetizer_id'];?>" title="<?php echo $a['appetizer_name'];?>"/>
						<label><?php echo $a['appetizer_name'];?></label>
					</p>
				<?php } ?>
				</div>
				
				<div>
					<img src="/img/main.png" title="Main" />
				</div>
				
				<div>
				<?php while($m= mysql_fetch_array($query_main)){?>
					<p>
						<input type="radio" name="main" class="main" value="<?php echo $m['main_id'];?>" title="<?php echo $m['main_name'];?> "/>
						<label><?php echo $m['main_name'];?></label>
					</p>
				<?php } ?>
				</div>
				
				<div>
					<img src="/img/dessert.png" title="Dessert" />
				</div>
				
				<div>
				<?php while($d= mysql_fetch_array($query_dessert)){?>
					<p>
						<input type="radio" name="dessert"  class="dessert" value="<?php echo $d['dessert_id'];?>" value="<?php echo $m['dessert_id'];?>" title="<?php echo $d['dessert_name'];?> "/>
						<label><?php echo $d['dessert_name'];?></label>
					</p>
				<?php } ?>
				</div>
			
				<h4>WARNING!</h4>
				
				<p>YOU MUST NOTIFY THE RESTAURANT THE DAY OF THE EVENT  OF ANY ALLERGIES OR PREFERENCES. THE WEBSITE, ITS SUBSIDIARIES, PARENT COMPANY, RESTAURANT AND THEIR STAFF AND THEIR PARENT COMPANIES WILL NOT BE HELD LIABLE FOR ANY INJURIES CAUSED THEROF.</p>
			
			</div>
				
					
		</div><!--.tablepage-->  
	
	</div><!--.wrap-->
 

<script src="js/bootstrap.min.js"></script>

</body>
</html>