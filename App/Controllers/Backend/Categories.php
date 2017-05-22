<?php
namespace App\Controllers\Backend;

use View, Model, Request, Session;

class Categories
{
    public function index()
    {
        $data['title']      = 'Kategoriler';
        $data['categories'] = Model::run('categories', 'backend')->getCategories();

        View::render('backend.categories.index', $data);
    }

    /**
     * Yeni Kategori Ekleme Penceresi
     */
    public function create()
    {
        View::render('backend.categories.create');
    }

    /**
     * Yeni Kategori Ekleme
     */
    public function save()
    {
        if (Request::isAjax()) {
            if (!csrf_check(Request::post('_token'))) {
                $response['code']   = 0;
                $response['msg']    = 'Token geçersiz.';
            } else {
                $categoryName = Request::post('categoryName', true);
                $categorySlug = Request::post('categorySlug', true);

                if ($categoryName == '' || $categorySlug == '') {
                    $response['code']   = 0;
                    $response['msg']    = 'Lütfen tüm alanları doldurun.';
                } else {
                    $category = [
                        'categoryName'  => $categoryName,
                        'categorySlug'  => $categorySlug,
                        'createdBy'     => Session::get('user_id')
                    ];

                    $save = Model::run('categories', 'backend')->save($category);

                    if ($save) {
                        $response['code']   = 1;
                        $response['msg']    = 'Kategori eklendi.';
                    } else {
                        $response['code']   = 0;
                        $response['msg']    = 'Kategori eklenirken bir hata oluştu. Lütfen tekrar deneyin.';
                    }
                }
            }

            echo json_encode($response);
        } else {
            dd('hata', true);
        }
    }

    /**
     * Kategori düzeltme
     *
     * @param int $categoryId
     */
    public function edit($categoryId)
    {
        $data['category'] = Model::run('categories', 'backend')->getCategory($categoryId);

        View::render('backend.categories.edit', $data);
    }

    /**
     * Kategori güncelleme
     *
     * @param int $categoryId
     */
    public function update($categoryId)
    {
        if (Request::isAjax()) {
            if (!csrf_check(Request::post('_token'))) {
                $response['code']   = 0;
                $response['msg']    = 'Token geçersiz.';
            } else {
                $categoryName = Request::post('categoryName', true);
                $categorySlug = Request::post('categorySlug', true);

                if ($categoryName == '' || $categorySlug == '') {
                    $response['code']   = 0;
                    $response['msg']    = 'Lütfen tüm alanları doldurun.';
                } else {
                    $category = [
                        'categoryName'  => $categoryName,
                        'categorySlug'  => $categorySlug,
                        'createdBy'     => Session::get('user_id')
                    ];

                    $update = Model::run('categories', 'backend')->update($categoryId, $category);

                    if ($update) {
                        $response['code']   = 1;
                        $response['msg']    = 'Kategori güncellendi.';
                    } else {
                        $response['code']   = 0;
                        $response['msg']    = 'Kategori güncellenirken bir hata oluştu. Lütfen tekrar deneyin.';
                    }
                }
            }

            echo json_encode($response);
        } else {
            dd('hata', true);
        }
    }

    /**
     * Kategori silme
     *
     * @param int $categoryId
     */
    public function delete($categoryId)
    {
        $hasPosts = Model::run('categories', 'backend')->hasPosts($categoryId);

        if ($hasPosts > 0) {
            $flash['code'] = 0;
            $flash['text'] = 'Bu kategoriye ait blog yazısı olduğundan silme işlemi gerçekleştirilemedi.';
        } else {
            $delete = Model::run('categories', 'backend')->delete($categoryId);

            if ($delete) {
                $flash['code'] = 1;
                $flash['text'] = 'Kategori silindi';
            } else {
                $flash['code'] = 0;
                $flash['text'] = 'Kategori silinirken bir hata oluştu. Lütfen tekrar deneyin.';
            }
        }

        echo json_encode($flash);
    }
}
