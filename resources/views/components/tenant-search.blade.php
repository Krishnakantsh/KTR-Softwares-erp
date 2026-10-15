<div class="shadow-1 radius-12 bg-base border border-slate-200 mb-24 card">
    <div class="card-header border-bottom bg-base py-20 px-24">
        <div class="d-flex align-items-center gap-3">
            <div class="brand-pulse-icon bg-primary-100 text-primary-600 p-10 radius-10">
                <i class="ri-user-search-line text-xl"></i>
            </div>
            <div>
                <h5 class="text-lg fw-bold mb-0 text-dark-main">Beneficiary Credentials Verification</h5>
                <p class="text-xs text-muted mb-0">Query global institutional parameters via Student ID or Matriculation
                    Name.</p>
            </div>
        </div>
    </div>

    <div class="card-body p-24 bg-slate-50/50">
        <div class="row align-items-center">
            <div class="col-lg-11 col-12 mx-auto">
                <div class="d-flex align-items-center gap-4 flex-md-row flex-column">

                    <div
                        class="premium-search-box-wrapper position-relative p-3 bg-base border border-slate-300 shadow-sm transition-all focus-within-glow flex-grow-1 w-100 rounded-pill overflow-visible">
                        <div class="d-flex align-items-center gap-3">
                            <div class="premium-icon-glow-ring d-flex align-items-center justify-content-center">
                                <i class="ri-search-2-line text-muted text-lg"></i>
                            </div>
                            <input type="text" id="studentLiveSearchForLibrary"
                                class="form-control border-0 bg-transparent font-monospace text-md py-10 w-100"
                                placeholder="Search school record by name..." autocomplete="off"
                                style="box-shadow: none !important;">

                            <button type="button" id="trigger_search_clear"
                                class="btn btn-sm btn-slate-100 p-8 radius-8 border-0 text-muted d-none">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>

                        <div class="search-results-dropdown" id="searchResultsContainerForLibrary"></div>
                    </div>

                    <div
                        class="search-mascot-wrapper d-none d-md-flex flex-column align-items-center position-relative">
                        <div class="mascot-bubble">Search Here!</div>
                        <div class="mascot-character">
                            <div class="mascot-eyes">
                                <div class="mascot-pupil"></div>
                                <div class="mascot-pupil"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="radius-12 border border-primary-100 bg-gradient px-24 py-16 mb-28 d-flex justify-content-between align-items-center flex-wrap gap-4"
    style="background: linear-gradient(135deg, #f0f7ff 0%, #e0f2fe 100%);">
    <div class="d-flex align-items-center gap-3">
        <div class="bg-primary-600 text-white rounded-circle p-3 d-flex align-items-center justify-content-center"
            style="width: 56px; height: 56px; shadow: 0 4px 14px rgba(37,99,235,0.3)">
            <i class="ri-building-line text-2xl"></i>
        </div>
        <div>
            <span class="badge bg-success-600 text-white font-xs px-8 py-2 radius-4 uppercase mb-4 fw-bold">Live
                Cluster</span>
            <h4 class="text-xl fw-bold text-neutral-900 mb-0" id="display_school_name">Greenfield International School
            </h4>
            <span class="text-xs font-monospace text-neutral-500">Tenant Hash: <span id="display_tenant_hash"
                    class="text-neutral-800 fw-bold">ktr_db_greenfield</span></span>
        </div>
    </div>
    <div class="d-flex align-items-center gap-4">
        <div class="text-end border-end pe-4 border-neutral-300">
            <span class="text-xs text-neutral-500 d-block uppercase tracking-wider">Gateway Status</span>
            <span class="text-sm fw-bold text-success-600 d-flex align-items-center gap-1"><i
                    class="ri-checkbox-circle-fill"></i> Operational</span>
        </div>
        <div>
            <span class="text-xs text-neutral-500 d-block uppercase tracking-wider">Node Location</span>
            <span class="text-sm fw-bold text-neutral-800"><i class="ri-global-line text-primary-500"></i>
                AWS-Mumbai-01</span>
        </div>
    </div>
</div>

