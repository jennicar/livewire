<?php

namespace App\Http\Controllers\Front;

use Src\Images\ContentImageServer;
use Src\Images\StaticImageServer;
use Illuminate\Http\Request;
use League\Glide\Signatures\SignatureFactory;
use League\Glide\Signatures\SignatureException;
use League\Glide\Filesystem\FileNotFoundException;

class ImageController extends FrontController
{
    public function show(Request $request, ContentImageServer $server, $path)
    {
        try {
            // Validate HTTP signature
            SignatureFactory::create(config('images.signature'))
                ->validateRequest('/img/' . $path, $request->all());

            return $server->getImageResponse($path, $request->all());
        } catch (SignatureException $e) {
            // Forbidden
            abort(403);
        } catch (FileNotFoundException $e) {
            // Not Found
            abort(404);
        }
    }

    public function showStatic(Request $request, StaticImageServer $server, $path)
    {
        try {
            // Validate HTTP signature
            SignatureFactory::create(config('images.signature'))
                ->validateRequest('/img/static/' . $path, $request->all());

            return $server->getImageResponse($path, $request->all());
        } catch (SignatureException $e) {
            // Forbidden
            abort(403);
        } catch (FileNotFoundException $e) {
            // Not Found
            abort(404);
        }
    }
}
