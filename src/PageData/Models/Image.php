<?php

namespace Src\PageData\Models;

class Image
{
    public $path;

    public $alt;

    public function __construct(string $path, string $alt)
    {
        $this->path = $path;
        $this->alt = $alt;
    }

    public function getOGTag(): string
    {
        $imageUrl = generateImageUrl($this->path, 1200, 630, null, null, 'crop-center');

        return <<<EOT
            <meta property="og:image" content="$imageUrl">
            <meta property="og:imagealt" content="$this->alt">
        EOT;
    }

    public function getTwitterTag(): string
    {
        $imageUrl = generateImageUrl($this->path, 1200, 630, null, null, 'crop-center');

        return <<<EOT
            <meta name="twitter:image" content="$imageUrl">
            <meta name="twitter:image:alt" content="$this->alt">
        EOT;
    }

    public function get16x9()
    {
        return generateImageUrl($this->path, 1600, 900, null, null, 'crop-center');
    }

    public function get4x3()
    {
        return generateImageUrl($this->path, 1200, 900, null, null, 'crop-center');
    }

    public function get1x1()
    {
        return generateImageUrl($this->path, 900, 900, null, null, 'crop-center');
    }
}
