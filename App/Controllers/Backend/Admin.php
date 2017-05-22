<?php
namespace App\Controllers\Backend;

use View, Model, Request, Validation, Session;

class Admin
{

    public function index()
    {
        $data['title'] = 'Yönetici Şifresi';

        View::render('backend.admin.index', $data);
    }

    /**
     * Yönetici şifresini güncelleme
     */
    public function update()
    {
        Validation::rule('current', 'Mevcut Şifre', 'required|min_len,8');
        Validation::rule('new', 'Yeni Şifre', 'required|min_len,8');
        Validation::rule('new_confirm', 'Yeni Şifre (Tekrar)', 'required|min_len,8|matches,new');

        Validation::data('current', Request::post('current', true));
        Validation::data('new', Request::post('new', true));
        Validation::data('new_confirm', Request::post('new_confirm', true));

        if (Validation::isValid()) {

            $confirmCurrent = Model::run('admin', 'backend')->confirmCurrent(Session::get('user_id'), Request::post('current', true));

            if ($confirmCurrent) {
                $password = [
                    'userpass'  => password_hash(Request::post('new', true), PASSWORD_DEFAULT)
                ];

                $update = Model::run('admin', 'backend')->update(Session::get('user_id'), $password);

                if ($update) {
                    $flash['code'] = 1;
                    $flash['text'] = 'Yönetici şifresi güncellendi.';
                } else {
                    $flash['code'] = 0;
                    $flash['text'] = 'Yönetici şifresi güncellenirken bir hata oluştu. Lütfen tekrar deneyin.';
                }
            } else {
                $flash['code'] = 0;
                $flash['text'] = 'Şifre geçersiz.';
            }

        } else {
            $flash['code'] = 0;
            $flash['text'] = '';
            foreach (Validation::errors() as $error) {
                $flash['text'] .= $error . '<br>';
            }
        }

        Session::setFlash($flash, base_url('backend/admin'));
    }

}
