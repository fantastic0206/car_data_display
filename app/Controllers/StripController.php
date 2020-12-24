<?php

namespace App\Controllers;

use App\Models\Home_model;
use CodeIgniter\Controller;

class StripController extends BaseController
{
	public function __construct()
	{
		$this->home_model = new Home_model();
	}

	public function index()
	{
		return view('stripe_view');
	}
}
