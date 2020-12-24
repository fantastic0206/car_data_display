<?php

namespace App\Controllers;

use App\Models\Home_model;
use CodeIgniter\Controller;

class Stripe extends BaseController
{
	public function __construct()
	{
		$this->home_model = new Home_model();
	}

	public function index()
	{
		$car_buy_data = $this->home_model->get_buy_data();
		$data = [
			'car_buy_data' => $car_buy_data
		];
		return view('stripe_view', $data);
	}

	public function payment()
    {
      require_once('app/libraries/stripe-php/init.php');

	  $stripeSecret = 'YOUR STRIPE SECRETE KEY';

      \Stripe\Stripe::setApiKey($stripeSecret);

        $stripe = \Stripe\Charge::create ([
                "amount" => $this->input->post('amount'),
                "currency" => "usd",
                "source" => $this->input->post('tokenId'),
                "description" => "This is from nicesnippets.com"
        ]);

       // after successfull payment, you can store payment related information into your database

        $data = array('success' => true, 'data'=> $stripe);

        echo json_encode($data);
    }
}
