<!-- SYSTEM CONSOLE: ADVANCED ID-CARD PRINTING & CUSTOMIZATION SUITE -->
<div class="row g-4">

    <!-- LEFT PANEL: MEMBER SELECTOR & REAL-TIME PREVIEW CANVAS -->
    <div class="col-xl-5 col-lg-6 unique-print-no-render">

        <!-- COMPONENT A: RAPID MEMBER INDEX SEARCH & SELECT -->
        <div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24">
            <div class="card-header border-bottom bg-base py-16 px-24">
                <h6 class="text-md fw-bold mb-4 text-gradient-primary text-uppercase tracking-wider">
                    <i class="ri-user-search-fill me-2"></i> Rapid Member Lookup Pipeline
                </h6>
                <p class="text-xs text-muted mb-0">Search via Name, Admission Number, or Card ID token for dynamic canvas
                    injection</p>
            </div>
            <div class="card-body p-24">
                <div class="premium-input-box match-highlight-zone">
                    <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Target
                        Active Member <span class="text-danger">*</span></label>
                    <div class="inner-addon">
                        <i class="ri-search-eye-line addon-icon text-violet"></i>
                        <select name="active_member_selector" id="activeMemberSelector"
                            class="form-control custom-premium-input dynamic-search-select" style="appearance: auto;">


                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- COMPONENT B: LIVE PREVIEW PHYSICAL CANVAS CARD -->
        <div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card p-24 sticky-top-offset">
            <div
                class="mb-16 pb-8 border-bottom border-dashed border-200 d-flex justify-content-between align-items-center">
                <span class="text-xs fw-bold text-uppercase tracking-wider text-muted"><i class="ri-eye-line me-1"></i>
                    Live Preview</span>
                <span class="badge bg-neutral-100 text-neutral-700 text-xxs font-monospace border">Standard CR80
                    Vertical</span>
            </div>

            <!-- THE ID CARD WRAPPER FOR PREVIEW ALIGNMENT -->
            <div class="print-preview-wrapper-zone">
                <!-- THE ID CARD CONTAINER (CR-80 Vertical Dimensions Enforced) -->
                <div id="physicalCardCanvas" class="library-pvc-card-frame dynamic-card-bg vertical-card-layout">
                    <!-- Watermark Node Element -->
                    <div id="cardWatermarkLayer" class="card-watermark-overlay"></div>

                    <!-- Card Header Layout (Supports full-banner mode overlay) -->
                    <div id="cardHeaderContainer" class="card-pvc-header">
                        <!-- Full Header Upload Banner Slot -->
                        <img id="canvasFullHeaderImg" src="" class="full-header-banner-image d-none"
                            alt="Full Header Banner">

                        <!-- Standard Default Modular Header Elements -->
                        <div id="defaultHeaderElements" class="w-100 d-flex align-items-center justify-content-between">
                            <div class="header-logo-placeholder" id="headerLogoContainer">
                                <i class="ri-book-3-fill text-xl header-default-icon"></i>
                            </div>
                            <div class="header-text-block text-end">
                                <p id="canvasHeaderTitle" class="card-institution-title">EXCELLENCE PUBLIC SCHOOL</p>
                                <p id="canvasHeaderSubtitle" class="card-institution-subtitle">Digital Central Library
                                    Pass</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Core Body Profile Matrix -->
                    <div class="card-pvc-body mt-16 d-flex flex-column align-items-center text-center">
                        <div class="member-avatar-box mb-12">
                            <i class="ri-user-line avatar-placeholder-icon"></i>
                            <img id="canvasMemberPhoto" src="" class="d-none" alt="Member Photo">
                        </div>

                        <div class="member-metadata-fields w-100 text-start">
                            <div class="mb-8 text-center">
                                <small class="meta-label-tag text-uppercase">Member Name</small>
                                <div id="canvasMemberName" class="member-dynamic-val value-name">Select A Member</div>
                            </div>

                            <hr class="my-8 border-200" style="border-style: dashed;">

                            <div class="row g-2 mb-8">
                                <div class="col-6">
                                    <small class="meta-label-tag">CLASS / DIVISION</small>
                                    <div id="canvasMemberClass" class="member-dynamic-val value-meta">-</div>
                                </div>
                                <div class="col-6 text-end">
                                    <small class="meta-label-tag">ADMISSION NO</small>
                                    <div id="canvasMemberAdm" class="member-dynamic-val value-meta font-monospace">-
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2">
                                <div class="col-6">
                                    <small class="meta-label-tag">MEMBERSHIP ID</small>
                                    <div id="canvasMemberCardID"
                                        class="member-dynamic-val value-meta font-monospace text-primary-600">-</div>
                                </div>
                                <div class="col-6 text-end">
                                    <small class="meta-label-tag">VALID UNTIL</small>
                                    <div id="canvasMemberExpiry"
                                        class="member-dynamic-val value-meta font-monospace text-danger">-</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer Bar System Asset -->
                    <div
                        class="card-pvc-footer mt-auto pt-12 border-top border-dashed border-200 d-flex justify-content-between align-items-end">
                        <div class="barcode-render-zone" id="barcodeRenderZone">
                            <i class="ri-barcode-box-line barcode-fallback-icon d-block"></i>
                            <img id="canvasUploadedBarcode" src="" class="d-none" alt="Barcode"
                                style="height: 28px; max-width: 110px; object-fit: contain;">
                            <span id="canvasBarcodeText"
                                class="font-monospace text-xxs tracking-widest d-block mt-2">0000000000</span>
                        </div>
                        <div class="signature-render-zone text-center">
                            <div class="admin-sig-canvas-slot">
                                <span id="sigFallbackLine" class="admin-sig-line d-block"></span>
                                <img id="canvasUploadedSignature" src="" class="d-none asset-signature-render"
                                    alt="Admin Signature">
                            </div>
                            <small class="text-xxs text-muted tracking-wider text-uppercase d-block">Authorized
                                Signature</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Print Dispatch Actions Panel -->
            <div class="mt-24 pt-16 border-top d-flex gap-3 justify-content-end">
                <button type="button" id="resetCanvasCustomizer"
                    class="btn btn-premium-action-secondary py-8 px-16 text-xs">
                    <i class="ri-restart-line me-1"></i> Reset Canvas Layout
                </button>
                <button type="button" id="dispatchPrintQueue"
                    class="btn btn-premium-action-primary py-8 px-20 text-xs">
                    <i class="ri-printer-fill me-1"></i> Send to Hardware Printer Spool
                </button>
            </div>
        </div>

    </div>

    <!-- RIGHT PANEL: ADVANCED HEAVY MEMBERSHIP CARD CUSTOMIZER CONTROL ENGINE -->
    <div class="col-xl-7 col-lg-6 unique-print-no-render">
        <div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card">

            <div
                class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-md fw-bold mb-0 text-gradient-primary text-uppercase tracking-wider">
                        <i class="ri-sound-module-fill me-2"></i> Heavy Membership Card Customizer Deck
                    </h6>
                    <p class="text-xs text-muted mb-0">Modify layouts, typography layers, background taxonomy patterns,
                        and barcode anchors on the fly</p>
                </div>
            </div>

            <div class="card-body p-24">

                <!-- LAYER MODULE 1: GLOBAL LAYOUT & BRANDING ASSETS -->
                <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                    <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i
                            class="ri-layout-grid-line me-1"></i> 1. Structural Branding & Layer Assets</span>
                </div>

                <div class="row gy-4 mb-24">
                    <!-- Custom Institution Name -->
                    <div class="col-xl-6 col-12">
                        <div class="premium-input-box">
                            <label
                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Institution
                                Primary Name</label>
                            <div class="inner-addon">
                                <i class="ri-building-4-line addon-icon"></i>
                                <input type="text" id="cfgInstName" class="form-control custom-premium-input"
                                    value="EXCELLENCE PUBLIC SCHOOL">
                            </div>
                        </div>
                    </div>

                    <!-- Custom Subtitle -->
                    <div class="col-xl-6 col-12">
                        <div class="premium-input-box">
                            <label
                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Institution
                                Subtitle Text</label>
                            <div class="inner-addon">
                                <i class="ri-subtext-line addon-icon"></i>
                                <input type="text" id="cfgInstSubtitle" class="form-control custom-premium-input"
                                    value="Digital Central Library Pass">
                            </div>
                        </div>
                    </div>

                    <!-- Full-Width Complete Header Background Graphic Uploader -->
                    <div class="col-xl-12 col-12">
                        <div class="premium-input-box p-12 border border-primary-light bg-primary-soft radius-8">
                            <label
                                class="text-xs fw-bold text-uppercase tracking-wider text-primary d-flex align-items-center justify-content-between mb-8">
                                <span><i class="ri-image-add-line me-1"></i> Upload Complete Full Header Graphic
                                    (Replaces Text Style)</span>
                                <span
                                    class="badge bg-primary text-white text-xxs px-8 py-4 font-monospace">Recommended:
                                    240px x 52px</span>
                            </label>
                            <div class="inner-addon">
                                <input type="file" id="cfgFullHeaderImageUpload" class="form-control"
                                    accept="image/*" style="font-size: 0.8rem; padding: 6px;">
                            </div>
                            <small class="text-neutral-500 text-xxs d-block mt-4">⚠️ Note: Uploading this will
                                completely cover default header background, logos, and custom titles
                                automatically.</small>
                        </div>
                    </div>

                    <!-- Logo & Watermark Layer Row Uploaders -->
                    <div class="col-xl-6 col-12">
                        <div class="premium-input-box">
                            <label
                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Left
                                Small Icon Logo (Default Mode)</label>
                            <div class="inner-addon">
                                <input type="file" id="cfgHeaderLogoUpload" class="form-control" accept="image/*"
                                    style="font-size: 0.7rem; padding: 6px;">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-12">
                        <div class="premium-input-box">
                            <label
                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Center
                                Background Watermark Graphic</label>
                            <div class="inner-addon">
                                <input type="file" id="cfgWatermarkUpload" class="form-control" accept="image/*"
                                    style="font-size: 0.7rem; padding: 6px;">
                            </div>
                        </div>
                    </div>

                    <!-- Barcode Asset Upload Input Element -->
                    <div class="col-xl-6 col-12">
                        <div class="premium-input-box">
                            <label
                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Custom
                                Barcode Asset Upload</label>
                            <div class="inner-addon">
                                <input type="file" id="cfgBarcodeGraphicUpload" class="form-control"
                                    accept="image/*" style="font-size: 0.7rem; padding: 6px;">
                            </div>
                        </div>
                    </div>

                    <!-- Authorized Signature Asset Upload Input Element -->
                    <div class="col-xl-6 col-12">
                        <div class="premium-input-box border border-warning-soft p-8 radius-8 bg-neutral-50">
                            <label
                                class="text-xs fw-bold text-uppercase tracking-wider text-warning-main mb-8 d-block"><i
                                    class="ri-edit-box-line me-1"></i> Authorized Signature Image</label>
                            <div class="inner-addon">
                                <input type="file" id="cfgSignatureGraphicUpload" class="form-control"
                                    accept="image/*" style="font-size: 0.7rem; padding: 6px;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LAYER MODULE 2: CHROMATIC & BACKGROUND ENGINE -->
                <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                    <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i
                            class="ri-palette-line me-1"></i> 2. Chromatic Matrix & Geometry Controls</span>
                </div>

                <div class="row gy-4 mb-24">
                    <!-- Card Theme Solid / Primary Background Color -->
                    <div class="col-xl-4 col-md-6">
                        <div class="premium-input-box">
                            <label
                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Card
                                Frame Solid Tint</label>
                            <div class="d-flex align-items-center gap-2">
                                <input type="color" id="cfgCardBgColor"
                                    class="form-control form-control-color radius-6 border-0" value="#ffffff"
                                    style="width: 48px; height: 38px; cursor: pointer;">
                                <input type="text" id="cfgCardBgColorHex"
                                    class="form-control font-monospace text-xs" value="#ffffff" readonly
                                    style="height: 38px;">
                            </div>
                        </div>
                    </div>

                    <!-- Header Bar Dynamic Solid Strip Accent -->
                    <div class="col-xl-4 col-md-6">
                        <div class="premium-input-box">
                            <label
                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Header
                                Block Strip Accent</label>
                            <div class="d-flex align-items-center gap-2">
                                <input type="color" id="cfgHeaderBgColor"
                                    class="form-control form-control-color radius-6 border-0" value="#4f46e5"
                                    style="width: 48px; height: 38px; cursor: pointer;">
                                <input type="text" id="cfgHeaderBgColorHex"
                                    class="form-control font-monospace text-xs" value="#4f46e5" readonly
                                    style="height: 38px;">
                            </div>
                        </div>
                    </div>

                    <!-- Watermark Opacity Slider Matrix -->
                    <div class="col-xl-4 col-md-6">
                        <div class="premium-input-box">
                            <label
                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Watermark
                                Scale Opacity</label>
                            <div class="pt-8">
                                <input type="range" id="cfgWatermarkOpacity" class="form-range" min="0"
                                    max="1" step="0.05" value="0.1">
                                <div class="d-flex justify-content-between text-xxs text-muted mt-4">
                                    <span>Hidden</span>
                                    <span id="lblWatermarkOpacity">10% Active</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Structural Border Radius Metric -->
                    <div class="col-xl-4 col-md-6">
                        <div class="premium-input-box">
                            <label
                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Card
                                Boundary Border Radius</label>
                            <div class="inner-addon">
                                <i class="ri-rounded-corner addon-icon"></i>
                                <input type="number" id="cfgCardRadius" class="form-control custom-premium-input"
                                    min="0" max="32" value="14" placeholder="px">
                            </div>
                        </div>
                    </div>

                    <!-- Border Stroke Configuration -->
                    <div class="col-xl-4 col-md-6">
                        <div class="premium-input-box">
                            <label
                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Outer
                                Stroke Color Accent</label>
                            <div class="d-flex align-items-center gap-2">
                                <input type="color" id="cfgCardBorderColor"
                                    class="form-control form-control-color radius-6 border-0" value="#e2e8f0"
                                    style="width: 48px; height: 38px; cursor: pointer;">
                                <input type="text" id="cfgCardBorderColorHex"
                                    class="form-control font-monospace text-xs" value="#e2e8f0" readonly
                                    style="height: 38px;">
                            </div>
                        </div>
                    </div>

                    <!-- Card Layout Presets Selector Dropdown -->
                    <div class="col-xl-4 col-md-6">
                        <div class="premium-input-box">
                            <label
                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Preset
                                Theme Configurator</label>
                            <div class="inner-addon">
                                <i class="ri-magic-line addon-icon"></i>
                                <select id="cfgThemePresetSelector" class="form-control custom-premium-input"
                                    style="appearance: auto;">
                                    <option value="custom" selected>Custom Matrix Configuration</option>
                                    <option value="royal-indigo">Royal Sapphire Indigo</option>
                                    <option value="emerald-vault">Emerald Scholar Vault</option>
                                    <option value="crimson-elite">Crimson Academic Elite</option>
                                    <option value="dark-stealth">Dark Obsidian Cyber Pass</option>
                                    <option value="cyberpunk-neon">Cyberpunk Neon Dusk</option>
                                    <option value="minimal-stark">Minimal Stark Platinum</option>
                                    <option value="luxury-gold">Monarch Luxury Gold</option>
                                    <option value="sunset-orange">Warm Sunset Terracotta</option>
                                    <option value="vintage-academic">Classic Vintage Sepia</option>
                                    <option value="corporate-teal">Executive Corporate Teal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LAYER MODULE 3: ADVANCED TYPOGRAPHY MAP CONTROLS -->
                <div class="mb-16 pb-8 border-bottom border-dashed border-200">
                    <span class="text-xs fw-bold text-gradient-primary text-uppercase tracking-wider"><i
                            class="ri-font-size me-1"></i> 3. Advanced Font Vectorization & Color Controllers</span>
                </div>

                <div class="row gy-4">
                    <!-- Institution Title Font Configurator -->
                    <div class="col-xl-6 col-12">
                        <div class="p-16 border bg-light-soft radius-8">
                            <span class="fw-bold text-dark-main mb-12 d-block"><i
                                    class="ri-font-color me-1 text-primary"></i> Institution Primary Title Font
                                Metrics</span>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" id="fontInstSize" class="form-control form-control-sm"
                                        placeholder="Size (px)" value="6" title="Font Size">
                                </div>
                                <div class="col-6">
                                    <input type="color" id="fontInstColor"
                                        class="form-control form-control-color form-control-sm w-100" value="#ffffff"
                                        title="Text Color">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Institution Subtitle Font Configurator -->
                    <div class="col-xl-6 col-12">
                        <div class="p-16 border bg-light-soft radius-8">
                            <span class="text-xs fw-bold text-dark-main mb-12 d-block"><i
                                    class="ri-font-color me-1 text-info"></i> Institution Subtitle Font Metrics</span>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" id="fontSubtitleSize" class="form-control form-control-sm"
                                        placeholder="Size (px)" value="9" title="Font Size">
                                </div>
                                <div class="col-6">
                                    <input type="color" id="fontSubtitleColor"
                                        class="form-control form-control-color form-control-sm w-100" value="#e2e8f0"
                                        title="Text Color">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Member Full Name Typography Setup -->
                    <div class="col-xl-6 col-12">
                        <div class="p-16 border bg-light-soft radius-8">
                            <span class="text-xs fw-bold text-dark-main mb-12 d-block"><i
                                    class="ri-font-color me-1 text-success"></i> Member Name Font Metrics</span>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" id="fontMemberSize" class="form-control form-control-sm"
                                        placeholder="Size (px)" value="14" title="Font Size">
                                </div>
                                <div class="col-6">
                                    <input type="color" id="fontMemberColor"
                                        class="form-control form-control-color form-control-sm w-100" value="#1e293b"
                                        title="Text Color">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Metadata Attribute Fields Typography Setup -->
                    <div class="col-xl-6 col-12">
                        <div class="p-16 border bg-light-soft radius-8">
                            <span class="text-xs fw-bold text-dark-main mb-12 d-block"><i
                                    class="ri-font-color me-1 text-warning"></i> Label & Metadata Layer Metrics</span>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" id="fontMetaSize" class="form-control form-control-sm"
                                        placeholder="Size (px)" value="10" title="Font Size">
                                </div>
                                <div class="col-6">
                                    <input type="color" id="fontMetaColor"
                                        class="form-control form-control-color form-control-sm w-100" value="#334155"
                                        title="Text Color">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Font Family Global Configuration Override -->
                    <div class="col-xl-12 col-12">
                        <div class="p-12 border bg-light-soft radius-8">
                            <label
                                class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">Global
                                Font Vector System</label>
                            <select id="cfgGlobalFontFamily" class="form-select form-select-sm"
                                style="height: 38px; font-weight:600;">
                                <option value="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif"
                                    selected>Standard System Sans-Serif</option>
                                <option value="'Courier New', Courier, monospace">Monospace Tech Type</option>
                                <option value="'Georgia', serif">Classic Georgia Serif Elegant</option>
                                <option value="'Trebuchet MS', sans-serif">Modernist Trebuchet Matrix</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


