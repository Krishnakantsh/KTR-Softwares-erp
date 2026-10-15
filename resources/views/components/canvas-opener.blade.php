@props([
    'target' => '',
    'icon' => 'ri-add-line',
])

<button type="button"  class="{{$target}} btn btn-glow-green rounded-circle d-inline-flex align-items-center justify-content-center p-0"
    style="width:40px;height:40px;">
    <i class="{{ $icon }} text-xl"></i>
</button>

@once
    <style>
        .btn-glow-green {
            border: none !important;
            border-radius: 50% !important;
            background: linear-gradient(135deg, #22c55e, #16a34a) !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(34, 197, 94, .30);
            transition: all .35s cubic-bezier(.4, 0, .2, 1);
        }

        .btn-glow-green i {
            color: #fff !important;
            transition: transform .35s ease;
        }

        .btn-glow-green:hover {
            background: linear-gradient(135deg, #16a34a, #15803d) !important;
            color: #fff !important;
            transform: scale(1.05);
            box-shadow:
                0 10px 25px rgba(34, 197, 94, .45),
                0 0 0 6px rgba(34, 197, 94, .12);
        }

        .btn-glow-green:hover i {
            transform: rotate(90deg);
        }

        .btn-glow-green:focus,
        .btn-glow-green:active {
            color: #fff !important;
            background: linear-gradient(135deg, #16a34a, #15803d) !important;
            box-shadow:
                0 0 0 4px rgba(34, 197, 94, .18),
                0 8px 20px rgba(34, 197, 94, .35);
        }
    </style>
@endonce







{{-- ri-add-line            // Default
ri-eye-line
ri-edit-line
ri-user-add-line
ri-file-add-line
ri-settings-3-line
ri-search-line
ri-printer-line
ri-download-2-line
ri-upload-2-line
ri-refresh-line --}}
