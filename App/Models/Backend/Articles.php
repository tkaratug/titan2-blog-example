<?php
namespace App\Models\Backend;

use DB;

class Articles
{
    /**
     * Tüm yazıları listeleme
     *
     * @return object
     */
    public function getArticles()
    {
        return DB::table('articles as t1')
                    ->leftJoin('categories as t2', 't1.categoryId=t2.categoryId')
                    ->orderBy('articleId', 'desc')
                    ->getAll();
    }

    /**
     * Kategorileri listeleme
     *
     * @return object
     */
    public function getCategories()
    {
        return DB::table('categories')->orderBy('categoryName', 'asc')->getAll();
    }

    /**
     * Yazı Kaydetme
     *
     * @param array $article
     * @return boolean
     */
    public function save($article)
    {
        return DB::table('articles')->insert($article);
    }

    /**
     * Yazı Detayları
     *
     * @param int $articleId
     * @return object
     */
    public function getArticle($articleId)
    {
        return DB::table('articles')->where('articleId', '=', $articleId)->getRow();
    }

    /**
     * Yazı Düzeltme
     *
     * @param int $articleId
     * @param array $article
     * @return boolean
     */
    public function update($articleId, $article)
    {
        return DB::table('articles')->where('articleId', '=', $articleId)->update($article);
    }

    /**
     * Yazi Silme
     *
     * @param int $articleId
     * @return boolean
     */
    public function delete($articleId)
    {
        return DB::table('articles')->where('articleId', '=', $articleId)->delete();
    }
}
