<?php

namespace Src\Breadcrumbs\Models;

class Breadcrumbs
{
    private $crumbs = [];

    public function __construct(Breadcrumb ...$crumbs)
    {
        $this->crumbs = $crumbs;
    }

    public function add(Breadcrumb $crumb)
    {
        array_push($this->crumbs, $crumb);
    }

    public function getVisible(): array
    {
        return array_filter($this->crumbs, fn(Breadcrumb $crumb): bool => $crumb->visible);
    }

    public function getLinkedData(): array
    {
        $linkedData =  [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => [],
        ];

        $linkedData['itemListElement'] = [];
        foreach ($this->crumbs as $i => $crumb) {
            $linkedData['itemListElement'][] = $crumb->getLinkedData();
            $linkedData['itemListElement'][$i]['position'] = $i + 1;
        }

        return $linkedData;
    }
}
