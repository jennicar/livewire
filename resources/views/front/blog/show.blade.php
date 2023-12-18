@extends('front.layouts.main')

@push('meta')
    {!! $articleMetaData->getMetaTags() !!}
    <script type="application/ld+json">
        @json($articleMetaData->getLinkedData())
    </script>
@endpush

@section('main-content')
    <article class="post-article">
        {!! $post->content !!}
    </article>
@endsection
