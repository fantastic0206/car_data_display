<?php
namespace App\Models;

use CodeIgniter\CLI\Console;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use mysqli;

class Home_model extends Model {
	public function get_company_data() {
		$db = db_connect();
		$query = $db->query('SELECT DISTINCT company_name FROM car_data');
		$results = $query->getResult();
		$ary = array();
		$rows = [];
		foreach($results as $row) {
			$rows['company'] = $row->company_name;
			array_push($ary, $rows);
		}

		return $ary;
	}

	public function get_car_model($companyName) {
		$db = db_connect();
		$query = $db->query('SELECT id, car_model FROM car_data WHERE company_name="'.$companyName.'"');
		$results = $query->getResult();
		$ary = array();
		$rows = [];

		foreach($results as $row) {
			$rows['id'] = $row->id;
			$rows['car_model'] = $row->car_model;
			array_push($ary, $rows);
		}

		return $ary;
	}

	public function get_car_data($carModelId) {
		$db = db_connect();
		$query = $db->query('SELECT id, year, company_name, car_model FROM car_data WHERE id="'.$carModelId.'"');
		$results = $query->getResult();
		$ary = array();
		$rows = [];
		foreach($results as $row) {
			$rows['id'] = $row->id;
			$rows['year'] = $row->year;
			$rows['company'] = $row->company_name;
			$rows['name'] = $row->car_model;
			array_push($ary, $rows);
		}

		return $ary;
	}

	public function get_year_data($yearSearch) {
		$db = db_connect();
		if($yearSearch != '') $query = $db->query('SELECT company_name FROM car_data WHERE year="'.$yearSearch.'"');
		else if($yearSearch == '') $query = $db->query('SELECT DISTINCT company_name FROM car_data');
		$results = $query->getResult();
		$ary = array();
		$rows = [];
		foreach($results as $row) {
			$rows['company'] = $row->company_name;
			array_push($ary, $rows);
		}

		return $ary;
	}
}
?>
