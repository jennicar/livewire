<?php

namespace Src\PageData\Models;

class Author
{
    public $name;

    public $photo;

    public $type;

    public function __construct(
        string $name,
        ?string $photo,
        string $type = 'Person'
    ) {
        $this->name = $name;
        $this->photo = $photo;
        $this->type = $type;
    }

    public function getLinkedData(): array
    {
        return [
            "@type" => $this->type,
            "name" => $this->name,
        ];
    }
}
