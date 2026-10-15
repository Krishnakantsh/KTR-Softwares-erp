@extends('SuperAdmin.Layout.main')

@section('title', 'KTR ERP : Plan Feature Mapping Matrix')

@push('style')
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .feature-premium-card {
            transition: all 0.25s ease-in-out;
            border: 1px solid var(--neutral-200);
        }

        .feature-premium-card:hover {
            border-color: var(--primary-300);
            box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.05);
        }

        /* Premium custom checkbox design */
        .custom-premium-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
    </style>
@endpush

@section('superAdminContent')
    <div class="dashboard-main-body py-24 px-16">

        <form id="mappingEngineForm" class="ajaxForm" data-url="{{ route('superAdmin.planFeaturesMapping.save') }}"
            data-method="POST">
            @csrf


            <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 custom-premium-card mb-32">
                <!-- Card Header -->
                <div class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="brand-pulse-container bg-primary-50 p-2 px-12 radius-10 border border-primary-100">
                            <i class="ri-git-merge-line text-2xl text-primary-600"></i>
                        </div>
                        <div>
                            <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Ecosystem Mapping Engine</h5>
                            <p class="text-xs text-neutral-500 mb-0">Select an enterprise architecture tier to orchestrate
                                and authorize core functional hooks.</p>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-28">
                    <div class="row align-items-center g-4">

                        <!-- LEFT SIDE: Dropdown Form -->
                        <div class="col-xl-7 col-lg-7 col-md-12">
                            <div class="premium-input-box position-relative">
                                <label
                                    class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-12 d-block text-start">
                                    Target Subscription Plan Matrix <span class="text-danger">*</span>
                                </label>
                                <div class="inner-addon position-relative">
                                    <i class="ri-medal-line text-neutral-400 addon-icon position-absolute start-0 top-50 translate-middle-y ms-16"
                                        style="z-index: 5;"></i>
                                    <select
                                        class="form-control form-select custom-premium-select ps-44 py-12 radius-8 fw-semibold text-neutral-800"
                                        name="subscription_plan_id" id="subscription_plan_id" required>
                                        <option value="">-- DISCOVER & SELECT SUBSCRIPTION PLAN --</option>
                                        <!-- Options yahan aayengi -->
                                    </select>
                                </div>
                                <p class="text-xs text-neutral-400 mt-8 mb-0"><i class="ri-information-line me-4"></i>
                                    Upgrading or changing plans will instantly recalculate API limits and node distribution.
                                </p>
                            </div>
                        </div>

                        <!-- RIGHT SIDE: Premium Graphics / Feature Preview Zone -->
                        <div class="col-xl-5 col-lg-5 col-md-12">
                            <div
                                class="graphics-preview-zone p-20 radius-12 bg-neutral-50 border border-neutral-100 position-relative overflow-hidden d-flex flex-column gap-3">
                                <!-- Subtle Background Decorative Shape -->
                                <div class="position-absolute end-0 bottom-0 opacity-10 text-primary-600 dynamic-bg-icon"
                                    style="font-size: 140px; line-height: 0; right: -20px; bottom: -20px;">
                                    <i class="ri-shield-flash-line"></i>
                                </div>

                                <span
                                    class="badge bg-primary-100 text-primary-700 align-self-start radius-4 text-xs px-8 py-4 fw-bold">LIVE
                                    METRICS</span>

                                <div class="graphics-content z-1 position-relative">
                                    <div class="d-flex align-items-start gap-12 mb-12">
                                        <div class="icon-wrap text-primary-600 bg-white shadow-sm radius-8 p-8 d-flex align-items-center justify-content-center"
                                            style="width: 36px; height: 36px;">
                                            <i class="ri-speed-up-line text-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-sm fw-bold text-neutral-800 mb-2">Automated Tier Provisioning
                                            </h6>
                                            <p class="text-xs text-neutral-500 mb-0">Instantly unlocks dedicated nodes,
                                                high-throughput pipelines, and advanced webhooks.</p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start gap-12">
                                        <div class="icon-wrap text-success-600 bg-white shadow-sm radius-8 p-8 d-flex align-items-center justify-content-center"
                                            style="width: 36px; height: 36px;">
                                            <i class="ri-lock-password-line text-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-sm fw-bold text-neutral-800 mb-2">Enterprise-Grade Security</h6>
                                            <p class="text-xs text-neutral-500 mb-0">All matrices include RBAC, custom TLS
                                                termination, and isolated execution layers.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 custom-premium-card d-none"
                id="featuresManifestContainer">
                <div
                    class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="brand-pulse-container bg-purple-50 p-2 px-12 radius-10 border border-purple-100">
                            <i class="ri-node-tree text-2xl text-purple-600"></i>
                        </div>
                        <div>
                            <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Functional Capabilities Matrix
                            </h5>
                            <p class="text-xs text-neutral-500 mb-0">Check or uncheck capability anchors to synchronize
                                access matrix rules for the selected engine profile.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" id="selectAllFeatures"
                            class="btn btn-sm btn-outline-neutral text-xs py-6 px-12 radius-6">Select All</button>
                        <button type="button" id="deselectAllFeatures"
                            class="btn btn-sm btn-outline-neutral text-xs py-6 px-12 radius-6">Clear All</button>
                    </div>
                </div>

                <div class="card-body p-28 bg-neutral-50/50">
                    <div class="row g-4" id="featuresGridContainer">
                    </div>
                </div>

                <div class="card-footer border-top bg-base py-20 px-28 d-flex justify-content-end align-items-center gap-3">
                    <button type="submit"
                        class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-32 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2"
                        id="btnSaveMapping">
                        <i class="ri-shield-flash-line"></i> Synchronize Matrix Mapping
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            populatePlanDropdown();


            $("#subscription_plan_id").on("change", function() {
                let planId = $(this).val();

                if (!planId) {
                    $("#featuresManifestContainer").addClass("d-none");
                    $("#featuresGridContainer").html("");
                    return;
                }

                let shimmerHtml = '';
                for (let i = 0; i < 6; i++) {
                    shimmerHtml += `
                        <div class="col-xl-4 col-md-6">
                            <div class="p-20 radius-12 bg-base border border-neutral-200 shadow-sm d-flex gap-3 align-items-start style="opacity: 0.6;">
                                <div class="bg-neutral-200 radius-8 placeholder animate-pulse" style="width: 40px; height: 40px;"></div>
                                <div class="flex-grow-1">
                                    <div class="bg-neutral-200 radius-4 placeholder mb-8 w-50 animate-pulse" style="height: 14px;"></div>
                                    <div class="bg-neutral-200 radius-4 placeholder w-100 animate-pulse" style="height: 24px;"></div>
                                </div>
                            </div>
                        </div>`;
                }
                $("#featuresGridContainer").html(shimmerHtml);
                $("#featuresManifestContainer").removeClass("d-none");


                $.ajax({
                    url: "{{ route('superAdmin.planFeaturesMapping.fetch') }}",
                    method: "GET",
                    data: {
                        id: planId
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status) {
                            renderFeaturesGrid(res.allFeatures, res.connectedFeatureIds);
                        } else {
                            renderEmptyState(
                                "Failed to synchronize ecosystem modules metadata framework."
                            );
                        }
                    },
                    error: function() {
                        renderEmptyState(
                            "Network orchestration break detected. Connection timed out.");
                    }
                });
            });

            $("#selectAllFeatures").on("click", function() {
                $(".feature-checkbox-node").prop("checked", true);
            });
            $("#deselectAllFeatures").on("click", function() {
                $(".feature-checkbox-node").prop("checked", false);
            });
        });

        function populatePlanDropdown() {
            fetchMasterData("{{ route('superAdmin.subscriptionPlan.fetch') }}", function(res) {
                let options = '<option value="">-- DISCOVER & SELECT SUBSCRIPTION PLAN --</option>';
                if (res.status && res.data.length > 0) {
                    $.each(res.data, function(index, plan) {
                        options += `<option value="${plan.id}">${plan.name} (${plan.code})</option>`;
                    });
                }
                $("#subscription_plan_id").html(options);
            });
        }


        function renderFeaturesGrid(allFeatures, connectedFeatureIds) {
            let html = '';

            if (allFeatures && allFeatures.length > 0) {
                $.each(allFeatures, function(index, feature) {

                    let selectedIds = connectedFeatureIds || [];

                    let isChecked = selectedIds.includes(feature.id) ?
                        'checked' :
                        '';

                    let moduleLabel = feature.module_name ? feature.module_name : 'General Hook';

                    html += `
                    <div class="col-xl-4 col-md-6 col-12">
                        <label class="w-100 h-100 cursor-pointer m-0" for="feature_chk_${feature.id}">
                            <div class="p-20 radius-12 bg-base feature-premium-card d-flex align-items-start gap-3 h-100 shadow-sm position-relative">
                                
                                <div class="pt-2">
                                    <input type="checkbox" name="plan_features[]" value="${feature.id}" 
                                           id="feature_chk_${feature.id}" 
                                           class="form-check-input custom-premium-checkbox feature-checkbox-node text-primary-600" 
                                           ${isChecked}>
                                </div>

                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between gap-2 mb-4">
                                        <h6 class="text-sm fw-bold text-neutral-800 mb-0 tracking-tight">${feature.name}</h6>
                                        <span class="badge bg-purple-50 text-purple-700 border border-purple-100 font-xxs px-8 py-2 radius-4">
                                            ${moduleLabel}
                                        </span>
                                    </div>
                                    <p class="text-xs text-neutral-400 font-mono mb-6">${feature.slug}</p>
                                    
                                    <p class="text-xs text-neutral-500 mb-0 line-clamp-2" title="${feature.description || ''}">
                                        ${feature.description || 'No descriptive context configured for this architectural capability anchor.'}
                                    </p>
                                </div>
                            </div>
                        </label>
                    </div>`;
                });
            } else {
                html = `
                <div class="col-12 py-40 text-center">
                    <div class="text-neutral-400 mb-2"><i class="ri-shield-cross-line text-3xl"></i></div>
                    <span class="text-sm fw-medium text-neutral-500">No architectural capabilities registered. Build plan features registry first.</span>
                </div>`;
            }

            $("#featuresGridContainer").html(html);
        }

        function renderEmptyState(message) {
            let html = `
            <div class="col-12 py-40 text-center">
                <div class="text-danger-400 mb-2"><i class="ri-error-warning-line text-3xl"></i></div>
                <span class="text-sm fw-medium text-danger-500">${message}</span>
            </div>`;
            $("#featuresGridContainer").html(html);
        }
    </script>
@endpush
