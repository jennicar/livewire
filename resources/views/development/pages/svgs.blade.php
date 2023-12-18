@extends('front.layouts.main')

@section('main-content')
{{--
    temporary inline styles; clean up once PR #60 Remove Tailwind merged
--}}
<style>
    .icons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1em;
    }

    .icon {
        display: grid;
        place-items: center;
        grid-template-rows: 2fr 1fr;
        gap: 1rem;
        padding: 1em;
        outline: 1px solid black;
    }

    .icon p {
        font-size: 0.8rem;
        word-break: break-word;
    }

    .icon svg {
        width: 50px;
        height: 50px;
    }

    pre {
        background-color: lightgray;
    }
</style>

<header>
    <h1>SVG Icons</h1>

    <p>Below are the available icons available for inlining.</p>

    <p>Icons can be included by calling <code>svg('iconName', ['classes', 'to', 'add'])</code>.</p>

    <h2>Example:</h2>
    <pre>{{"
            @verbatim
            <div>
                {!! svg('chevron', ['chevron', 'chevron--right']) !!}
            </div>
            @endverbatim"}}</pre>
</header>

<section>
    <ul class="icons">
        @foreach ($availableSvgs as $svg)
            <li class="icon">
                {!! svg($svg) !!}
                <p>{{ $svg }}</p>
            </li>
        @endforeach
    </ul>
</section>
@endsection
