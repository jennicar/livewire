<?php

namespace Src\PageData\Models;

class Publisher
{
    private $name;

    private $logoUrl;

    public function __construct(string $name, string $logoUrl)
    {
        $this->name = $name;
        $this->logoUrl = $logoUrl;
    }

    public function getLinkedData(): array
    {
        return [
            '@type' => 'Organization',
            'name' => $this->name,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $this->logoUrl,
            ],
        ];
    }
}
