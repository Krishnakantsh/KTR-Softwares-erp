<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="brand-pulse-icon">
                <i class="ri-truck-line text-xl text-white"></i>
            </div>
            <div>
                <h6 class="text-lg fw-bold mb-0 text-gradient-primary">Supplier & Vendor Onboarding Engine</h6>
                <p class="text-xs text-muted mb-0">Register procurement partners, agency contacts, fiscal IDs, and
                    routing channels</p>
            </div>
        </div>
        <span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-12 py-6 fw-semibold radius-8">
            <i class="ri-shield-user-line me-1 ripple-effect"></i> Supply Chain Active
        </span>
    </div>

    <div class="card-body p-24">


        <form id="supplierRegistrationForm" class="ajaxForm" data-url="{{ route('school.library.supplier.save') }}"
            data-refresh="fetchRegisteredSuppliers" data-method="POST" autocomplete="off">
            @csrf
            <input type="hidden" name="id" id="supplier_id">

            <div class="row gy-4">
                <div class="col-xl-9 col-md-9">
                    <div class="row ">
                        <div class="col-xl-4 col-md-6 mb-12">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                    Supplier Agency Name <span class="text-danger">*</span>
                                </label>
                                <div class="inner-addon">
                                    <i class="ri-hotel-line addon-icon"></i>
                                    <input type="text" name="supplier_name" id="supplier_name"
                                        class="form-control custom-premium-input"
                                        placeholder="e.g. Allied Book Distributors" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                    Contact Person
                                </label>
                                <div class="inner-addon">
                                    <i class="ri-user-voice-line addon-icon"></i>
                                    <input type="text" name="contact_person" id="contact_person"
                                        class="form-control custom-premium-input" placeholder="e.g. John Doe">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-12">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                    GSTIN / Fiscal ID Number
                                </label>
                                <div class="inner-addon">
                                    <i class="ri-file-shield-2-line addon-icon"></i>
                                    <input type="text" name="gst_number" id="gst_number"
                                        class="form-control custom-premium-input" placeholder="e.g. 07AAAAA1111A1Z1">
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-4 col-md-6 mb-12">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                    Primary Mobile <span class="text-danger">*</span>
                                </label>
                                <div class="inner-addon">
                                    <i class="ri-phone-line addon-icon"></i>
                                    <input type="tel" name="mobile" id="mobile"
                                        class="form-control custom-premium-input" placeholder="e.g. +91 98765 43210"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                    Alternate Contact
                                </label>
                                <div class="inner-addon">
                                    <i class="ri-cellphone-line addon-icon"></i>
                                    <input type="tel" name="alternate_mobile" id="alternate_mobile"
                                        class="form-control custom-premium-input"
                                        placeholder="e.g. Landline or backup phone">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="premium-input-box">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                                    Official Email Address
                                </label>
                                <div class="inner-addon">
                                    <i class="ri-mail-send-line addon-icon"></i>
                                    <input type="email" name="email" id="email"
                                        class="form-control custom-premium-input" placeholder="e.g. supply@agency.com">
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box h-100">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-12 d-block">
                            Procurement Channel State <span class="text-danger">*</span>
                        </label>
                        <div class="d-flex flex-wrap gap-12">
                            <label class="platform-tab-wrapper">
                                <input type="radio" name="status" id="status_active" value="1" checked>
                                <span class="platform-tile active-status-tile"><i
                                        class="ri-checkbox-circle-line me-2"></i>Active</span>
                            </label>
                            <label class="platform-tab-wrapper">
                                <input type="radio" name="status" id="status_inactive" value="0">
                                <span class="platform-tile inactive-status-tile"><i
                                        class="ri-close-circle-line me-2"></i>Archived</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-12">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                            Corporate / Dispatch Address HQ
                        </label>
                        <div class="inner-addon">
                            <i class="ri-map-pin-2-line addon-icon"></i>
                            <input type="text" name="address" id="address"
                                class="form-control custom-premium-input"
                                placeholder="Enter full logistical street address details...">
                        </div>
                    </div>
                </div>





            </div>

            <div class="d-flex justify-content-end align-items-center gap-3 backend-action-bar">
                <button type="button" id="resetSupplierForm" class="btn btn-premium-action-secondary">
                    <i class="ri-refresh-line me-2"></i> Clear Configuration
                </button>
                <button type="submit" class="btn btn-premium-action-primary">
                    <i class="ri-save-3-line me-2"></i> Commit Vendor Contract
                </button>
            </div>
        </form>
    </div>
