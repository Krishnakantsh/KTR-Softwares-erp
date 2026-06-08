<style>
    .bg-light-all {
        background-color: #f8fafc;
        border: 1px solid #f1f5f9;
    }

    .premium-room-spec-card {
        background: #ffffff;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
    }
</style>

<div class="shadow-1 radius-12 bg-base h-100 overflow-hidden mt-24 premium-hostel-card">
    <div
        class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center dynamic-header">
        <div class="d-flex align-items-center gap-3">
            <div class="brand-pulse-icon-hostel">
                <i class="bi bi-building-fill text-xl text-white"></i>
            </div>
            <div>
                <h6 class="text-lg fw-bold mb-0 text-gradient-purple">Hostel Allocation</h6>
                <p class="text-xs text-muted mb-0">Smart residency mapping, room inventory & housing sub-engine</p>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3 custom-toggle-pill border px-16 py-8 radius-30">
            <label class="text-xs fw-bold text-uppercase tracking-wider text-secondary-light mb-0 cursor-pointer"
                for="is_hostel_enabled">
                Active Status
            </label>
            <label class="switch">
                <input type="checkbox" name="is_Hostel_apply" id="is_Hostel_apply" value="1"
                    onchange="toggleHostelPanel(this)">
                <span class="slider"></span>
            </label>
        </div>
    </div>

    <div class="card-body p-24 d-none" id="hostel_config_panel">

        <div class="row gy-4 mb-24">
            <div class="col-lg-6 col-md-12">
                <div class="premium-input-box">
                    <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                        1. Select Hostel <span class="text-danger">*</span>
                    </label>
                    <div class="inner-addon">
                        <i class="bi bi-building text-purple-600 addon-icon"></i>
                        <select name="hostel_id" id="hostel_id" class="form-control form-select custom-premium-select"
                            required disabled onchange="hostelChanged(this.value)">

                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="premium-input-box">
                    <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                        2. Hostel Block <span class="text-danger">*</span>
                    </label>
                    <div class="inner-addon">
                        <i class="bi bi-grid-3x3-gap text-purple-600 addon-icon"></i>
                        <select name="block_id" id="block_id" class="form-control form-select custom-premium-select"
                            required disabled onchange="blockChanged(this.value)">

                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="premium-input-box">
                    <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                        3. Floor Level <span class="text-danger">*</span>
                    </label>
                    <div class="inner-addon">
                        <i class="bi bi-layer-forward text-purple-600 addon-icon"></i>
                        <select name="floor_id" id="floor_id" class="form-control form-select custom-premium-select"
                            required disabled onchange="floorChanged(this.value)">

                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="premium-input-box">
                    <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                        4. Assigned Room No. <span class="text-danger">*</span>
                    </label>
                    <div class="inner-addon">
                        <i class="bi bi-door-open text-purple-600 addon-icon"></i>
                        <select name="room_id" id="room_id" class="form-control form-select custom-premium-select"
                            required disabled onchange="roomChanged(this.value)">

                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row gy-4 mb-24 ke thik neeche isko paste karein -->
        <div id="premium_room_detail_card" class="p-24 radius-12 border bg-base mb-24 d-none premium-room-spec-card">
            <div class="d-flex align-items-center gap-3 mb-20 pb-12 border-bottom">
                <div class="brand-pulse-icon-hostel bg-success-600"
                    style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);">
                    <i class="bi bi-info-circle-fill text-xl text-white"></i>
                </div>
                <div>
                    <h6 class="text-md fw-bold mb-0 text-dark">Selected Room Specifications</h6>
                    <p class="text-xs text-muted mb-0">Live inventory and amenity overview for the selected room</p>
                </div>
            </div>
            <div class="row gy-3">
                <div class="col-lg-3 col-sm-6">
                    <div class="p-12 radius-8 bg-light-all h-100">
                        <span class="text-xs text-muted d-block mb-4">Hostel / Block</span>
                        <strong class="text-sm text-dark" id="det_hostel_block">-</strong>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="p-12 radius-8 bg-light-all h-100">
                        <span class="text-xs text-muted d-block mb-4">Floor Level</span>
                        <strong class="text-sm text-dark" id="det_floor">-</strong>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="p-12 radius-8 bg-light-all h-100">
                        <span class="text-xs text-muted d-block mb-4">Room Type & Beds</span>
                        <strong class="text-sm text-dark" id="det_room_type">-</strong>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="p-12 radius-8 bg-light-all h-100"
                        style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                        <span class="text-xs text-success d-block mb-4 fw-semibold">Monthly Fees</span>
                        <strong class="text-lg text-success fw-bold" id="det_fees">₹ 0.00</strong>
                    </div>
                </div>

                <div class="col-12 mt-12">
                    <div class="p-16 radius-8 bg-light-all">
                        <span class="text-xs text-muted d-block mb-8 fw-semibold">
                            <i class="bi bi-stars text-warning me-2"></i>Available Facilities & Amenities
                        </span>
                        <div class="d-flex flex-wrap gap-2" id="det_facilities_wrapper">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="live_hostel_map_wrapper" class="p-20 radius-12 border bg-white mb-24 d-none">
            <h6 class="text-xs fw-bold text-uppercase tracking-widest text-muted mb-20"><i
                    class="bi bi-geo-fill me-2"></i>Live Residency Mapping Pipeline Preview</h6>

            <div class="hostel-timeline">
                <div class="timeline-step active" id="h_step_main">
                    <div class="step-icon"><i class="bi bi-building"></i></div>
                    <div class="step-content">
                        <p class="step-title" id="lbl_map_hostel">Hostel Hub</p>
                        <span class="step-desc">Residency Building</span>
                    </div>
                </div>

                <div class="timeline-line"></div>

                <div class="timeline-step active" id="h_step_block">
                    <div class="step-icon"><i class="bi bi-grid-1x2"></i></div>
                    <div class="step-content">
                        <p class="step-title" id="lbl_map_block">Block Segment</p>
                        <span class="step-desc" id="lbl_map_floor">Floor Level</span>
                    </div>
                </div>

                <div class="timeline-line"></div>

                <div class="timeline-step terminal" id="h_step_room">
                    <div class="step-icon"><i class="bi bi-door-closed-fill"></i></div>
                    <div class="step-content">
                        <p class="step-title" id="lbl_map_room">Room Number</p>
                        <span class="step-desc" id="lbl_map_type">Room Category</span>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="p-16 radius-12 alert-shield-glass-hostel d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="shield-pulse-wrapper-hostel">
                    <i class="bi bi-shield-lock-fill text-xl text-purple-600"></i>
                </div>
                <div>
                    <h6 class="text-sm fw-bold text-dark mb-2">Automated Inventory Verification Secure</h6>
                    <p class="text-xs text-muted mb-0">Residency system dynamically reserves bed matrices to prevent
                        double allocation bottlenecks.</p>
                </div>
            </div>
            <span class="badge premium-neon-badge-hostel">Active Inventory Shield</span>
        </div>

    </div>
