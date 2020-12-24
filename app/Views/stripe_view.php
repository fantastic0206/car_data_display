<!DOCTYPE html>
<html>
<head>
    <title>stripe</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <style>
   .container{
    padding: 0.5%;
   }
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.css"
  rel="stylesheet"
/>

</head>
<body style="padding: 10px">
	<div style="width: 700px; margin: 30px auto; border: 1px solid black;">
		<div class="card h-100" style="boder: 1px solid black; padding: 10px;">
		<img
			src="https://static.tcimg.net/vehicles/primary/f8dbd13868cae982/2020-Acura-MDX-white-full_color-driver_side_front_quarter.png"
			class="card-img-top"
			alt="..."
		/>
		<div class="card-body">
			<h5 class="card-title" style="text-align: center;">CAR NAME : <?php echo $car_buy_data[0]['name']; ?></h5>
			<p class="card-text" style="text-align: center;">
				This car is produced in <?php echo $car_buy_data[0]['year']; ?> year.
			</p>
			<p class="card-text" style="text-align: center;">
				Speed of this car is very fast and clear.
			</p>
			<p class="card-text" style="text-align: center;">
				Please buy this car.
			</p>
		</div>
		<div class="card-footer">
			<p style="text-align: center;"><small class="text-muted">COMPANY NAME : <?php echo $car_buy_data[0]['company']; ?></small></p>
			<p style="text-align: center;"><small class="text-muted">YEAR : <?php echo $car_buy_data[0]['year']; ?></small></p>
			<p style="text-align: center;"><small class="text-muted">PRICE : 100$</small></p>
			<button class="btn btn-primary btn-block" onclick="pay(100)">BUY NOW</button>
		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://checkout.stripe.com/checkout.js"></script>

	<script type="text/javascript">

	function pay(amount) {
		var handler = StripeCheckout.configure({
		key: 'YOUR STRIPE KEY',
		locale: 'auto',
		token: function (token) {
			// You can access the token ID with `token.id`.
			// Get the token ID to your server-side code for use.
			console.log('Token Created!!');
			console.log(token)
			$('#token_response').html(JSON.stringify(token));

			$.ajax({
			url:"<?php echo base_url(); ?>stripe/payment",
			method: 'post',
			data: { tokenId: token.id, amount: amount },
			dataType: "json",
			success: function( response ) {
				console.log(response.data);
				$('#token_response').append( '<br />' + JSON.stringify(response.data));
			}
			})
		}
		});

		handler.open({
		name: 'Demo Site',
		description: '2 widgets',
		amount: amount * 100
		});
	}
	</script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</html>
