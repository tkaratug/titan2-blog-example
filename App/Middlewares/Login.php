<?php
namespace App\Middlewares;

use Session;

class Login
{

	public static function handle()
	{
		if (Session::has('logged')) {
			redirect(link_to('backend'));
		}
	}

}
