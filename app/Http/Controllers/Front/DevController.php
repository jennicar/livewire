<?php

namespace App\Http\Controllers\Front;

use App\Utility\SVG;
use Shortcode;

class DevController extends FrontController
{
    public function criticalCss()
    {
        return view('layouts.front.basic');
    }

    public function design()
    {
        return view('development.pages.design');
    }

    public function shortcodes()
    {
        Shortcode::disable();
        $compiledBtnShortcode = Shortcode::compile("[button class='foo' href='/']Here's an example shortcode[/button]");

        return view('development.pages.shortcodes', [
            'shortcodeExample' => $compiledBtnShortcode
        ])->withoutShortcodes();
    }

    public function svgs()
    {
        $availableSvgs = get_class_methods(SVG::class);
        asort($availableSvgs);

        return view('development.pages.svgs', [
            'availableSvgs' => $availableSvgs
        ]);
    }

    public function designTypography()
    {
        return view('front.design.type');
    }
}
