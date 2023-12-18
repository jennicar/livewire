@extends('front.layouts.main')

@push('meta')
{!! $metaData->getAllTags() !!}
@endpush

@section('main-content')

    @foreach ($products as $product)
        {{ $product['title'] }}
    @endforeach

@endsection
