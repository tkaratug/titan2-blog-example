<?php
namespace App\Middlewares;

use Session;

class Auth
{

	public static function handle()
	{
		if (!Session::has('logged')) {
			redirect(base_url('login'));
		}
	}

}
