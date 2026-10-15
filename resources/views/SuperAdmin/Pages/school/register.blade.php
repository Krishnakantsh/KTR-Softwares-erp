@extends('SuperAdmin.Layout.main')

@section('title', 'KTR ERP : Enterprise School Provisioning Engine')

@section('superAdminContent')

    <div class="dashboard-main-body py-24 px-16">



        <!-- FIRST CARD: DEPLOY SCHOOL INSTANCE FORM -->
        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 radius-10 border border-primary-100">
                        <i class="ri-server-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Deploy School Instance</h5>
                        <p class="text-xs text-neutral-500 mb-0">Initialize core system tenant, secure gateway
                            authentication, and dynamic cluster data endpoints.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-28">
                <form id="schoolRegistrationForm" class="ajaxForm" enctype="multipart/form-data"
                    data-url="{{ route('superAdmin.school.register') }}" data-refresh="onDeploymentComplete"
                    data-method="POST" autocomplete="off">
                    @csrf

                    <input type="hidden" name="id" id="school_master_id" value="{{ $school->id ?? '' }}">

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-primary-100 text-primary-700 font-xs fw-bold px-12 py-6 radius-6">01</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Core Institutional
                                Identity</h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Legal School Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-building-4-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="school_name" name="name" value="{{ $school->name ?? '' }}"
                                            placeholder="Greenfield International School" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Administrative Email
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-mail-open-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="email" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="email" name="email" value="{{ $school->email ?? '' }}"
                                            placeholder="admin@domain.com" maxlength="150">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Hotline Phone Terminal
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-phone-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="phone" name="phone" value="{{ $school->phone ?? '' }}"
                                            placeholder="+91 98765-43210" maxlength="20">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-segment mb-32">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-success-100 text-success-700 font-xs fw-bold px-12 py-6 radius-6">02</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Infrastructure & Node
                                Access</h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Gateway Username <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-user-shield-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="username" name="username" value="{{ $school->username ?? '' }}"
                                            placeholder="greenfield_node">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Gateway Password
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-lock-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="password"
                                            class="form-control custom-premium-input ps-44 py-12 radius-8" id="password"
                                            name="password" placeholder="••••••••••••">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Isolated DB Name
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i
                                            class="ri-database-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                        <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                            id="db_name" name="db_name" value="{{ $school->db_name ?? '' }}"
                                            placeholder="ktr_db_greenfield">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Choose Plan
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i class="ri-checkbox-circle-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"
                                            style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select ps-44 py-12 radius-8"
                                            name="plan_id" id="showAllPlans">
                                            {{-- <option value="1"
                                                {{ !isset($school) || $school->is_active == 1 ? 'selected' : '' }}>Active
                                                Node</option>
                                            <option value="0"
                                                {{ isset($school) && $school->is_active == 0 ? 'selected' : '' }}>
                                                Decommissioned</option> --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Billing Cycle
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i class="ri-checkbox-circle-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"
                                            style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select ps-44 py-12 radius-8"
                                            name="billing_cycle" id="billing_cycle">
                                            <option value="yearly">Yearly</option>
                                            <option value="half_yearly">Half-Yearly</option>
                                            <option value="quarterly">Quarterly</option>
                                            <option value="monthly">Monthly</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                  
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box position-relative">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Cluster Node Status
                                    </label>
                                    <div class="inner-addon position-relative">
                                        <i class="ri-checkbox-circle-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"
                                            style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select ps-44 py-12 radius-8"
                                            name="is_active" id="is_active">
                                            <option value="1"
                                                {{ !isset($school) || $school->is_active == 1 ? 'selected' : '' }}>Active
                                                Node</option>
                                            <option value="0"
                                                {{ isset($school) && $school->is_active == 0 ? 'selected' : '' }}>
                                                Decommissioned</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <hr class="border-neutral-200 mb-24">

                    <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <button type="reset"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Reset Form
                        </button>
                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2"
                            id="btnSave">
                            <i class="ri-rocket-2-line"></i> Deploy Instance
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- SECOND CARD: CREATE TENANT INSTANCE METADATA FORM (UPDATED) -->
        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-container bg-primary-50 p-2 radius-10 border border-primary-100">
                        <i class="ri-add-box-line text-2xl text-primary-600"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Create Tenant Instance Metadata
                        </h5>
                        <p class="text-xs text-neutral-500 mb-0">Populate the core instance parameters inside the
                            designated tenant cluster scope.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-28">
                <form id="createSchoolInstanceForm" class="ajaxForm"
                    data-url="{{ route('superAdmin.school.makeSchoolProfile') }}" data-method="POST" autocomplete="off">
                    @csrf

                    <div class="row gy-4 mb-24">
                        <div class="col-xl-6 col-md-6">
                            <div class="premium-input-box position-relative">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    School Name <span class="text-danger">*</span>
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-building-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                        name="name" id="instance_school_name"
                                        placeholder="Greenfield International School" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="premium-input-box position-relative">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    School Code
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-qr-code-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <input type="text"
                                        class="form-control custom-premium-input ps-44 py-12 radius-8 font-monospace"
                                        name="school_code" placeholder="GFIS-091">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="premium-input-box position-relative">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Educational Board
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-government-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                        name="board" placeholder="CBSE / ICSE">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Phone, Email, Website -->
                    <div class="row gy-4 mb-24">
                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box position-relative">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Phone Number
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-phone-fill text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                        name="phone" id="instance_school_phone" placeholder="+91 98765 43210">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box position-relative">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Email Address
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-mail-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <input type="email" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                        name="email" id="instance_school_email" placeholder="admin@greenfield.com">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box position-relative">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Official Website
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-global-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <input type="url" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                        name="website" placeholder="https://greenfield.com">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: City, State, Pincode -->
                    <div class="row gy-4 mb-24">
                        <div class="col-xl-3 col-md-6">
                            <div class="premium-input-box position-relative">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    City
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-map-pin-2-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                        name="city" placeholder="Mumbai">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="premium-input-box position-relative">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    State
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-map-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <input type="text" class="form-control custom-premium-input ps-44 py-12 radius-8"
                                        name="state" placeholder="Maharashtra">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="premium-input-box position-relative">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                    Pincode
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-compass-3-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <input type="text"
                                        class="form-control custom-premium-input ps-44 py-12 radius-8 font-monospace"
                                        name="pincode" placeholder="400001">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="premium-input-box position-relative">
                                <label class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                Tenant Database Name
                                </label>
                                <div class="inner-addon position-relative">
                                    <i
                                        class="ri-compass-3-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"></i>
                                    <input type="text"
                                        class="form-control custom-premium-input ps-44 py-12 radius-8 font-monospace"
                                        name="db_name" placeholder="ktr_xyz">
                                </div>
                            </div>
                        </div>
                    </div>



                    <hr class="border-neutral-200 mb-24">

                    <!-- Actions Bar -->
                    <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2">
                            <i class="ri-folder-add-line"></i> Save Instance Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>



    </div>
@endsection


@push('script')
    <script>
        populatePlanDropdown();

        function populatePlanDropdown() {
            fetchMasterData("{{ route('superAdmin.subscriptionPlan.fetch') }}", function(res) {
                let options = '<option value="">-- DISCOVER & SELECT SUBSCRIPTION PLAN --</option>';
                if (res.status && res.data.length > 0) {
                    $.each(res.data, function(index, plan) {
                        options += `<option value="${plan.id}">${plan.name} (${plan.code})</option>`;
                    });
                }
                $("#showAllPlans").html(options);
            });
        }
    </script>
@endpush
