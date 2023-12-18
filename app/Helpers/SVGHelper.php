<?php

use App\Utility\SVG;
use Illuminate\Support\Arr;

/**
 * Retrieves an inline SVG element from the SVG class. Classes can be applied
 * conditionally, similar to Blade's @class() directive.
 *
 * @param string $name - the name of the target element
 * @param array $classes - the classes to add to the main <svg> element
 */
function svg(string $name = "", array $classes = [])
{
    if (!$name) {
        return "";
    }

    $finalizedClasses = Arr::toCssClasses($classes);

    return SVG::$name($finalizedClasses);
}
