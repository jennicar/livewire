<?php

namespace Src\PageData\Models;

use DateTime;

class Timestamps
{
    private $dateCreated;

    private $dateModified;

    private $datePublished;

    public function __construct(
        DateTime $dateCreated,
        DateTime $dateModified,
        DateTime $datePublished = null
    ) {
        $this->dateCreated = $dateCreated;
        $this->dateModified = $dateModified;
        $this->datePublished = $datePublished;
    }

    public function getFormattedTimestamps()
    {
        return [
            'dateCreated' => $this->dateCreated->format(DateTime::ATOM),
            'dateModified' => $this->dateModified->format(DateTime::ATOM),
            'datePublished' => $this->datePublished ? $this->datePublished->format(DateTime::ATOM) : null,
        ];
    }
}
