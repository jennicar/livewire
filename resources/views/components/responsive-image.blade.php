<picture {{ $attributes }}>
    @if ($disableLazyLoading)
        <source
            srcset="{{ $getSrcset('webp') }}"
            sizes="{{ $getSizes() }}"
            type="image/webp"
        >
        <img
            @if ($imgHeight)
                height="{{ $imgHeight }}"
            @endif
            @if ($imgWidth)
                width="{{ $imgWidth }}"
            @endif
            srcset="{{ $getSrcset() }}"
            sizes="{{ $getSizes() }}"
            src="{{ $getImagePreview() }}"
            alt="{{  $alt }}"
        >
    @else
        <source
            data-srcset="{{ $getSrcset('webp') }}"
            data-sizes="{{ $getSizes() }}"
            data-type="image/webp"
        >
        <img
            @if ($imgHeight)
                height="{{ $imgHeight }}"
            @endif
            @if ($imgWidth)
                width="{{ $imgWidth }}"
            @endif
            data-srcset="{{ $getSrcset() }}"
            data-sizes="{{ $getSizes() }}"
            src="{{ $getImagePreview() }}"
            alt="{{  $alt }}"
        >
    @endif
    <noscript>
        <img
            @if ($imgHeight)
                height="{{ $imgHeight }}"
            @endif
            @if ($imgWidth)
                width="{{ $imgWidth }}"
            @endif
            srcset="{{ $getSrcset() }}"
            sizes="{{ $getSizes() }}"
            src="{{ $getFallbackSrc() }}"
            alt="{{ $alt }}"
            loading="lazy"
            {{ $attributes }}
        >
    </noscript>
</picture>
