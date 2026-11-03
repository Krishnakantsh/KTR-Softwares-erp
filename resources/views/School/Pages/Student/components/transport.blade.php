<div class="shadow-1 radius-12 bg-base h-100 overflow-hidden mt-24 premium-transport-card">
    <div
        class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center dynamic-header">
        <div class="d-flex align-items-center gap-3">
            <div class="brand-pulse-icon">
                <i class="bi bi-bus-front-fill text-xl text-white"></i>
            </div>
            <div>
                <h6 class="text-lg fw-bold mb-0 text-gradient-primary">Transport Allocation</h6>
                <p class="text-xs text-muted mb-0">Smart route matching & vehicle assignment sub-engine</p>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3 custom-toggle-pill border px-16 py-8 radius-30">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-secondary-light mb-0 cursor-pointer"
                for="is_transport_enabled">
                Active Status
            </label>
            <label class="switch">
                <input type="checkbox" name="is_Transport_apply" id="is_Transport_apply" value="1"
                    onchange="toggleTransportPanel(this)">
                <span class="slider"></span>
            </label>
        </div>
    </div>

    <div class="card-body p-24 d-none" id="transport_config_panel">

        <div class="row gy-4 mb-24">
            <div class="col-lg-4 col-md-6">
                <div class="premium-input-box">
                    <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                        1. Transit Corridor / Route <span class="text-danger">*</span>
                    </label>
                    <div class="inner-addon">
                        <i class="bi bi-signpost-split text-primary-600 addon-icon"></i>


                        <select name="route_id" id="route_id" class="form-control form-select custom-premium-select"
                            onchange="routeChanged(this.value)">
                        </select>

                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="premium-input-box">
                    <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                        2. Allocated Fleet / Vehicle <span class="text-danger">*</span>
                    </label>
                    <div class="inner-addon">
                        <i class="bi bi-truck text-primary-600 addon-icon"></i>
                        <select name="vehicle_id" id="vehicle_id" class="form-control form-select custom-premium-select"
                            required disabled onchange="updateLiveMap()">

                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="premium-input-box">
                    <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                        3. Drop-off Destination Stoppage <span class="text-danger">*</span>
                    </label>
                    <div class="inner-addon">
                        <i class="bi bi-geo-alt-fill text-danger addon-icon"></i>
                        <select name="destination_id" id="destination_id"
                            class="form-control form-select custom-premium-select" required disabled
                            onchange="updateLiveMap()">

                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div id="live_route_map_wrapper" class="p-20 radius-12 border bg-white mb-24 d-none">
            <h6 class="text-xs fw-bold text-uppercase tracking-widest text-muted mb-20"><i
                    class="bi bi-map-fill me-2"></i>Live Logistics Route Pipeline Preview</h6>

            <div class="transport-timeline">
                <div class="timeline-step passed">
                    <div class="step-icon"><i class="bi bi-building"></i></div>
                    <div class="step-content">
                        <p class="step-title">School Campus</p>
                        <span class="step-desc">Origin Hub</span>
                    </div>
                </div>

                <div class="timeline-line"></div>

                <div class="timeline-step active" id="map_step_route">
                    <div class="step-icon"><i class="bi bi-signpost-split-fill"></i></div>
                    <div class="step-content">
                        <p class="step-title" id="lbl_map_route">Route Corridor</p>
                        <span class="step-desc" id="lbl_map_fleet">Assigned Vehicle</span>
                    </div>
                </div>

                <div class="timeline-line"></div>

                <div class="timeline-step terminal" id="map_step_dest">
                    <div class="step-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <div class="step-content">
                        <p class="step-title" id="lbl_map_dest">Stoppage Point</p>
                        <span class="step-desc">Final Destination</span>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="p-16 radius-12 alert-shield-glass d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="shield-pulse-wrapper">
                    <i class="bi bi-shield-check text-xl text-success-600"></i>
                </div>
                <div>
                    <h6 class="text-sm fw-bold text-dark mb-2">Automated Smart Tracking Shield Active</h6>
                    <p class="text-xs text-muted mb-0">AI Engine automatically updates instant SMS dispatch nodes 10
                        minutes prior to arrival.</p>
                </div>
            </div>
            <span class="badge premium-neon-badge">Active Fleet Protection</span>
        </div>

    </div>
</div>


