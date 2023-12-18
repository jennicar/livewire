<?php

namespace Src\PageData\Models;

class Meta
{
    public $title;

    public $description;

    public $url;

    public $image;

    public string $type;

    public function __construct(string $title, string $description, string $url, Image $image = null, string $type = 'website')
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->image = $image ?: new Image('/static/share-image.png', 'btp-laravel-base');
        $this->type = $type;
    }

    public function getGenericTags(): string
    {
        return <<<EOT
            <title>$this->title</title>
            <link rel="canonical" href="$this->url">
            <meta name="description" content="$this->description">
            <meta name="title" content="$this->title">
        EOT;
    }

    public function getOGTags(): string
    {
        $appUrl = config('app.url');
        $metaTags = <<<EOT
            <meta property="og:locale" content="en_US">
            <meta property="og:type" content="$this->type">
            <meta property="og:site_name" content="btp-laravel-base">
            <meta property="og:url" content="$appUrl">
            <meta property="og:description" content="$this->description">
            <meta property="og:title" content="$this->title">
        EOT;

        $imageTags = $this->image->getOGTag();

        return $metaTags . $imageTags;
    }

    public function getTwitterTags(): string
    {
        $metaTags = <<<EOT
            <meta name="twitter:title" content="$this->title">
            <meta name="twitter:description" content="$this->description">
            <meta name="twitter:card" content="summary">
        EOT;

        $imageTags = $this->image->getTwitterTag();

        return $metaTags . $imageTags;
    }

    public function getAllTags(): string
    {
        return $this->getGenericTags() . "\n" . $this->getOGTags() . "\n" . $this->getTwitterTags();
    }
}
