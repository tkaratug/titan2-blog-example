<?php
namespace App\Middlewares;

use Session;

class Login
{

	public static function handle()
	{
		if (Session::has('logged')) {
			redirect(base_url('backend'));
		}
	}

}
