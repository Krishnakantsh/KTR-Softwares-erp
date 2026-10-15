@php
    $initials = strtoupper(
        substr(
            collect(explode(' ', $name ?? 'Student'))
                ->map(fn($item) => $item[0] ?? '')
                ->join(''),
            0,
            2,
        ),
    );
    $sizeStyle = isset($size) ? "width: {$size}px; height: {$size}px; font-size: calc({$size}px / 3);" : '';
@endphp

<div class="avatar" style="{{ $sizeStyle }} {{ !empty($img) ? "background-image: url('{$img}');" : '' }}">
    @if (empty($img))
        {{ $initials }}
    @endif
</div>