</div>

<style>
    /* Card Accent Elements for Hostel */
    .premium-hostel-card {
        border: 1px solid #e2e8f0;
        background: #ffffff;
    }

    .text-gradient-purple {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .brand-pulse-icon-hostel {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(168, 85, 247, 0.25);
    }

    .text-purple-600 {
        color: #a855f7 !important;
    }

    /* Live Visual Hostel Timeline Grid */
    .hostel-timeline {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        overflow-x: auto;
    }

    .hostel-timeline .timeline-step {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 200px;
    }

    .hostel-timeline .timeline-step .step-icon {
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

    .hostel-timeline .timeline-step.active .step-icon {
        background: #faf5ff;
        color: #a855f7;
        border-color: #d8b4fe;
        box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.15);
    }

    .hostel-timeline .timeline-step.terminal .step-icon {
        background: #f0fdf4;
        color: #16a34a;
        border-color: #bbf7d0;
        box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.15);
    }

    /* System Shield Section for Hostel */
    .alert-shield-glass-hostel {
        background: linear-gradient(90deg, #faf5ff 0%, #ffffff 100%);
        border: 1px dashed #d8b4fe;
    }

    .shield-pulse-wrapper-hostel {
        background: #f3e8ff;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulseEffectHostel 2s infinite;
    }

    .premium-neon-badge-hostel {
        background: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%);
        color: white;
        padding: 6px 16px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 11px;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(168, 85, 247, 0.2);
    }

    @keyframes pulseEffectHostel {
        0% {
            box-shadow: 0 0 0 0 rgba(168, 85, 247, 0.2);
        }

        70% {
            box-shadow: 0 0 0 8px rgba(168, 85, 247, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(168, 85, 247, 0);
        }
    }

    /* Micro Animations Wrapper rules reuse standard properties */
    #hostel_config_panel {
        transition: all 0.4s ease;
    }
</style>


