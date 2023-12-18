@extends('front.layouts.main')

@section('title', $metaData->title)

@section('meta-tags')
    {!! $metaData->getAllTags() !!}
@endsection

@section('main-content')

    @foreach ($categories as $cat)
        <a href="{{ route('blog.categoryIndex', ['category' => $cat->slug]) }}">{{ $cat->name }}</a>
    @endforeach

    @include('front.blog.posts', ['posts' => $posts])

    @if($morePosts)
        <button data-comp-blog-index-load-more-button data-category-id="{{ $category ? $category->id : null }}">
            Load more
        </button>
    @endif
</div>
@endsection