@push('script')
    <script>
        let globalSchoolsDataset = [];
        const liveSearchInput = document.getElementById('studentLiveSearchForLibrary');
        const clearSearchBtn = document.getElementById('trigger_search_clear');
        const resultsDrop = document.getElementById('searchResultsContainerForLibrary');

        // On Page Load: Fetch master arrays directly from the server
        $(document).ready(function() {
            window.fetchMasterData("{{ route('superAdmin.school.fetchAllSchools') }}", function(response) {
                globalSchoolsDataset = Array.isArray(response) ? response : (response.data || []);
            });
        });


        liveSearchInput.addEventListener('input', function(e) {
            let val = e.target.value.trim().toLowerCase();
            if (val.length > 0) {
                clearSearchBtn.classList.remove('d-none');
                resultsDrop.style.display = 'block';
                resultsDrop.classList.remove('d-none');

                let filtered = globalSchoolsDataset.filter(school => {
                    return (school.name && school.name.toLowerCase().includes(val)) ||
                        (school.username && school.username.toLowerCase().includes(val)) ||
                        (school.db_name && school.db_name.toLowerCase().includes(val));
                });

                if (filtered.length > 0) {
                    let dropdownHtml =
                        `<div class="p-8 text-neutral-400 font-xs tracking-wider uppercase border-bottom bg-neutral-50 px-12 fw-semibold">Matched Clusters</div>`;
                    filtered.forEach(school => {
                        let statusBadge = school.is_active ?
                            `<span class="badge bg-success-50 text-success-700 font-2xs fw-bold px-8 py-4 radius-4">Active</span>` :
                            `<span class="badge bg-danger-50 text-danger-700 font-2xs fw-bold px-8 py-4 radius-4">Suspended</span>`;

                        dropdownHtml += `
                            <div class="d-flex align-items-center justify-content-between p-12 hover-bg-neutral-50 border-bottom text-decoration-none dropdown-item-node" data-id="${school.id}" style="cursor: pointer;">
                                <div>
                                    <span class="text-sm fw-bold text-neutral-800 d-block">${school.name}</span>
                                    <span class="text-xs font-monospace text-neutral-400">db_name: ${school.db_name}</span>
                                </div>
                                ${statusBadge}
                            </div>`;
                    });
                    resultsDrop.innerHTML = dropdownHtml;

                    // Click handler for dropdown items
                    const nodes = resultsDrop.querySelectorAll('.dropdown-item-node');
                    nodes.forEach(item => {
                        item.addEventListener('click', function(ev) {
                            ev.stopPropagation();
                            let targetId = this.getAttribute('data-id');

                            // FIX 1: Click hote hi dropdown ko sabse pahle band/hide karein
                            resultsDrop.style.display = 'none';
                            resultsDrop.classList.add('d-none');

                            // Detailed downstream elements sync trigger
                            window.getDataById("{{ route('superAdmin.school.show') }}", targetId,
                                function(dataDetails) {
                                    if (dataDetails) {

                                        onTenantSelected(targetId);
                                        // 1. Attach unique ID logic inside all forms hidden elements
                                        document.querySelectorAll('.attached-school-id')
                                            .forEach(hiddenInput => {
                                                hiddenInput.value = dataDetails.id;
                                            });

                                        // FIX 2: Specific hidden input 'school_id' me bhi ID set karein toggle ke liye
                                        const schoolIdInput = document.getElementById(
                                            'school_id');
                                        if (schoolIdInput) {
                                            schoolIdInput.value = dataDetails.id;
                                        }

                                        // 2. Sync cross-view text labels parameters
                                        document.getElementById('display_school_name')
                                            .innerText = dataDetails.name || '';
                                        document.getElementById('display_tenant_hash')
                                            .innerText = dataDetails.db_name || '';
                                        liveSearchInput.value = dataDetails.name || '';

                                        // 3. Dynamic setup of Cloning input fields logic
                                        if (dataDetails.db_name) {
                                            const targetDb = document.getElementById(
                                                'target_db_name');
                                            if (targetDb) targetDb.value = dataDetails.db_name;

                                            document.getElementById('terminal_db_hash')
                                                .innerText = 'TXN_' + dataDetails.db_name
                                                .toUpperCase();
                                        }

                                        // 4. Fill structural fields inside Create Tenant Instance form section
                                        const instName = document.getElementById(
                                            'instance_school_name');
                                        const instPhone = document.getElementById(
                                            'instance_school_phone');
                                        const instEmail = document.getElementById(
                                            'instance_school_email');

                                        if (instName) instName.value = dataDetails.name || '';
                                        if (instPhone) instPhone.value = dataDetails.phone ||
                                            '';
                                        if (instEmail) instEmail.value = dataDetails.email ||
                                            '';

                                        // 5. Build dynamic subscription architecture layout components
                                        if (dataDetails.start_date) document.getElementById(
                                                'display_start_date').innerText = dataDetails
                                            .start_date;
                                        if (dataDetails.valid_upto) document.getElementById(
                                                'display_valid_upto').innerText = dataDetails
                                            .valid_upto;

                                        // 6. Security Traffic permissions switcher alignment 
                                        document.getElementById('is_ews').checked = !!
                                            dataDetails.is_active;
                                    }
                                });
                        });
                    });
                } else {
                    resultsDrop.innerHTML =
                        `<div class="no-result">No matching school cluster records discovered</div>`;
                }
            } else {
                clearSearchBtn.classList.add('d-none');
                resultsDrop.style.display = 'none';
                resultsDrop.classList.add('d-none');
            }
        });

        // Hide search dropdown if clicked anywhere outside the layout wrapper
        document.addEventListener('click', function(event) {
            if (!liveSearchInput.contains(event.target) && !resultsDrop.contains(event.target)) {
                resultsDrop.style.display = 'none';
                resultsDrop.classList.add('d-none');
            }
        });

        clearSearchBtn.addEventListener('click', function() {
            liveSearchInput.value = '';
            this.classList.add('d-none');
            resultsDrop.style.display = 'none';
            resultsDrop.classList.add('d-none');
            liveSearchInput.focus();
        });



      
    </script>
@endpush
