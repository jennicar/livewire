@if(isset($attributes['href']))
    <a {{ $attributes->merge(['class' => $getClassesString()]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $getClassesString()]) }}>
        {{ $slot }}
    </button>
@endif
