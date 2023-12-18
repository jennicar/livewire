@extends('front.layouts.main')

@section('main-content')

    <header>
        <h1>Shortcodes</h1>
    </header>

    <section>
        <h2>Button</h2>

        <h3>Example</h3>

        <pre style="display: block; background: lightgray; padding: 0">

            [button class='button' href='/']
                Here's an example shortcode
            [/button]
        </pre>

        <h3>Output</h3>

        <pre style="display: block; background: lightgray; padding: 0">
            {{"
            <a class='button' href='/'>
                Here's an example shortcode
            </a>"}}
        </pre>

        <p>Result</p>

        {!! $shortcodeExample !!}
    </section>

@endsection
