<?php

use PhpParser\Node\Expr\Cast\Bool_;

function createNonBlockingStyleLinkTag(string $path, bool $webpackLoaded = true)
{
    /**
     * When webpack-dev-server has Hot Module Replacement (HMR) enabled (hot === true),
     * styles are injected with a JS file automatically loaded by Mix.
     * We can leave out any style tags when HMR is enabled.
     */
    $hmrFlagFile = public_path('hot-output.ini');
    if (app()->environment('local') && $webpackLoaded) {
        if (is_file($hmrFlagFile) && parse_ini_file($hmrFlagFile)['hmr']) {
            return '';
        }
    }

    $blocking = createBlockingStyleLinkTag($path);
    $nonBlocking = '<link rel="preload" as="style" href="' . $path . '"  onload="this.onload=null;this.rel=\'stylesheet\'">';

    return $nonBlocking . '<noscript>' . $blocking . '</noscript>';
}

function createBlockingStyleLinkTag(string $path)
{
    return '<link rel="stylesheet" href="' . $path . '">';
}

/**
 * Given a path to a .js file,
 * create a 'nomodule' script tag that loads only in older browsers.
 * Since we don't always transpile our scripts to ES5 sytax in development,
 * this function returns an empty string if mix() throws an exception.
 *
 * This exception gets thrown when Laravel Mix doesn't fine the requested file
 * in its manifest.json file.
 */
function createES5ScriptTag(string $path)
{
    try {
        return "<script nomodule src=" . mix($path) . " defer></script>";
    } catch (Exception $e) {
        return "";
    }
}

function inlineCssFile(string $path): string
{
    $fullPath = public_path($path);
    return is_file($fullPath) ? '<style>' . file_get_contents($fullPath) . '</style>' : '';
}
