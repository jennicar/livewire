<?php

namespace App\Utility;

/**
 * The SVG class's sole purpose is to return raw SVG markup for inlining
 * onto a page. It's effectively a glorified SVG store.
 *
 * While you could call the methods directly on the class, the recommended
 * way to inject the SVG is via the svg() helper method found in App\Helpers\SVGHelper.
 */

class SVG
{
    public static function closeIcon(string $classes = ""): string
    {
        return '
            <svg class="' . $classes . '" width="64" height="63" viewBox="0 0 64 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.9609 15.039L47.9805 46.0586" stroke="black" stroke-width="1.4"/>
                <path d="M47.5099 15.5097L16.4902 46.5293" stroke="black" stroke-width="1.4"/>
            </svg>
        ';
    }

    public static function chevron(string $classes = ""): string
    {
        return '
            <svg class="' . $classes . '" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 1L1 10L10 19" stroke="black" stroke-width="1.4"/>
            </svg>
        ';
    }
}
