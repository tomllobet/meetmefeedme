<?php require_once('php/table.php'); ?>
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
		
			<?php echo $display_error;?>
			
			function display_error(){
				$('.modal').fadeIn(300);
				//alert('faded in');
			}
			
			$('.close-modal').click(function(){
				$('.modal').fadeOut();
			});
		
			$('.cancel').click(function(){
				$('.modal p').html('Are you sure you want to cancel? You cannot undo this!<br /> <a href="#" class="cancel_seat">Cancel Seat</a>');
				$('.modal').fadeIn();
			});
			
			$('.cancel_seat').click(function(){
				
				var res_id	= '<?php echo $reservation_id; ?>';
				
				$.ajax({  
					type: "POST",  
					url: "/php/cancel_seat.php",  
					data: "res_id=" + res_id,  
					success: function(responseHTML){
						// Success
					},
					error:function (){
						// Error
					}    
				});  
								
				
			});
		
			
		});
		
	</script>

</head>

<body class="table-body">
	<?php //print_r($_SESSION); ?>
	<div class="modal">
		<div class="close-modal">close.</div>
		<p><?php echo $error_model_message; ?></p>
	</div>
	
	<div class="wrap">
	
		<div class="tablepage">
			
			<div class="table-restaurant-join">
				<?php echo $join_cancel; ?>
			
			</div>
			
			<div class="table-restaurant-image">
				<img src="/img/restaurant_images/<?php echo $restaurant_image; ?>"/>
			
			</div>
				
			<div class="table-restaurant-info">
				<?php echo $restaurant_name; ?>
				<br />
				<a target="_blank" href="<?php echo $restaurant_website; ?>">Visit the website</a>
				<br />
				<a target="_blank" href="http://maps.google.com/?q=<?php echo $restaurant_location; ?>">Map Location</a>
				<br />
				Price Fix: <?php echo $price_fix; ?>
				<br />
				Corking Fee: <?php echo $corking_fee; ?>
				<br />
				Parking: <?php echo $parking; ?>
				<br />
			
			</div>
		
			<div>
			
			<?php $i=1; while($a= mysql_fetch_array($q_attend)){?>
				<div class="chair chair<?php echo $i;$i++?>">
					<img  src="https://graph.facebook.com/<?php echo $a['user_fb_id'];?>/picture" />
					<br />
					<?php echo $a['user_name'];?><br />
					
				</div>
			<?php } ?>
			
			</div>
		
		</div><!--.tablepage-->  
	
	</div><!--.wrap-->
 

<script src="js/bootstrap.min.js"></script>

</body>
</html>