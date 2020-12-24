<div class="col-md-5" id="retable">
	<table id="campanylist" class="table table-striped table-bordered">
		<thead>
			<tr><th>CAR CAMPANY</th></tr>
		</thead>
		<tbody id="company_list_tr">
			<?php
				for($i = 0; $i < count($company_name); $i++) {
					echo "<tr><td onclick='carlist()' id=".$company_name[$i]['company'].">".$company_name[$i]['company']."</td></tr>";
				}
			?>
		</tbody>
	</table>
</div>

