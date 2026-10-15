<button type="button" data-bs-dismiss="modal"
    {{ $attributes->merge(['class' => 'btn btn-glow-red rounded-circle d-inline-flex align-items-center  justify-content-center p-0']) }}
    style="width: 50px; height: 50px;">
    <i class="ri-close-line text-xl"></i>
</button>


<style>
    .btn-glow-red {
        width: 40px;
        height: 40px;
        border: none !important;
        border-radius: 50% !important;
        background: linear-gradient(135deg, #ef4444, #dc2626) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(239, 68, 68, .30);
        transition: all .35s cubic-bezier(.4, 0, .2, 1);
    }

    .btn-glow-red i {
        color: #ffffff !important;
        transition: transform .35s ease;
    }

    .btn-glow-red:hover {
        background: linear-gradient(135deg, #dc2626, #b91c1c) !important;
        color: #ffffff !important;
        transform: scale(1.02) rotate(90deg);
        box-shadow:
            0 10px 25px rgba(239, 68, 68, .45),
            0 0 0 6px rgba(239, 68, 68, .12);
    }

    .btn-glow-red:hover i {
        transform: rotate(90deg);
    }

    .btn-glow-red:focus,
    .btn-glow-red:active {
        color: #ffffff !important;
        background: linear-gradient(135deg, #dc2626, #b91c1c) !important;
        box-shadow:
            0 0 0 4px rgba(239, 68, 68, .18),
            0 8px 20px rgba(239, 68, 68, .35);
    }
</style>
