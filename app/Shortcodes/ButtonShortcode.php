<?php

namespace App\Shortcodes;

class ButtonShortcode
{
    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        $classes = $shortcode->class ?? "";
        $href = $shortcode->href ?? "/";

        return <<<BUTTON
            <a class="$classes" href="$href">
                $content
            </a>
        BUTTON;
    }
}