</div>

<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="text-md fw-bold mb-0 text-dark-main text-uppercase tracking-wider">Verified Procurement
                Directory</h6>
            <p class="text-xs text-muted mb-0">Active supply chain catalog and validated logistics stakeholder grid</p>
        </div>

        <div class="d-flex gap-3 align-items-center">
            <div class="inner-addon" style="width: 260px;">
                <i class="ri-search-2-line addon-icon"></i>
                <input type="text" id="supplierRegistrySearch"
                    class="form-control custom-premium-input registry-search-bar"
                    placeholder="Filter stakeholders instantly...">
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive scrollable-class-registry">
            <table class="table bordered-table align-middle mb-0 text-sm">
                <thead class="position-sticky top-0 bg-base z-3 border-bottom">
                    <tr>
                        <th scope="col" style="width: 60px;" class="text-center">S.No.</th>
                        <th scope="col" style="width: 280px;">Supplier / Agency</th>
                        <th scope="col" style="width: 240px;">Contact Mapping Matrix</th>
                        <th scope="col" style="width: 180px;">Fiscal Tokens</th>
                        <th scope="col" class="text-center" style="width: 150px;">System Status</th>
                        <th scope="col" class="text-center" style="width: 130px;">Operations</th>
                    </tr>
                </thead>
                <tbody id="supplierRegistryTableBody">

                </tbody>
            </table>
        </div>
    </div>
</div>


