@extends('frontend.master')

@section('content')
<div class="row">

    <!-- Blog Post Content Column -->
    <div class="col-lg-8">

        @foreach($articles as $article)
            <!-- Title -->
            <h1>{{ $article->title }}</h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#">Admin</a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on {{ Date::set($article->createdAt)->get('d.m.y H:i:s') }}</p>

            <hr>

            <!-- Post Content -->
            <p class="lead">{!! $article->content !!}</p>

            <hr>
        @endforeach

    </div>
    <!-- /.Blog Post Content Column -->

    <!-- Blog Sidebar Widgets Column -->
    <div class="col-md-4">
        <!-- Blog Categories Well -->
        <div class="well">
            <h4>Blog Categories</h4>

            <ul class="list-unstyled">
            @foreach($categories as $category)
            <li><a href="/categories/{{ $category->categorySlug }}">{{ $category->categoryName }}</a></li>
            @endforeach
            </ul>

        </div>
    </div>
    <!-- /.Blog Sidebar Widgets Column -->

</div>
@endsection
