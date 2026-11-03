@extends('SuperAdmin.Layout.main')

@section('title', 'KTR ERP : Create And Update Broadcast')

@section('superAdminContent')
    <div class="dashboard-main-body py-24 px-16">

        <div class="shadow-2 radius-16 bg-base overflow-hidden border border-neutral-200 mb-16 custom-premium-card">

            <div
                class="card-header border-bottom bg-base py-20 px-28 d-flex justify-content-between align-items-center dynamic-header-wrapper">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-pulse-icon">
                        <i class="ri-broadcast-line text-2xl text-white"></i>
                    </div>
                    <div>
                        <h5 class="text-xl fw-bold mb-2 text-neutral-900 tracking-tight">Broadcast Control Terminal</h5>
                        <p class="text-xs text-neutral-500 mb-0">Configure enterprise-level dynamic alerts, system-wide
                            updates, notifications, and scheduled micro-targeting rules.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-28">
                <form id="broadcastForm" class="ajaxForm" enctype="multipart/form-data"
                    data-url="{{ route('superAdmin.broadcast.save') }}" data-method="POST" autocomplete="off">
                    @csrf

                    <input type="hidden" name="id" id="broadcast_id" value="{{ $broadcast->id ?? '' }}">

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-primary-100 text-primary-700 font-xs fw-bold px-12 py-6 radius-6">01</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Core Broadcast
                                Dispatch</h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Broadcast Dispatch Title <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-advertisement-line addon-icon"></i>
                                        <input type="text" class="form-control custom-premium-input" id="title"
                                            name="title" value="{{ $broadcast->title ?? '' }}"
                                            placeholder="Enter system broadcast title" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Broadcast Type Engine <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-git-merge-line addon-icon" style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select" name="type"
                                            id="broadcast_type">
                                            <option value="announcement">📢 Announcement</option>
                                            <option value="broadcast">📡 Broadcast</option>
                                            <option value="feature">✨ New Feature Release</option>
                                            <option value="module">📦 Module Update</option>
                                            <option value="bug_fix">🐛 Bug Fix Resolved</option>
                                            <option value="maintenance">🔧 Scheduled Maintenance</option>
                                            <option value="security">🔒 Security Shield Warning</option>
                                            <option value="app_update">🚀 App Update Release</option>
                                            <option value="subscription">💳 Subscription Alert</option>
                                            <option value="payment">💰 Billing/Payment Processing</option>
                                            <option value="holiday">🏖️ Institutional Holiday</option>
                                            <option value="news">📰 Press & Ecosystem News</option>
                                            <option value="offer">🎁 Promotional Offer</option>
                                            <option value="other">☕ Miscellaneous / Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Criticality Priority Level
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-flashlight-line addon-icon" style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select" name="priority"
                                            id="priority">
                                            <option value="low">Green (Low Priority)</option>
                                            <option value="normal" selected>Blue (Normal Baseline)</option>
                                            <option value="high">Orange (High Attention)</option>
                                            <option value="critical">Red (Critical Impact)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Comprehensive
                                        Description Narrative</label>
                                    <textarea class="form-control" name="description" rows="3"
                                        placeholder="Compose standard rich communication description corpus..."
                                        style="border: 1px solid #cbd5e1; border-radius: 8px; font-weight:600; font-size:0.9rem; padding: 12px; color:#1e293b;">{{ $broadcast->description ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-success-100 text-success-700 font-xs fw-bold px-12 py-6 radius-6">02</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Audience Targeting &
                                Distribution Nodes</h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">
                                        Audience Target Strategy <span class="text-danger">*</span>
                                    </label>
                                    <div class="inner-addon">
                                        <i class="ri-user-search-line addon-icon" style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select" name="audience_type"
                                            id="audience_type">
                                            <option value="all" selected>All Active Clusters (Universal Broadcast)
                                            </option>
                                            <option value="selected">Selective Targeting (Specific Tenants)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6" id="tenant_wrapper" style="display: none;">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Target
                                        Multi-Tenants Node <span class="text-danger">*</span></label>
                                    <div class="dropdown custom-premium-multiselect">
                                        <button
                                            class="form-control custom-premium-input d-flex justify-content-between align-items-center text-start"
                                            type="button" id="tenantDropdownBtn" data-bs-toggle="dropdown"
                                            data-bs-auto-close="outside" style="padding-left:14px !important;">
                                            <span class="selected-text text-muted font-xs">Select Target Clusters...</span>
                                            <i class="ri-arrow-down-s-line"></i>
                                        </button>
                                        <div class="dropdown-menu p-3 shadow-lg border-neutral-200"
                                            style="width: 100%; max-height: 280px; overflow-y: auto; border-radius:12px;">
                                            <input type="text"
                                                class="form-control form-control-sm mb-2 premium-search-box-input"
                                                placeholder="🔍 Search cluster systems..."
                                                style="font-size: 13px; border-radius: 6px;">
                                            <div class="options-container">
                                                @foreach ($schools ?? [] as $schoolItem)
                                                    <div
                                                        class="dropdown-item d-flex align-items-center gap-2 py-8 cursor-pointer select-option-row">
                                                        <input type="checkbox" name="tenant_json[]"
                                                            value="{{ $schoolItem->id }}"
                                                            class="form-check-input select-checkbox-input"
                                                            id="tenant_{{ $schoolItem->id }}">
                                                        <label
                                                            class="form-check-label font-xs mb-0 cursor-pointer text-neutral-800 fw-semibold"
                                                            for="tenant_{{ $schoolItem->id }}">{{ $schoolItem->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Target
                                        Active Ecosystem Channels <span class="text-danger">*</span></label>
                                    <div class="dropdown custom-premium-multiselect">
                                        <button
                                            class="form-control custom-premium-input d-flex justify-content-between align-items-center text-start"
                                            type="button" id="platformDropdownBtn" data-bs-toggle="dropdown"
                                            data-bs-auto-close="outside" style="padding-left:14px !important;">
                                            <span class="selected-text text-muted font-xs">Select Ecosystem
                                                Platforms...</span>
                                            <i class="ri-arrow-down-s-line"></i>
                                        </button>
                                        <div class="dropdown-menu p-3 shadow-lg border-neutral-200"
                                            style="width: 100%; border-radius:12px;">
                                            <input type="text"
                                                class="form-control form-control-sm mb-2 premium-search-box-input"
                                                placeholder="🔍 Search platform channels..."
                                                style="font-size: 13px; border-radius: 6px;">
                                            <div class="options-container">
                                                <div
                                                    class="dropdown-item d-flex align-items-center gap-2 py-8 cursor-pointer select-option-row">
                                                    <input type="checkbox" name="platform[]" value="web"
                                                        class="form-check-input select-checkbox-input" id="plat_web"
                                                        checked>
                                                    <label
                                                        class="form-check-label font-xs mb-0 cursor-pointer text-neutral-800 fw-semibold"
                                                        for="plat_web">🖥️ Web Application Hub</label>
                                                </div>
                                                <div
                                                    class="dropdown-item d-flex align-items-center gap-2 py-8 cursor-pointer select-option-row">
                                                    <input type="checkbox" name="platform[]" value="android"
                                                        class="form-check-input select-checkbox-input" id="plat_android">
                                                    <label
                                                        class="form-check-label font-xs mb-0 cursor-pointer text-neutral-800 fw-semibold"
                                                        for="plat_android">🤖 Android Core Engine</label>
                                                </div>
                                                <div
                                                    class="dropdown-item d-flex align-items-center gap-2 py-8 cursor-pointer select-option-row">
                                                    <input type="checkbox" name="platform[]" value="ios"
                                                        class="form-check-input select-checkbox-input" id="plat_ios">
                                                    <label
                                                        class="form-check-label font-xs mb-0 cursor-pointer text-neutral-800 fw-semibold"
                                                        for="plat_ios">🍏 iOS Apple Terminal</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span
                                class="badge bg-warning-100 text-warning-700 font-xs fw-bold px-12 py-6 radius-6">03</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">Dynamic Layout
                                Architecture Configurations</h6>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xl-4 col-md-6 dynamic-field" data-depend-type="module">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Routing
                                        Module System Key Name</label>
                                    <div class="inner-addon">
                                        <i class="ri-mickey-line addon-icon"></i>
                                        <input type="text" class="form-control custom-premium-input"
                                            name="module_name" placeholder="e.g., examination_hub">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 dynamic-field" data-depend-type="module">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Routing
                                        Micro-Frontend URL Target</label>
                                    <div class="inner-addon">
                                        <i class="ri-route-line addon-icon"></i>
                                        <input type="text" class="form-control custom-premium-input" name="module_url"
                                            placeholder="e.g., /modules/exam-terminal">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Interactive
                                        Action Handler</label>
                                    <div class="inner-addon">
                                        <i class="ri-cursor-fill addon-icon" style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select" name="action_type"
                                            id="action_type">
                                            <option value="none" selected>No Interactive Engagement Action</option>
                                            <option value="module">Internal Module Portal Routing</option>
                                            <option value="url">External Secure Hyperlink URL</option>
                                            <option value="download">File Resource Attachment Download</option>
                                            <option value="contact_support">Route to Customer Support Gateway</option>
                                            <option value="renew_subscription">Automated Billing Renewal Route</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 dynamic-field"
                                data-depend-action="module,url,download,contact_support,renew_subscription">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Interactive
                                        CTA Button Label Text</label>
                                    <div class="inner-addon">
                                        <i class="ri-text-snippet addon-icon"></i>
                                        <input type="text" class="form-control custom-premium-input"
                                            name="button_text" placeholder="e.g., Execute Upgrades Now">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 dynamic-field" data-depend-action="url,download">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Action
                                        Target Endpoint URL</label>
                                    <div class="inner-addon">
                                        <i class="ri-link-m addon-icon"></i>
                                        <input type="url" class="form-control custom-premium-input" name="button_url"
                                            placeholder="https://secure.gateway.domain/resource">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Presentation
                                        UI Archetype</label>
                                    <div class="inner-addon">
                                        <i class="ri-window-line addon-icon" style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select" name="display_type"
                                            id="display_type">
                                            <option value="popup" selected>Central Modal Box Overlay (Popup)</option>
                                            <option value="banner">Global Header/Footer Ribbon Strip (Banner)</option>
                                            <option value="notification">Bell Control Center Feed (Notification)</option>
                                            <option value="toast">Snack Bar Temporary Pop-up Alert (Toast)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 dynamic-field" data-depend-display="popup">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Popup
                                        Anchor Screen Quadrant</label>
                                    <div class="inner-addon">
                                        <i class="ri-focus-3-line addon-icon" style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select"
                                            name="popup_position">
                                            <option value="center" selected>Absolute Screen View Center</option>
                                            <option value="top">Top View Banner Center</option>
                                            <option value="bottom">Bottom Dock Center Overlay</option>
                                            <option value="top_left">Upper Left Corner Anchor</option>
                                            <option value="top_right">Upper Right Floating Corner</option>
                                            <option value="bottom_left">Lower Left Status Bar Corner</option>
                                            <option value="bottom_right">Lower Right System Status Float</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 dynamic-field" data-depend-display="banner">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Ribbon
                                        Theme CSS Hex Color</label>
                                    <div class="inner-addon">
                                        <i class="ri-palette-line addon-icon"></i>
                                        <input type="color" class="form-control custom-premium-input p-1"
                                            name="banner_color" value="#4f46e5" style="height:44px;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 dynamic-field"
                                data-depend-type="app_update,maintenance,bug_fix">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Target
                                        Version Build Baseline</label>
                                    <div class="inner-addon">
                                        <i class="ri-git-commit-line addon-icon"></i>
                                        <input type="text" class="form-control custom-premium-input"
                                            name="current_version" placeholder="e.g., v3.4.1-stable">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-segment mb-28">
                        <div class="d-flex align-items-center gap-2 mb-16 segment-indicator">
                            <span class="badge bg-info-100 text-info-700 font-xs fw-bold px-12 py-6 radius-6">04</span>
                            <h6 class="text-sm fw-bold uppercase tracking-wider text-neutral-700 mb-0">System Logic
                                Behaviors, Schedules & Resource Attachments</h6>
                        </div>

                        <div class="row gy-4 align-items-center">
                            <div class="col-xl-3 col-md-6">
                                <div
                                    class="d-flex align-items-center justify-content-between p-3 border border-neutral-200 radius-12 bg-light-soft">
                                    <span class="font-xs fw-bold text-neutral-700 text-uppercase tracking-wider">Trigger
                                        Modal Box Popup</span>
                                    <label class="switch">
                                        <input type="checkbox" name="show_popup" value="1" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div
                                    class="d-flex align-items-center justify-content-between p-3 border border-neutral-200 radius-12 bg-light-soft">
                                    <span class="font-xs fw-bold text-neutral-700 text-uppercase tracking-wider">Inject
                                        Center Feed Inbox</span>
                                    <label class="switch">
                                        <input type="checkbox" name="show_notification" value="1" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div
                                    class="d-flex align-items-center justify-content-between p-3 border border-neutral-200 radius-12 bg-light-soft">
                                    <span class="font-xs fw-bold text-neutral-700 text-uppercase tracking-wider">User Can
                                        Safely Dismiss</span>
                                    <label class="switch">
                                        <input type="checkbox" name="is_dismissible" value="1" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div
                                    class="d-flex align-items-center justify-content-between p-3 border border-neutral-200 radius-12 bg-light-soft">
                                    <span class="font-xs fw-bold text-neutral-700 text-uppercase tracking-wider">Force
                                        Active Acknowledgement</span>
                                    <label class="switch">
                                        <input type="checkbox" name="requires_acknowledgement" value="1">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Recurrence
                                        State Loop Rule</label>
                                    <div class="inner-addon">
                                        <i class="ri-refresh-line addon-icon" style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select" name="repeat_type">
                                            <option value="once" selected>Display Exactly Once per Node</option>
                                            <option value="daily">Daily Cron Recurrent Trigger Loop</option>
                                            <option value="every_login">Force Trigger on Active Session Login</option>
                                            <option value="until_dismissed">Loop Display Till Target Action Dismissed
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">File
                                        Asset Attachment Resource</label>
                                    <div class="inner-addon">
                                        <i class="ri-attachment-line addon-icon"></i>
                                        <input type="file" class="form-control custom-premium-input pt-10"
                                            name="attachment">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">System
                                        Terminal Initial Status</label>
                                    <div class="inner-addon">
                                        <i class="ri-shield-user-line addon-icon" style="z-index: 5;"></i>
                                        <select class="form-control form-select custom-premium-select" name="status">
                                            <option value="draft" selected>Draft Configuration Vault</option>
                                            <option value="active">Active System Dispatch Production</option>
                                            <option value="inactive">Suspended Inactive State Node</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Deployment
                                        Start Date <span class="text-danger">*</span></label>
                                    <div class="inner-addon">
                                        <i class="ri-calendar-todo-line addon-icon"></i>
                                        <input type="date" class="form-control custom-premium-input" name="start_date"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Decommission
                                        End Date <span class="text-danger">*</span></label>
                                    <div class="inner-addon">
                                        <i class="ri-calendar-close-line addon-icon"></i>
                                        <input type="date" class="form-control custom-premium-input" name="end_date"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Start
                                        Time Gate</label>
                                    <div class="inner-addon">
                                        <i class="ri-time-line addon-icon"></i>
                                        <input type="time" class="form-control custom-premium-input"
                                            name="start_time">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="premium-input-box">
                                    <label
                                        class="text-xs fw-bold text-uppercase tracking-wider text-neutral-600 mb-8 d-block">Termination
                                        Time Gate</label>
                                    <div class="inner-addon">
                                        <i class="ri-time-fill addon-icon"></i>
                                        <input type="time" class="form-control custom-premium-input" name="end_time">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-neutral-200 mb-24">

                    <div class="d-flex justify-content-end align-items-center gap-3 execution-control-bar">
                        <button type="reset"
                            class="btn border border-neutral-300 bg-neutral-50 text-neutral-700 hover-bg-neutral-100 px-24 py-12 radius-8 fw-semibold transition-all d-flex align-items-center gap-2">
                            <i class="ri-loop-left-line"></i> Flush Terminal Form
                        </button>
                        <button type="submit"
                            class="btn btn-primary bg-primary-600 text-white hover-bg-primary-700 px-28 py-12 radius-8 fw-semibold border-0 shadow-sm transition-all d-flex align-items-center gap-2"
                            id="btnSave">
                            <i class="ri-rocket-2-line"></i> Save & Deploy Dispatch
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const typeSelect = document.getElementById("broadcast_type");
        const audienceSelect = document.getElementById("audience_type");
        const actionSelect = document.getElementById("action_type");
        const displaySelect = document.getElementById("display_type");
        const tenantWrapper = document.getElementById("tenant_wrapper");

        function evaluateDynamicFields() {
            const selectedType = typeSelect.value;
            const selectedAction = actionSelect.value;
            const selectedDisplay = displaySelect.value;
            const selectedAudience = audienceSelect.value;

            if (selectedAudience === 'selected') {
                tenantWrapper.style.display = "block";
            } else {
                tenantWrapper.style.display = "none";
            }

            document.querySelectorAll(".dynamic-field").forEach(field => {
                let matchesRule = true;

                if (field.hasAttribute("data-depend-type")) {
                    const types = field.getAttribute("data-depend-type").split(",");
                    if (!types.includes(selectedType)) matchesRule = false;
                }

                if (field.hasAttribute("data-depend-action")) {
                    const actions = field.getAttribute("data-depend-action").split(",");
                    if (!actions.includes(selectedAction)) matchesRule = false;
                }

                // Rule check for layout interface archetype
                if (field.hasAttribute("data-depend-display")) {
                    const displays = field.getAttribute("data-depend-display").split(",");
                    if (!displays.includes(selectedDisplay)) matchesRule = false;
                }

                // Execute clean UI transformation animations/toggles safely
                if (matchesRule) {
                    field.style.display = "block";
                    field.removeAttribute("disabled");
                } else {
                    field.style.display = "none";
                    field.setAttribute("disabled", "disabled");
                }
            });
        }

        // Attach native reactive events for automatic structural synchronization
        typeSelect.addEventListener("change", evaluateDynamicFields);
        audienceSelect.addEventListener("change", evaluateDynamicFields);
        actionSelect.addEventListener("change", evaluateDynamicFields);
        displaySelect.addEventListener("change", evaluateDynamicFields);

        // Initial pass boot sequence execution
        evaluateDynamicFields();

        document.querySelectorAll(".custom-premium-multiselect").forEach(multiselect => {
            const searchInput = multiselect.querySelector(".premium-search-box-input");
            const optionsContainer = multiselect.querySelector(".options-container");
            const btnText = multiselect.querySelector(".selected-text");
            const defaultPlaceholder = btnText.textContent;

            // Dynamic Text Sync Update Module
            function syncCheckedLabels() {
                const checkedBoxes = optionsContainer.querySelectorAll(
                ".select-checkbox-input:checked");
                if (checkedBoxes.length === 0) {
                    btnText.textContent = defaultPlaceholder;
                    btnText.classList.add("text-muted");
                } else if (checkedBoxes.length <= 2) {
                    const labels = [];
                    checkedBoxes.forEach(cb => {
                        labels.push(cb.nextElementSibling.textContent.trim().split(" ")[0] || cb
                            .nextElementSibling.textContent.trim());
                    });
                    btnText.textContent = labels.join(", ");
                    btnText.classList.remove("text-muted");
                } else {
                    btnText.textContent =
                    `🎯 Core Active Targets (${checkedBoxes.length} Checked Node)`;
                    btnText.classList.remove("text-muted");
                }
            }

            // Search Filter Engine Logic
            if (searchInput) {
                searchInput.addEventListener("input", function(e) {
                    const query = e.target.value.toLowerCase().trim();
                    optionsContainer.querySelectorAll(".select-option-row").forEach(row => {
                        const labelTxt = row.querySelector(".form-check-label")
                            .textContent.toLowerCase();
                        if (labelTxt.includes(query)) {
                            row.style.setProperty("display", "flex", "important");
                        } else {
                            row.style.setProperty("display", "none", "important");
                        }
                    });
                });
            }

            // Handle inner checkbox changes safely
            optionsContainer.addEventListener("change", function(e) {
                if (e.target.classList.contains("select-checkbox-input")) {
                    syncCheckedLabels();
                }
            });

            // Make option rows robust clicking mapping target anchors
            optionsContainer.querySelectorAll(".select-option-row").forEach(row => {
                row.addEventListener("click", function(e) {
                    if (e.target.tagName !== "INPUT" && e.target.tagName !== "LABEL") {
                        const cb = row.querySelector(".select-checkbox-input");
                        cb.checked = !cb.checked;
                        cb.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));
                    }
                });
            });

            // Initial mapping layer sync pass execution
            syncCheckedLabels();
        });
    });
</script>
