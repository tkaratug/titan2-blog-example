<?php
namespace App\Models\Frontend;

use DB;

class Articles
{

    /**
     * Blog Yazıları
     *
     * @return object
     */
    public function getArticles()
    {
        return DB::table('articles')->where('status', '=', 1)->orderBy('articleId', 'desc')->getAll();
    }

    /**
     * Kategoriler
     *
     * @return object
     */
    public function getCategories()
    {
        return DB::table('categories')->orderBy('categoryId', 'asc')->getAll();
    }

    /**
     * Kategori Detayları
     *
     * @param string $categorySlug
     * @return object
     */
    public function getCategory($categorySlug)
    {
        return DB::table('categories')->where('categorySlug', '=', $categorySlug)->getRow();
    }

    /**
     * Kategoriye ait blog yazıları
     *
     * @param int $categoryId
     * @return object
     */
    public function getArticlesByCategoryId($categoryId)
    {
        return DB::table('articles')->where('categoryId', '=', $categoryId)->where('status', '=', 1)->orderBy('articleId', 'desc')->getAll();
    }

}
