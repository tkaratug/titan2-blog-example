<?php

namespace App\Controllers\Frontend;

use View, Model;

class Home
{

	public function index()
	{
		$data['title'] 		= 'Blog - Titan 2 Web Framework';
		$data['articles']	= Model::run('articles', 'frontend')->getArticles();
		$data['categories'] = Model::run('articles', 'frontend')->getCategories();

		View::render('frontend.home', $data);
	}

	public function categories($categorySlug)
	{
		$data['category']	= Model::run('articles', 'frontend')->getCategory($categorySlug);
		$data['articles']	= Model::run('articles', 'frontend')->getArticlesByCategoryId($data['category']->categoryId);
		$data['categories'] = Model::run('articles', 'frontend')->getCategories();

		$data['title'] 		= $data['category']->categoryName;

		View::render('frontend.categories', $data);
	}

}