@push('script')
    <script>
        function toggleHostelPanel(checkbox) {
            const panel = document.getElementById('hostel_config_panel');
            const fields = panel.querySelectorAll('select');

            if (checkbox.checked) {
                panel.classList.add('panel-active-animation');
                panel.classList.remove('d-none');
                fields.forEach(field => field.removeAttribute('disabled'));
            } else {
                panel.classList.add('d-none');
                panel.classList.remove('panel-active-animation');
                fields.forEach(field => {
                    field.value = "";
                    field.setAttribute('disabled', 'true');
                });
                document.getElementById('live_hostel_map_wrapper').classList.add('d-none');
            }
        }

        fetchMasterData("{{ route('school.hostel.fetch') }}", function(res) {
            let routes = res.data;
            let options = '';


            if (routes.length > 0) {

                options +=
                    `<option value="" selected data-sub="Select Hostel Name">Please Select Hostel</option>`;

                $.each(routes, function(index, d) {
                    options +=
                        `<option value="${d.id}" data-sub="${d.hostel_name}">${d.hostel_name}</option>`
                });

            } else {
                options +=
                    `<option value="" data-sub="No Hostel Available">No Hostel Data available </option>`
            }

            $('#hostel_id').html(options);
        });

        //  function hostelChanged(routeId) {

        //     getDataById(
        //         "{{ route('school.common.get_blocks_by_hostel_id') }}",
        //         routeId,
        //         function(res) {
        //             console.log('Fetched blocks : ', res);

        //             let blockOptions =
        //                 '<option value="">Select Block</option>';

        //             if (res.data && res.data.length) {

        //                 $.each(res.data, function(i, d) {

        //                     blockOptions += `
    //                     <option value="${d.id}"
    //                             data-sub="${d.block_name}">
    //                            ${d.block_name}
    //                         </option>
    //                     `;
        //                 });
        //             }

        //             $('#block_id')
        //                 .html(blockOptions)


        //             updateLiveHostelMap();
        //         }
        //     );



        // }

        function hostelChanged(hostelId) {

            return new Promise(resolve => {

                getDataById(
                    "{{ route('school.common.get_blocks_by_hostel_id') }}",
                    hostelId,
                    function(res) {

                        let options = '<option value="">Select Block</option>';

                        $.each(res.data || [], function(i, d) {
                            options += `
                        <option value="${d.id}"
                            data-sub="${d.block_name}">
                            ${d.block_name}
                        </option>
                    `;
                        });

                        $('#block_id').html(options);

                        resolve();
                    }
                );

            });

        }

        // function blockChanged(routeId) {
        //     getDataById(
        //         "{{ route('school.common.get_floors_by_block_id') }}",
        //         routeId,
        //         function(res) {

        //             let blockOptions =
        //                 '<option value="">Select Floor</option>';

        //             if (res.data && res.data.length) {

        //                 $.each(res.data, function(i, d) {

        //                     blockOptions += `
    //                     <option value="${d.id}"
    //                             data-sub="${d.floor_name}">
    //                            ${d.floor_name}
    //                         </option>
    //                     `;
        //                 });
        //             }

        //             $('#floor_id')
        //                 .html(blockOptions)


        //             updateLiveHostelMap();
        //         }
        //     );
        // }

        function blockChanged(blockId) {

            return new Promise(resolve => {

                getDataById(
                    "{{ route('school.common.get_floors_by_block_id') }}",
                    blockId,
                    function(res) {

                        let options = '<option value="">Select Floor</option>';

                        $.each(res.data || [], function(i, d) {
                            options += `
                        <option value="${d.id}"
                            data-sub="${d.floor_name}">
                            ${d.floor_name}
                        </option>
                    `;
                        });

                        $('#floor_id').html(options);

                        resolve();
                    }
                );

            });

        }


        let currentFloorRooms = [];

        // function floorChanged(floorId) {
        //     getDataById(
        //         "{{ route('school.common.get_rooms_by_floor_id') }}",
        //         floorId,
        //         function(res) {
        //             console.log("fetched room :", res);
        //             let roomOptions = '<option value="">Select Room</option>';

        //             // Purani details clear aur hide karne ke liye
        //             $('#premium_room_detail_card').addClass('d-none');
        //             currentFloorRooms = [];

        //             if (res.data && res.data.length) {
        //                 currentFloorRooms = res.data;

        //                 $.each(res.data, function(i, d) {
        //                     roomOptions += `
    //             <option value="${d.id}" data-sub="${d.room_number}">
    //                    Room ${d.room_number}
    //             </option>
    //             `;
        //                 });
        //             }

        //             $('#room_id').html(roomOptions);
        //             updateLiveHostelMap();
        //         }
        //     );
        // }


        function floorChanged(floorId) {

            return new Promise(resolve => {

                getDataById(
                    "{{ route('school.common.get_rooms_by_floor_id') }}",
                    floorId,
                    function(res) {

                        let roomOptions =
                            '<option value="">Select Room</option>';

                        currentFloorRooms = [];

                        if (res.data && res.data.length) {

                            currentFloorRooms = res.data;

                            $.each(res.data, function(i, d) {

                                roomOptions += `
                            <option value="${d.id}"
                                data-sub="${d.room_number}">
                                Room ${d.room_number}
                            </option>
                        `;
                            });
                        }

                        $('#room_id').html(roomOptions);

                        resolve();
                    }
                );

            });

        }

        // Naya function jab room change hoga
        function roomChanged(roomId) {
            const detailCard = document.getElementById('premium_room_detail_card');

            if (!roomId) {
                detailCard.classList.add('d-none');
                updateLiveHostelMap();
                return;
            }

            // Array se selected room find karo
            const selectedRoom = currentFloorRooms.find(r => r.id == roomId);

            if (selectedRoom) {
                // 1. Hostel aur Block Name mapping
                const hostelName = selectedRoom.hostel?.hostel_name || 'N/A';
                const blockName = selectedRoom.floor?.block_id == 1 ? "Block A" :
                    "N/A"; // Agar data object me direct block text na mile toh handle karein
                document.getElementById('det_hostel_block').innerText = `${hostelName} (${blockName})`;

                // 2. Floor Detail
                document.getElementById('det_floor').innerText = selectedRoom.floor?.floor_name || 'N/A';

                // 3. Room Type & Beds Mapping
                const roomType = selectedRoom.room_type?.room_type || 'Standard';
                const availableBeds = selectedRoom.available_beds || 0;
                const totalBeds = selectedRoom.total_beds || 0;
                document.getElementById('det_room_type').innerHTML =
                    `${roomType} <br><small class="text-muted">Beds: ${availableBeds} Available / ${totalBeds} Total</small>`;

                // 4. Fees Render
                const roomFees = selectedRoom.room_type?.fees ?
                    `₹ ${parseFloat(selectedRoom.room_type.fees).toFixed(2)}` : 'N/A';
                document.getElementById('det_fees').innerText = roomFees;

                // 5. Facilities Badges Generator
                const facilitiesContainer = document.getElementById('det_facilities_wrapper');
                facilitiesContainer.innerHTML = ''; // Pehle wala saaf karein

                if (selectedRoom.facilities) {
                    // "WiFi, Study Table, Attatched Bathroom, Fan" ko split karke array banayein
                    const amenities = selectedRoom.facilities.split(',');
                    amenities.forEach(item => {
                        if (item.trim() !== "") {
                            facilitiesContainer.innerHTML +=
                                `<span class="badge bg-purple-100 text-purple-800 px-12 py-6 radius-4 border text-xs fw-medium mb-2"><i class="bi bi-check2-circle me-1 text-purple-600"></i>${item.trim()}</span>`;
                        }
                    });
                } else {
                    facilitiesContainer.innerHTML =
                        `<span class="text-xs text-muted italic">No extra facilities listed for this room.</span>`;
                }

                // Card ko layout me show karein smoothly
                detailCard.classList.remove('d-none');
            }

            // Aapka purana live map engine function call
            updateLiveHostelMap();
        }


        // Visual Map Pipeline Engine for Hostel Allocation
        function updateLiveHostelMap() {
            const hostelSelect = document.getElementById('hostel_id');
            const blockSelect = document.getElementById('block_id');
            const floorSelect = document.getElementById('floor_id');
            const roomSelect = document.getElementById('room_id');


            const mapWrapper = document.getElementById('live_hostel_map_wrapper');

            // Display pipeline container as soon as first select triggers
            if (hostelSelect.value || blockSelect.value || floorSelect.value || roomSelect.value) {
                mapWrapper.classList.remove('d-none');
            }

            // Live Dynamic Node Population
            if (hostelSelect.value) {
                document.getElementById('lbl_map_hostel').innerText =
                    hostelSelect.options[hostelSelect.selectedIndex]?.dataset.sub;

                // document.getElementById('lbl_map_hostel').innerText = hostelSelect.value;
            } else {
                document.getElementById('lbl_map_hostel').innerText = "Hostel Hub";
            }

            if (blockSelect.value) {
                document.getElementById('lbl_map_block').innerText =
                    blockSelect.options[blockSelect.selectedIndex]?.dataset.sub;

                // document.getElementById('lbl_map_block').innerText = blockSelect.value;
            } else {
                document.getElementById('lbl_map_block').innerText = "Block Segment";
            }

            if (floorSelect.value) {
                document.getElementById('lbl_map_floor').innerText =
                    floorSelect.options[floorSelect.selectedIndex]?.dataset.sub;
                // document.getElementById('lbl_map_floor').innerText = floorSelect.value;
            } else {
                document.getElementById('lbl_map_floor').innerText = "Floor Level";
            }

            if (roomSelect.value) {
                document.getElementById('lbl_map_room').innerText =
                    roomSelect.options[roomSelect.selectedIndex]?.dataset.sub;

                // document.getElementById('lbl_map_room').innerText = roomSelect.value;
            } else {
                document.getElementById('lbl_map_room').innerText = "Room Number";
            }
        }
    </script>
@endpush
