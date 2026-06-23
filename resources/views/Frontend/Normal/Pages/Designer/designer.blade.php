{{-- @extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Professional Card Designer Engine')

@section('dynamic-content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;600;700&family=Roboto:wght@400;700&family=Georgia&display=swap" rel="stylesheet">
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
                        <span class="badge bg-indigo-soft text-indigo rounded-pill px-2 py-1">ERP Data</span>
                    </div>

                    <div class="dynamic-fields-grid d-flex flex-column gap-2">
                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between" data-field="{Name}">
                            <span><i class="bi bi-person me-2 text-muted"></i> Name</span> <i class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>
                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between" data-field="{AdmissionNo}">
                            <span><i class="bi bi-hash me-2 text-muted"></i> Admission No</span> <i class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>
                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between" data-field="{Class}">
                            <span><i class="bi bi-journal-bookmark me-2 text-muted"></i> Class</span> <i class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>
                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between" data-field="{Section}">
                            <span><i class="bi bi-grid-3x3-gap me-2 text-muted"></i> Section</span> <i class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>
                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between" data-field="{Mobile}">
                            <span><i class="bi bi-telephone me-2 text-muted"></i> Mobile</span> <i class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>
                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between" data-field="{Photo}">
                            <span><i class="bi bi-image me-2 text-muted"></i> Photo</span> <i class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>
                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between" data-field="{QRCode}">
                            <span><i class="bi bi-qr-code-scan me-2 text-muted"></i> QR Code</span> <i class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
                        </button>
                        <button class="dynamic-field btn text-start d-flex align-items-center justify-content-between" data-field="{Barcode}">
                            <span><i class="bi bi-upc me-2 text-muted"></i> Barcode</span> <i class="bi bi-plus-short text-muted opacity-50 fs-5"></i>
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
                            <i class="bi bi-eye me-1"></i> Live Preview
                        </button>
                        <button id="downloadPdfBtn" class="btn btn-action-pdf btn-sm px-3 fw-medium rounded-3">
                            <i class="bi bi-printer me-1"></i> Print / PDF
                        </button>
                        <div class="vr mx-1 opacity-25"></div>
                        <button id="saveTemplateBtn" class="btn btn-action-save btn-sm px-4 fw-medium rounded-3 shadow-sm">
                            <i class="bi bi-cloud-arrow-up-fill me-1"></i> Save Card Template
                        </button>
                    </div>
                </div>

                <div class="canvas-wrapper py-5">
                    <div class="canvas-container-scalable" id="canvasScaleTarget" style="transform: scale(1); transform-origin: center center; transition: transform 0.1s ease;">
                        <div id="frontCanvas" class="designer-canvas grid-enabled"></div>
                        <div id="backCanvas" class="designer-canvas grid-enabled d-none"></div>
                    </div>
                </div>
            </div>

            <div class="designer-right-panel shadow-sm p-0">
                <ul class="nav nav-tabs designer-tabs border-bottom px-3 pt-2" id="panelTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-medium px-3 py-2 fs-7" id="design-tab" data-bs-toggle="tab" data-bs-target="#tab-design" type="button" role="tab">Styles & Properties</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-medium px-3 py-2 fs-7" id="layers-tab" data-bs-toggle="tab" data-bs-target="#tab-layers" type="button" role="tab">Layers Tree</button>
                    </li>
                </ul>

                <div class="tab-content" id="panelTabContent">
                    <div class="tab-pane fade show active p-3" id="tab-design" role="tabpanel">
                        
                        <div class="right-panel-section mb-4">
                            <div class="section-title d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-sliders2 text-muted"></i>
                                <h6 class="mb-0 fw-bold fs-7 text-uppercase tracking-wider text-muted">Canvas Global Styles</h6>
                            </div>
                            <div class="mb-3">
                                <label class="form-label-custom">Canvas Background Color</label>
                                <div class="color-picker-wrapper d-flex align-items-center gap-2 p-1.5 border rounded-3 bg-white">
                                    <input type="color" id="canvasBgColor" class="form-control form-control-color border-0 p-0 rounded-circle" style="width:24px; height:24px;" value="#ffffff">
                                    <span class="fs-7 text-muted fw-mono text-uppercase">HEX COLOR</span>
                                </div>
                            </div>
                        </div>

                        <div class="right-panel-section border-top pt-3 mt-3">
                            <div class="section-title d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-bounding-box-circles text-primary"></i>
                                    <h6 class="mb-0 fw-bold fs-7 text-uppercase tracking-wider text-dark">Element Inspector</h6>
                                </div>
                                <span class="badge bg-primary-soft text-primary rounded-pill px-2 fs-8" id="activeElementBadge">None Selected</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Text Content / Value</label>
                                <textarea id="propertyInnerText" rows="2" class="form-control custom-input border-0 py-2 placeholder-sm" placeholder="Select an element to edit text..."></textarea>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Width (W)</label>
                                    <div class="input-group input-group-sm custom-input-group">
                                        <input type="number" id="propertyWidth" class="form-control border-0">
                                        <span class="input-group-text bg-transparent border-0 text-muted px-2 fs-8">px</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Height (H)</label>
                                    <div class="input-group input-group-sm custom-input-group">
                                        <input type="number" id="propertyHeight" class="form-control border-0">
                                        <span class="input-group-text bg-transparent border-0 text-muted px-2 fs-8">px</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Font Size</label>
                                    <div class="input-group input-group-sm custom-input-group">
                                        <input type="number" id="propertyFontSize" class="form-control border-0" value="14">
                                        <span class="input-group-text bg-transparent border-0 text-muted px-2 fs-8">px</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Font Family</label>
                                    <select id="propertyFontFamily" class="form-select form-select-sm custom-input border-0">
                                        <option value="Arial">Arial</option>
                                        <option value="Poppins">Poppins</option>
                                        <option value="Roboto">Roboto</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Inter">Inter</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Font Weight</label>
                                    <select id="propertyFontWeight" class="form-select form-select-sm custom-input border-0">
                                        <option value="400">Normal</option>
                                        <option value="600">Semi Bold</option>
                                        <option value="700">Bold</option>
                                        <option value="800">Extra Bold</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Rotation</label>
                                    <div class="input-group input-group-sm custom-input-group">
                                        <input type="number" id="propertyRotate" class="form-control border-0" value="0">
                                        <span class="input-group-text bg-transparent border-0 text-muted px-2 fs-8">°</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Text Color</label>
                                    <div class="color-picker-wrapper d-flex align-items-center gap-2 p-1 border rounded-3 bg-white">
                                        <input type="color" id="propertyTextColor" class="form-control form-control-color border-0 p-0 rounded-circle" style="width:24px; height:24px;" value="#000000">
                                        <span class="fs-8 text-muted fw-mono">HEX</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Fill Color</label>
                                    <div class="color-picker-wrapper d-flex align-items-center gap-2 p-1 border rounded-3 bg-white">
                                        <input type="color" id="propertyBgColor" class="form-control form-control-color border-0 p-0 rounded-circle" style="width:24px; height:24px;" value="#transparent">
                                        <span class="fs-8 text-muted fw-mono">HEX</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-custom mb-0">Opacity</label>
                                    <span class="fs-8 text-muted fw-medium" id="opacVal">100%</span>
                                </div>
                                <input type="range" id="propertyOpacity" min="0" max="1" step="0.1" value="1" class="form-range custom-range">
                            </div>

                            <div class="advanced-customization-box bg-light-soft p-3 rounded-3 border border-dashed mt-3">
                                <p class="text-xs fw-bold text-secondary mb-2 uppercase-tracking d-flex align-items-center gap-1" style="font-size:0.8rem;">
                                    <i class="bi bi-gear-wide-connected text-primary"></i> Extended UI Controls
                                </p>
                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <label class="form-label-custom fs-8 text-muted">Border Radius</label>
                                        <input type="number" id="extendedBorderRadius" class="form-control form-control-sm border-0 custom-input" placeholder="0px" value="0">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label-custom fs-8 text-muted">Letter Spacing</label>
                                        <input type="number" id="extendedLetterSpacing" class="form-control form-control-sm border-0 custom-input" placeholder="0px" value="0">
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label-custom fs-8 text-muted">Text Alignment</label>
                                    <div class="btn-group w-100 bg-white p-1 border rounded-2" role="group">
                                        <button type="button" class="btn btn-sm text-muted bg-transparent border-0 py-1" id="alignTextLeft"><i class="bi bi-text-left"></i></button>
                                        <button type="button" class="btn btn-sm text-muted bg-transparent border-0 py-1" id="alignTextCenter"><i class="bi bi-text-center"></i></button>
                                        <button type="button" class="btn btn-sm text-muted bg-transparent border-0 py-1" id="alignTextRight"><i class="bi bi-text-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade p-3" id="tab-layers" role="tabpanel">
                        <div class="right-panel-section mb-4">
                            <h6 class="mb-3 fw-bold fs-7 text-uppercase tracking-wider text-muted d-flex align-items-center gap-2">
                                <i class="bi bi-sliders"></i> Actions Console
                            </h6>
                            <div class="d-flex gap-2 mb-3">
                                <button id="deleteLayerBtn" class="btn btn-light border hover-danger text-danger flex-fill py-2 rounded-3 d-flex align-items-center justify-content-center gap-2 fw-medium fs-7">
                                    <i class="bi bi-trash3"></i> Delete
                                </button>
                                <button id="duplicateLayerBtn" class="btn btn-light border text-secondary flex-fill py-2 rounded-3 d-flex align-items-center justify-content-center gap-2 fw-medium fs-7">
                                    <i class="bi bi-copy"></i> Duplicate
                                </button>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <button id="undoBtn" class="btn btn-outline-secondary w-100 py-2 rounded-3 d-flex align-items-center justify-content-center gap-2 fw-medium fs-7">
                                        <i class="bi bi-arrow-counterclockwise"></i> Undo
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button id="redoBtn" class="btn btn-outline-secondary w-100 py-2 rounded-3 d-flex align-items-center justify-content-center gap-2 fw-medium fs-7">
                                        <i class="bi bi-arrow-clockwise"></i> Redo
                                    </button>
                                </div>
                            </div>

                            <div class="row g-2">
                                <div class="col-6">
                                    <button id="bringFrontBtn" class="btn btn-dark w-100 py-2 rounded-3 d-flex align-items-center justify-content-center gap-2 fw-medium shadow-sm fs-7">
                                        <i class="bi bi-layers-half text-success"></i> Bring Front
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button id="sendBackBtn" class="btn btn-dark w-100 py-2 rounded-3 d-flex align-items-center justify-content-center gap-2 fw-medium shadow-sm fs-7">
                                        <i class="bi bi-layers text-warning"></i> Send Back
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="right-panel-section mb-4 border-top pt-3">
                            <h6 class="mb-3 fw-bold fs-7 text-uppercase tracking-wider text-muted d-flex align-items-center gap-2">
                                <i class="bi bi-stack"></i> Active Layers Tree
                            </h6>
                            <div class="layer-list-container rounded-3 border bg-light-soft p-1">
                                <ul id="layerList" class="list-group list-group-flush gap-1">
                                    </ul>
                            </div>
                        </div>

                        <div class="right-panel-section border-top pt-3">
                            <h6 class="mb-3 fw-bold fs-7 text-uppercase tracking-wider text-muted d-flex align-items-center gap-2">
                                <i class="bi bi-cpu-fill text-secondary"></i> Smart Utilities
                            </h6>

                            <button id="toggleGridBtn" class="btn btn-tool-utility btn-light border w-100 mb-2 text-start d-flex align-items-center justify-content-between fs-7 py-2 px-3 rounded-3">
                                <span><i class="bi bi-grid-3x3 text-muted me-2"></i> Toggle Smart Grid</span>
                                <i class="bi bi-check-circle-fill text-primary" id="gridStatusIcon"></i>
                            </button>

                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <button id="centerHorizontalBtn" class="btn btn-tool-utility btn-light border w-100 text-start d-flex align-items-center gap-2 fs-7 py-2 rounded-3">
                                        <i class="bi bi-align-center text-success"></i> Center Horiz.
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button id="centerVerticalBtn" class="btn btn-tool-utility btn-light border w-100 text-start d-flex align-items-center gap-2 fs-7 py-2 rounded-3">
                                        <i class="bi bi-align-middle text-success"></i> Center Vert.
                                    </button>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <button id="alignLeftBtn" class="btn btn-tool-utility btn-light border w-100 text-start d-flex align-items-center gap-2 fs-7 py-2 rounded-3">
                                        <i class="bi bi-text-left text-dark"></i> Snap Left
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button id="alignTopBtn" class="btn btn-tool-utility btn-light border w-100 text-start d-flex align-items-center gap-2 fs-7 py-2 rounded-3">
                                        <i class="bi bi-align-top text-dark"></i> Snap Top
                                    </button>
                                </div>
                            </div>

                            <div class="zoom-panel bg-dark rounded-3 p-3 text-white">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fs-8 text-uppercase tracking-wider opacity-70">Canvas Calibration Scale</span>
                                    <span class="badge bg-secondary text-white fw-mono" id="zoomDisplay">100%</span>
                                </div>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <button id="zoomIn" class="btn btn-sm btn-outline-light w-100 py-1.5 rounded-2"><i class="bi bi-zoom-in"></i> Zoom In</button>
                                    </div>
                                    <div class="col-6">
                                        <button id="zoomOut" class="btn btn-sm btn-outline-light w-100 py-1.5 rounded-2"><i class="bi bi-zoom-out"></i> Zoom Out</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold text-dark mb-0">Card Template Live Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column align-items-center justify-content-center gap-4 py-4" style="background:#f1f5f9;">
                    <div id="modalPreviewFront" class="preview-modal-render shadow-sm rounded-3 bg-white" style="position:relative; width:360px; height:560px; overflow:hidden;"></div>
                    <div id="modalPreviewBack" class="preview-modal-render shadow-sm rounded-3 bg-white d-none" style="position:relative; width:360px; height:560px; overflow:hidden;"></div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary btn-sm px-3" id="btnTogglePreviewFront">Front Side</button>
                        <button type="button" class="btn btn-outline-primary btn-sm px-3" id="btnTogglePreviewBack">Back Side</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}



{{-- @push('styles')
    <style>
        .premium-designer-theme {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        .designer-wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
            background: #f1f5f9;
        }
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
        }
        .tool-btn:hover {
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
            transform: translateY(-1px);
        }
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
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05), 0 20px 48px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .grid-enabled {
            background-image: linear-gradient(to right, rgba(0,0,0,0.04) 1px, transparent 1px), linear-gradient(to bottom, rgba(0,0,0,0.04) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .designer-right-panel {
            width: 340px;
            background: #ffffff;
            border-left: 1px solid #e2e8f0;
            overflow-y: auto;
            z-index: 10;
        }
        .form-label-custom {
            font-size: 0.78rem;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 5px;
            text-uppercase: uppercase;
        }
        .custom-input, .custom-input-group {
            background-color: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            font-size: 0.85rem !important;
        }
        .custom-input:focus {
            background-color: #ffffff !important;
            border-color: #2563eb !important;
            box-shadow: none !important;
        }
        
        /* Draggable Elements Wrapper Style */
        .design-element {
            position: absolute;
            min-width: 30px;
            min-height: 20px;
            padding: 4px;
            cursor: move;
            user-select: none;
            box-sizing: border-box;
            border: 1px dashed transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: transparent;
        }
        .design-element.active {
            border: 1px dashed #2563eb !important;
            background-color: rgba(37, 99, 235, 0.02);
        }
        
        /* Custom UI Transform Resizers Handles */
        .resize-handle {
            width: 8px;
            height: 8px;
            background-color: #2563eb;
            border: 1px solid #ffffff;
            position: absolute;
            border-radius: 50%;
            display: none;
        }
        .design-element.active .resize-handle {
            display: block;
        }
        .resize-nw { top: -4px; left: -4px; cursor: nwse-resize; }
        .resize-ne { top: -4px; right: -4px; cursor: nesw-resize; }
        .resize-sw { bottom: -4px; left: -4px; cursor: nesw-resize; }
        .resize-se { bottom: -4px; right: -4px; cursor: nwse-resize; }

        .layer-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 4px;
            font-size: 0.82rem;
            cursor: pointer;
        }
        .layer-item.active {
            background: #eff6ff;
            border-color: #3b82f6;
            color: #1d4ed8;
            font-weight: 500;
        }
        .bg-light-soft { background-color: #f8fafc; }
        .placeholder-sm::placeholder { font-size: 0.8rem; color: #cbd5e1; }
        
        /* Printing Layout Rule Config */
        @media print {
            body * { visibility: hidden; }
            .preview-modal-render, .preview-modal-render * { visibility: visible; }
            .preview-modal-render { position: absolute; left: 0; top: 0; width: 100%; border:none !important; box-shadow:none !important; }
            .btn-group, .btn-close { display:none !important; }
        }
    </style>
@endpush --}}



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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            let activeCanvas = '#frontCanvas';
            let selectedElement = null;
            let zoomLevel = 1;
            let gridSnap = true;
            const snapSize = 20;

            // Undo / Redo Memory Stacks Structures
            let undoStack = [];
            let redoStack = [];

            function pushState() {
                if (undoStack.length > 30) undoStack.shift();
                undoStack.push({
                    front: $('#frontCanvas').html(),
                    back: $('#backCanvas').html()
                });
                redoStack = []; // Clear redo stack on structural mutation
            }

            // Initialization state push
            pushState();

            // Switch Artboard Front/Back Canvas
            $('#frontSideBtn').click(function() {
                $(this).addClass('btn-primary').removeClass('text-secondary hover-bg-light');
                $('#backSideBtn').addClass('text-secondary hover-bg-light').removeClass(
                    'btn-primary shadow-sm');
                $('#frontCanvas').removeClass('d-none');
                $('#backCanvas').addClass('d-none');
                activeCanvas = '#frontCanvas';
                deselectAll();
                updateLayersTree();
            });

            $('#backSideBtn').click(function() {
                $(this).addClass('btn-primary').removeClass('text-secondary hover-bg-light');
                $('#frontSideBtn').addClass('text-secondary hover-bg-light').removeClass(
                    'btn-primary shadow-sm');
                $('#backCanvas').removeClass('d-none');
                $('#frontCanvas').addClass('d-none');
                activeCanvas = '#backCanvas';
                deselectAll();
                updateLayersTree();
            });

            // Undo / Redo Implementations
            $('#undoBtn').click(function() {
                if (undoStack.length > 1) {
                    let currentState = undoStack.pop();
                    redoStack.push(currentState);
                    let previousState = undoStack[undoStack.length - 1];
                    $('#frontCanvas').html(previousState.front);
                    $('#backCanvas').html(previousState.back);
                    deselectAll();
                    updateLayersTree();
                    rebindDraggables();
                }
            });

            $('#redoBtn').click(function() {
                if (redoStack.length > 0) {
                    let nextState = redoStack.pop();
                    undoStack.push(nextState);
                    $('#frontCanvas').html(nextState.front);
                    $('#backCanvas').html(nextState.back);
                    deselectAll();
                    updateLayersTree();
                    rebindDraggables();
                }
            });

            // Toggle Smart Grid System
            $('#toggleGridBtn').click(function() {
                gridSnap = !gridSnap;
                if (gridSnap) {
                    $('.designer-canvas').addClass('grid-enabled');
                    $('#gridStatusIcon').addClass('text-primary bi-check-circle-fill').removeClass(
                        'text-muted bi-circle');
                } else {
                    $('.designer-canvas').removeClass('grid-enabled');
                    $('#gridStatusIcon').removeClass('text-primary bi-check-circle-fill').addClass(
                        'text-muted bi-circle');
                }
            });

            // Add Element Engine Core Controller
            let elementCounter = 0;

            function createGenericElement(type, innerContentHTML, styleDefaults) {
                elementCounter++;
                let elementId = `elem_${type}_${elementCounter}`;

                let elem = $(`
                    <div id="${elementId}" class="design-element" data-type="${type}" style="${styleDefaults}">
                        <div class="element-content-wrapper w-100 h-100 d-flex align-items-center justify-content-center" style="overflow:hidden; pointer-events:none;">
                            ${innerContentHTML}
                        </div>
                        <div class="resize-handle resize-nw"></div>
                        <div class="resize-handle resize-ne"></div>
                        <div class="resize-handle resize-sw"></div>
                        <div class="resize-handle resize-se"></div>
                    </div>
                `);

                elem.css({
                    top: '40px',
                    left: '40px'
                });
                $(activeCanvas).append(elem);

                bindDragAndResize(elem);
                selectElement(elem);
                pushState();
                updateLayersTree();
            }

            // Element Types Click Triggers
            $('.add-text-btn').click(function() {
                createGenericElement('Text', 'Sample Text Field',
                    'font-size:16px; font-family:Arial; color:#000000; width:150px; height:40px;');
            });

            $('.add-image-btn').click(function() {
                let url = prompt("Enter Absolute Image Web Address URL:",
                    "https://images.unsplash.com/photo-1579546929518-9e396f3cc809?w=300");
                if (url) {
                    createGenericElement('Image',
                        `<img src="${url}" class="w-100 h-100" style="object-fit:cover;">`,
                        'width:120px; height:120px;');
                }
            });

            $('.add-qr-btn').click(function() {
                createGenericElement('QR',
                    `<div class="bg-light border text-center p-2 fw-bold" style="font-size:10px; width:100%; height:100%;"><i class="bi bi-qr-code fs-1 d-block mb-1"></i> [LIVE_QR_CODE]</div>`,
                    'width:100px; height:100px;');
            });

            $('.add-barcode-btn').click(function() {
                createGenericElement('Barcode',
                    `<div class="bg-light border text-center p-1 fw-mono" style="font-size:9px; width:100%; height:100%;"><i class="bi bi-barcode fs-2 d-block"></i> 123456789</div>`,
                    'width:160px; height:50px;');
            });

            $('.add-line-btn').click(function() {
                createGenericElement('Line', '', 'width:150px; height:2px; background-color:#334155;');
            });

            $('.add-rectangle-btn').click(function() {
                createGenericElement('Rectangle', '',
                    'width:100px; height:100px; background-color:#e2e8f0; border:1px solid #cbd5e1;');
            });

            // Map Dynamic ERP Fields Data
            $('.dynamic-field').click(function() {
                let token = $(this).attr('data-field');
                createGenericElement('DynamicField',
                    `<span class="text-indigo fw-semibold">${token}</span>`,
                    'font-size:14px; font-family:Arial; color:#4f46e5; width:140px; height:35px;');
            });

            // Zoom Matrix Engine Calibration Logic 
            $('#zoomIn').click(function() {
                if (zoomLevel < 2) {
                    zoomLevel += 0.1;
                    applyZoom();
                }
            });

            $('#zoomOut').click(function() {
                if (zoomLevel > 0.5) {
                    zoomLevel -= 0.1;
                    applyZoom();
                }
            });

            function applyZoom() {
                $('#canvasScaleTarget').css('transform', `scale(${zoomLevel})`);
                $('#zoomDisplay').text(Math.round(zoomLevel * 100) + '%');
            }

            // Universal Drag and Precise Resize Calibration Matrix Engine
            function bindDragAndResize(element) {
                element.on('mousedown', function(e) {
                    if ($(e.target).hasClass('resize-handle')) return;
                    selectElement($(this));

                    let el = $(this);
                    let startX = e.pageX;
                    let startY = e.pageY;
                    let initialLeft = parseFloat(el.css('left'));
                    let initialTop = parseFloat(el.css('top'));

                    $(document).on('mousemove.drag', function(moveEvent) {
                        // Math calibration adjusted according to structural zoom view scaling
                        let dx = (moveEvent.pageX - startX) / zoomLevel;
                        let dy = (moveEvent.pageY - startY) / zoomLevel;

                        let targetLeft = initialLeft + dx;
                        let targetTop = initialTop + dy;

                        if (gridSnap) {
                            targetLeft = Math.round(targetLeft / snapSize) * snapSize;
                            targetTop = Math.round(targetTop / snapSize) * snapSize;
                        }

                        // Bounds checking limits alignment matching
                        targetLeft = Math.max(0, Math.min($(activeCanvas).width() - el.outerWidth(),
                            targetLeft));
                        targetTop = Math.max(0, Math.min($(activeCanvas).height() - el
                        .outerHeight(), targetTop));

                        el.css({
                            left: targetLeft + 'px',
                            top: targetTop + 'px'
                        });
                        updateInspectorInputs();
                    });

                    $(document).on('mouseup.drag', function() {
                        $(document).off('mousemove.drag mouseup.drag');
                        pushState();
                    });
                });

                // Resizing Core Matrices Handles
                element.find('.resize-handle').on('mousedown', function(handleEvent) {
                    handleEvent.stopPropagation();
                    let handle = $(this);
                    let el = element;
                    let startPageX = handleEvent.pageX;
                    let startPageY = handleEvent.pageY;

                    let initialW = el.outerWidth();
                    let initialH = el.outerHeight();
                    let initialL = parseFloat(el.css('left'));
                    let initialT = parseFloat(el.css('top'));

                    $(document).on('mousemove.resize', function(mEvent) {
                        let deltaX = (mEvent.pageX - startPageX) / zoomLevel;
                        let deltaY = (mEvent.pageY - startPageY) / zoomLevel;

                        if (handle.hasClass('resize-se')) {
                            let w = initialW + deltaX;
                            let h = initialH + deltaY;
                            if (gridSnap) {
                                w = Math.round(w / snapSize) * snapSize;
                                h = Math.round(h / snapSize) * snapSize;
                            }
                            el.css({
                                width: Math.max(15, w) + 'px',
                                height: Math.max(5, h) + 'px'
                            });
                        } else if (handle.hasClass('resize-sw')) {
                            let w = initialW - deltaX;
                            let h = initialH + deltaY;
                            let l = initialL + deltaX;
                            if (w > 15) el.css({
                                width: w + 'px',
                                height: h + 'px',
                                left: l + 'px'
                            });
                        } else if (handle.hasClass('resize-ne')) {
                            let w = initialW + deltaX;
                            let h = initialH - deltaY;
                            let t = initialT + deltaY;
                            if (h > 5) el.css({
                                width: w + 'px',
                                height: h + 'px',
                                top: t + 'px'
                            });
                        } else if (handle.hasClass('resize-nw')) {
                            let w = initialW - deltaX;
                            let h = initialH - deltaY;
                            let l = initialL + deltaX;
                            let t = initialT + deltaY;
                            if (w > 15 && h > 5) el.css({
                                width: w + 'px',
                                height: h + 'px',
                                left: l + 'px',
                                top: t + 'px'
                            });
                        }
                        updateInspectorInputs();
                    });

                    $(document).on('mouseup.resize', function() {
                        $(document).off('mousemove.resize mouseup.resize');
                        pushState();
                    });
                });
            }

            function rebindDraggables() {
                $('.design-element').each(function() {
                    bindDragAndResize($(this));
                });
            }

            // Elements Selection Controllers
            function selectElement(elem) {
                deselectAll();
                selectedElement = elem;
                selectedElement.addClass('active');
                $('#activeElementBadge').text(selectedElement.attr('data-type'));
                updateInspectorInputs();
                updateLayersTree();
            }

            function deselectAll() {
                $('.design-element').removeClass('active');
                selectedElement = null;
                $('#activeElementBadge').text('None Selected');
                clearInspectorInputs();
            }

            // Sync Selected Element values straight to inputs panel
            function updateInspectorInputs() {
                if (!selectedElement) return;

                // Get absolute plain content text
                let type = selectedElement.attr('data-type');
                if (type === 'Text' || type === 'DynamicField') {
                    $('#propertyInnerText').val(selectedElement.find('.element-content-wrapper').text().trim());
                } else {
                    $('#propertyInnerText').val('[Block Element Node]');
                }

                $('#propertyWidth').val(Math.round(selectedElement.outerWidth()));
                $('#propertyHeight').val(Math.round(selectedElement.outerHeight()));
                $('#propertyFontSize').val(parseInt(selectedElement.css('font-size')) || 14);
                $('#propertyFontFamily').val(selectedElement.css('font-family').replace(/['"]/g, ''));
                $('#propertyFontWeight').val(selectedElement.css('font-weight'));
                $('#propertyOpacity').val(selectedElement.css('opacity') || 1);

                // Calculate precise standard angle rotation
                let tr = selectedElement.css('transform');
                let values = tr.split('(')[1] ? tr.split('(')[1].split(')')[0].split(',') : null;
                let angle = 0;
                if (values) {
                    let a = values[0];
                    let b = values[1];
                    angle = Math.round(Math.atan2(b, a) * (180 / Math.PI));
                }
                $('#propertyRotate').val(angle < 0 ? angle + 360 : angle);

                // Fetch colors
                $('#propertyTextColor').val(rgbToHex(selectedElement.css('color')));
                $('#propertyBgColor').val(rgbToHex(selectedElement.css('background-color')));
                $('#extendedBorderRadius').val(parseInt(selectedElement.css('border-radius')) || 0);
                $('#extendedLetterSpacing').val(parseInt(selectedElement.css('letter-spacing')) || 0);
            }

            function clearInspectorInputs() {
                $('#propertyInnerText, #propertyWidth, #propertyHeight, #propertyFontSize, #propertyRotate, #extendedBorderRadius, #extendedLetterSpacing')
                    .val('');
            }

            // Conversions helper 
            function rgbToHex(rgb) {
                if (!rgb || rgb === 'transparent' || rgb.indexOf('rgba(0, 0, 0, 0)') > -1) return '#ffffff';
                let matches = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
                if (!matches) return '#ffffff';

                function hex(x) {
                    return ("0" + parseInt(x).toString(16)).slice(-2);
                }
                return "#" + hex(matches[1]) + hex(matches[2]) + hex(matches[3]);
            }

            // Realtime Customizer Event Bindings (Sync changes instantly back to canvas)
            $('#propertyInnerText').on('input', function() {
                if (selectedElement && (selectedElement.attr('data-type') === 'Text' || selectedElement
                        .attr('data-type') === 'DynamicField')) {
                    selectedElement.find('.element-content-wrapper').text($(this).val());
                }
            });

            $('#propertyWidth').on('input', function() {
                if (selectedElement) selectedElement.css('width', $(this).val() + 'px');
            });

            $('#propertyHeight').on('input', function() {
                if (selectedElement) selectedElement.css('height', $(this).val() + 'px');
            });

            $('#propertyFontSize').on('input', function() {
                if (selectedElement) selectedElement.css('font-size', $(this).val() + 'px');
            });

            $('#propertyFontFamily').change(function() {
                if (selectedElement) selectedElement.css('font-family', $(this).val());
            });

            $('#propertyFontWeight').change(function() {
                if (selectedElement) selectedElement.css('font-weight', $(this).val());
            });

            $('#propertyRotate').on('input', function() {
                if (selectedElement) selectedElement.css('transform', `rotate(${$(this).val()}deg)`);
            });

            $('#propertyTextColor').on('input', function() {
                if (selectedElement) selectedElement.css('color', $(this).val());
            });

            $('#propertyBgColor').on('input', function() {
                if (selectedElement) selectedElement.css('background-color', $(this).val());
            });

            $('#propertyOpacity').on('input', function() {
                if (selectedElement) selectedElement.css('opacity', $(this).val());
            });

            $('#extendedBorderRadius').on('input', function() {
                if (selectedElement) selectedElement.css('border-radius', $(this).val() + 'px');
            });

            $('#extendedLetterSpacing').on('input', function() {
                if (selectedElement) selectedElement.css('letter-spacing', $(this).val() + 'px');
            });

            $('#alignTextLeft').click(function() {
                if (selectedElement) selectedElement.css('text-align', 'left');
            });
            $('#alignTextCenter').click(function() {
                if (selectedElement) selectedElement.css('text-align', 'center');
            });
            $('#alignTextRight').click(function() {
                if (selectedElement) selectedElement.css('text-align', 'right');
            });

            // Global Background Changer Event
            $('#canvasBgColor').on('input', function() {
                $('.designer-canvas').css('background-color', $(this).val());
            });

            // Canvas Core Positioning Tools
            $('#centerHorizontalBtn').click(function() {
                if (selectedElement) {
                    let parentW = $(activeCanvas).width();
                    let elemW = selectedElement.outerWidth();
                    selectedElement.css('left', ((parentW - elemW) / 2) + 'px');
                    pushState();
                }
            });

            $('#centerVerticalBtn').click(function() {
                if (selectedElement) {
                    let parentH = $(activeCanvas).height();
                    let elemH = selectedElement.outerHeight();
                    selectedElement.css('top', ((parentH - elemH) / 2) + 'px');
                    pushState();
                }
            });

            $('#alignLeftBtn').click(function() {
                if (selectedElement) {
                    selectedElement.css('left', '0px');
                    pushState();
                }
            });

            // Layer Management Engine (Z-Index Controls)
            $('#bringFrontBtn').click(function() {
                if (selectedElement) {
                    let currentZ = parseInt(selectedElement.css('z-index')) || 1;
                    selectedElement.css('z-index', currentZ + 1);
                    updateLayersTree();
                }
            });

            $('#sendBackBtn').click(function() {
                if (selectedElement) {
                    let currentZ = parseInt(selectedElement.css('z-index')) || 1;
                    selectedElement.css('z-index', Math.max(1, currentZ - 1));
                    updateLayersTree();
                }
            });

            $('#deleteLayerBtn').click(function() {
                if (selectedElement) {
                    selectedElement.remove();
                    deselectAll();
                    pushState();
                    updateLayersTree();
                }
            });

            $('#duplicateLayerBtn').click(function() {
                if (selectedElement) {
                    let clone = selectedElement.clone();
                    clone.removeClass('active');
                    elementCounter++;
                    let newId = `elem_cloned_${elementCounter}`;
                    clone.attr('id', newId);

                    let left = parseFloat(selectedElement.css('left')) + 20;
                    let top = parseFloat(selectedElement.css('top')) + 20;
                    clone.css({
                        left: left + 'px',
                        top: top + 'px'
                    });

                    $(activeCanvas).append(clone);
                    bindDragAndResize(clone);
                    selectElement(clone);
                    pushState();
                }
            });

            // Click canvas body to clear selection
            $('.designer-canvas').on('mousedown', function(e) {
                if (e.target === this) {
                    deselectAll();
                }
            });

            // Dynamic Active Layers Mapping Tree Renderer Engine
            function updateLayersTree() {
                let list = $('#layerList');
                list.empty();

                $(`${activeCanvas} .design-element`).each(function() {
                    let item = $(this);
                    let id = item.attr('id');
                    let type = item.attr('data-type');
                    let z = item.css('z-index') || 1;
                    let activeClass = (selectedElement && selectedElement.attr('id') === id) ? 'active' :
                    '';

                    list.append(`
                        <li class="layer-item ${activeClass}" data-target="#${id}">
                            <span><i class="bi bi-layer-forward me-2 text-muted"></i>${type} <small class="text-xs text-muted">(Index: ${z})</small></span>
                            <i class="bi bi-eye opacity-70"></i>
                        </li>
                    `);
                });
            }

            $(document).on('click', '.layer-item', function() {
                let targetId = $(this).attr('data-target');
                selectElement($(targetId));
            });

            // 1. Template Saver System Execution Engine 
            $('#saveTemplateBtn').click(function() {
                deselectAll();
                let cardTemplatePayload = {
                    front_markup: $('#frontCanvas').html(),
                    back_markup: $('#backCanvas').html(),
                    canvas_bg: $('#canvasBgColor').val()
                };

                // Premium visual alerts structure layout feedback mapping
                let btn = $(this);
                btn.html('<i class="bi bi-hourglass-split me-1"></i> Saving to Server...').prop('disabled',
                    true);

                $.ajax({
                    url: '/save-card-template', // Replace matching backend routes string controller path maps
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: cardTemplatePayload,
                    success: function(response) {
                        alert(
                            "✨ Layout saved successfully via Ajax pipeline transaction layers!");
                        btn.html(
                            '<i class="bi bi-cloud-arrow-up-fill me-1"></i> Save Card Template'
                            ).prop('disabled', false);
                    },
                    error: function() {
                        // Simulation backup save strategy to LocalStorage if endpoint fails
                        localStorage.setItem('backup_ktr_template', JSON.stringify(
                            cardTemplatePayload));
                        alert(
                            "Saved to Browser Local Storage Cache Memory Matrix as standard procedural secure fallback layer redundancy!");
                        btn.html(
                            '<i class="bi bi-cloud-arrow-up-fill me-1"></i> Save Card Template'
                            ).prop('disabled', false);
                    }
                });
            });

            // 2. High-Fidelity Modal Live Preview Framework Logic
            $('#previewBtn').click(function() {
                deselectAll();
                $('#modalPreviewFront').html($('#frontCanvas').html()).css('background-color', $(
                    '#canvasBgColor').val());
                $('#modalPreviewBack').html($('#backCanvas').html()).css('background-color', $(
                    '#canvasBgColor').val());

                // Strips designer specific active outline selectors classes rules inside visualizer modal frames
                $('.preview-modal-render .design-element').removeClass('active').css('border', 'none');
                $('.preview-modal-render .resize-handle').remove();

                let myModal = new bootstrap.Modal(document.getElementById('previewModal'));
                myModal.show();
            });

            $('#btnTogglePreviewFront').click(function() {
                $(this).addClass('btn-primary').removeClass('btn-outline-primary');
                $('#btnTogglePreviewBack').addClass('btn-outline-primary').removeClass('btn-primary');
                $('#modalPreviewFront').removeClass('d-none');
                $('#modalPreviewBack').addClass('d-none');
            });

            $('#btnTogglePreviewBack').click(function() {
                $(this).addClass('btn-primary').removeClass('btn-outline-primary');
                $('#btnTogglePreviewFront').addClass('btn-outline-primary').removeClass('btn-primary');
                $('#modalPreviewBack').removeClass('d-none');
                $('#modalPreviewFront').addClass('d-none');
            });

            // 3. Print Engine Setup
            $('#downloadPdfBtn').click(function() {
                deselectAll();
                // Copies cleanest nodes layouts safely straight to browser device default print spool drivers pipelines
                $('#modalPreviewFront').html($('#frontCanvas').html()).css('background-color', $(
                    '#canvasBgColor').val());
                $('#modalPreviewBack').html($('#backCanvas').html()).css('background-color', $(
                    '#canvasBgColor').val());
                $('.preview-modal-render .design-element').removeClass('active').css('border', 'none');
                $('.preview-modal-render .resize-handle').remove();

                // Triggers structural native rendering print interface directly
                window.print();
            });
        });
    </script>
@endpush
