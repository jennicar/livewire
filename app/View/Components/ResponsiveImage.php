<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Src\Images\ContentImageServer;
use Src\Images\ImageServerInterface;
use Src\Images\StaticImageServer;
use Illuminate\View\Component;
use League\Glide\Urls\UrlBuilder;
use League\Glide\Urls\UrlBuilderFactory;

class ResponsiveImage extends Component
{
    private static array $breakpoints = [
        'break-1' => 480,
        'break-2' => 768,
        'break-3' => 950,
        'break-4' => 1200,
        'break-5' => 1600,
    ];

    private static string $staticPathKey = 'static/';

    private ImageServerInterface $server;

    private UrlBuilder $urlBuilder;

    private string $path;

    private string $alt;

    private string $maxWidth;

    public ?bool $disableLazyLoading;

    public ?int $imgHeight;

    public ?int $imgWidth;

    public function __construct(
        string $path,
        string $alt,
        int $maxWidth,
        ?int $imgHeight = null,
        ?int $imgWidth = null,
        ?bool $disableLazyLoading = false
    ) {
        $this->server = resolve($this->isStatic($path) ? StaticImageServer::class : ContentImageServer::class);
        $this->urlBuilder = UrlBuilderFactory::create('img/', config('images.signature'));

        $this->path = $path;
        $this->alt = $alt;
        $this->maxWidth = $maxWidth;
        $this->disableLazyLoading = $disableLazyLoading;
        $this->imgHeight = $imgHeight;
        $this->imgWidth = $imgWidth;
    }

    public function getSizes(): string
    {
        $sizes = collect();
        $widths = $this->getWidths()->sort();

        for ($i = 1; $i < count($widths); $i++) {
            $sizes->push("(max-width: " . self::$breakpoints['break-' . ($i)] . "px) {$widths[$i-1]}px");
        }

        $sizes->push("{$widths->last()}px");

        return $sizes->implode(', ');
    }

    public function getSrcset(string $format = null): string
    {
        return $this->getWidths()
            ->map(fn (int $w) => $this->urlBuilder->getUrl($this->path, ['w' => $w, 'fm' => $format]) . ' ' . $w . 'w')
            ->implode(', ');
    }

    public function getFallbackSrc(): string
    {
        return $this->urlBuilder->getUrl($this->path, ['w' => $this->getWidths()->last()]);
    }

    public function getImagePreview(string $path): string
    {
        $path = $this->isStatic($path) ? $this->removeStaticPathBase($path) : $path;

        return $this->server->getImagePreview($path);
    }

    private function getWidths(): Collection
    {
        $targetWidths = collect();
        $maxBp = end(self::$breakpoints);

        foreach (self::$breakpoints as $bp) {
            // Choose whichever is smaller: the scaled image width, or the breakpoint.
            // This will avoid downloading images that are too large.
            $newWidth = (int) min($bp, floor($bp / $maxBp * $this->maxWidth ^ 2 / $maxBp));
            $targetWidths->push($newWidth);
        }

        $targetWidths->push($this->maxWidth);

        return $targetWidths;
    }

    private function isStatic(string $path)
    {
        return strpos($path, self::$staticPathKey) !== false;
    }

    private function removeStaticPathBase(string $src)
    {
        return substr($src, strpos($src, self::$staticPathKey) + strlen(self::$staticPathKey));
    }

    public function render()
    {
        return view('components.responsive-image');
    }
}
