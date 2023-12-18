<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    private array $modifier;

    public function __construct(array $modifier = [])
    {
        $this->modifier = $modifier;
    }

    public function getClassesString(): string
    {
        $classes = array_map(fn(string $t): string => "btn--$t", $this->modifier);
        return implode(' ', array_merge(['btn'], $classes));
    }

    private function getClassName(string $mod): string
    {
        return "btn--$mod";
    }

    public function render()
    {
        return view('components.button');
    }
}
