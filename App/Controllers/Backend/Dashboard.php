<?php
namespace App\Controllers\Backend;

use View;

class Dashboard
{

	public function index()
	{
		$data['title'] = 'Dashboard';
		View::render('backend.dashboard', $data);
	}

}
