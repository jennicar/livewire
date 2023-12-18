<?php

namespace Src\Breadcrumbs\Models;

class Breadcrumb
{
    public $label;

    public $url;

    public $visible;

    public function __construct(string $url, string $label, bool $visible = true)
    {
        $this->label = $label;
        $this->url = $url;
        $this->visible = $visible;
    }

    public function getLinkedData(): array
    {
        return [
            "@type" => "ListItem",
            "name" => $this->label,
            "item" => $this->url,
        ];
    }
}
