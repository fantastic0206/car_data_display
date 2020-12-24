<?php

namespace App\Controllers;

use App\Models\Home_model;

class Home extends BaseController
{
	public function __construct()
	{
		$this->home_model = new Home_model();
	}

	public function index()
	{
		$car_company_data = $this->home_model->get_company_data();
		$data = [
			'company_name' => $car_company_data
		];
		return view('main_view', $data);
	}

	public function getCarList() {
		$companyName = $_POST['companyName'];
		$data = $this->home_model->get_car_model($companyName);

		echo json_encode($data);
	}

	public function getCarData() {
		$carModelId = $_POST['carModelId'];
		$data = $this->home_model->get_car_data($carModelId);

		echo json_encode($data);
	}

	public function getYearData() {
		$yearSearch = $_POST['yearSearch'];
		$data = $this->home_model->get_year_data($yearSearch);

		echo json_encode($data);
	}

	public function buyDataInsert() {
		$buyCarId = $_POST['buyCarId'];
		$this->home_model->insert_buy_car_data($buyCarId);
	}
}
