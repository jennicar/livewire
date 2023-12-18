{!! $criticalCSS !!}
@stack('critical-styles')

<script>{!!  file_get_contents(public_path('js/cssrelpreload.min.js')) !!}</script>
{!! createNonBlockingStyleLinkTag(mix('css/global.css')) !!}

@stack('styles')