@push('styles')
    <style>
        .premium-generator-card {
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

        .avatar-matrix-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(124, 58, 237, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(124, 58, 237, 0.15);
        }

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
            width: 100%;
        }

        .inner-addon .addon-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #64748b;
            pointer-events: none;
            z-index: 10;
        }

        .premium-input-box:focus-within .addon-icon {
            color: #7c3aed;
        }

        .custom-premium-input {
            width: 100% !important;
            padding-left: 42px !important;
            padding-right: 14px !important;
            border-radius: 8px !important;
            border: 1px solid #cbd5e1 !important;
            font-weight: 600 !important;
            height: 42px;
            font-size: 0.88rem;
            color: #1e293b;
            background-color: #ffffff !important;
        }

        .registry-search-bar {
            height: 38px !important;
            font-size: 0.85rem !important;
            padding-left: 40px !important;
        }

        .backend-action-bar {
            border-top: 1px dashed #e2e8f0;
            padding-top: 24px;
            margin-top: 12px;
        }

        .btn-premium-action-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: #ffffff !important;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 12px 28px;
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 14px rgba(124, 58, 237, 0.25);
            transition: all 0.25s ease-in-out;
            display: inline-flex;
            align-items: center;
        }

        .btn-premium-action-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
            filter: brightness(1.05);
        }

        .btn-premium-action-secondary {
            background: #ffffff;
            color: #475569 !important;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 12px 24px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
        }

        .btn-premium-action-secondary:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }

        .platform-tab-wrapper {
            cursor: pointer;
            flex: 1;
            min-width: 100px;
            position: relative;
        }

        .platform-tab-wrapper input {
            position: absolute;
            opacity: 0;
        }

        .platform-tile {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 14px;
            border-radius: 8px;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            font-size: 0.85rem;
            font-weight: 700;
            color: #64748b;
            transition: all 0.2s ease;
            text-align: center;
        }

        .platform-tab-wrapper:hover .platform-tile {
            background: #f1f5f9;
        }

        .platform-tab-wrapper input:checked+.platform-tile.active-status-tile {
            border-color: #22c55e;
            color: #15803d;
            background: #dcfce7;
        }

        .platform-tab-wrapper input:checked+.platform-tile.inactive-status-tile {
            border-color: #ef4444;
            color: #b91c1c;
            background: #fee2e2;
        }

        .scrollable-class-registry {
            max-height: 480px;
            overflow-y: auto;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-completed {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .pulse-dot-green {
            width: 6px;
            height: 6px;
            background: #2e7d32;
            border-radius: 50%;
            display: inline-block;
        }

        .bg-slate-100 {
            background-color: #f1f5f9;
        }

        .text-slate-700 {
            color: #334155;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {

            fetchRegisteredSuppliers();

            // search

            $("#supplierRegistrySearch").on("keyup", function() {

                let value = $(this).val().toLowerCase();

                $("#supplierRegistryTableBody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });

            });

        });

        // fetch

        function fetchRegisteredSuppliers() {

            fetchMasterData(
                "{{ route('school.library.supplier.fetch') }}",
                function(res) {

                    let html = '';

                    if (res.status && res.data.length > 0) {

                        $.each(res.data, function(index, row) {

                            let initials = row.supplier_name
                                .split(' ')
                                .map(word => word.charAt(0))
                                .join('')
                                .substring(0, 3)
                                .toUpperCase();

                            let statusBadge = row.status == 1 ?

                                `<span class="status-badge badge-completed">
                                <span class="pulse-dot-green"></span>
                                Active Node
                            </span>`

                                :

                                `<span class="status-badge badge-cancelled">
                                Archived
                            </span>`;

                            html += `
                            <tr class="supplier-record-row">

                                <td class="text-center fw-semibold text-muted">
                                    ${index + 1}
                                </td>

                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="avatar-matrix-icon">
                                            <span class="fw-bold text-sm text-gradient-primary">
                                                ${initials}
                                            </span>
                                        </div>

                                        <div>

                                            <span class="fw-bold text-dark-main d-block">
                                                ${row.supplier_name}
                                            </span>

                                            <small class="text-muted text-xs d-block">
                                                ID : ${row.id}
                                            </small>

                                            <span class="text-xs text-primary-600 fw-semibold">
                                                <i class="ri-user-line me-1"></i>
                                                ${row.contact_person ?? '-'}
                                            </span>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <span class="fw-bold text-dark-main d-block" style="font-size:13px;">
                                        <i class="ri-phone-fill text-xs text-muted me-1"></i>
                                        ${row.mobile ?? '-'}
                                    </span>

                                    <span class="text-muted d-block" style="font-size:12px;">
                                        <i class="ri-mail-line text-xs me-1"></i>
                                        ${row.email ?? '-'}
                                    </span>

                                </td>

                                <td>

                                    <span class="badge bg-slate-100 text-slate-700 font-monospace text-xs">
                                        GST : ${row.gst_number ?? '-'}
                                    </span>

                                </td>

                                <td class="text-center">
                                    ${statusBadge}
                                </td>

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-2">

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-primary radius-6 py-4 px-8 edit-supplier-trigger"
                                            data-id="${row.id}"
                                            title="Edit">

                                            <i class="ri-edit-box-line"></i>

                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger radius-6 py-4 px-8 deleteLibrarySupplier"
                                            data-id="${row.id}"
                                            title="Delete">

                                            <i class="ri-delete-bin-6-line"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>
                        `;
                        });

                    } else {

                        html = `
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                No Records Found
                            </td>
                        </tr>
                    `;
                    }

                    $("#supplierRegistryTableBody").html(html);

                }
            );

        }

        // edit

        $(document).on("click", ".edit-supplier-trigger", function() {

            let id = $(this).data("id");

            getDataById(
                "{{ route('school.library.supplier.get') }}",
                id,
                function(res) {

                    if (!res.status) {
                        return;
                    }

                    let row = res.data;

                    $("#supplier_id").val(row.id);
                    $("#supplier_name").val(row.supplier_name);
                    $("#contact_person").val(row.contact_person);
                    $("#gst_number").val(row.gst_number);
                    $("#mobile").val(row.mobile);
                    $("#alternate_mobile").val(row.alternate_mobile);
                    $("#email").val(row.email);
                    $("#address").val(row.address);

                    if (row.status == 1) {

                        $("#status_active").prop("checked", true);

                    } else {

                        $("#status_inactive").prop("checked", true);

                    }

                    $("html, body").animate({
                        scrollTop: 0
                    }, 300);

                }
            );

        });

        // reset

        $("#resetSupplierForm").on("click", function() {

            $("#supplierRegistrationForm")[0].reset();

            $("#supplier_id").val("");

            $("#status_active").prop("checked", true);

        });
    </script>
@endpush
