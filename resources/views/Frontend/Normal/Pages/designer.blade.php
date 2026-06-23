
@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Permissions Manage')

@section('dynamic-content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <div class="container-fluid p-0 premium-designer-theme">
        <div class="designer-wrapper">

            <div class="designer-left-panel shadow-sm">
                <div class="panel-header d-flex align-items-center gap-2 mb-4">
                    <div class="header-icon-box"><i class="bi bi-grid-1x2-fill text-primary"></i></div>
                    <h6 class="mb-0 fw-bold tracking-tight">Tool Box</h6>
                </div>

                <div class="tool-section mb-4">
                    <small class="text-uppercase tracking-wider text-muted fw-semibold d-block mb-2">Create Elements</small>
                    <div class="d-flex flex-column gap-2">
                        <button class="tool-btn add-text-btn btn w-100 d-flex align-items-center gap-3">
                            <i class="bi bi-type text-primary fs-5"></i> <span>Add Text</span>
                        </button>

                        <button class="tool-btn add-image-btn btn w-100 d-flex align-items-center gap-3">
                            <i class="bi bi-image text-success fs-5"></i> <span>Add Image</span>
                        </button>

                        <button class="tool-btn add-qr-btn btn w-100 d-flex align-items-center gap-3">
                            <i class="bi bi-qr-code text-dark fs-5"></i> <span>Add QR</span>
                        </button>

                        <button class="tool-btn add-barcode-btn btn w-100 d-flex align-items-center gap-3">
                            <i class="bi bi-barcode text-warning fs-5"></i> <span>Add Barcode</span>
                        </button>

                        <button class="tool-btn add-line-btn btn w-100 d-flex align-items-center gap-3">
                            <i class="bi bi-vector-pen text-info fs-5"></i> <span>Add Line</span>
                        </button>

                        <button class="tool-btn add-rectangle-btn btn w-100 d-flex align-items-center gap-3">
                            <i class="bi bi-square text-danger fs-5"></i> <span>Add Rectangle</span>
                        </button>
                    </div>
                </div>

                <div class="tool-section mt-4 pt-3 border-top">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <small class="text-uppercase tracking-wider text-muted fw-semibold">Dynamic Fields</small>
                        <span class="badge bg-indigo-soft text-indigo rounded-pill px-12 py-8">ERP Data</span>
                    </div>

                    <div class="dynamic-fields-grid d-flex flex-column gap-2">
                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between"
                            data-field="{Name}">
                            <span><i class="bi bi-person me-2 text-muted"></i> Name</span> <i
                                class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>

                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between"
                            data-field="{AdmissionNo}">
                            <span><i class="bi bi-hash me-2 text-muted"></i> Admission No</span> <i
                                class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>

                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between"
                            data-field="{Class}">
                            <span><i class="bi bi-journal-bookmark me-2 text-muted"></i> Class</span> <i
                                class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>

                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between"
                            data-field="{Section}">
                            <span><i class="bi bi-grid-3x3-gap me-2 text-muted"></i> Section</span> <i
                                class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>

                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between"
                            data-field="{Mobile}">
                            <span><i class="bi bi-telephone me-2 text-muted"></i> Mobile</span> <i
                                class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>

                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between"
                            data-field="{Photo}">
                            <span><i class="bi bi-image-avatar me-2 text-muted"></i> Photo</span> <i
                                class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>

                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between"
                            data-field="{QRCode}">
                            <span><i class="bi bi-qr-code-scan me-2 text-muted"></i> QR Code</span> <i
                                class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>

                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between"
                            data-field="{Barcode}">
                            <span><i class="bi bi-upc me-2 text-muted"></i> Barcode</span> <i
                                class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="designer-center-panel">

                <div class="designer-topbar shadow-sm">
                    <div class="bg-light p-1 rounded-3 d-flex gap-1 border">
                        <button id="frontSideBtn" class="btn btn-sm px-3 rounded-2 fw-medium btn-primary shadow-sm">
                            <i class="bi bi-front me-1"></i> Front Side
                        </button>
                        <button id="backSideBtn" class="btn btn-sm px-3 rounded-2 fw-medium text-secondary hover-bg-light">
                            <i class="bi bi-back me-1"></i> Back Side
                        </button>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <button id="previewBtn" class="btn btn-action-preview btn-sm px-3 fw-medium rounded-3">
                            <i class="bi bi-eye me-1"></i> Preview
                        </button>
                        <button id="downloadPdfBtn" class="btn btn-action-pdf btn-sm px-3 fw-medium rounded-3">
                            <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                        </button>
                        <div class="vr mx-1 opacity-25"></div>
                        <button id="saveTemplateBtn" class="btn btn-action-save btn-sm px-4 fw-medium rounded-3 shadow-sm">
                            <i class="bi bi-cloud-arrow-up-fill me-1"></i> Save Template
                        </button>
                    </div>
                </div>

                <div class="canvas-wrapper py-5">
                    <div id="frontCanvas" class="designer-canvas"></div>
                    <div id="backCanvas" class="designer-canvas d-none"></div>
                </div>
            </div>

            <div class="designer-right-panel shadow-sm p-0">

                <ul class="nav nav-tabs designer-tabs border-bottom px-3 pt-2" id="panelTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-medium px-3 py-2.5.5 fs-7" id="design-tab" data-bs-toggle="tab"
                            data-bs-target="#tab-design" type="button" role="tab">Design</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-medium px-3 py-2.5.5 fs-7" id="layers-tab" data-bs-toggle="tab"
                            data-bs-target="#tab-layers" type="button" role="tab">Layers & Actions</button>
                    </li>
                </ul>

                <div class="tab-content" id="panelTabContent">

                    <div class="tab-pane fade show active p-3" id="tab-design" role="tabpanel">

                        <div class="right-panel-section mb-4">
                            <div class="section-title d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-sliders2 text-muted"></i>
                                <h6 class="mb-0 fw-bold fs-7 text-uppercase tracking-wider text-muted">Global Design Styles
                                </h6>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Font Size</label>
                                    <div class="input-group input-group-sm custom-input-group">
                                        <input type="number" id="fontSize" class="form-control border-0">
                                        <span
                                            class="input-group-text bg-transparent border-0 text-muted px-2 fs-7">px</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Font Family</label>
                                    <select id="fontFamily" class="form-select form-select-sm custom-input border-0">
                                        <option>Arial</option>
                                        <option>Poppins</option>
                                        <option>Roboto</option>
                                        <option>Georgia</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Font Weight</label>
                                <select id="fontWeight" class="form-select form-select-sm custom-input border-0">
                                    <option value="400">Normal (400)</option>
                                    <option value="600">Semi Bold (600)</option>
                                    <option value="700">Bold (700)</option>
                                    <option value="800">Extra Bold (800)</option>
                                </select>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Text Color</label>
                                    <div
                                        class="color-picker-wrapper d-flex align-items-center gap-2 p-1.5 border rounded-3 bg-white">
                                        <input type="color" id="textColor"
                                            class="form-control form-control-color border-0 p-0 rounded-circle"
                                            style="width:24px; height:24px;">
                                        <span class="fs-7 text-muted fw-mono text-uppercase">Hex</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Background</label>
                                    <div
                                        class="color-picker-wrapper d-flex align-items-center gap-2 p-1.5 border rounded-3 bg-white">
                                        <input type="color" id="backgroundColor"
                                            class="form-control form-control-color border-0 p-0 rounded-circle"
                                            style="width:24px; height:24px;">
                                        <span class="fs-7 text-muted fw-mono text-uppercase">Hex</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-custom mb-0">Global Rotation</label>
                                    <span class="badge bg-light text-dark fs-8 border rounded-1" id="rotVal">0°</span>
                                </div>
                                <input type="range" id="rotationRange" min="0" max="360" value="0"
                                    class="form-range custom-range"
                                    oninput="document.getElementById('rotVal').innerText = this.value + '°'">
                            </div>
                        </div>

                        <div class="right-panel-section border-top pt-3 mt-3">
                            <div class="section-title d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-bounding-box-circles text-primary"></i>
                                    <h6 class="mb-0 fw-bold fs-7 text-uppercase tracking-wider text-dark">Element
                                        Properties</h6>
                                </div>
                                <span class="badge bg-primary-soft text-primary rounded-pill px-2 fs-8">Active</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Inner Text Content</label>
                                <textarea id="propertyInnerText" rows="2" class="form-control custom-input border-0 py-2.5 placeholder-sm"
                                    placeholder="Type text content..."></textarea>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Width (W)</label>
                                    <div class="input-group input-group-sm custom-input-group">
                                        <input type="number" id="propertyWidth" class="form-control border-0">
                                        <span
                                            class="input-group-text bg-transparent border-0 text-muted px-2 fs-8">px</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Height (H)</label>
                                    <div class="input-group input-group-sm custom-input-group">
                                        <input type="number" id="propertyHeight" class="form-control border-0">
                                        <span
                                            class="input-group-text bg-transparent border-0 text-muted px-2 fs-8">px</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Font Size</label>
                                    <div class="input-group input-group-sm custom-input-group">
                                        <input type="number" id="propertyFontSize" class="form-control border-0">
                                        <span
                                            class="input-group-text bg-transparent border-0 text-muted px-2 fs-8">px</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Rotation</label>
                                    <div class="input-group input-group-sm custom-input-group">
                                        <input type="number" id="propertyRotate" class="form-control border-0">
                                        <span
                                            class="input-group-text bg-transparent border-0 text-muted px-2 fs-8">°</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-custom mb-0">Opacity</label>
                                    <span class="fs-8 text-muted fw-medium" id="opacVal">100%</span>
                                </div>
                                <input type="range" id="propertyOpacity" min="0" max="1" step="0.1"
                                    value="1" class="form-range custom-range"
                                    oninput="document.getElementById('opacVal').innerText = (this.value * 100) + '%'">
                            </div>

                            <div class="advanced-customization-box bg-light-soft p-12 rounded-3 border border-dashed mt-3">
                                <p
                                    class="text-xs fw-bold text-secondary mb-2 uppercase-tracking d-flex align-items-center gap-1">
                                    <i class="bi bi-gear-wide-connected text-primary"></i> Extended UI Controls
                                </p>
                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <label class="form-label-custom fs-8 text-muted">Border Radius</label>
                                        <input type="number" id="extendedBorderRadius"
                                            class="form-control form-control-sm border-0 custom-input" placeholder="0px">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label-custom fs-8 text-muted">Letter Spacing</label>
                                        <input type="number" id="extendedLetterSpacing"
                                            class="form-control form-control-sm border-0 custom-input" placeholder="0px">
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label-custom fs-8 text-muted">Text Alignment</label>
                                    <div class="btn-group w-100 bg-white p-0.5 border rounded-2" role="group">
                                        <button type="button" class="btn btn-sm text-muted bg-transparent border-0 py-1"
                                            id="alignTextLeft"><i class="bi bi-text-left"></i></button>
                                        <button type="button" class="btn btn-sm text-muted bg-transparent border-0 py-1"
                                            id="alignTextCenter"><i class="bi bi-text-center"></i></button>
                                        <button type="button" class="btn btn-sm text-muted bg-transparent border-0 py-1"
                                            id="alignTextRight"><i class="bi bi-text-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade p-3" id="tab-layers" role="tabpanel">

                        <div class="right-panel-section mb-4">
                            <h6
                                class="mb-3 fw-bold fs-7 text-uppercase tracking-wider text-muted d-flex align-items-center gap-2">
                                <i class="bi bi-sliders"></i> Control Panel
                            </h6>

                            <div class="d-flex gap-2 mb-3">
                                <button id="deleteLayerBtn"
                                    class="btn btn-light border hover-danger text-danger flex-fill py-2.5 rounded-3 d-flex align-items-center justify-content-center gap-2 fw-medium transition-all fs-7">
                                    <i class="bi bi-trash3"></i> Delete
                                </button>
                                <button id="duplicateLayerBtn"
                                    class="btn btn-light border text-secondary flex-fill py-2.5 rounded-3 d-flex align-items-center justify-content-center gap-2 fw-medium transition-all fs-7">
                                    <i class="bi bi-copy"></i> Duplicate
                                </button>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <button id="undoBtn"
                                        class="btn btn-outline-secondary w-100 py-2.5 rounded-3 d-flex align-items-center justify-content-center gap-2 fw-medium fs-7">
                                        <i class="bi bi-arrow-counterclockwise"></i> Undo
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button id="redoBtn"
                                        class="btn btn-outline-secondary w-100 py-2.5 rounded-3 d-flex align-items-center justify-content-center gap-2 fw-medium fs-7">
                                        <i class="bi bi-arrow-clockwise"></i> Redo
                                    </button>
                                </div>
                            </div>

                            <div class="row g-2">
                                <div class="col-6">
                                    <button id="bringFrontBtn"
                                        class="btn btn-dark w-100 py-2.5 rounded-3 d-flex align-items-center justify-content-center gap-2 fw-medium shadow-sm fs-7">
                                        <i class="bi bi-layers-half text-success"></i> Bring Front
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button id="sendBackBtn"
                                        class="btn btn-dark w-100 py-2.5 rounded-3 d-flex align-items-center justify-content-center gap-2 fw-medium shadow-sm fs-7">
                                        <i class="bi bi-layers text-warning"></i> Send Back
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="right-panel-section mb-4 border-top pt-3">
                            <h6
                                class="mb-3 fw-bold fs-7 text-uppercase tracking-wider text-muted d-flex align-items-center gap-2">
                                <i class="bi bi-stack"></i> Active Layers Tree
                            </h6>
                            <div class="layer-list-container rounded-3 border bg-light-soft p-1">
                                <ul id="layerList" class="list-group list-group-flush gap-1">
                                </ul>
                            </div>
                        </div>

                        <div class="right-panel-section border-top pt-3">
                            <h6
                                class="mb-3 fw-bold fs-7 text-uppercase tracking-wider text-muted d-flex align-items-center gap-2">
                                <i class="bi bi-cpu-fill text-secondary"></i> Advanced Smart Tools
                            </h6>

                            <button id="toggleGridBtn"
                                class="btn btn-tool-utility btn-light border w-100 mb-2 text-start d-flex align-items-center justify-content-between fs-7 py-2.5 px-3 rounded-3">
                                <span><i class="bi bi-grid-3x3 text-muted me-2"></i> Toggle Smart Grid</span>
                                <i class="bi bi-toggle-on text-primary fs-5"></i>
                            </button>

                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <button id="centerHorizontalBtn"
                                        class="btn btn-tool-utility btn-light border w-100 text-start d-flex align-items-center gap-2 fs-7 py-2.5 rounded-3">
                                        <i class="bi bi-align-center text-success"></i> Center Horiz.
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button id="centerVerticalBtn"
                                        class="btn btn-tool-utility btn-light border w-100 text-start d-flex align-items-center gap-2 fs-7 py-2.5 rounded-3">
                                        <i class="bi bi-align-middle text-success"></i> Center Vert.
                                    </button>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <button id="lockLayerBtn"
                                        class="btn btn-tool-utility btn-light border w-100 text-start d-flex align-items-center gap-2 fs-7 py-2.5 rounded-3">
                                        <i class="bi bi-lock text-warning"></i> Lock Element
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button id="hideLayerBtn"
                                        class="btn btn-tool-utility btn-light border w-100 text-start d-flex align-items-center gap-2 fs-7 py-2.5 rounded-3">
                                        <i class="bi bi-eye-slash text-secondary"></i> Hide Layer
                                    </button>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <button id="alignLeftBtn"
                                        class="btn btn-tool-utility btn-light border w-100 text-start d-flex align-items-center gap-2 fs-7 py-2.5 rounded-3">
                                        <i class="bi bi-text-left text-dark"></i> Align Left
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button id="alignTopBtn"
                                        class="btn btn-tool-utility btn-light border w-100 text-start d-flex align-items-center gap-2 fs-7 py-2.5 rounded-3">
                                        <i class="bi bi-align-top text-dark"></i> Align Top
                                    </button>
                                </div>
                            </div>

                            <div class="zoom-panel bg-dark rounded-3 p-3 text-white">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fs-8 text-uppercase tracking-wider opacity-70">Canvas Scale</span>
                                    <span class="badge bg-secondary text-white fw-mono" id="zoomDisplay">100%</span>
                                </div>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <button id="zoomIn"
                                            class="btn btn-sm btn-outline-light w-100 py-1.5 rounded-2 d-flex align-items-center justify-content-center gap-1">
                                            <i class="bi bi-zoom-in"></i> Zoom In
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button id="zoomOut"
                                            class="btn btn-sm btn-outline-light w-100 py-1.5 rounded-2 d-flex align-items-center justify-content-center gap-1">
                                            <i class="bi bi-zoom-out"></i> Zoom Out
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Base Global Theme Stylesheet Override */
        .premium-designer-theme {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            letter-spacing: -0.2px;
        }

        .designer-wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
            background: #f1f5f9;
        }

        /* 1. Left Control Panel Styling */
        .designer-left-panel {
            width: 280px;
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            padding: 20px 16px;
            overflow-y: auto;
            z-index: 10;
        }

        .header-icon-box {
            background: #eff6ff;
            padding: 6px 10px;
            border-radius: 8px;
        }

        .tracking-tight {
            letter-spacing: -0.5px;
        }

        .tracking-wider {
            letter-spacing: 0.5px;
            font-size: 0.75rem;
        }

        .fs-7 {
            font-size: 0.85rem !important;
        }

        .fs-8 {
            font-size: 0.75rem !important;
        }

        /* Left Side Tools Buttons Styling (Figma Neutral Flat Dark style) */
        .tool-btn {
            background: #ffffff !important;
            color: #334155 !important;
            border: 1px solid #e2e8f0 !important;
            padding: 11px 14px !important;
            border-radius: 10px !important;
            font-weight: 500 !important;
            font-size: 0.88rem !important;
            text-align: left !important;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
        }

        .tool-btn:hover {
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
            transform: translateY(-1px);
        }

        /* Dynamic Badges fields */
        .dynamic-field {
            background: #f8fafc !important;
            color: #475569 !important;
            border: 1px dashed #cbd5e1 !important;
            padding: 9px 12px !important;
            border-radius: 8px !important;
            font-size: 0.85rem !important;
            font-weight: 500 !important;
            transition: all 0.15s ease;
        }

        .dynamic-field:hover {
            background: #e0e7ff !important;
            border-color: #4f46e5 !important;
            color: #4f46e5 !important;
        }

        .bg-indigo-soft {
            background-color: #e0e7ff;
        }

        .text-indigo {
            color: #4f46e5;
        }

        /* 2. Center Panel Viewport Area Styles */
        .designer-center-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #f1f5f9;
            position: relative;
        }

        .designer-topbar {
            height: 64px;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 9;
        }

        .hover-bg-light:hover {
            background-color: #f8fafc;
            color: #0f172a !important;
        }

        /* Topbar Right Action Utilities Button Designs */
        .btn-action-preview {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .btn-action-preview:hover {
            background-color: #e2e8f0;
            color: #1e293b;
        }

        .btn-action-pdf {
            background-color: #fff1f2;
            color: #e11d48;
            border: 1px solid #ffe4e6;
        }

        .btn-action-pdf:hover {
            background-color: #ffe4e6;
        }

        .btn-action-save {
            background-color: #2563eb;
            color: #ffffff;
            border: none;
        }

        .btn-action-save:hover {
            background-color: #1d4ed8;
        }

        /* Canvas Wrapper & Artboard Element Layout */
        .canvas-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: auto;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 16px 16px;
        }

        .designer-canvas {
            width: 360px;
            height: 560px;
            background: #ffffff;
            position: relative;
            border-radius: 12px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.12), 0 0 1px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* 3. Right Property Configurations Sidebar Panel */
        .designer-right-panel {
            width: 340px;
            background: #ffffff;
            border-left: 1px solid #e2e8f0;
            overflow-y: auto;
            z-index: 10;
        }

        .designer-tabs .nav-link {
            color: #64748b;
            border: none;
            border-bottom: 2px solid transparent;
        }

        .designer-tabs .nav-link.active {
            color: #2563eb;
            border-bottom: 2px solid #2563eb;
            background: transparent;
        }

        .right-panel-section {
            padding-bottom: 4px;
        }

        /* Premium Minimalist Input Control Fields */
        .form-label-custom {
            font-size: 0.78rem;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 5px;
            display: block;
            text-uppercase: uppercase;
        }

        .custom-input,
        .custom-input-group {
            background-color: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            color: #0f172a !important;
            font-weight: 500;
        }

        .custom-input:focus,
        .custom-input-group:focus-within {
            border-color: #cbd5e1 !important;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.06) !important;
            background-color: #ffffff !important;
        }

        .custom-input-group input {
            background: transparent;
            font-size: 0.85rem;
            font-weight: 500;
            padding-left: 10px;
        }

        .custom-range::-webkit-slider-thumb {
            background: #2563eb;
        }

        .bg-light-soft {
            background-color: #f8fafc;
        }

        .bg-primary-soft {
            background-color: #eff6ff;
            color: #2563eb;
        }

        /* Utilities Control Grid Switch Layouts */
        .btn-tool-utility {
            background: #ffffff;
            color: #475569;
            transition: all 0.15s ease;
        }

        .btn-tool-utility:hover {
            background: #f8fafc;
            color: #0f172a;
            border-color: #cbd5e1 !important;
        }

        /* Control Panel utilities styles */
        .transition-all {
            transition: all 0.2s ease;
        }

        .hover-danger:hover {
            background-color: #fff1f2 !important;
            border-color: #fecdd3 !important;
        }

        /* Active Layer Selection Node Styling */
        .layer-list-container {
            max-height: 180px;
            overflow-y: auto;
        }

        #layerList .list-group-item {
            border: 1px solid transparent;
            border-radius: 6px;
            margin-bottom: 2px;
            font-size: 0.82rem;
            color: #475569;
            padding: 8px 12px;
            font-weight: 500;
        }

        #layerList .list-group-item.active {
            background-color: #eff6ff !important;
            color: #2563eb !important;
            border-color: #bfdbfe !important;
        }

        /* Base Component Interactive Canvas Drag Node Framework */
        .design-element {
            position: absolute;
            min-width: 40px;
            min-height: 25px;
            cursor: move;
            user-select: none;
            border: 1px dashed transparent;
            padding: 2px;
        }

        .design-element.active {
            border: 1px dashed #2563eb;
        }

        .resize-handle {
            width: 8px;
            height: 8px;
            background: #ffffff;
            border: 2px solid #2563eb;
            position: absolute;
            border-radius: 50%;
        }

        .resize-nw {
            left: -4px;
            top: -4px;
            cursor: nw-resize;
        }

        .resize-ne {
            right: -4px;
            top: -4px;
            cursor: ne-resize;
        }

        .resize-sw {
            left: -4px;
            bottom: -4px;
            cursor: sw-resize;
        }

        .resize-se {
            right: -4px;
            bottom: -4px;
            cursor: se-resize;
        }

        .rotate-handle {
            width: 10px;
            height: 10px;
            background: #ffffff;
            border: 2px solid #e11d48;
            border-radius: 50%;
            position: absolute;
            top: -22px;
            left: 50%;
            transform: translateX(-50%);
            cursor: grab;
        }

        .grid-enabled {
            background-image: linear-gradient(rgba(15, 23, 42, 0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(15, 23, 42, 0.05) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .multi-selected {
            outline: 2px solid #ef4444 !important;
            outline-offset: 2px;
        }

        .layer-locked {
            pointer-events: none;
            opacity: 0.6;
        }

        /* Context menus styling */
        #contextMenu {
            position: absolute;
            display: none;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 999999;
            padding: 4px;
        }
    </style>
@endpush



@push('script')
    <script>
        $(document).ready(function() {

            let currentCanvas = '#frontCanvas';

            let selectedElement = null;

            let dragActive = false;

            let resizeActive = false;

            let rotateActive = false;

            let selectedElements = [];

            let startX = 0;

            let startY = 0;

            let historyStack = [];

            let redoStack = [];

            let startWidth = 0;

            let startHeight = 0;

            let startRotation = 0;

            let gridEnabled = false;

            let elementCounter = 0;


            $('#frontSideBtn').click(function() {

                currentCanvas = '#frontCanvas';

                $('#backCanvas').addClass('d-none');

                $('#frontCanvas').removeClass('d-none');

                $(this).removeClass('btn-outline-primary').addClass('btn-primary');

                $('#backSideBtn').removeClass('btn-primary').addClass('btn-outline-primary');

            });

            $('#backSideBtn').click(function() {

                currentCanvas = '#backCanvas';

                $('#frontCanvas').addClass('d-none');

                $('#backCanvas').removeClass('d-none');

                $(this)
                    .removeClass('btn-outline-primary')
                    .addClass('btn-primary');

                $('#frontSideBtn')
                    .removeClass('btn-primary')
                    .addClass('btn-outline-primary');

            });

            function refreshLayers() {

                $('#layerList').html('');

                $('.design-element').each(function() {

                    let id = $(this).attr('id');

                    $('#layerList').append(`
                        <li class="list-group-item layer-item"
                            data-id="${id}">
                            ${id}
                        </li>
                    `);

                });

            }

            $(document).on(
                'click',
                '.design-element',
                function(e) {

                    e.stopPropagation();

                    $('.design-element')
                        .removeClass('active');

                    $(this)
                        .addClass('active');

                    selectedElement = $(this);

                }
            );

            $('.designer-canvas').click(function() {

                $('.design-element')
                    .removeClass('active');

                selectedElement = null;

            });

            $('.add-text-btn').click(function() {

                elementCounter++;

                let html = `
                        <div
                            id="element_${elementCounter}"
                            class="design-element"
                            style="
                                top:50px;
                                left:50px;
                            ">

                            New Text

                            <span class="resize-handle resize-nw"></span>
                            <span class="resize-handle resize-ne"></span>
                            <span class="resize-handle resize-sw"></span>
                            <span class="resize-handle resize-se"></span>

                            <span class="rotate-handle"></span>

                        </div>
                        `;

                $(currentCanvas).append(html);

                refreshLayers();

            });


            $('.dynamic-field').click(function() {

                elementCounter++;

                let value =
                    $(this).data('field');

                let html = `
                    <div
                        id="element_${elementCounter}"
                        class="design-element"
                        style="
                            top:80px;
                            left:80px;
                        ">

                        ${value}

                        <span class="resize-handle resize-nw"></span>
                        <span class="resize-handle resize-ne"></span>
                        <span class="resize-handle resize-sw"></span>
                        <span class="resize-handle resize-se"></span>

                        <span class="rotate-handle"></span>

                    </div>
                    `;

                $(currentCanvas)
                    .append(html);

                refreshLayers();

            });


            $(document).on(
                'mousedown',
                '.design-element',
                function(e) {

                    if (
                        $(e.target)
                        .hasClass('resize-handle')
                    ) {
                        return;
                    }

                    if (
                        $(e.target)
                        .hasClass('rotate-handle')
                    ) {
                        return;
                    }

                    selectedElement = $(this);

                    dragActive = true;

                    startX = e.pageX;

                    startY = e.pageY;

                });


            $(document).mousemove(function(e) {

                if (
                    !dragActive ||
                    !selectedElement
                ) {
                    return;
                }

                let dx =
                    e.pageX - startX;

                let dy =
                    e.pageY - startY;

                let x = parseInt(selectedElement.css('left')) + dx;
                let y = parseInt(selectedElement.css('top')) + dy;


                if (gridEnabled) {
                    x =
                        Math.round(x / 20) * 20;

                    y =
                        Math.round(y / 20) * 20;
                }

                selectedElement.css({

                    left: x + 'px',
                    top: y + 'px'

                });

                startX = e.pageX;
                startY = e.pageY;



                if (
                    rotateActive &&
                    selectedElement
                ) {

                    let box =
                        selectedElement[0]
                        .getBoundingClientRect();

                    let centerX =
                        box.left +
                        box.width / 2;

                    let centerY =
                        box.top +
                        box.height / 2;

                    let angle =
                        Math.atan2(
                            e.pageY - centerY,
                            e.pageX - centerX
                        ) *
                        (180 / Math.PI);

                    selectedElement.css({

                        transform: `rotate(${angle}deg)`

                    });

                }


                if (
                    rotateActive &&
                    selectedElement
                ) {

                    let box =
                        selectedElement[0]
                        .getBoundingClientRect();

                    let centerX =
                        box.left +
                        box.width / 2;

                    let centerY =
                        box.top +
                        box.height / 2;

                    let angle =
                        Math.atan2(
                            e.pageY - centerY,
                            e.pageX - centerX
                        ) *
                        (180 / Math.PI);

                    selectedElement.css({

                        transform: `rotate(${angle}deg)`

                    });

                }

            });



            $(document).mouseup(function() {

                dragActive = false;
                resizeActive = false;
                rotateActive = false;

            });


            $(document).on(
                'mousedown',
                '.resize-handle',
                function(e) {

                    e.stopPropagation();

                    resizeActive = true;

                    selectedElement =
                        $(this).parent();

                    startX = e.pageX;

                    startY = e.pageY;

                    startWidth =
                        selectedElement.outerWidth();

                    startHeight =
                        selectedElement.outerHeight();

                });




            $(document).on(
                'mousedown',
                '.rotate-handle',
                function(e) {

                    e.stopPropagation();

                    rotateActive = true;

                    selectedElement =
                        $(this).parent();

                });


            $(document).keydown(function(e) {

                if (
                    e.key === 'Delete' &&
                    selectedElement
                ) {

                    selectedElement.remove();

                    refreshLayers();

                    selectedElement = null;

                }

            });



            $(document).keydown(function(e) {

                if (!selectedElement) {
                    return;
                }

                let step = 1;

                let left =
                    parseInt(
                        selectedElement.css('left')
                    );

                let top =
                    parseInt(
                        selectedElement.css('top')
                    );

                switch (e.key) {

                    case 'ArrowLeft':

                        left -= step;

                        break;

                    case 'ArrowRight':

                        left += step;

                        break;

                    case 'ArrowUp':

                        top -= step;

                        break;

                    case 'ArrowDown':

                        top += step;

                        break;

                }

                selectedElement.css({

                    left: left,
                    top: top

                });

            });



            $(document).on('click', '.layer-item',
                function() {

                    let id =
                        $(this).data('id');

                    $('.design-element')
                        .removeClass('active');

                    $('#' + id)
                        .addClass('active');

                    selectedElement =
                        $('#' + id);

                });




        });
    </script>


    <script>
        $(function() {

            let activeElement = null;

            let designer = $('#designerCanvas');

            /* =====================================
               SELECT ELEMENT
            ===================================== */

            $(document).on('click', '.designer-item', function(e) {

                e.stopPropagation();

                $('.designer-item').removeClass('selected');

                $(this).addClass('selected');

                activeElement = $(this);

                loadProperties();

            });

            $(document).click(function() {

                $('.designer-item').removeClass('selected');

                activeElement = null;

            });

            /* =====================================
               DRAG SYSTEM
            ===================================== */

            let dragging = false;

            let offsetX = 0;
            let offsetY = 0;

            $(document).on('mousedown', '.designer-item', function(e) {

                activeElement = $(this);

                dragging = true;

                offsetX =
                    e.pageX -
                    activeElement.position().left;

                offsetY =
                    e.pageY -
                    activeElement.position().top;

            });

            $(document).mousemove(function(e) {

                if (!dragging || !activeElement) {
                    return;
                }

                let parentOffset =
                    designer.offset();

                let x =
                    e.pageX -
                    parentOffset.left -
                    offsetX;

                let y =
                    e.pageY -
                    parentOffset.top -
                    offsetY;

                activeElement.css({
                    left: x,
                    top: y
                });

            });

            $(document).mouseup(function() {

                dragging = false;

            });

            /* =====================================
               RESIZE
            ===================================== */

            let resizing = false;

            let startWidth;
            let startHeight;
            let startX;
            let startY;

            $(document).on(
                'mousedown',
                '.resize-handle',
                function(e) {

                    e.stopPropagation();

                    activeElement =
                        $(this).parent();

                    resizing = true;

                    startWidth =
                        activeElement.width();

                    startHeight =
                        activeElement.height();

                    startX = e.pageX;
                    startY = e.pageY;

                }
            );

            $(document).mousemove(function(e) {

                if (!resizing || !activeElement) {
                    return;
                }

                let width =
                    startWidth +
                    (e.pageX - startX);

                let height =
                    startHeight +
                    (e.pageY - startY);

                activeElement.css({
                    width: width,
                    height: height
                });

            });

            $(document).mouseup(function() {

                resizing = false;

            });

            /* =====================================
               ROTATE
            ===================================== */

            $('#rotateRange').on(
                'input',
                function() {

                    if (!activeElement) {
                        return;
                    }

                    activeElement.css(
                        'transform',
                        'rotate(' +
                        $(this).val() +
                        'deg)'
                    );

                }
            );

            /* =====================================
               FONT SIZE
            ===================================== */

            $('#fontSize').on(
                'input',
                function() {

                    if (!activeElement) {
                        return;
                    }

                    activeElement.css(
                        'font-size',
                        $(this).val() + 'px'
                    );

                }
            );

            /* =====================================
               FONT COLOR
            ===================================== */

            $('#fontColor').change(function() {

                if (!activeElement) {
                    return;
                }

                activeElement.css(
                    'color',
                    $(this).val()
                );

            });

            /* =====================================
               FONT FAMILY
            ===================================== */

            $('#fontFamily').change(function() {

                if (!activeElement) {
                    return;
                }

                activeElement.css(
                    'font-family',
                    $(this).val()
                );

            });

            /* =====================================
               FONT WEIGHT
            ===================================== */

            $('#fontWeight').change(function() {

                if (!activeElement) {
                    return;
                }

                activeElement.css(
                    'font-weight',
                    $(this).val()
                );

            });

            /* =====================================
               TEXT ALIGN
            ===================================== */

            $('#textAlign').change(function() {

                if (!activeElement) {
                    return;
                }

                activeElement.css(
                    'text-align',
                    $(this).val()
                );

            });

            /* =====================================
               OPACITY
            ===================================== */

            $('#opacityRange').on(
                'input',
                function() {

                    if (!activeElement) {
                        return;
                    }

                    activeElement.css(
                        'opacity',
                        $(this).val() / 100
                    );

                }
            );

            /* =====================================
               Z INDEX
            ===================================== */

            $('#bringFront').click(function() {

                if (!activeElement) {
                    return;
                }

                let z =
                    parseInt(
                        activeElement.css('z-index')
                    ) || 1;

                activeElement.css(
                    'z-index',
                    z + 1
                );

            });

            $('#sendBack').click(function() {

                if (!activeElement) {
                    return;
                }

                let z =
                    parseInt(
                        activeElement.css('z-index')
                    ) || 1;

                activeElement.css(
                    'z-index',
                    z - 1
                );

            });

            /* =====================================
               DUPLICATE
            ===================================== */

            $('#duplicateElement').click(function() {

                if (!activeElement) {
                    return;
                }

                let clone =
                    activeElement.clone();

                clone.removeClass(
                    'selected'
                );

                clone.css({
                    top: parseInt(
                        activeElement.css('top')
                    ) + 20,

                    left: parseInt(
                        activeElement.css('left')
                    ) + 20
                });

                designer.append(clone);

            });

            /* =====================================
               DELETE
            ===================================== */

            $('#deleteElement').click(function() {

                if (!activeElement) {
                    return;
                }

                activeElement.remove();

                activeElement = null;

            });

            /* =====================================
               LOAD PROPERTIES
            ===================================== */

            function loadProperties() {

                if (!activeElement) {
                    return;
                }

                $('#fontSize').val(
                    parseInt(
                        activeElement.css('font-size')
                    )
                );

                $('#fontColor').val(
                    rgb2hex(
                        activeElement.css('color')
                    )
                );

            }

            /* =====================================
               RGB TO HEX
            ===================================== */

            function rgb2hex(rgb) {

                if (!rgb) {
                    return '#000000';
                }

                let result =
                    rgb.match(/\d+/g);

                if (!result) {
                    return '#000000';
                }

                return "#" +
                    (
                        (1 << 24) +
                        (parseInt(result[0]) << 16) +
                        (parseInt(result[1]) << 8) +
                        parseInt(result[2])
                    )
                    .toString(16)
                    .slice(1);

            }

        });
    </script>



    {{-- part 5  --}}

    <script>
        /* ======================================
                                                                                                                                                                                                                           LAYER SYSTEM
                                                                                                                                                                                                                        ====================================== */

        function refreshLayerPanel() {
            let html = '';

            $('.draggable-element').each(function() {

                let id = $(this).attr('id');

                html += `
                <li
                    class="list-group-item layer-item"
                    data-id="${id}">
                    ${id}
                </li>
        `;

            });

            $('#layerList').html(html);
        }

        refreshLayerPanel();


        $(document).on(
            'click',
            '.layer-item',
            function() {

                let id =
                    $(this).data('id');

                $('.draggable-element')
                    .removeClass('active-layer');

                $('#' + id)
                    .addClass('active-layer');

                selectedElement =
                    $('#' + id);

                loadProperties();

            }
        );


        function loadProperties() {
            if (!selectedElement) {
                return;
            }

            $('#propertyFontSize')
                .val(
                    parseInt(
                        selectedElement.css('font-size')
                    )
                );

            $('#propertyWidth')
                .val(
                    parseInt(
                        selectedElement.width()
                    )
                );

            $('#propertyHeight')
                .val(
                    parseInt(
                        selectedElement.height()
                    )
                );

            $('#propertyOpacity')
                .val(
                    selectedElement.css('opacity')
                );
        }

        $('#propertyFontSize').on(
            'keyup change',
            function() {

                if (!selectedElement) {
                    return;
                }

                selectedElement.css({
                    fontSize: $(this).val() + 'px'
                });

            }
        );


        $('#propertyWidth').on(
            'keyup change',
            function() {

                if (!selectedElement) {
                    return;
                }

                selectedElement.width(
                    $(this).val()
                );

            }
        );

        $('#propertyHeight').on(
            'keyup change',
            function() {

                if (!selectedElement) {
                    return;
                }

                selectedElement.height(
                    $(this).val()
                );

            }
        );

        $('#propertyOpacity').on(
            'input',
            function() {

                if (!selectedElement) {
                    return;
                }

                selectedElement.css({
                    opacity: $(this).val()
                });

            }
        );

        $('#propertyRotate').on(
            'keyup change',
            function() {

                if (!selectedElement) {
                    return;
                }

                selectedElement.css({
                    transform: 'rotate(' +
                        $(this).val() +
                        'deg)'
                });

            }
        );

        $('#deleteLayerBtn').click(function() {

            if (!selectedElement) {
                return;
            }

            selectedElement.remove();

            selectedElement = null;

            refreshLayerPanel();

        });

        $('#duplicateLayerBtn').click(function() {

            if (!selectedElement) {
                return;
            }

            let clone =
                selectedElement.clone();

            let randomId =
                'layer_' +
                Date.now();

            clone.attr(
                'id',
                randomId
            );

            clone.css({
                left: parseInt(
                    selectedElement.css('left')
                ) + 20,

                top: parseInt(
                    selectedElement.css('top')
                ) + 20
            });

            selectedElement
                .parent()
                .append(clone);

            refreshLayerPanel();

        });
        $('#bringFrontBtn').click(function() {

            if (!selectedElement) {
                return;
            }

            let maxZ = 1;

            $('.draggable-element').each(function() {

                let z =
                    parseInt(
                        $(this).css('z-index')
                    ) || 1;

                if (z > maxZ) {
                    maxZ = z;
                }

            });

            selectedElement.css({
                zIndex: maxZ + 1
            });

        });


        $('#sendBackBtn').click(function() {

            if (!selectedElement) {
                return;
            }

            selectedElement.css({
                zIndex: 1
            });

        });


        function saveHistory() {
            historyStack.push(
                $('#designerFrontCard').html()
            );

            if (historyStack.length > 50) {
                historyStack.shift();
            }
        }

        $(document).on(
            'mouseup',
            '.draggable-element',
            function() {

                saveHistory();

            }
        );


        $('#undoBtn').click(function() {

            if (
                historyStack.length <= 1
            ) {
                return;
            }

            let current =
                historyStack.pop();

            redoStack.push(current);

            let previous =
                historyStack[
                    historyStack.length - 1
                ];

            $('#designerFrontCard')
                .html(previous);

        });

        $('#redoBtn').click(function() {

            if (
                redoStack.length === 0
            ) {
                return;
            }

            let state =
                redoStack.pop();

            historyStack.push(state);

            $('#designerFrontCard')
                .html(state);

        });



        let selectedElements = [];

        $('#toggleGridBtn').click(function() {

            gridEnabled = !gridEnabled;

            $('.designer-card')
                .toggleClass(
                    'grid-enabled'
                );

        });

        $(document).on(
            'click',
            '.draggable-element',
            function(e) {

                if (e.ctrlKey) {
                    $(this)
                        .toggleClass(
                            'multi-selected'
                        );

                    let id =
                        $(this).attr('id');

                    if (
                        selectedElements.includes(id)
                    ) {
                        selectedElements =
                            selectedElements.filter(
                                x => x !== id
                            );
                    } else {
                        selectedElements.push(id);
                    }

                    if (
                        selectedElements.length > 1
                    ) {

                        selectedElements.forEach(function(id) {

                            $('#' + id).css({

                                left: x + 'px',
                                top: y + 'px'

                            });

                        });

                    }
                    showGuides(selectedElement);
                    autoAlignCheck();
                    return;
                }

            }
        );



        $('#lockLayerBtn').click(function() {

            if (!selectedElement) {
                return;
            }

            selectedElement
                .toggleClass(
                    'layer-locked'
                );

        });

        $('#hideLayerBtn').click(function() {

            if (!selectedElement) {
                return;
            }

            selectedElement.toggle();

        });

        $('#centerHorizontalBtn')
            .click(function() {

                if (!selectedElement) {
                    return;
                }

                let parent =
                    selectedElement.parent();

                let x =
                    (
                        parent.width() -
                        selectedElement.outerWidth()
                    ) / 2;

                selectedElement.css({
                    left: x
                });

            });

        $('#centerVerticalBtn')
            .click(function() {

                if (!selectedElement) {
                    return;
                }

                let parent =
                    selectedElement.parent();

                let y =
                    (
                        parent.height() -
                        selectedElement.outerHeight()
                    ) / 2;

                selectedElement.css({
                    top: y
                });

            });

        $('#alignLeftBtn').click(function() {

            if (
                selectedElements.length < 2
            ) {
                return;
            }

            let first =
                $('#' + selectedElements[0]);

            let left =
                first.position().left;

            selectedElements.forEach(function(id) {

                $('#' + id).css({
                    left: left
                });

            });

        });

        $('#alignTopBtn').click(function() {

            if (
                selectedElements.length < 2
            ) {
                return;
            }

            let first =
                $('#' + selectedElements[0]);

            let top =
                first.position().top;

            selectedElements.forEach(function(id) {

                $('#' + id).css({
                    top: top
                });

            });

        });


        function createHorizontalRuler() {
            let html = '';

            for (let i = 0; i < 5000; i += 10) {
                html += `
                <span
                    style="
                    position:absolute;
                    left:${i}px;
                    font-size:9px;">
                    ${i}
                </span>`;
            }

            $('#horizontalRuler').html(html);
        }

        createHorizontalRuler();


        function createVerticalRuler() {
            let html = '';

            for (let i = 0; i < 5000; i += 20) {
                html += `
                <div
                style="
                position:absolute;
                top:${i}px;
                font-size:8px;">
                ${i}
                </div>`;
            }

            $('#verticalRuler').html(html);
        }

        createVerticalRuler();


        function showGuides(element) {
            let canvasWidth =
                $('#designerCanvas').width();

            let canvasHeight =
                $('#designerCanvas').height();

            let left =
                element.position().left;

            let top =
                element.position().top;

            let centerX =
                canvasWidth / 2;

            let centerY =
                canvasHeight / 2;

            if (Math.abs(left - centerX) < 5) {
                $('#guideX')
                    .css('left', centerX)
                    .show();
            } else {
                $('#guideX').hide();
            }

            if (Math.abs(top - centerY) < 5) {
                $('#guideY')
                    .css('top', centerY)
                    .show();
            } else {
                $('#guideY').hide();
            }
        }

        $(document).keydown(function(e) {

            if (!selectedElement) {
                return;
            }

            let step = 1;

            if (e.shiftKey) {
                step = 10;
            }

            let left =
                parseInt(selectedElement.css('left'));

            let top =
                parseInt(selectedElement.css('top'));

            if (e.key === "ArrowLeft") {
                selectedElement.css(
                    'left',
                    left - step
                );
            }

            if (e.key === "ArrowRight") {
                selectedElement.css(
                    'left',
                    left + step
                );
            }

            if (e.key === "ArrowUp") {
                selectedElement.css(
                    'top',
                    top - step
                );
            }

            if (e.key === "ArrowDown") {
                selectedElement.css(
                    'top',
                    top + step
                );
            }

        });

        function refreshLayers() {
            let html = '';

            $('.draggable-element').each(function() {

                let id = $(this).attr('id');

                html += `
        <li
        data-layer="${id}">
            ${id}
        </li>`;
            });

            $('#layerTree').html(html);
        }

        refreshLayers();

        $(document).on(
            'click',
            '#layerTree li',
            function() {

                let id =
                    $(this).data('layer');

                $('.draggable-element')
                    .removeClass('active-layer');

                $('#' + id)
                    .addClass('active-layer');

                selectedElement =
                    $('#' + id);

            });

        let contextTarget = null;

        $(document).on(
            'contextmenu',
            '.draggable-element',
            function(e) {

                e.preventDefault();

                contextTarget = $(this);

                $('#contextMenu')
                    .css({
                        top: e.pageY,
                        left: e.pageX
                    })
                    .show();
            });

        let copiedHtml = '';

        $('.copyLayer').click(function() {

            copiedHtml =
                contextTarget.prop('outerHTML');

        });

        $(document).keydown(function(e) {

            if (e.ctrlKey && e.key === 'c') {
                copiedHtml =
                    selectedElement.prop('outerHTML');
            }

        });
        $(document).keydown(function(e) {

            if (e.ctrlKey && e.key === 'v') {
                $('#designerCanvas')
                    .append(copiedHtml);
            }

        });

        let zoom = 1;

        $('#zoomIn').click(function() {

            zoom += 0.1;

            $('#designerCanvas').css(
                'transform',
                `scale(${zoom})`
            );

        });

        $('#zoomOut').click(function() {

            zoom -= 0.1;

            $('#designerCanvas').css(
                'transform',
                `scale(${zoom})`
            );

        });

        function updateMiniMap() {
            let cw =
                $('#designerCanvas').width();

            let ch =
                $('#designerCanvas').height();

            $('#miniViewport').css({

                width: cw / 10,
                height: ch / 10

            });
        }

        updateMiniMap();

        function autoAlignCheck() {
            let center =
                $('#designerCanvas').width() / 2;

            $('.draggable-element').each(function() {

                let left =
                    $(this).position().left;

                if (Math.abs(left - center) < 3) {
                    $(this).css(
                        'outline',
                        '2px solid green'
                    );
                }

            });
        }
    </script>
@endpush










@push('script')
    <script>
        $(document).ready(function() {

            let currentCanvas = '#frontCanvas';

            let selectedElement = null;

            let dragActive = false;

            let resizeActive = false;

            let rotateActive = false;

            let selectedElements = [];

            let startX = 0;

            let startY = 0;

            let historyStack = [];

            let redoStack = [];

            let startWidth = 0;

            let startHeight = 0;

            let startRotation = 0;

            let gridEnabled = false;

            let elementCounter = 0;


            $('#frontSideBtn').click(function() {

                currentCanvas = '#frontCanvas';

                $('#backCanvas').addClass('d-none');

                $('#frontCanvas').removeClass('d-none');

                $(this).removeClass('btn-outline-primary').addClass('btn-primary');

                $('#backSideBtn').removeClass('btn-primary').addClass('btn-outline-primary');

            });

            $('#backSideBtn').click(function() {

                currentCanvas = '#backCanvas';

                $('#frontCanvas').addClass('d-none');

                $('#backCanvas').removeClass('d-none');

                $(this)
                    .removeClass('btn-outline-primary')
                    .addClass('btn-primary');

                $('#frontSideBtn')
                    .removeClass('btn-primary')
                    .addClass('btn-outline-primary');

            });

            function refreshLayers() {

                $('#layerList').html('');

                $('.design-element').each(function() {

                    let id = $(this).attr('id');

                    $('#layerList').append(`
                        <li class="list-group-item layer-item"
                            data-id="${id}">
                            ${id}
                        </li>
                    `);

                });

            }

            $(document).on(
                'click',
                '.design-element',
                function(e) {

                    e.stopPropagation();

                    $('.design-element')
                        .removeClass('active');

                    $(this)
                        .addClass('active');

                    selectedElement = $(this);

                }
            );

            $('.designer-canvas').click(function() {

                $('.design-element')
                    .removeClass('active');

                selectedElement = null;

            });

            $('.add-text-btn').click(function() {

                elementCounter++;

                let html = `
                        <div
                            id="element_${elementCounter}"
                            class="design-element"
                            style="
                                top:50px;
                                left:50px;
                            ">

                            New Text

                            <span class="resize-handle resize-nw"></span>
                            <span class="resize-handle resize-ne"></span>
                            <span class="resize-handle resize-sw"></span>
                            <span class="resize-handle resize-se"></span>

                            <span class="rotate-handle"></span>

                        </div>
                        `;

                $(currentCanvas).append(html);

                refreshLayers();

            });


            $('.dynamic-field').click(function() {

                elementCounter++;

                let value =
                    $(this).data('field');

                let html = `
                    <div
                        id="element_${elementCounter}"
                        class="design-element"
                        style="
                            top:80px;
                            left:80px;
                        ">

                        ${value}

                        <span class="resize-handle resize-nw"></span>
                        <span class="resize-handle resize-ne"></span>
                        <span class="resize-handle resize-sw"></span>
                        <span class="resize-handle resize-se"></span>

                        <span class="rotate-handle"></span>

                    </div>
                    `;

                $(currentCanvas)
                    .append(html);

                refreshLayers();

            });


            $(document).on(
                'mousedown',
                '.design-element',
                function(e) {

                    if (
                        $(e.target)
                        .hasClass('resize-handle')
                    ) {
                        return;
                    }

                    if (
                        $(e.target)
                        .hasClass('rotate-handle')
                    ) {
                        return;
                    }

                    selectedElement = $(this);

                    dragActive = true;

                    startX = e.pageX;

                    startY = e.pageY;

                });


            $(document).mousemove(function(e) {

                if (
                    !dragActive ||
                    !selectedElement
                ) {
                    return;
                }

                let dx =
                    e.pageX - startX;

                let dy =
                    e.pageY - startY;

                let x = parseInt(selectedElement.css('left')) + dx;
                let y = parseInt(selectedElement.css('top')) + dy;


                if (gridEnabled) {
                    x =
                        Math.round(x / 20) * 20;

                    y =
                        Math.round(y / 20) * 20;
                }

                selectedElement.css({

                    left: x + 'px',
                    top: y + 'px'

                });

                startX = e.pageX;
                startY = e.pageY;



                if (
                    rotateActive &&
                    selectedElement
                ) {

                    let box =
                        selectedElement[0]
                        .getBoundingClientRect();

                    let centerX =
                        box.left +
                        box.width / 2;

                    let centerY =
                        box.top +
                        box.height / 2;

                    let angle =
                        Math.atan2(
                            e.pageY - centerY,
                            e.pageX - centerX
                        ) *
                        (180 / Math.PI);

                    selectedElement.css({

                        transform: `rotate(${angle}deg)`

                    });

                }


                if (
                    rotateActive &&
                    selectedElement
                ) {

                    let box =
                        selectedElement[0]
                        .getBoundingClientRect();

                    let centerX =
                        box.left +
                        box.width / 2;

                    let centerY =
                        box.top +
                        box.height / 2;

                    let angle =
                        Math.atan2(
                            e.pageY - centerY,
                            e.pageX - centerX
                        ) *
                        (180 / Math.PI);

                    selectedElement.css({

                        transform: `rotate(${angle}deg)`

                    });

                }

            });



            $(document).mouseup(function() {

                dragActive = false;
                resizeActive = false;
                rotateActive = false;

            });


            $(document).on(
                'mousedown',
                '.resize-handle',
                function(e) {

                    e.stopPropagation();

                    resizeActive = true;

                    selectedElement =
                        $(this).parent();

                    startX = e.pageX;

                    startY = e.pageY;

                    startWidth =
                        selectedElement.outerWidth();

                    startHeight =
                        selectedElement.outerHeight();

                });




            $(document).on(
                'mousedown',
                '.rotate-handle',
                function(e) {

                    e.stopPropagation();

                    rotateActive = true;

                    selectedElement =
                        $(this).parent();

                });


            $(document).keydown(function(e) {

                if (
                    e.key === 'Delete' &&
                    selectedElement
                ) {

                    selectedElement.remove();

                    refreshLayers();

                    selectedElement = null;

                }

            });



            $(document).keydown(function(e) {

                if (!selectedElement) {
                    return;
                }

                let step = 1;

                let left =
                    parseInt(
                        selectedElement.css('left')
                    );

                let top =
                    parseInt(
                        selectedElement.css('top')
                    );

                switch (e.key) {

                    case 'ArrowLeft':

                        left -= step;

                        break;

                    case 'ArrowRight':

                        left += step;

                        break;

                    case 'ArrowUp':

                        top -= step;

                        break;

                    case 'ArrowDown':

                        top += step;

                        break;

                }

                selectedElement.css({

                    left: left,
                    top: top

                });

            });



            $(document).on('click', '.layer-item',
                function() {

                    let id =
                        $(this).data('id');

                    $('.design-element')
                        .removeClass('active');

                    $('#' + id)
                        .addClass('active');

                    selectedElement =
                        $('#' + id);

                });




        });
    </script>


    <script>
        $(function() {

            let activeElement = null;

            let designer = $('#designerCanvas');

            /* =====================================
               SELECT ELEMENT
            ===================================== */

            $(document).on('click', '.designer-item', function(e) {

                e.stopPropagation();

                $('.designer-item').removeClass('selected');

                $(this).addClass('selected');

                activeElement = $(this);

                loadProperties();

            });

            $(document).click(function() {

                $('.designer-item').removeClass('selected');

                activeElement = null;

            });

            /* =====================================
               DRAG SYSTEM
            ===================================== */

            let dragging = false;

            let offsetX = 0;
            let offsetY = 0;

            $(document).on('mousedown', '.designer-item', function(e) {

                activeElement = $(this);

                dragging = true;

                offsetX =
                    e.pageX -
                    activeElement.position().left;

                offsetY =
                    e.pageY -
                    activeElement.position().top;

            });

            $(document).mousemove(function(e) {

                if (!dragging || !activeElement) {
                    return;
                }

                let parentOffset =
                    designer.offset();

                let x =
                    e.pageX -
                    parentOffset.left -
                    offsetX;

                let y =
                    e.pageY -
                    parentOffset.top -
                    offsetY;

                activeElement.css({
                    left: x,
                    top: y
                });

            });

            $(document).mouseup(function() {

                dragging = false;

            });

            /* =====================================
               RESIZE
            ===================================== */

            let resizing = false;

            let startWidth;
            let startHeight;
            let startX;
            let startY;

            $(document).on(
                'mousedown',
                '.resize-handle',
                function(e) {

                    e.stopPropagation();

                    activeElement =
                        $(this).parent();

                    resizing = true;

                    startWidth =
                        activeElement.width();

                    startHeight =
                        activeElement.height();

                    startX = e.pageX;
                    startY = e.pageY;

                }
            );

            $(document).mousemove(function(e) {

                if (!resizing || !activeElement) {
                    return;
                }

                let width =
                    startWidth +
                    (e.pageX - startX);

                let height =
                    startHeight +
                    (e.pageY - startY);

                activeElement.css({
                    width: width,
                    height: height
                });

            });

            $(document).mouseup(function() {

                resizing = false;

            });

            /* =====================================
               ROTATE
            ===================================== */

            $('#rotateRange').on(
                'input',
                function() {

                    if (!activeElement) {
                        return;
                    }

                    activeElement.css(
                        'transform',
                        'rotate(' +
                        $(this).val() +
                        'deg)'
                    );

                }
            );

            /* =====================================
               FONT SIZE
            ===================================== */

            $('#fontSize').on(
                'input',
                function() {

                    if (!activeElement) {
                        return;
                    }

                    activeElement.css(
                        'font-size',
                        $(this).val() + 'px'
                    );

                }
            );

            /* =====================================
               FONT COLOR
            ===================================== */

            $('#fontColor').change(function() {

                if (!activeElement) {
                    return;
                }

                activeElement.css(
                    'color',
                    $(this).val()
                );

            });

            /* =====================================
               FONT FAMILY
            ===================================== */

            $('#fontFamily').change(function() {

                if (!activeElement) {
                    return;
                }

                activeElement.css(
                    'font-family',
                    $(this).val()
                );

            });

            /* =====================================
               FONT WEIGHT
            ===================================== */

            $('#fontWeight').change(function() {

                if (!activeElement) {
                    return;
                }

                activeElement.css(
                    'font-weight',
                    $(this).val()
                );

            });

            /* =====================================
               TEXT ALIGN
            ===================================== */

            $('#textAlign').change(function() {

                if (!activeElement) {
                    return;
                }

                activeElement.css(
                    'text-align',
                    $(this).val()
                );

            });

            /* =====================================
               OPACITY
            ===================================== */

            $('#opacityRange').on(
                'input',
                function() {

                    if (!activeElement) {
                        return;
                    }

                    activeElement.css(
                        'opacity',
                        $(this).val() / 100
                    );

                }
            );

            /* =====================================
               Z INDEX
            ===================================== */

            $('#bringFront').click(function() {

                if (!activeElement) {
                    return;
                }

                let z =
                    parseInt(
                        activeElement.css('z-index')
                    ) || 1;

                activeElement.css(
                    'z-index',
                    z + 1
                );

            });

            $('#sendBack').click(function() {

                if (!activeElement) {
                    return;
                }

                let z =
                    parseInt(
                        activeElement.css('z-index')
                    ) || 1;

                activeElement.css(
                    'z-index',
                    z - 1
                );

            });

            /* =====================================
               DUPLICATE
            ===================================== */

            $('#duplicateElement').click(function() {

                if (!activeElement) {
                    return;
                }

                let clone =
                    activeElement.clone();

                clone.removeClass(
                    'selected'
                );

                clone.css({
                    top: parseInt(
                        activeElement.css('top')
                    ) + 20,

                    left: parseInt(
                        activeElement.css('left')
                    ) + 20
                });

                designer.append(clone);

            });

            /* =====================================
               DELETE
            ===================================== */

            $('#deleteElement').click(function() {

                if (!activeElement) {
                    return;
                }

                activeElement.remove();

                activeElement = null;

            });

            /* =====================================
               LOAD PROPERTIES
            ===================================== */

            function loadProperties() {

                if (!activeElement) {
                    return;
                }

                $('#fontSize').val(
                    parseInt(
                        activeElement.css('font-size')
                    )
                );

                $('#fontColor').val(
                    rgb2hex(
                        activeElement.css('color')
                    )
                );

            }

            /* =====================================
               RGB TO HEX
            ===================================== */

            function rgb2hex(rgb) {

                if (!rgb) {
                    return '#000000';
                }

                let result =
                    rgb.match(/\d+/g);

                if (!result) {
                    return '#000000';
                }

                return "#" +
                    (
                        (1 << 24) +
                        (parseInt(result[0]) << 16) +
                        (parseInt(result[1]) << 8) +
                        parseInt(result[2])
                    )
                    .toString(16)
                    .slice(1);

            }

        });
    </script>



    {{-- part 5  --}}

    <script>
        /* ======================================
                                                                                                                                                                                                                       LAYER SYSTEM
                                                                                                                                                                                                                    ====================================== */

        function refreshLayerPanel() {
            let html = '';

            $('.draggable-element').each(function() {

                let id = $(this).attr('id');

                html += `
                <li
                    class="list-group-item layer-item"
                    data-id="${id}">
                    ${id}
                </li>
        `;

            });

            $('#layerList').html(html);
        }

        refreshLayerPanel();


        $(document).on(
            'click',
            '.layer-item',
            function() {

                let id =
                    $(this).data('id');

                $('.draggable-element')
                    .removeClass('active-layer');

                $('#' + id)
                    .addClass('active-layer');

                selectedElement =
                    $('#' + id);

                loadProperties();

            }
        );


        function loadProperties() {
            if (!selectedElement) {
                return;
            }

            $('#propertyFontSize')
                .val(
                    parseInt(
                        selectedElement.css('font-size')
                    )
                );

            $('#propertyWidth')
                .val(
                    parseInt(
                        selectedElement.width()
                    )
                );

            $('#propertyHeight')
                .val(
                    parseInt(
                        selectedElement.height()
                    )
                );

            $('#propertyOpacity')
                .val(
                    selectedElement.css('opacity')
                );
        }

        $('#propertyFontSize').on(
            'keyup change',
            function() {

                if (!selectedElement) {
                    return;
                }

                selectedElement.css({
                    fontSize: $(this).val() + 'px'
                });

            }
        );


        $('#propertyWidth').on(
            'keyup change',
            function() {

                if (!selectedElement) {
                    return;
                }

                selectedElement.width(
                    $(this).val()
                );

            }
        );

        $('#propertyHeight').on(
            'keyup change',
            function() {

                if (!selectedElement) {
                    return;
                }

                selectedElement.height(
                    $(this).val()
                );

            }
        );

        $('#propertyOpacity').on(
            'input',
            function() {

                if (!selectedElement) {
                    return;
                }

                selectedElement.css({
                    opacity: $(this).val()
                });

            }
        );

        $('#propertyRotate').on(
            'keyup change',
            function() {

                if (!selectedElement) {
                    return;
                }

                selectedElement.css({
                    transform: 'rotate(' +
                        $(this).val() +
                        'deg)'
                });

            }
        );

        $('#deleteLayerBtn').click(function() {

            if (!selectedElement) {
                return;
            }

            selectedElement.remove();

            selectedElement = null;

            refreshLayerPanel();

        });

        $('#duplicateLayerBtn').click(function() {

            if (!selectedElement) {
                return;
            }

            let clone =
                selectedElement.clone();

            let randomId =
                'layer_' +
                Date.now();

            clone.attr(
                'id',
                randomId
            );

            clone.css({
                left: parseInt(
                    selectedElement.css('left')
                ) + 20,

                top: parseInt(
                    selectedElement.css('top')
                ) + 20
            });

            selectedElement
                .parent()
                .append(clone);

            refreshLayerPanel();

        });
        $('#bringFrontBtn').click(function() {

            if (!selectedElement) {
                return;
            }

            let maxZ = 1;

            $('.draggable-element').each(function() {

                let z =
                    parseInt(
                        $(this).css('z-index')
                    ) || 1;

                if (z > maxZ) {
                    maxZ = z;
                }

            });

            selectedElement.css({
                zIndex: maxZ + 1
            });

        });


        $('#sendBackBtn').click(function() {

            if (!selectedElement) {
                return;
            }

            selectedElement.css({
                zIndex: 1
            });

        });


        function saveHistory() {
            historyStack.push(
                $('#designerFrontCard').html()
            );

            if (historyStack.length > 50) {
                historyStack.shift();
            }
        }

        $(document).on(
            'mouseup',
            '.draggable-element',
            function() {

                saveHistory();

            }
        );


        $('#undoBtn').click(function() {

            if (
                historyStack.length <= 1
            ) {
                return;
            }

            let current =
                historyStack.pop();

            redoStack.push(current);

            let previous =
                historyStack[
                    historyStack.length - 1
                ];

            $('#designerFrontCard')
                .html(previous);

        });

        $('#redoBtn').click(function() {

            if (
                redoStack.length === 0
            ) {
                return;
            }

            let state =
                redoStack.pop();

            historyStack.push(state);

            $('#designerFrontCard')
                .html(state);

        });



        let selectedElements = [];

        $('#toggleGridBtn').click(function() {

            gridEnabled = !gridEnabled;

            $('.designer-card')
                .toggleClass(
                    'grid-enabled'
                );

        });

        $(document).on(
            'click',
            '.draggable-element',
            function(e) {

                if (e.ctrlKey) {
                    $(this)
                        .toggleClass(
                            'multi-selected'
                        );

                    let id =
                        $(this).attr('id');

                    if (
                        selectedElements.includes(id)
                    ) {
                        selectedElements =
                            selectedElements.filter(
                                x => x !== id
                            );
                    } else {
                        selectedElements.push(id);
                    }

                    if (
                        selectedElements.length > 1
                    ) {

                        selectedElements.forEach(function(id) {

                            $('#' + id).css({

                                left: x + 'px',
                                top: y + 'px'

                            });

                        });

                    }
                    showGuides(selectedElement);
                    autoAlignCheck();
                    return;
                }

            }
        );



        $('#lockLayerBtn').click(function() {

            if (!selectedElement) {
                return;
            }

            selectedElement
                .toggleClass(
                    'layer-locked'
                );

        });

        $('#hideLayerBtn').click(function() {

            if (!selectedElement) {
                return;
            }

            selectedElement.toggle();

        });

        $('#centerHorizontalBtn')
            .click(function() {

                if (!selectedElement) {
                    return;
                }

                let parent =
                    selectedElement.parent();

                let x =
                    (
                        parent.width() -
                        selectedElement.outerWidth()
                    ) / 2;

                selectedElement.css({
                    left: x
                });

            });

        $('#centerVerticalBtn')
            .click(function() {

                if (!selectedElement) {
                    return;
                }

                let parent =
                    selectedElement.parent();

                let y =
                    (
                        parent.height() -
                        selectedElement.outerHeight()
                    ) / 2;

                selectedElement.css({
                    top: y
                });

            });

        $('#alignLeftBtn').click(function() {

            if (
                selectedElements.length < 2
            ) {
                return;
            }

            let first =
                $('#' + selectedElements[0]);

            let left =
                first.position().left;

            selectedElements.forEach(function(id) {

                $('#' + id).css({
                    left: left
                });

            });

        });

        $('#alignTopBtn').click(function() {

            if (
                selectedElements.length < 2
            ) {
                return;
            }

            let first =
                $('#' + selectedElements[0]);

            let top =
                first.position().top;

            selectedElements.forEach(function(id) {

                $('#' + id).css({
                    top: top
                });

            });

        });


        function createHorizontalRuler() {
            let html = '';

            for (let i = 0; i < 5000; i += 10) {
                html += `
                <span
                    style="
                    position:absolute;
                    left:${i}px;
                    font-size:9px;">
                    ${i}
                </span>`;
            }

            $('#horizontalRuler').html(html);
        }

        createHorizontalRuler();


        function createVerticalRuler() {
            let html = '';

            for (let i = 0; i < 5000; i += 20) {
                html += `
                <div
                style="
                position:absolute;
                top:${i}px;
                font-size:8px;">
                ${i}
                </div>`;
            }

            $('#verticalRuler').html(html);
        }

        createVerticalRuler();


        function showGuides(element) {
            let canvasWidth =
                $('#designerCanvas').width();

            let canvasHeight =
                $('#designerCanvas').height();

            let left =
                element.position().left;

            let top =
                element.position().top;

            let centerX =
                canvasWidth / 2;

            let centerY =
                canvasHeight / 2;

            if (Math.abs(left - centerX) < 5) {
                $('#guideX')
                    .css('left', centerX)
                    .show();
            } else {
                $('#guideX').hide();
            }

            if (Math.abs(top - centerY) < 5) {
                $('#guideY')
                    .css('top', centerY)
                    .show();
            } else {
                $('#guideY').hide();
            }
        }

        $(document).keydown(function(e) {

            if (!selectedElement) {
                return;
            }

            let step = 1;

            if (e.shiftKey) {
                step = 10;
            }

            let left =
                parseInt(selectedElement.css('left'));

            let top =
                parseInt(selectedElement.css('top'));

            if (e.key === "ArrowLeft") {
                selectedElement.css(
                    'left',
                    left - step
                );
            }

            if (e.key === "ArrowRight") {
                selectedElement.css(
                    'left',
                    left + step
                );
            }

            if (e.key === "ArrowUp") {
                selectedElement.css(
                    'top',
                    top - step
                );
            }

            if (e.key === "ArrowDown") {
                selectedElement.css(
                    'top',
                    top + step
                );
            }

        });

        function refreshLayers() {
            let html = '';

            $('.draggable-element').each(function() {

                let id = $(this).attr('id');

                html += `
        <li
        data-layer="${id}">
            ${id}
        </li>`;
            });

            $('#layerTree').html(html);
        }

        refreshLayers();

        $(document).on(
            'click',
            '#layerTree li',
            function() {

                let id =
                    $(this).data('layer');

                $('.draggable-element')
                    .removeClass('active-layer');

                $('#' + id)
                    .addClass('active-layer');

                selectedElement =
                    $('#' + id);

            });

        let contextTarget = null;

        $(document).on(
            'contextmenu',
            '.draggable-element',
            function(e) {

                e.preventDefault();

                contextTarget = $(this);

                $('#contextMenu')
                    .css({
                        top: e.pageY,
                        left: e.pageX
                    })
                    .show();
            });

        let copiedHtml = '';

        $('.copyLayer').click(function() {

            copiedHtml =
                contextTarget.prop('outerHTML');

        });

        $(document).keydown(function(e) {

            if (e.ctrlKey && e.key === 'c') {
                copiedHtml =
                    selectedElement.prop('outerHTML');
            }

        });
        $(document).keydown(function(e) {

            if (e.ctrlKey && e.key === 'v') {
                $('#designerCanvas')
                    .append(copiedHtml);
            }

        });

        let zoom = 1;

        $('#zoomIn').click(function() {

            zoom += 0.1;

            $('#designerCanvas').css(
                'transform',
                `scale(${zoom})`
            );

        });

        $('#zoomOut').click(function() {

            zoom -= 0.1;

            $('#designerCanvas').css(
                'transform',
                `scale(${zoom})`
            );

        });

        function updateMiniMap() {
            let cw =
                $('#designerCanvas').width();

            let ch =
                $('#designerCanvas').height();

            $('#miniViewport').css({

                width: cw / 10,
                height: ch / 10

            });
        }

        updateMiniMap();

        function autoAlignCheck() {
            let center =
                $('#designerCanvas').width() / 2;

            $('.draggable-element').each(function() {

                let left =
                    $(this).position().left;

                if (Math.abs(left - center) < 3) {
                    $(this).css(
                        'outline',
                        '2px solid green'
                    );
                }

            });
        }
    </script>
@endpush









@push('script')
    <script>
        $(document).ready(function() {
            // ==========================================
            // CORE DESIGNER STATE CONFIGURATIONS
            // ==========================================
            let currentCanvas = '#frontCanvas';
            let selectedElement = null;
            let selectedElements = []; // For Multi-Selection feature

            // Drag, Resize & Rotate tracking states
            let dragActive = false;
            let resizeActive = false;
            let rotateActive = false;

            // Coordinate offsets
            let startX = 0, startY = 0;
            let startWidth = 0, startHeight = 0;
            let startRotation = 0;
            
            let gridEnabled = false;
            let elementCounter = 0;
            let currentZoom = 1;

            // Undo / Redo Global Arrays
            let historyStack = [];
            let redoStack = [];

            // Initialize App state history snapshot
            saveHistory();

            // ==========================================
            // CANVAS TOGGLE MODULE (FRONT / BACK SIDE)
            // ==========================================
            $('#frontSideBtn').click(function() {
                currentCanvas = '#frontCanvas';
                $('#backCanvas').addClass('d-none');
                $('#frontCanvas').removeClass('d-none');
                $(this).removeClass('text-secondary hover-bg-light').addClass('btn-primary shadow-sm');
                $('#backSideBtn').removeClass('btn-primary shadow-sm').addClass('text-secondary hover-bg-light');
                clearSelection();
            });

            $('#backSideBtn').click(function() {
                currentCanvas = '#backCanvas';
                $('#frontCanvas').addClass('d-none');
                $('#backCanvas').removeClass('d-none');
                $(this).removeClass('text-secondary hover-bg-light').addClass('btn-primary shadow-sm');
                $('#frontSideBtn').removeClass('btn-primary shadow-sm').addClass('text-secondary hover-bg-light');
                clearSelection();
            });

            // ==========================================
            // LAYER MANAGEMENT SYSTEM
            // ==========================================
            function refreshLayers() {
                let html = '';
                $('.design-element').each(function() {
                    let id = $(this).attr('id');
                    let text = $(this).text().replace(/[\n\t]/g, '').trim();
                    if(text.length > 20) text = text.substring(0, 18) + '...';
                    let activeClass = (selectedElement && selectedElement.attr('id') === id) ? 'active' : '';
                    
                    html += `
                        <li class="list-group-item layer-item ${activeClass}" data-id="${id}">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <span><i class="bi bi-layers text-muted me-2"></i> ${text || id}</span>
                                <small class="text-xs text-muted">#${id.split('_')[1]}</small>
                            </div>
                        </li>`;
                });
                $('#layerList').html(html);
            }

            // Layer Node click sync
            $(document).on('click', '.layer-item', function(e) {
                e.stopPropagation();
                let id = $(this).data('id');
                let target = $('#' + id);
                if (target.length) {
                    $('.design-element').removeClass('active');
                    target.addClass('active');
                    selectedElement = target;
                    loadProperties();
                    refreshLayers();
                }
            });

            // ==========================================
            // ELEMENT GENERATORS (TEXT & DYNAMIC FIELDS)
            // ==========================================
            function getBaseElementHtml(id, content) {
                return `
                    <div id="${id}" class="design-element" style="top: 80px; left: 80px; font-size: 16px; font-family: Arial; position: absolute; min-width: 100px; padding: 6px;">
                        <span class="element-content-wrapper">${content}</span>
                        <span class="resize-handle resize-nw"></span>
                        <span class="resize-handle resize-ne"></span>
                        <span class="resize-handle resize-sw"></span>
                        <span class="resize-handle resize-se"></span>
                        <span class="rotate-handle"></span>
                    </div>`;
            }

            $('.add-text-btn').click(function() {
                elementCounter++;
                let uniqueId = 'element_' + Date.now() + '_' + elementCounter;
                $(currentCanvas).append(getBaseElementHtml(uniqueId, 'New Text Element'));
                setActiveElement($('#' + uniqueId));
                saveHistory();
            });

            $('.dynamic-field').click(function() {
                elementCounter++;
                let value = $(this).data('field');
                let uniqueId = 'element_' + Date.now() + '_' + elementCounter;
                $(currentCanvas).append(getBaseElementHtml(uniqueId, value));
                setActiveElement($('#' + uniqueId));
                saveHistory();
            });

            // ==========================================
            // SELECTION ENGINE
            // ==========================================
            $(document).on('mousedown', '.design-element', function(e) {
                if ($(e.target).hasClass('resize-handle') || $(e.target).hasClass('rotate-handle')) return;
                if ($(this).hasClass('layer-locked')) return;

                e.stopPropagation();
                
                // Multi-selection feature matching via Command / Ctrl Key
                if (e.ctrlKey || e.metaKey) {
                    let id = $(this).attr('id');
                    $(this).toggleClass('multi-selected');
                    if (selectedElements.includes(id)) {
                        selectedElements = selectedElements.filter(x => x !== id);
                    } else {
                        selectedElements.push(id);
                    }
                    return;
                }

                setActiveElement($(this));

                dragActive = true;
                startX = e.pageX;
                startY = e.pageY;
            });

            // Canvas Click Unselect handler
            $('.designer-canvas').click(function(e) {
                if(e.target === this) {
                    clearSelection();
                }
            });

            function setActiveElement(element) {
                $('.design-element').removeClass('active multi-selected');
                selectedElements = [];
                selectedElement = element;
                selectedElement.addClass('active');
                loadProperties();
                refreshLayers();
            }

            function clearSelection() {
                $('.design-element').removeClass('active multi-selected');
                selectedElement = null;
                selectedElements = [];
                refreshLayers();
            }

            // ==========================================
            // INTERMEDIATE DRAG, RESIZE & ROTATE RUNTIME
            // ==========================================
            $(document).on('mousedown', '.resize-handle', function(e) {
                e.stopPropagation();
                resizeActive = true;
                selectedElement = $(this).parent();
                startX = e.pageX;
                startY = e.pageY;
                startWidth = selectedElement.outerWidth();
                startHeight = selectedElement.outerHeight();
            });

            $(document).on('mousedown', '.rotate-handle', function(e) {
                e.stopPropagation();
                rotateActive = true;
                selectedElement = $(this).parent();
                
                let matrix = selectedElement.css('transform');
                if (matrix !== 'none') {
                    let values = matrix.split('(')[1].split(')')[0].split(',');
                    let a = values[0];
                    let b = values[1];
                    startRotation = Math.round(Math.atan2(b, a) * (180 / Math.PI));
                } else {
                    startRotation = 0;
                }
            });

            $(document).mousemove(function(e) {
                if (!selectedElement) return;

                // 1. DRAG ACTION TRACKING
                if (dragActive) {
                    let dx = (e.pageX - startX) / currentZoom;
                    let dy = (e.pageY - startY) / currentZoom;

                    let x = parseInt(selectedElement.css('left')) || 0;
                    let y = parseInt(selectedElement.css('top')) || 0;

                    let newX = x + dx;
                    let newY = y + dy;

                    if (gridEnabled) {
                        newX = Math.round(newX / 20) * 20;
                        newY = Math.round(newY / 20) * 20;
                    }

                    selectedElement.css({ left: newX + 'px', top: newY + 'px' });
                    startX = e.pageX;
                    startY = e.pageY;
                }

                // 2. RESIZE ACTION TRACKING
                if (resizeActive) {
                    let dx = (e.pageX - startX) / currentZoom;
                    let dy = (e.pageY - startY) / currentZoom;
                    
                    let w = startWidth + dx;
                    let h = startHeight + dy;

                    if (w > 20) selectedElement.css('width', w + 'px');
                    if (h > 15) selectedElement.css('height', h + 'px');
                    
                    $('#propertyWidth').val(Math.round(w));
                    $('#propertyHeight').val(Math.round(h));
                }

                // 3. ROTATE ACTION TRACKING
                if (rotateActive) {
                    let box = selectedElement[0].getBoundingClientRect();
                    let centerX = box.left + box.width / 2;
                    let centerY = box.top + box.height / 2;

                    let angle = Math.atan2(e.pageY - centerY, e.pageX - centerX) * (180 / Math.PI);
                    angle = (angle + 90) % 360; // Normalize angle alignment coordinate offset

                    selectedElement.css('transform', `rotate(${Math.round(angle)}deg)`);
                    $('#propertyRotate').val(Math.round(angle));
                }
            });

            $(document).mouseup(function() {
                if (dragActive || resizeActive || rotateActive) {
                    saveHistory();
                }
                dragActive = false;
                resizeActive = false;
                rotateActive = false;
            });

            // ==========================================
            // NATIVE KEYBOARD CONTROLS (NUDGE & DELETE)
            // ==========================================
            $(document).keydown(function(e) {
                if (!selectedElement || $('input, textarea, select').is(':focus')) return;

                if (e.key === 'Delete' || e.key === 'Backspace') {
                    selectedElement.remove();
                    clearSelection();
                    saveHistory();
                    return;
                }

                let step = e.shiftKey ? 10 : 1; // Nudge factor allocation
                let left = parseInt(selectedElement.css('left')) || 0;
                let top = parseInt(selectedElement.css('top')) || 0;

                if (['ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown'].includes(e.key)) {
                    e.preventDefault();
                    if (e.key === 'ArrowLeft') left -= step;
                    if (e.key === 'ArrowRight') left += step;
                    if (e.key === 'ArrowUp') top -= step;
                    if (e.key === 'ArrowDown') top += step;

                    selectedElement.css({ left: left + 'px', top: top + 'px' });
                    saveHistory();
                }
            });

            // ==========================================
            // PROPERTIES DATA SYNC ENGINE
            // ==========================================
            function loadProperties() {
                if (!selectedElement) return;

                // Sync left global panel configurations
                let fSize = parseInt(selectedElement.css('font-size')) || 16;
                $('#fontSize, #propertyFontSize').val(fSize);
                
                let fFamily = selectedElement.css('font-family').replace(/['"]/g, '');
                $('#fontFamily').val(fFamily.split(',')[0]);
                
                let fWeight = selectedElement.css('font-weight') || '400';
                $('#fontWeight').val(fWeight);

                $('#textColor').val(rgb2hex(selectedElement.css('color')));
                $('#backgroundColor').val(rgb2hex(selectedElement.css('background-color')));
                
                // Elements dimensions specs sync
                $('#propertyWidth').val(Math.round(selectedElement.outerWidth()));
                $('#propertyHeight').val(Math.round(selectedElement.outerHeight()));
                
                let textNode = selectedElement.find('.element-content-wrapper').text() || selectedElement.text();
                $('#propertyInnerText').val(textNode.trim());
                
                let opac = selectedElement.css('opacity') || 1;
                $('#propertyOpacity').val(opac);
                $('#opacVal').text((opac * 100) + '%');

                // Advanced controls sync (Border radius & alignment)
                $('#extendedBorderRadius').val(parseInt(selectedElement.css('border-radius')) || 0);
                $('#extendedLetterSpacing').val(parseInt(selectedElement.css('letter-spacing')) || 0);

                // Extraction logic for rotation matrix
                let matrix = selectedElement.css('transform');
                let angle = 0;
                if (matrix !== 'none') {
                    let values = matrix.split('(')[1].split(')')[0].split(',');
                    angle = Math.round(Math.atan2(values[1], values[0]) * (180 / Math.PI));
                    if(angle < 0) angle += 360;
                }
                $('#propertyRotate, #rotationRange').val(angle);
                $('#rotVal').text(angle + '°');
            }

            // Sync dynamic value modifications
            $('#propertyFontSize, #fontSize').on('input change', function() {
                if (selectedElement) { selectedElement.css('font-size', $(this).val() + 'px'); }
            });

            $('#fontFamily').change(function() {
                if (selectedElement) { selectedElement.css('font-family', $(this).val()); }
            });

            $('#fontWeight').change(function() {
                if (selectedElement) { selectedElement.css('font-weight', $(this).val()); }
            });

            $('#textColor').on('input change', function() {
                if (selectedElement) { selectedElement.css('color', $(this).val()); }
            });

            $('#backgroundColor').on('input change', function() {
                if (selectedElement) { selectedElement.css('background-color', $(this).val()); }
            });

            $('#rotationRange').on('input change', function() {
                let deg = $(this).val();
                if (selectedElement) { selectedElement.css('transform', `rotate(${deg}deg)`); $('#propertyRotate').val(deg); }
            });

            $('#propertyInnerText').on('input', function() {
                if (selectedElement) {
                    let wrapper = selectedElement.find('.element-content-wrapper');
                    if(wrapper.length) { wrapper.text($(this).val()); } else { selectedElement.text($(this).val()); }
                    refreshLayers();
                }
            });

            $('#propertyWidth').on('input change', function() {
                if (selectedElement) { selectedElement.css('width', $(this).val() + 'px'); }
            });

            $('#propertyHeight').on('input change', function() {
                if (selectedElement) { selectedElement.css('height', $(this).val() + 'px'); }
            });

            $('#propertyOpacity').on('input change', function() {
                if (selectedElement) { selectedElement.css('opacity', $(this).val()); }
            });

            $('#propertyRotate').on('input change', function() {
                if (selectedElement) { selectedElement.css('transform', `rotate(${$(this).val()}deg)`); $('#rotationRange').val($(this).val()); }
            });

            // Extended Properties logic handlers
            $('#extendedBorderRadius').on('input change', function() {
                if (selectedElement) { selectedElement.css('border-radius', $(this).val() + 'px'); }
            });

            $('#extendedLetterSpacing').on('input change', function() {
                if (selectedElement) { selectedElement.css('letter-spacing', $(this).val() + 'px'); }
            });

            $('#alignTextLeft').click(function() { if(selectedElement) selectedElement.css('text-align', 'left'); });
            $('#alignTextCenter').click(function() { if(selectedElement) selectedElement.css('text-align', 'center'); });
            $('#alignTextRight').click(function() { if(selectedElement) selectedElement.css('text-align', 'right'); });

            // ==========================================
            // LAYER CONTROLS ENGINE (DUPLICATE/DELETE/ORDER)
            // ==========================================
            $('#deleteLayerBtn').click(function() {
                if (!selectedElement) return;
                selectedElement.remove();
                clearSelection();
                saveHistory();
            });

            $('#duplicateLayerBtn').click(function() {
                if (!selectedElement) return;
                let clone = selectedElement.clone();
                let randomId = 'element_' + Date.now();
                clone.attr('id', randomId).removeClass('active multi-selected');
                
                let targetLeft = (parseInt(selectedElement.css('left')) || 0) + 20;
                let targetTop = (parseInt(selectedElement.css('top')) || 0) + 20;
                clone.css({ left: targetLeft + 'px', top: targetTop + 'px' });
                
                $(currentCanvas).append(clone);
                setActiveElement($('#' + randomId));
                saveHistory();
            });

            $('#bringFrontBtn').click(function() {
                if (!selectedElement) return;
                let maxZ = 0;
                $('.design-element').each(function() {
                    let z = parseInt($(this).css('z-index')) || 0;
                    if (z > maxZ) maxZ = z;
                });
                selectedElement.css('z-index', maxZ + 1);
                saveHistory();
            });

            $('#sendBackBtn').click(function() {
                if (!selectedElement) return;
                let minZ = 0;
                $('.design-element').each(function() {
                    let z = parseInt($(this).css('z-index')) || 0;
                    if (z < minZ) minZ = z;
                });
                selectedElement.css('z-index', minZ - 1);
                saveHistory();
            });

            // ==========================================
            // UNDO / REDO STATE MANAGEMENT
            // ==========================================
            function saveHistory() {
                // Snapshot the state composition structure
                let stateSnapshot = {
                    front: $('#frontCanvas').html(),
                    back: $('#backCanvas').html(),
                    counter: elementCounter
                };
                historyStack.push(JSON.stringify(stateSnapshot));
                if (historyStack.length > 40) historyStack.shift();
                redoStack = []; // Reset operations buffer map tracking
            }

            $('#undoBtn').click(function() {
                if (historyStack.length <= 1) return;
                let current = historyStack.pop();
                redoStack.push(current);

                let previousState = JSON.parse(historyStack[historyStack.length - 1]);
                $('#frontCanvas').html(previousState.front);
                $('#backCanvas').html(previousState.back);
                elementCounter = previousState.counter;
                clearSelection();
            });

            $('#redoBtn').click(function() {
                if (redoStack.length === 0) return;
                let next = redoStack.pop();
                historyStack.push(next);

                let nextState = JSON.parse(next);
                $('#frontCanvas').html(nextState.front);
                $('#backCanvas').html(nextState.back);
                elementCounter = nextState.counter;
                clearSelection();
            });

            // ==========================================
            // ADVANCED UTILITIES & CANVAS SNAP CONTROLS
            // ==========================================
            $('#toggleGridBtn').click(function() {
                gridEnabled = !gridEnabled;
                $('#frontCanvas, #backCanvas').toggleClass('grid-enabled');
                $(this).find('i').toggleClass('bi-toggle-on bi-toggle-off text-primary text-muted');
            });

            $('#lockLayerBtn').click(function() {
                if (!selectedElement) return;
                selectedElement.toggleClass('layer-locked');
                clearSelection();
            });

            $('#hideLayerBtn').click(function() {
                if (!selectedElement) return;
                selectedElement.fadeOut(150);
                clearSelection();
            });

            $('#centerHorizontalBtn').click(function() {
                if (!selectedElement) return;
                let parentWidth = selectedElement.parent().width();
                let elementWidth = selectedElement.outerWidth();
                selectedElement.css('left', ((parentWidth - elementWidth) / 2) + 'px');
                saveHistory();
            });

            $('#centerVerticalBtn').click(function() {
                if (!selectedElement) return;
                let parentHeight = selectedElement.parent().height();
                let elementHeight = selectedElement.outerHeight();
                selectedElement.css('top', ((parentHeight - elementHeight) / 2) + 'px');
                saveHistory();
            });

            // Multi-align executions
            $('#alignLeftBtn').click(function() {
                if (selectedElements.length < 2) return;
                let masterLeft = $('#' + selectedElements[0]).css('left');
                selectedElements.forEach(id => $('#' + id).css('left', masterLeft));
                saveHistory();
            });

            $('#alignTopBtn').click(function() {
                if (selectedElements.length < 2) return;
                let masterTop = $('#' + selectedElements[0]).css('top');
                selectedElements.forEach(id => $('#' + id).css('top', masterTop));
                saveHistory();
            });

            // ==========================================
            // ZOOM LEVEL CONTROLLER
            // ==========================================
            $('#zoomIn').click(function() {
                if(currentZoom < 2) {
                    currentZoom += 0.1;
                    applyZoom();
                }
            });

            $('#zoomOut').click(function() {
                if(currentZoom > 0.5) {
                    currentZoom -= 0.1;
                    applyZoom();
                }
            });

            function applyZoom() {
                let displayPercent = Math.round(currentZoom * 100) + '%';
                $('#zoomDisplay').text(displayPercent);
                $('#frontCanvas, #backCanvas').css('transform', `scale(${currentZoom})`);
            }

            // Helpers: Convert RGB color values from browser style engine to Hex strings
            function rgb2hex(rgb) {
                if (!rgb || rgb === 'transparent' || rgb.indexOf('rgba(0, 0, 0, 0)') > -1) return '#ffffff';
                let matches = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
                if (!matches) return '#ffffff';
                function hex(x) { return ("0" + parseInt(x).toString(16)).slice(-2); }
                return "#" + hex(matches[1]) + hex(matches[2]) + hex(matches[3]);
            }
        });
    </script>
@endpush
