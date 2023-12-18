<?php

namespace Src\Images;

use League\Glide\Server;

abstract class ImageServer
{
    private Server $server;

    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    public function getImagePreview(string $path): string
    {
        $params = [
            'fit' => 'max',
            'w' => 32,
            'blur' => 4,
        ];

        return $this->server->getImageAsBase64($path, $params);
    }

    public function getImageResponse(string $path, array $params)
    {
        try {
            return $this->server->getImageResponse($path, $params);
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
