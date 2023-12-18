<!-- Built By the Pixel -->
<!-- https://bythepixel.com -->

@stack('meta')

<link rel="icon" href="/static/images/TODO.png" type="image/png">
<meta name="robots" content="{{ app()->environment() === 'production' ? 'all' : 'noindex, nofollow' }}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<script type="application/ld+json">
    @json($breadcrumbs->getLinkedData())
</script>

