<?php
namespace App\Models\Backend;

use DB;

class Categories
{
    /**
     * Kategori Listesi
     *
     * @return object
     */
    public function getCategories()
    {
        return DB::table('categories')->orderBy('categoryName', 'asc')->getAll();
    }

    /**
     * Kategori ekleme
     *
     * @param array $category
     * @return boolean
     */
    public function save($category)
    {
        return DB::table('categories')->insert($category);
    }

    /**
     * Kategori detayları
     *
     * @param int $categoryId
     * @return object
     */
    public function getCategory($categoryId)
    {
        return DB::table('categories')->where('categoryId', '=', $categoryId)->getRow();
    }

    /**
     * Kategori güncelleme
     *
     * @param int $categoryId
     * @param array $category
     * @return boolean
     */
    public function update($categoryId, $category)
    {
        return DB::table('categories')->where('categoryId', '=', $categoryId)->update($category);
    }

    /**
     * Kategoriye ait blog yazısı sayısı
     *
     * @param int $categoryId
     * @return int
     */
    public function hasPosts($categoryId)
    {
        DB::table('articles')->where('categoryId', '=', $categoryId)->getAll();
        return DB::numRows();
    }

    /**
     * Kategori Silme
     *
     * @param int $categoryId
     * @return boolean
     */
    public function delete($categoryId)
    {
        return DB::table('categories')->where('categoryId', '=', $categoryId)->delete();
    }
}
