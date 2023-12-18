<?php

use League\Glide\Urls\UrlBuilderFactory;

function generateImageUrl(
    string $path,
    int $width = null,
    int $height = null,
    string $format = null,
    int $quality = null,
    string $fit = null
): string {
    $urlBuilder = UrlBuilderFactory::create('img/', config('images.signature'));
    $imageConfig = [];

    if ($height) {
        $imageConfig['h'] = $height;
    }

    if ($width) {
        $imageConfig['w'] = $width;
    }

    if ($format) {
        $imageConfig['fm'] = $format;
    }

    if ($quality) {
        $imageConfig['q'] = $quality;
    }

    if ($fit) {
        $imageConfig['fit'] = $fit;
    }

    return config('app.url') . $urlBuilder->getUrl($path, $imageConfig);
}
