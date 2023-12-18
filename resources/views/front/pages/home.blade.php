@extends('front.layouts.main')

@push('meta')
    {!! $metaData->getAllTags() !!}
@endpush

@push('styles')

@endpush

@push('critical-styles')

@endpush

@section('main-content')
    @include('components.header')

    <article class="container px-4 mx-auto my-8">
        <h1 class="text-6xl md:text-md6xl">hello world</h1>
        <p class="text-base">Culpa excepteur qui exercitation excepteur cupidatat occaecat. Ullamco ad occaecat dolore aliqua qui aliquip qui et culpa veniam ipsum ea ex id. Esse ad do consectetur mollit nostrud aliquip labore magna laboris velit esse. Ullamco esse aute occaecat sint incididunt adipisicing occaecat duis ea culpa sit. Sunt do ea anim enim pariatur. Esse deserunt eiusmod ullamco eu. Non proident magna incididunt non et est incididunt dolor aliqua.</p>
    </article>

@endsection
