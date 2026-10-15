<div class="row p-4 g-3 transport-container" id="transportMonthsContainer">

    <!-- Header -->
    <div class="col-md-12 d-flex align-items-center justify-content-between mb-3 p-3 header-card">
        <div>
            <h4 class="fw-bold mb-1 header-title">Transport Setting</h4>
            <p class="text-muted mb-0 small">
                Enable / Disable monthly transport fee
            </p>
        </div>

        <div class="transport-icon">
            <i class="fa fa-bus"></i>
        </div>
    </div>

    <!-- Dynamic Months Render Here -->

</div>

<style>
    .transport-container {
        background: #f8fafc;
        border-radius: 24px;
        padding: 24px !important;
    }

    .header-card {
        background: #ffffff;
        padding: 20px 24px !important;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
    }

    .header-title {
        color: #0f172a;
        letter-spacing: -0.5px;
    }

    .transport-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
    }

    .month-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 22px;
        border-radius: 20px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
    }

    .month-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.08);
    }

    .month-item.active {
        background: linear-gradient(to right, #ffffff, #f5f3ff);
        border-color: rgba(79, 70, 229, 0.25);
    }

    .month-item h6 {
        margin-bottom: 4px;
        font-weight: 700;
        color: #1e293b;
    }

    .month-item small {
        color: #64748b;
        font-size: 12px;
        font-weight: 500;
    }

    .month-item.active small {
        color: #4f46e5;
    }

    /* Toggle */

    .switch {
        position: relative;
        display: inline-block;
        width: 54px;
        height: 30px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        inset: 0;
        cursor: pointer;
        background: #e2e8f0;
        border-radius: 50px;
        transition: .3s;
    }

    .slider:before {
        position: absolute;
        content: "";
        width: 22px;
        height: 22px;
        left: 4px;
        bottom: 4px;
        background: #fff;
        border-radius: 50%;
        transition: .3s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .switch input:checked+.slider {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35);
    }

    .switch input:checked+.slider:before {
        transform: translateX(24px);
    }
</style>

@push('script')
    <script>
        /*
            |--------------------------------------------------------------------------
            | FETCH MONTHS
            |--------------------------------------------------------------------------
            */

        window.fetchMonths = function() {

            $.ajax({
                url: "{{ route('school.transport_month.fetch') }}",
                method: "GET",

                success: function(res) {

                    let html = '';

                    if (res.data.length > 0) {

                        res.data.forEach(month => {

                            let checked = month.is_transport_enable ? 'checked' : '';
                            let activeClass = month.is_transport_enable ? 'active' : '';
                            let statusText = month.is_transport_enable ?
                                'Transport fee active' :
                                'Transport fee inactive';

                            html += `
                            <div class="col-md-6">

                                <div class="month-item ${activeClass}"
                                     data-month-id="${month.id}">

                                    <div>
                                        <h6>${month.month_name}</h6>

                                        <small class="status-text">
                                            ${statusText}
                                        </small>
                                    </div>

                                    <label class="switch">

                                        <input type="checkbox"
                                               class="month-toggle"
                                               ${checked}>

                                        <span class="slider"></span>

                                    </label>

                                </div>

                            </div>
                        `;
                        });
                    }

                    $('#transportMonthsContainer').append(html);

                    bindToggleEvents();
                },

                error: function(err) {
                    console.log(err);
                }
            });
        }

        /*
        |--------------------------------------------------------------------------
        | BIND TOGGLE EVENTS
        |--------------------------------------------------------------------------
        */

        function bindToggleEvents() {

            $('.month-toggle').off('change').on('change', function() {

                const monthItem = $(this).closest('.month-item');

                const monthId = monthItem.data('month-id');

                const isChecked = $(this).is(':checked');

                const statusText = monthItem.find('.status-text');

                /*
                |--------------------------------------------------------------------------
                | UI UPDATE
                |--------------------------------------------------------------------------
                */

                if (isChecked) {

                    monthItem.addClass('active');

                    statusText.text('Transport fee active');

                } else {

                    monthItem.removeClass('active');

                    statusText.text('Transport fee inactive');
                }

                /*
                |--------------------------------------------------------------------------
                | AJAX UPDATE
                |--------------------------------------------------------------------------
                */

                $.ajax({
                    url: "{{ route('school.transport_month.is_enabled') }}",
                    method: "POST",

                    data: {
                        id: monthId,
                        is_transport_enable: isChecked ? 1 : 0,
                        _token: "{{ csrf_token() }}",
                        _method: "PUT"
                    },

                    success: function(res) {

                        console.log(res);

                        showToast('success', res.message || 'Success');

                    },

                    error: function(err) {

                        console.log(err);

                        showToast('error', err.responseJSON?.message || 'Something went wrong');

                    }
                });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | PAGE LOAD
        |--------------------------------------------------------------------------
        */

        $(document).ready(function() {

            fetchMonths();

        });
    </script>
@endpush
