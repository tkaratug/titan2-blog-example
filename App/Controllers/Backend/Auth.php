<?php
namespace App\Controllers\Backend;

use View, Validation, Request, Session, Model;

class Auth
{
    public function login()
    {
        View::render('backend.login');
    }

    public function doLogin()
    {
        if (!csrf_check(Request::post('_token'))) {
            View::render('errors.404');
            exit();
        }

        $usermail = Request::post('usermail', true);
        $userpass = Request::post('userpass', true);
        //$remember = Request::post('remember');

        Validation::rule('usermail', 'E-Posta', 'required|email');
        Validation::rule('userpass', 'Parola', 'required|min_len,8');
        Validation::data('usermail', $usermail);
        Validation::data('userpass', $userpass);

        if (!Validation::isValid()) {
            $messages = '';
            foreach (Validation::errors() as $error) {
                $messages .= $error . '<br>';
            }
            Session::setFlash($messages, base_url('login'));
        } else {
            $login = Model::run('auth', 'backend')->login($usermail, $userpass);

            if ($login !== false) {
                Session::set(['logged' => true, 'user_id' => $login->userId, 'usermail' => $login->usermail]);

                redirect(base_url('backend'));
            } else {
                Session::setFlash('Hatalı giriş', base_url('login'));
            }

        }
    }

    public function logout()
    {
        Session::delete();
        redirect(base_url('login'));
    }
}
