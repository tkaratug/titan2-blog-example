<?php
namespace App\Controllers\Backend;

use View, Model, Request, Validation, Session;

class Articles
{
    /**
     * Tüm Yazılar
     */
    public function index()
    {
        $data['title']      = 'Yazılar';
        $data['articles']   = Model::run('articles', 'backend')->getArticles();

        View::render('backend.articles.index', $data);
    }

    /**
     * Yeni Yazı Ekleme
     */
    public function create()
    {
        $data['title']          = 'Yeni Yazı';
        $categories             = Model::run('articles', 'backend')->getCategories();
        $data['categories'][0]  = 'Kategori Seçimi';

        foreach($categories as $category) {
            $data['categories'][$category->categoryId] = $category->categoryName;
        }

        View::render('backend.articles.create', $data);
    }

    /**
     * Yazı Kaydet
     */
     public function save()
     {
         if (!csrf_check(Request::post('_token'))) {
             View::render('errors.404');
             exit();
         }

         $title         = Request::post('title', true);
         $content       = Request::post('content');
         $status        = Request::post('status');
         $categoryId    = Request::post('categoryId');

         Validation::rule('title', 'Başlık', 'required');
         Validation::rule('content', 'Yazı Metni', 'required');
         Validation::data('title', $title);
         Validation::data('content', $content);

         if (Validation::isValid() !== true) {
             $flash['code'] = 0;
             $flash['text'] = '';
             foreach (Validation::errors() as $error) {
                 $flash['text'] .= $error . '<br>';
             }
         } else {
             $article   = [
                 'title'        => $title,
                 'content'      => $content,
                 'categoryId'   => $categoryId,
                 'status'       => $status,
                 'createdBy'    => Session::get('user_id')
             ];

             $save = Model::run('articles', 'backend')->save($article);

             if ($save) {
                 $flash['code'] = 1;
                 $flash['text'] = 'Blog yazısı kaydedildi.';
             } else {
                 $flash['code'] = 0;
                 $flash['text'] = 'Blog yazısı kaydedilirken bir hata oluştu. Lütfen tekrar deneyiniz.';
             }
         }

         Session::setFlash($flash, 'create');
     }

     /**
      * Yazı Düzeltme Sayfası
      *
      * @param int $articleId
      */
     public function edit($articleId)
     {
         $data['title']         = 'Yazı Düzelt';
         $data['article']       = Model::run('articles', 'backend')->getArticle($articleId);
         $categories            = Model::run('articles', 'backend')->getCategories();
         $data['categories'][0]  = 'Kategori Seçimi';

         foreach($categories as $category) {
             $data['categories'][$category->categoryId] = $category->categoryName;
         }

         View::render('backend.articles.edit', $data);
     }

     /**
      * Yazı düzeltme işlemi
      *
      * @param int $articleId
      */
     public function update($articleId)
     {
         if (!csrf_check(Request::post('_token'))) {
             View::render('errors.404');
             exit();
         }
         
         $title         = Request::post('title', true);
         $content       = Request::post('content');
         $status        = Request::post('status');
         $categoryId    = Request::post('categoryId');

         Validation::rule('title', 'Başlık', 'required');
         Validation::rule('content', 'Yazı Metni', 'required');
         Validation::data('title', $title);
         Validation::data('content', $content);

         if (Validation::isValid() !== true) {
             $flash['code'] = 0;
             $flash['text'] = '';
             foreach (Validation::errors() as $error) {
                 $flash['text'] .= $error . '<br>';
             }
         } else {
             $article   = [
                 'title'        => $title,
                 'content'      => $content,
                 'categoryId'   => $categoryId,
                 'status'       => $status
             ];

             $update = Model::run('articles', 'backend')->update($articleId, $article);

             if ($update) {
                 $flash['code'] = 1;
                 $flash['text'] = 'Blog yazısı güncellendi.';
             } else {
                 $flash['code'] = 0;
                 $flash['text'] = 'Blog yazısı güncellenirken bir hata oluştu. Lütfen tekrar deneyiniz.';
             }
         }

         Session::setFlash($flash, base_url('backend/articles/edit/' . $articleId));
     }

     /**
      * Yazı Silme
      *
      * @param int $articleId
      */
     public function delete($articleId)
     {
         $delete = Model::run('articles', 'backend')->delete($articleId);

         if ($delete) {
             $flash['code'] = 1;
             $flash['text'] = 'Yazı silindi.';
         } else {
             $flash['code'] = 0;
             $flash['text'] = 'Yazı silinirken bir hata oluştu. Lütfen tekrar deneyin.';
         }

         echo json_encode($flash);
     }
}
