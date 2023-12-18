<?php

namespace Src\Images;

interface ImageServerInterface
{
    public function getImagePreview(string $path): string;

    public function getImageResponse(string $path, array $params);
}