@push('styles')
    <style>
        .sticky-top-offset {
            position: sticky;
            top: 24px;
            z-index: 10;
        }

        .library-pvc-card-frame.vertical-card-layout {
            width: 240px !important;
            height: 380px !important;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            position: relative;
            padding: 14px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            margin: 0 auto;
            box-sizing: border-box;
        }

        /* Floating Image Nodes Overlay System */
        .card-watermark-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 140px;
            height: 140px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            opacity: 0.1;
            pointer-events: none;
            z-index: 1;
        }

        .card-pvc-header {
            background: #4f46e5;
            margin: -14px -14px 0 -14px;
            padding: 10px 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 2;
            height: 52px;
            overflow: hidden;
        }

        /* Full banner image sizing overrides */
        .full-header-banner-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 240px;
            height: 52px;
            object-fit: fill;
            z-index: 5;
        }

        .header-logo-placeholder {
            width: 28px;
            height: 28px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            flex-shrink: 0;
        }

        .header-logo-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 6px;
        }

        .card-institution-title {
            font-size: 11px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 0;
            letter-spacing: 0.3px;
            line-height: 1.2;
        }

        .card-institution-subtitle {
            font-size: 9px;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 0;
        }

        .card-pvc-body {
            position: relative;
            z-index: 2;
            width: 100%;
        }

        .member-avatar-box {
            width: 80px;
            height: 95px;
            border: 2px solid #cbd5e1;
            border-radius: 6px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .avatar-placeholder-icon {
            font-size: 28px;
            color: #94a3b8;
        }

        .member-avatar-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .meta-label-tag {
            font-size: 8px;
            font-weight: 700;
            color: #64748b;
            letter-spacing: 0.4px;
            display: block;
            margin-bottom: 1px;
        }

        .member-dynamic-val {
            font-weight: 700;
            color: #1e293b;
            line-height: 1.2;
        }

        .member-dynamic-val.value-name {
            font-size: 14px;
        }

        .member-dynamic-val.value-meta {
            font-size: 10px;
        }

        .card-pvc-footer {
            position: relative;
            z-index: 2;
            width: 100%;
            height: 50px;
        }

        .barcode-fallback-icon {
            font-size: 32px;
            color: #1e293b;
            line-height: 1;
            height: 22px;
        }

        .admin-sig-canvas-slot {
            height: 30px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        .admin-sig-line {
            width: 80px;
            border-bottom: 1px solid #94a3b8;
            margin-bottom: 2px;
        }

        .asset-signature-render {
            max-width: 85px;
            max-height: 30px;
            object-fit: contain;
        }

        .bg-light-soft {
            background-color: #f8fafc;
        }


        @media print {

            body * {
                visibility: hidden;
            }

            #physicalCardCanvas,
            #physicalCardCanvas * {
                visibility: visible;
            }

            #physicalCardCanvas {
                position: absolute;
                left: 0;
                top: 0;

                width: 240px !important;
                height: 380px !important;

                box-shadow: none !important;

                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
@endpush


@push('script')
    <script>
        $(document).ready(function() {

            fetchLibraryMembers();

            function fetchLibraryMembers() {

                fetchMasterData(
                    "{{ route('school.library.membership.fetch.with') }}",
                    function(res) {

                        let html = '';

                        if (res.status && res.data.length > 0) {


                            html += `
                               <option value="">Select Member Profile...</option>
                            `;

                            let data = res.data;

                  

                            $.each(data, function(index, row) {

                                let activation_date = formatDate(row.expiry_date, 'short');

                                html += `
                                   <option value="${row.id}" data-name="${row.student?.first_name} ${row.student?.last_name}" data-roll="${row.student?.admission_no ?? '-'}" data-class="Class: ${row.student?.class_master?.name}-${row.student?.section?.name}"
                                data-image="{{ asset('') }}${row.student?.student_photo}"
                                data-adm="${row.student?.admission_no}" data-card="${row.membership_card_number}" data-barcode="${row.barcode_token}"
                                data-expiry="${activation_date}">${row.student?.first_name} ${row.student?.last_name}</option>
                            `;
                            });

                        } else {


                            html += `
                               <option value="">No member available....</option>
                            `;
                        }

                        $("#activeMemberSelector").html(html);

                    }
                );
            }
            fetchLibraryBooks();

            function fetchLibraryBooks() {

                fetchMasterData(
                    "{{ route('school.library.book.get') }}",
                    function(res) {

                        let html = '';

                        if (res.status && res.data.length > 0) {


                            html += `
                               <option value="">Select Member Profile...</option>
                            `;

                            let data = res.data;

                           
                            $.each(data, function(index, row) {

                                let activation_date = formatDate(row.expiry_date, 'short');

                                html += `
                                   <option value="${row.id}" data-name="${row.student?.first_name} ${row.student?.last_name}" data-roll="${row.student?.admission_no ?? '-'}" data-class="Class: ${row.student?.class_master?.name}-${row.student?.section?.name}"
                                data-image="{{ asset('') }}${row.student?.student_photo}"
                                data-adm="${row.student?.admission_no}" data-card="${row.membership_card_number}" data-barcode="${row.barcode_token}"
                                data-expiry="${activation_date}">${row.student?.first_name} ${row.student?.last_name}</option>
                            `;
                            });

                        } else {


                            html += `
                               <option value="">No member available....</option>
                            `;
                        }

                        $("#activeMemberSelector").html(html);

                    }
                );
            }


            // Member Dropdown Onchange mapping engine
            $('#activeMemberSelector').on('change', function() {
                let option = $(this).find('option:selected');

                if ($(this).val() !== "") {
                    $('#canvasMemberName').text(option.data('name'));

                    $('#canvasMemberClass').text(option.data('class'));
                    $('#canvasMemberAdm').text(option.data('adm'));
                    $('#canvasMemberCardID').text(option.data('card'));
                    $('#canvasMemberExpiry').text(option.data('expiry'));
                    $('#canvasMemberPhoto')
                        .attr('src', option.data('image'))
                        .removeClass('d-none');

                    $('.avatar-placeholder-icon').addClass('d-none');
                    $('#canvasBarcodeText').text(option.data('barcode'));



                } else {
                    $('#canvasMemberName').text('Select A Member');
                    $('#canvasMemberClass').text('-');
                    $('#canvasMemberAdm').text('-');
                    $('#canvasMemberPhoto')
                        .attr('src', '')
                        .addClass('d-none');

                    $('.avatar-placeholder-icon').removeClass('d-none');
                    $('#canvasMemberCardID').text('-');
                    $('#canvasMemberExpiry').text('-');
                    $('#canvasBarcodeText').text('0000000000');
                }
            });

            // Customizer real-time text updates
            $('#cfgInstName').on('input', function() {
                $('#canvasHeaderTitle').text($(this).val());
            });

            $('#cfgInstSubtitle').on('input', function() {
                $('#canvasHeaderSubtitle').text($(this).val());
            });

            // FULL WIDTH COMPLETE HEADER IMAGE BANNER PIPELINE
            $('#cfgFullHeaderImageUpload').on('change', function(e) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#defaultHeaderElements').addClass('d-none');
                    $('#canvasFullHeaderImg').attr('src', event.target.result).removeClass('d-none');
                }
                if (e.target.files[0]) {
                    reader.readAsDataURL(e.target.files[0]);
                }
            });

            // SIGNATURE REALTIME ASSET TRANSFER ENGINE
            $('#cfgSignatureGraphicUpload').on('change', function(e) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#sigFallbackLine').addClass('d-none');
                    $('#canvasUploadedSignature').attr('src', event.target.result).removeClass(
                        'd-none');
                }
                if (e.target.files[0]) {
                    reader.readAsDataURL(e.target.files[0]);
                }
            });

            // Chromatic matrix color updates
            $('#cfgCardBgColor').on('input', function() {
                let val = $(this).val();
                $('#cfgCardBgColorHex').val(val);
                $('#physicalCardCanvas').css('background-color', val);
            });

            $('#cfgHeaderBgColor').on('input', function() {
                let val = $(this).val();
                $('#cfgHeaderBgColorHex').val(val);
                $('#cardHeaderContainer').css('background', val);
            });

            $('#cfgCardBorderColor').on('input', function() {
                let val = $(this).val();
                $('#cfgCardBorderColorHex').val(val);
                $('#physicalCardCanvas').css('border-color', val);
            });

            $('#cfgCardRadius').on('input', function() {
                $('#physicalCardCanvas').css('border-radius', $(this).val() + 'px');
            });

            // Header Logo & Watermark Upload Streams
            $('#cfgHeaderLogoUpload').on('change', function(e) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#headerLogoContainer').html('<img src="' + event.target.result +
                        '" alt="logo">');
                }
                if (e.target.files[0]) reader.readAsDataURL(e.target.files[0]);
            });

            $('#cfgWatermarkUpload').on('change', function(e) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#cardWatermarkLayer').css('background-image', 'url(' + event.target.result +
                        ')');
                }
                if (e.target.files[0]) reader.readAsDataURL(e.target.files[0]);
            });

            $('#cfgWatermarkOpacity').on('input', function() {
                let val = $(this).val();
                $('#lblWatermarkOpacity').text(Math.round(val * 100) + '% Active');
                $('#cardWatermarkLayer').css('opacity', val);
            });

            // Custom Barcode Graphic Stream Integration
            $('#cfgBarcodeGraphicUpload').on('change', function(e) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('.barcode-fallback-icon').addClass('d-none');
                    $('#canvasUploadedBarcode').attr('src', event.target.result).removeClass('d-none');
                }
                if (e.target.files[0]) reader.readAsDataURL(e.target.files[0]);
            });

            $('#fontInstSize').on('input', function() {
                $('#canvasHeaderTitle').css('font-size', $(this).val() + 'px');
            });

            $('#fontInstColor').on('input', function() {
                $('#canvasHeaderTitle').css('color', $(this).val());
            });

            $('#fontSubtitleSize').on('input', function() {
                $('#canvasHeaderSubtitle').css('font-size', $(this).val() + 'px');
            });
            $('#fontSubtitleColor').on('input', function() {
                $('#canvasHeaderSubtitle').css('color', $(this).val());
            });

            $('#fontMemberSize').on('input', function() {
                $('#canvasMemberName').css('font-size', $(this).val() + 'px');
            });
            $('#fontMemberColor').on('input', function() {
                $('#canvasMemberName').css('color', $(this).val());
            });

            $('#fontMetaSize').on('input', function() {
                $('.value-meta').css('font-size', $(this).val() + 'px');
            });
            $('#fontMetaColor').on('input', function() {
                $('.meta-label-tag, .value-meta').css('color', $(this).val());
            });
            $('#cfgGlobalFontFamily').on('change', function() {
                $('#physicalCardCanvas').css('font-family', $(this).val());
            });

            // 10+ COMPREHENSIVE PREMIUM THEME PRESET ROUTINES
            $('#cfgThemePresetSelector').on('change', function() {
                let mode = $(this).val();
                switch (mode) {
                    case 'royal-indigo':
                        applyPreset('#ffffff', '#1e1b4b', '#e0e7ff', '#1e293b', '#ffffff');
                        break;
                    case 'emerald-vault':
                        applyPreset('#f8fafc', '#064e3b', '#a7f3d0', '#0f172a', '#ffffff');
                        break;
                    case 'crimson-elite':
                        applyPreset('#fff5f5', '#7f1d1d', '#fca5a5', '#3f2020', '#ffffff');
                        break;
                    case 'dark-stealth':
                        applyPreset('#0f172a', '#1e293b', '#334155', '#f8fafc', '#38bdf8');
                        break;
                    case 'cyberpunk-neon':
                        applyPreset('#120424', '#7928ca', '#ff007a', '#00f0ff', '#fffdfa');
                        break;
                    case 'minimal-stark':
                        applyPreset('#ffffff', '#f1f5f9', '#cbd5e1', '#0f172a', '#0f172a');
                        break;
                    case 'luxury-gold':
                        applyPreset('#1c1917', '#78350f', '#f59e0b', '#fef08a', '#ffffff');
                        break;
                    case 'sunset-orange':
                        applyPreset('#fff7ed', '#ea580c', '#ffedd5', '#431407', '#ffffff');
                        break;
                    case 'vintage-academic':
                        applyPreset('#fefcbf', '#4a3728', '#b7a284', '#2c1d11', '#f7fafc');
                        break;
                    case 'corporate-teal':
                        applyPreset('#f0fdfa', '#115e59', '#99f6e4', '#134e4a', '#ffffff');
                        break;
                }
            });

            function applyPreset(cardBg, headerBg, stroke, txtColor, headerTxtColor) {
                $('#physicalCardCanvas').css({
                    'background-color': cardBg,
                    'border-color': stroke
                });
                $('#cardHeaderContainer').css('background', headerBg);
                $('#canvasMemberName').css('color', txtColor);
                $('#canvasHeaderTitle').css('color', headerTxtColor);

                $('#cfgCardBgColor').val(cardBg);
                $('#cfgCardBgColorHex').val(cardBg);
                $('#cfgHeaderBgColor').val(headerBg);
                $('#cfgHeaderBgColorHex').val(headerBg);
                $('#cfgCardBorderColor').val(stroke);
                $('#cfgCardBorderColorHex').val(stroke);
            }

            // Reset Layout Execution Hook
            $('#resetCanvasCustomizer').on('click', function() {
                applyPreset('#ffffff', '#4f46e5', '#e2e8f0', '#1e293b', '#ffffff');
                $('#cfgCardRadius').val(14);
                $('#physicalCardCanvas').css({
                    'border-radius': '14px',
                    'font-family': 'inherit'
                });
                $('#cfgGlobalFontFamily').val(0);

                // Header Text resets
                $('#canvasHeaderTitle').text('EXCELLENCE PUBLIC SCHOOL').css('font-size', '11px');
                $('#canvasHeaderSubtitle').text('Digital Central Library Pass').css('font-size', '9px');
                $('#fontInstSize').val(11);
                $('#fontSubtitleSize').val(9);

                // Visibility toggles
                $('#defaultHeaderElements').removeClass('d-none');
                $('#canvasFullHeaderImg').addClass('d-none').attr('src', '');
                $('#cfgFullHeaderImageUpload').val('');

                // Signature Resets
                $('#sigFallbackLine').removeClass('d-none');
                $('#canvasUploadedSignature').addClass('d-none').attr('src', '');
                $('#cfgSignatureGraphicUpload').val('');

                // Barcode Resets
                $('.barcode-fallback-icon').removeClass('d-none');
                $('#canvasUploadedBarcode').addClass('d-none').attr('src', '');
                $('#cfgBarcodeGraphicUpload').val('');
            });
        });




        $('#dispatchPrintQueue').on('click', function() {

            let card = $('#physicalCardCanvas').prop('outerHTML');

            let styles = '';

            $('link[rel="stylesheet"], style').each(function() {
                styles += $(this).prop('outerHTML');
            });

            let win = window.open('', '_blank');

            win.document.write(`
                <html>
                <head>
                    <title>Membership Card</title>

                    ${styles}

                    <style>
                        body{
                            margin:0;
                            display:flex;
                            justify-content:center;
                            align-items:center;
                            height:100vh;
                            background:#fff;
                        }

                        #physicalCardCanvas{
                            width:240px !important;
                            height:380px !important;
                            box-shadow:none !important;

                            -webkit-print-color-adjust: exact !important;
                            print-color-adjust: exact !important;
                        }
                    </style>

                </head>
                <body>
                    ${card}
                </body>
                </html>
            `);

            win.document.close();

            setTimeout(function() {
                win.focus();
                win.print();
            }, 1000);
        });
    </script>
@endpush