<style>
    /* Card Accent Elements */
    .premium-transport-card {
        border: 1px solid #e2e8f0;
        background: #ffffff;
    }

    .text-gradient-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .brand-pulse-icon {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.25);
    }

    .custom-toggle-pill {
        background: #f8fafc;
        border-color: #e2e8f0 !important;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    /* Premium Form Inputs Custom CSS */
    .premium-input-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.01);
        transition: all 0.3s ease;
    }

    .premium-input-box:focus-within {
        border-color: #7c3aed;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.08);
    }

    .inner-addon {
        position: relative;
        display: flex;
        align-items: center;
    }

    .addon-icon {
        position: absolute;
        left: 12px;
        z-index: 5;
        font-size: 16px;
    }

    .custom-premium-select {
        padding-left: 38px !important;
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        font-weight: 500 !important;
        height: 42px;
        background-color: #ffffff !important;
    }

    .custom-premium-select:focus {
        border-color: transparent !important;
        box-shadow: none !important;
    }

    .custom-premium-select:disabled {
        background-color: #f8fafc !important;
        border-color: #e2e8f0 !important;
        opacity: 0.7;
    }

    /* Live Visual Route Timeline Grid */
    .transport-timeline {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        overflow-x: auto;
    }

    .timeline-step {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 180px;
    }

    .timeline-step .step-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        border: 2px solid #e2e8f0;
        transition: all 0.4s ease;
    }

    .timeline-step.passed .step-icon {
        background: #e0f2fe;
        color: #0284c7;
        border-color: #bae6fd;
    }

    .timeline-step.active .step-icon {
        background: #f3e8ff;
        color: #7c3aed;
        border-color: #d8b4fe;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.15);
    }

    .timeline-step.terminal .step-icon {
        background: #fee2e2;
        color: #dc2626;
        border-color: #fca5a5;
    }

    .step-title {
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 2px;
        color: #1e293b;
    }

    .step-desc {
        font-size: 11px;
        color: #64748b;
        font-weight: 500;
    }

    .timeline-line {
        flex-grow: 1;
        height: 2px;
        background: #e2e8f0;
        margin: 0 16px;
        position: relative;
    }

    /* System Shield Glassmorphism Section */
    .alert-shield-glass {
        background: linear-gradient(90deg, #f0fdf4 0%, #ffffff 100%);
        border: 1px dashed #bbf7d0;
    }

    .shield-pulse-wrapper {
        background: #dcfce7;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulseEffect 2s infinite;
    }

    .premium-neon-badge {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 6px 16px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 11px;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
    }

    @keyframes pulseEffect {
        0% {
            box-shadow: 0 0 0 0 rgba(22, 163, 74, 0.2);
        }

        70% {
            box-shadow: 0 0 0 8px rgba(22, 163, 74, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(22, 163, 74, 0);
        }
    }

    /* Core Micro Animations */
    #transport_config_panel {
        transition: all 0.4s ease;
    }

    @keyframes smoothSlideDown {
        from {
            opacity: 0;
            transform: translateY(-16px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .panel-active-animation {
        display: block !important;
        animation: smoothSlideDown 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>

@push('script')
    <script>
        fetchMasterData("{{ route('school.transport.route.fetch') }}", function(res) {
            let routes = res.data;
            let options = '';


            if (routes.length > 0) {

                options +=
                    `<option value="" selected data-sub="Select Route Name">Please Select Route</option>`;

                $.each(routes, function(index, d) {

                    options +=
                        `<option value="${d.id}" data-sub="${d.route_name}">${d.route_name}</option>`
                });

            } else {
                options +=
                    `<option value="" data-sub="North Suburbs">No Route Data available </option>`
            }

            $('#route_id').html(options);
        })


        window.routeChanged = function(routeId) {

            $('#vehicle_id').html('');
            $('#destination_id').html('');

            if (!routeId) {

                $('#vehicle_id').prop('disabled', true);
                $('#destination_id').prop('disabled', true);

                return Promise.resolve();
            }

            return Promise.all([

                new Promise(resolve => {

                    getDataById(
                        "{{ route('school.common.get_destinations_by_route_id') }}",
                        routeId,
                        function(res) {

                            let destinationOptions =
                                '<option value="">Select Destination</option>';

                            if (res.data && res.data.length) {

                                $.each(res.data, function(i, d) {

                                    destinationOptions += `
                                <option value="${d.id}"
                                    data-sub="${d.destination_name}">
                                    ${d.destination_name}
                                </option>
                            `;
                                });
                            }

                            $('#destination_id')
                                .html(destinationOptions)
                                .prop('disabled', false);

                            resolve();
                        }
                    );

                }),

                new Promise(resolve => {

                    getDataById(
                        "{{ route('school.common.get_vehicles_by_route_id') }}",
                        routeId,
                        function(res) {

                            let vehicleOptions =
                                '<option value="">Select Vehicle</option>';

                            if (res.data && res.data.length) {

                                $.each(res.data, function(i, v) {

                                    vehicleOptions += `
                                <option value="${v.vehicle?.id}"
                                    data-sub="${v.vehicle?.vehicle_number}">
                                    ${v.vehicle?.vehicle_number}
                                </option>
                            `;
                                });
                            }

                            $('#vehicle_id')
                                .html(vehicleOptions)
                                .prop('disabled', false);

                            resolve();
                        }
                    );

                })

            ]);

        }



        // window.routeChanged = function(routeId) {

        //     $('#vehicle_id').html('');
        //     $('#destination_id').html('');



        //     if (!routeId) {

        //         $('#vehicle_id').prop('disabled', true);
        //         $('#destination_id').prop('disabled', true);

        //         return;
        //     }

        //     getDataById(
        //         "{{ route('school.common.get_destinations_by_route_id') }}",
        //         routeId,
        //         function(res) {

        //             let destinationOptions =
        //                 '<option value="">Select Destination</option>';

        //             if (res.data && res.data.length) {

        //                 $.each(res.data, function(i, d) {

        //                     destinationOptions += `
    //                     <option value="${d.id}"
    //                             data-sub="${d.destination_name}">
    //                            ${d.destination_name}
    //                         </option>
    //                     `;
        //                 });

        //                 $('#destination_id')
        //                     .html(destinationOptions)
        //                     .prop('disabled', false);
        //             }

        //             updateLiveMap();
        //         }
        //     );


        //     getDataById(
        //         "{{ route('school.common.get_vehicles_by_route_id') }}",
        //         routeId,
        //         function(res) {

        //             let vehicleOptions =
        //                 '<option value="">Select Vehicle</option>';

        //             if (res.data && res.data.length) {

        //                 $.each(res.data, function(i, v) {

        //                     vehicleOptions += `
    //                         <option value="${v.vehicle?.id}"
    //                             data-sub="${v.vehicle?.vehicle_number}">
    //                             ${v.vehicle?.vehicle_number}
    //                         </option>
    //                     `;
        //                 });

        //                 $('#vehicle_id')
        //                     .html(vehicleOptions)
        //                     .prop('disabled', false);
        //             }

        //             updateLiveMap();
        //         }
        //     );
        // }


        function toggleTransportPanel(checkbox) {

            const panel = document.getElementById('transport_config_panel');

            if (checkbox.checked) {

                panel.classList.add('panel-active-animation');
                panel.classList.remove('d-none');

                $('#route_id').prop('disabled', false);
                $('#vehicle_id').prop('disabled', true);
                $('#destination_id').prop('disabled', true);

            } else {

                panel.classList.add('d-none');
                panel.classList.remove('panel-active-animation');

                $('#route_id').val('').prop('disabled', true);
                $('#vehicle_id').val('').prop('disabled', true);
                $('#destination_id').val('').prop('disabled', true);

                $('#live_route_map_wrapper').addClass('d-none');
            }
        }



        // Visual Map Pipeline dynamic rendering engine
        function updateLiveMap() {
            const routeSelect = document.getElementById('route_id');
            const vehicleSelect = document.getElementById('vehicle_id');
            const destSelect = document.getElementById('destination_id');
            const mapWrapper = document.getElementById('live_route_map_wrapper');

            // Show map framework if at least one selection is made
            if (routeSelect.value || vehicleSelect.value || destSelect.value) {
                mapWrapper.classList.remove('d-none');
            }

            // Dynamic strings updates
            if (routeSelect.value) {
                document.getElementById('lbl_map_route').innerText =
                    routeSelect.options[routeSelect.selectedIndex]?.dataset.sub;
            } else {
                document.getElementById('lbl_map_route').innerText = "Route Corridor";
            }


            if (vehicleSelect.value) {
                document.getElementById('lbl_map_fleet').innerText =
                    vehicleSelect.options[vehicleSelect.selectedIndex]?.dataset.sub;

            } else {
                document.getElementById('lbl_map_fleet').innerText = "Assigned Vehicle";
            }

            if (destSelect.value) {
                document.getElementById('lbl_map_dest').innerText =
                    destSelect.options[destSelect.selectedIndex]?.dataset.sub;

            } else {
                document.getElementById('lbl_map_dest').innerText = "Stoppage Point";
            }
        }
    </script>
@endpush
