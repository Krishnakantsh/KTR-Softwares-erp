@props(['id' => 'closeFormBtn', 'icon' => 'ri-close-line'])

<button type="button" id="{{ $id }}"
    {{ $attributes->merge(['class' => 'btn btn-outline-danger btn-glow-red rounded-circle d-inline-flex align-items-center justify-content-center p-0']) }}
    style="width: 36px; height: 36px;">
    <i class="{{ $icon }} text-xl"></i>
</button>

@once

    <style>
        .btn-outline-danger.btn-glow-red {
            color: #ef4444 !important;
            border-color: #ef4444 !important;
            background-color: transparent !important;
            transition: all 0.3s ease-in-out !important;
        }

        .btn-outline-danger.btn-glow-red:hover {
            color: #ffffff !important;
            background-color: #ef4444 !important;
            border-color: #ef4444 !important;
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.7) !important;
        }
    </style>

@endonce
