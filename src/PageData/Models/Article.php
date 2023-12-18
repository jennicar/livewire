<?php

namespace Src\PageData\Models;

class Article
{
    private $meta;

    public $author;

    public $publisher;

    public $timestamps;

    public $content;

    public function __construct(
        Meta $meta,
        Author $author,
        Publisher $publisher,
        Timestamps $timestamps,
        string $content
    ) {
        $this->meta = $meta;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->timestamps = $timestamps;
        $this->content = $content;
    }

    public function getLinkedData(): array
    {
        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $this->meta->title,
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $this->meta->url,
            ],
            'image' => [
                $this->meta->image->get16x9(),
                $this->meta->image->get4x3(),
                $this->meta->image->get1x1()
            ],
            'articleBody' => $this->content,
            'author' => $this->author->getLinkedData(),
            'publisher' => $this->publisher->getLinkedData(),
        ];

        return $data + $this->timestamps->getFormattedTimestamps();
    }

    public function getMetaTags(): string
    {
        return $this->meta->getAllTags();
    }
}
