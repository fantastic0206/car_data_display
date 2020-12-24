<!DOCTYPE html>
<html>
<head>
    <title>carlist</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" href="/CodeIgniter4/public/Assets/css/main.css" />

</head>
<body>
	<!-- <div class="car-search row">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-4">
					<h4>Year Search:</h4>
				</div>
				<div class="col-md-8">
					<input id="search_year" onkeyup="yearsearch()" type="number" class="form-control input-sm year-search" />
				</div>
			</div>
		</div>
	</div> -->
	<div class="car-search" style="display: flex; width: 41.27%; padding:10px">
		<h5 style="width: 25%;">
			Year Search:
		</h5>
		<select class="form-control" id='search_year' onChange='yearsearch()'>
			<option></option>
			<?php
				for($i = 1909; $i <= 2020; $i++) {
					echo "<option>".$i."</option>";
				}
			?>
		</select>
	</div>
	<div class="car-data row" id="total_data">
		<?php include_once 'company_list_view.php'; ?>
		<?php include_once 'car_list_view.php'; ?>
		<?php include_once 'car_data_view.php'; ?>
	</div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#campanylist').DataTable();
    } );
    $(document).ready(function() {
        $('#carlist').DataTable({searching: false, paging: false, info: false});
    } );

	function carlist() {
		var companyId = "#"+event.target.id;
		var companyName = $(companyId).text();
		// $(companyId).toggleClass("active");
		$.ajax({
			// url: "http://localhost:8080/CodeIgniter4/public/index.php/home/getCarList",
			url: "<?php echo base_url('CodeIgniter4/public/index.php/home/getCarList')?>",
			type: 'POST',
			dataType:'json',
			data : {
				companyName : companyName,
			},
			success:function(data){
				var rowData=[];
				for(var i = 0; i < data.length ; i++) {
					var row = "<tr>"+
						"<td onclick='cardata()' id="+data[i]['id']+">"+data[i]['car_model']+"</td>"+
					"</tr>";
					rowData.push(row);
				}
				$("#car_list_tr").html(rowData);
			}
		});
	}

	function cardata() {
		var carModelId = event.target.id;
		$.ajax({
			// url: "http://localhost:8080/CodeIgniter4/public/index.php/home/getCarList",
			url: "<?php echo base_url('CodeIgniter4/public/index.php/home/getCarData')?>",
			type: 'POST',
			dataType:'json',
			data : {
				carModelId : carModelId,
			},
			success:function(data){
				var car_detail = "<div class='card' style='margin-top: 40px; padding-top: 10px;'>"+
					"<div class='card-header'><label>CAR DETAIL</label></div>"+
						"<img src='https://static.tcimg.net/vehicles/primary/f8dbd13868cae982/2020-Acura-MDX-white-full_color-driver_side_front_quarter.png' alt='Denim Jeans' style='width:100%'>"+
						"<h1>"+data[0].name+"</h1>"+
						"<p class='price'>price:$20</p>"+
						"<p>year:"+data[0].year+"</p>"+
						"<p>company:"+data[0].company+"</p>"+
						"<a href='<?php echo base_url('CodeIgniter4/public/index.php/stripContoller'); ?>'><button class='btn btn-primary'>Buy</button></a>"+
					"</div>";
				$("#car_detail").html(car_detail);
			}
		});
	}

	function yearsearch() {
		var yearSearch = $("#search_year").val();
		$.ajax({
			url: "<?php echo base_url('CodeIgniter4/public/index.php/home/getYearData')?>",
			type: 'POST',
			dataType:'json',
			data : {
				yearSearch : yearSearch,
			},
			success:function(data){
				var yearSearchData = data;
				var rowData=[];
				for(var i = 0; i < data.length ; i++) {
					var row = "<tr><td onclick='carlist()' id="+data[i]['company']+">"+data[i]['company']+"</td></tr>";
					rowData.push(row);
				}
				// var table = "<table id='campanylist' class='table table-striped table-bordered'>"+
				// 	"<thead>"+
				// 		"<tr><th>CAR CAMPANY</th></tr>"+
				// 	"</thead>"+
				// 	"<tbody>"+
				// 		rowData
				// 	"</tbody>"+
				// "</table>";
				// $("#retable").html(table);
				$("#company_list_tr").html(rowData)
			}
		});
	}
</script>

</html>
