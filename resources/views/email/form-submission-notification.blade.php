<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8" />
</head>
<body>
<h1 style="color: #26262b;">Contact Request</h1>
<dl>
    @foreach ($formData as $label => $value)
        <dt style="color: #26262b;">{{ Str::of(Str::title($label))->replace('_', ' ') }}:</dt>
        <dd style="margin-left: 0; margin-bottom: 1em; color: #26262b;">{{ $value }}</dd>
    @endforeach
</dl>
</body>
</html>
