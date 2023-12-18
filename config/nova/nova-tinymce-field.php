<?php

/**
 * Nova TinyMCE Configuration
 *
 * For more details, see: https://www.tiny.cloud/docs/configure/
 */

return [
    'options' => [
        'apiKey' => env('TINYMCE_API_KEY', ''), // To generate your API Key, go to https://www.tiny.cloud/auth/signup/
        'init' => [
            'allow_html_in_named_anchor' => false,
            'branding' => false,
            'extended_valid_elements' => 'a[data-*|href|rel|target],img[*]',
            'image_caption' => true,
            'menubar' => false,
            'paste_as_text' => false,
            'paste_retain_style_properties' => false,
            'valid_elements' => '*',
        ],
        'plugins' => [
            'advlist autolink lists link image imagetools media',
            'paste code wordcount autoresize table',
        ],
        'toolbar' => [
            'formatselect forecolor | bold italic underline |
                 bullist numlist outdent indent | link image media insertmedialibrary | code',
        ],
    ],
];
