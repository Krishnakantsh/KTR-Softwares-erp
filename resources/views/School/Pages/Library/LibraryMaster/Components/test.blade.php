<div class="row">

    <!-- CONTROL PANEL -->
    <div class="col-xl-4">

        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h5 class="mb-0">
                    ID Card Designer Control Panel
                </h5>
            </div>

            <div class="card-body">

                <!-- MEMBER -->
                <div class="mb-3">
                    <label class="form-label">
                        Select Member
                    </label>

                    <select id="memberSelector" class="form-control">
                        <option value="">Choose Member</option>
                    </select>
                </div>

                <!-- CARD SIDE -->
                <div class="mb-3">
                    <label class="form-label">
                        Card Side
                    </label>

                    <select id="cardSideSelector" class="form-control">
                        <option value="front">Front Side</option>
                        <option value="back">Back Side</option>
                    </select>
                </div>

                <!-- CARD SIZE -->
                <div class="mb-3">
                    <label class="form-label">
                        Card Size
                    </label>

                    <select id="cardSizeSelector" class="form-control">
                        <option value="cr80">CR80</option>
                        <option value="pvc">PVC</option>
                        <option value="a4">A4 Sheet</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>

                <!-- CUSTOM SIZE -->
                <div class="row mb-3">

                    <div class="col-6">
                        <input type="number" id="customWidth" class="form-control" placeholder="Width">
                    </div>

                    <div class="col-6">
                        <input type="number" id="customHeight" class="form-control" placeholder="Height">
                    </div>

                </div>

                <!-- FONT FAMILY -->
                <div class="mb-3">

                    <label class="form-label">
                        Font Family
                    </label>

                    <select id="fontFamily" class="form-control">

                        <option value="Arial">
                            Arial
                        </option>

                        <option value="Roboto">
                            Roboto
                        </option>

                        <option value="Poppins">
                            Poppins
                        </option>

                        <option value="Georgia">
                            Georgia
                        </option>

                    </select>

                </div>

                <!-- FONT WEIGHT -->
                <div class="mb-3">

                    <label class="form-label">
                        Font Weight
                    </label>

                    <select id="fontWeight" class="form-control">

                        <option value="400">
                            Normal
                        </option>

                        <option value="600">
                            Semi Bold
                        </option>

                        <option value="700">
                            Bold
                        </option>

                        <option value="800">
                            Extra Bold
                        </option>

                    </select>

                </div>

                <!-- ALIGNMENT -->
                <div class="mb-3">

                    <label class="form-label">
                        Text Alignment
                    </label>

                    <select id="textAlign" class="form-control">

                        <option value="left">
                            Left
                        </option>

                        <option value="center">
                            Center
                        </option>

                        <option value="right">
                            Right
                        </option>

                    </select>

                </div>

                <!-- COLORS -->

                <div class="row mb-3">

                    <div class="col-6">

                        <label>
                            Background
                        </label>

                        <input type="color" id="cardBgColor" class="form-control form-control-color">

                    </div>

                    <div class="col-6">

                        <label>
                            Text
                        </label>

                        <input type="color" id="cardTextColor" class="form-control form-control-color">

                    </div>

                </div>

                <!-- UPLOADS -->

                <div class="mb-3">

                    <label>
                        Background Image
                    </label>

                    <input type="file" id="backgroundImageUpload" class="form-control">

                </div>

                <div class="mb-3">

                    <label>
                        Logo Upload
                    </label>

                    <input type="file" id="logoUpload" class="form-control">

                </div>

                <div class="mb-3">

                    <label>
                        Signature Upload
                    </label>

                    <input type="file" id="signatureUpload" class="form-control">

                </div>

                <div class="mb-3">

                    <label>
                        Watermark Upload
                    </label>

                    <input type="file" id="watermarkUpload" class="form-control">

                </div>

                <!-- QR -->

                <div class="mb-3">

                    <label>
                        QR Content
                    </label>

                    <input type="text" id="qrContent" class="form-control">

                </div>

                <!-- BARCODE -->

                <div class="mb-3">

                    <label>
                        Barcode Value
                    </label>

                    <input type="text" id="barcodeContent" class="form-control">

                </div>

                <!-- ACTIONS -->

                <div class="d-grid gap-2">

                    <button class="btn btn-success" id="saveTemplateBtn">

                        Save Template

                    </button>

                    <button class="btn btn-info" id="loadTemplateBtn">

                        Load Template

                    </button>

                    <button class="btn btn-primary" id="downloadPNG">

                        Download PNG

                    </button>

                    <button class="btn btn-danger" id="downloadPDF">

                        Download PDF

                    </button>

                    <button class="btn btn-warning" id="multiplePrintBtn">

                        Multiple Print

                    </button>

                    <button class="btn btn-dark" id="flipCardBtn">

                        Flip Front / Back

                    </button>

                </div>

            </div>
        </div>

    </div>

    <!-- DESIGNER -->

    <div class="col-xl-8">

        <div class="designer-stage">

            <!-- FRONT -->

            <div id="designerFrontCard" class="designer-card">

                <div id="dragLogo" class="draggable-element">

                    <img id="previewLogo" src="" class="designer-logo">

                </div>

                <div id="dragPhoto" class="draggable-element">

                    <img id="previewPhoto" src="" class="designer-photo">

                </div>

                <div id="dragName" class="draggable-element">

                    STUDENT NAME

                </div>

                <div id="dragClass" class="draggable-element">

                    CLASS 10

                </div>

                <div id="dragBarcode" class="draggable-element">

                    <svg id="barcodeSvg"></svg>

                </div>

                <div id="dragQr" class="draggable-element">

                    <div id="qrCodeContainer"></div>

                </div>

                <div id="dragSignature" class="draggable-element">

                    <img id="previewSignature">

                </div>

                <div id="dragWatermark" class="draggable-element">

                    <img id="previewWatermark">

                </div>

            </div>

            <!-- BACK -->

            <div id="designerBackCard" class="designer-card d-none">

                <div id="dragAddress" class="draggable-element">

                    School Address Here

                </div>

                <div id="dragRules" class="draggable-element">

                    Library Rules Here

                </div>

                <div id="dragContact" class="draggable-element">

                    Contact Information

                </div>

            </div>

        </div>
    </div>

</div>


@push('styles')
    <style>
        /* ==========================================
                       DESIGNER STAGE
                    ========================================== */

        .designer-stage {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 700px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        /* ==========================================
                       CARD BASE
                    ========================================== */

        .designer-card {
            width: 340px;
            height: 540px;
            position: relative;
            overflow: hidden;
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #dbe4ee;
            box-shadow:
                0 20px 40px rgba(0, 0, 0, .12),
                0 5px 12px rgba(0, 0, 0, .06);
            transition: .3s ease;
            background-size: cover;
            background-position: center;
        }

        .designer-card:hover {
            transform: translateY(-3px);
        }

        /* ==========================================
                       CARD SIZE SYSTEM
                    ========================================== */

        .card-cr80 {
            width: 340px;
            height: 540px;
        }

        .card-pvc {
            width: 340px;
            height: 540px;
        }

        .card-a4 {
            width: 700px;
            height: 980px;
        }

        .card-custom {
            width: 100%;
            height: 100%;
        }

        /* ==========================================
                       DRAG ELEMENTS
                    ========================================== */

        .draggable-element {
            position: absolute;
            cursor: move;
            user-select: none;
            z-index: 10;
        }

        .draggable-element.active-layer {
            outline: 2px dashed #2563eb;
        }

        .draggable-element:hover {
            outline: 1px dashed #60a5fa;
        }

        /* ==========================================
                       RESIZE HANDLE
                    ========================================== */

        .resize-handle {
            width: 10px;
            height: 10px;
            background: #2563eb;
            position: absolute;
            right: -5px;
            bottom: -5px;
            cursor: nwse-resize;
            border-radius: 50%;
        }

        /* ==========================================
                       LOGO
                    ========================================== */

        #dragLogo {
            top: 15px;
            left: 15px;
        }

        .designer-logo {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        /* ==========================================
                       PHOTO
                    ========================================== */

        #dragPhoto {
            top: 90px;
            left: 105px;
        }

        .designer-photo {
            width: 120px;
            height: 140px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
        }

        /* ==========================================
                       NAME
                    ========================================== */

        #dragName {
            top: 245px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 22px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* ==========================================
                       CLASS
                    ========================================== */

        #dragClass {
            top: 285px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 14px;
            font-weight: 600;
        }

        /* ==========================================
                       BARCODE
                    ========================================== */

        #dragBarcode {
            bottom: 70px;
            left: 50%;
            transform: translateX(-50%);
        }

        #barcodeSvg {
            width: 220px;
            height: 60px;
        }

        /* ==========================================
                       QR CODE
                    ========================================== */

        #dragQr {
            right: 15px;
            bottom: 130px;
        }

        #qrCodeContainer canvas,
        #qrCodeContainer img {
            width: 80px !important;
            height: 80px !important;
        }

        /* ==========================================
                       SIGNATURE
                    ========================================== */

        #dragSignature {
            right: 20px;
            bottom: 20px;
        }

        #previewSignature {
            width: 90px;
            height: 40px;
            object-fit: contain;
        }

        /* ==========================================
                       WATERMARK
                    ========================================== */

        #dragWatermark {
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            opacity: .08;
            pointer-events: none;
        }

        #previewWatermark {
            width: 220px;
            height: 220px;
            object-fit: contain;
        }

        /* ==========================================
                       BACK SIDE
                    ========================================== */

        #designerBackCard {
            padding: 20px;
        }

        #dragAddress {
            top: 40px;
            left: 20px;
            right: 20px;
            font-size: 14px;
        }

        #dragRules {
            top: 140px;
            left: 20px;
            right: 20px;
            font-size: 13px;
        }

        #dragContact {
            bottom: 40px;
            left: 20px;
            right: 20px;
            font-size: 13px;
        }

        /* ==========================================
                       THEMES
                    ========================================== */

        .theme-blue {
            background: #ffffff;
        }

        .theme-blue::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background: #2563eb;
        }

        .theme-green::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background: #16a34a;
        }

        .theme-red::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background: #dc2626;
        }

        .theme-black::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background: #111827;
        }

        .theme-gold::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background: #ca8a04;
        }

        /* ==========================================
                       GRID SUPPORT
                    ========================================== */

        .grid-enabled {
            background-image:
                linear-gradient(rgba(0, 0, 0, .05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, .05) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        /* ==========================================
                       PRINT MODE
                    ========================================== */

        @media print {

            body * {
                visibility: hidden;
            }

            .designer-card,
            .designer-card * {
                visibility: visible;
            }

            .designer-card {
                position: absolute;
                top: 0;
                left: 0;
                box-shadow: none !important;
                transform: none !important;
            }

        }

        /* ==========================================
                       RESPONSIVE
                    ========================================== */

        @media(max-width:991px) {

            .designer-card {
                width: 300px;
                height: 500px;
            }

            .designer-photo {
                width: 100px;
                height: 120px;
            }

            #dragName {
                font-size: 18px;
            }

        }

        @media(max-width:576px) {

            .designer-stage {
                padding: 10px;
            }

            .designer-card {
                width: 270px;
                height: 450px;
            }

        }
    </style>
@endpush



@push('script')
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        $(document).ready(function() {

            let currentSide = "front";

            /* ==================================
               DRAG ENGINE
            ================================== */

            let selectedElement = null;
            let isDragging = false;
            let offsetX = 0;
            let offsetY = 0;

            $(document).on('mousedown', '.draggable-element', function(e) {

                selectedElement = $(this);

                $('.draggable-element').removeClass('active-layer');
                selectedElement.addClass('active-layer');

                isDragging = true;

                let position = selectedElement.position();

                offsetX = e.pageX - position.left;
                offsetY = e.pageY - position.top;

            });

            $(document).on('mousemove', function(e) {

                if (!isDragging || !selectedElement) {
                    return;
                }

                let parent = selectedElement.parent();

                let x = e.pageX - parent.offset().left - offsetX;
                let y = e.pageY - parent.offset().top - offsetY;

                selectedElement.css({
                    left: x + 'px',
                    top: y + 'px'
                });

            });

            $(document).on('mouseup', function() {

                isDragging = false;

            });

            /* ==================================
               RESIZE ENGINE
            ================================== */

            $('.draggable-element').each(function() {

                if ($(this).find('.resize-handle').length === 0) {

                    $(this).append(
                        '<span class="resize-handle"></span>'
                    );

                }

            });

            let resizeTarget = null;
            let resizeStartX = 0;
            let resizeStartWidth = 0;

            $(document).on('mousedown', '.resize-handle', function(e) {

                e.stopPropagation();

                resizeTarget = $(this).parent();

                resizeStartX = e.pageX;
                resizeStartWidth = resizeTarget.width();

            });

            $(document).on('mousemove', function(e) {

                if (!resizeTarget) {
                    return;
                }

                let newWidth =
                    resizeStartWidth +
                    (e.pageX - resizeStartX);

                if (newWidth < 20) {
                    newWidth = 20;
                }

                resizeTarget.css({
                    width: newWidth + 'px'
                });

            });

            $(document).on('mouseup', function() {

                resizeTarget = null;

            });

            /* ==================================
               FRONT BACK FLIP
            ================================== */

            $('#flipCardBtn').click(function() {

                if (currentSide === "front") {

                    $('#designerFrontCard').addClass('d-none');
                    $('#designerBackCard').removeClass('d-none');

                    currentSide = "back";

                } else {

                    $('#designerBackCard').addClass('d-none');
                    $('#designerFrontCard').removeClass('d-none');

                    currentSide = "front";
                }

            });

            $('#cardSideSelector').change(function() {

                let side = $(this).val();

                if (side === 'front') {

                    $('#designerBackCard').addClass('d-none');
                    $('#designerFrontCard').removeClass('d-none');

                    currentSide = 'front';

                } else {

                    $('#designerFrontCard').addClass('d-none');
                    $('#designerBackCard').removeClass('d-none');

                    currentSide = 'back';
                }

            });

            /* ==================================
               FONT FAMILY
            ================================== */

            $('#fontFamily').change(function() {

                $('.designer-card').css(
                    'font-family',
                    $(this).val()
                );

            });

            /* ==================================
               FONT WEIGHT
            ================================== */

            $('#fontWeight').change(function() {

                $('.active-layer').css(
                    'font-weight',
                    $(this).val()
                );

            });

            /* ==================================
               TEXT ALIGN
            ================================== */

            $('#textAlign').change(function() {

                $('.active-layer').css(
                    'text-align',
                    $(this).val()
                );

            });

            /* ==================================
               CARD BG COLOR
            ================================== */

            $('#cardBgColor').change(function() {

                $('.designer-card').css(
                    'background-color',
                    $(this).val()
                );

            });

            /* ==================================
               TEXT COLOR
            ================================== */

            $('#cardTextColor').change(function() {

                $('.designer-card').css(
                    'color',
                    $(this).val()
                );

            });

            /* ==================================
               CARD SIZE
            ================================== */

            $('#cardSizeSelector').change(function() {

                let size = $(this).val();

                let card =
                    $('#designerFrontCard,#designerBackCard');

                card.removeClass(
                    'card-cr80 card-pvc card-a4 card-custom'
                );

                if (size === 'cr80') {

                    card.addClass('card-cr80');

                }

                if (size === 'pvc') {

                    card.addClass('card-pvc');

                }

                if (size === 'a4') {

                    card.addClass('card-a4');

                }

                if (size === 'custom') {

                    card.addClass('card-custom');

                }

            });

            /* ==================================
               CUSTOM SIZE
            ================================== */

            $('#customWidth,#customHeight').on(
                'keyup change',
                function() {

                    let width =
                        $('#customWidth').val();

                    let height =
                        $('#customHeight').val();

                    if (width && height) {

                        $('#designerFrontCard,#designerBackCard')
                            .css({
                                width: width + 'px',
                                height: height + 'px'
                            });

                    }

                }
            );

            /* ==================================
               BACKGROUND IMAGE
            ================================== */

            $('#backgroundImageUpload').change(function(e) {

                let file = e.target.files[0];

                if (!file) {
                    return;
                }

                let reader = new FileReader();

                reader.onload = function(event) {

                    $('.designer-card').css({
                        backgroundImage: 'url(' + event.target.result + ')'
                    });

                };

                reader.readAsDataURL(file);

            });

            /* ==================================
               LOGO UPLOAD
            ================================== */

            $('#logoUpload').change(function(e) {

                let file = e.target.files[0];

                if (!file) {
                    return;
                }

                let reader = new FileReader();

                reader.onload = function(event) {

                    $('#previewLogo').attr(
                        'src',
                        event.target.result
                    );

                };

                reader.readAsDataURL(file);

            });

            /* ==================================
               SIGNATURE
            ================================== */

            $('#signatureUpload').change(function(e) {

                let file = e.target.files[0];

                if (!file) {
                    return;
                }

                let reader = new FileReader();

                reader.onload = function(event) {

                    $('#previewSignature').attr(
                        'src',
                        event.target.result
                    );

                };

                reader.readAsDataURL(file);

            });

            /* ==================================
               WATERMARK
            ================================== */

            $('#watermarkUpload').change(function(e) {

                let file = e.target.files[0];

                if (!file) {
                    return;
                }

                let reader = new FileReader();

                reader.onload = function(event) {

                    $('#previewWatermark').attr(
                        'src',
                        event.target.result
                    );

                };

                reader.readAsDataURL(file);

            });

            /* ==================================
           QR GENERATOR
        ================================== */

            let qrInstance = null;

            function generateQRCode(value) {

                $('#qrCodeContainer').html('');

                if (!value) {
                    return;
                }

                qrInstance = new QRCode(
                    document.getElementById('qrCodeContainer'), {
                        text: value,
                        width: 80,
                        height: 80
                    }
                );
            }

            $('#qrContent').on(
                'keyup change',
                function() {

                    generateQRCode(
                        $(this).val()
                    );

                }
            );

            /* ==================================
               BARCODE GENERATOR
            ================================== */

            function generateBarcode(value) {

                if (!value) {
                    return;
                }

                JsBarcode(
                    "#barcodeSvg",
                    value, {
                        format: "CODE128",
                        width: 2,
                        height: 50,
                        displayValue: true,
                        fontSize: 14
                    }
                );
            }

            $('#barcodeContent').on(
                'keyup change',
                function() {

                    generateBarcode(
                        $(this).val()
                    );

                }
            );

            /* ==================================
               SAVE POSITIONS
            ================================== */

            function getPositions() {

                let positions = {};

                $('.draggable-element').each(function() {

                    let id = $(this).attr('id');

                    positions[id] = {

                        top: $(this).css('top'),
                        left: $(this).css('left'),
                        width: $(this).css('width'),
                        height: $(this).css('height')

                    };

                });

                return positions;
            }

            /* ==================================
               RESTORE POSITIONS
            ================================== */

            function restorePositions(data) {

                $.each(data, function(id, config) {

                    $('#' + id).css({

                        top: config.top,
                        left: config.left,
                        width: config.width,
                        height: config.height

                    });

                });

            }

            /* ==================================
               SAVE TEMPLATE
            ================================== */

            $('#saveTemplateBtn').click(function() {

                let template = {

                    bgColor: $('#cardBgColor').val(),
                    textColor: $('#cardTextColor').val(),

                    fontFamily: $('#fontFamily').val(),
                    fontWeight: $('#fontWeight').val(),

                    qrContent: $('#qrContent').val(),
                    barcodeContent: $('#barcodeContent').val(),

                    positions: getPositions(),

                    width: $('#designerFrontCard').width(),
                    height: $('#designerFrontCard').height(),

                    cardHTML: $('#designerFrontCard').html()

                };

                localStorage.setItem(
                    'library_card_template',
                    JSON.stringify(template)
                );

                alert('Template Saved Successfully');

            });

            /* ==================================
               LOAD TEMPLATE
            ================================== */

            $('#loadTemplateBtn').click(function() {

                let template =
                    localStorage.getItem(
                        'library_card_template'
                    );

                if (!template) {

                    alert('No Template Found');
                    return;
                }

                template = JSON.parse(template);

                $('#cardBgColor')
                    .val(template.bgColor)
                    .trigger('change');

                $('#cardTextColor')
                    .val(template.textColor)
                    .trigger('change');

                $('#fontFamily')
                    .val(template.fontFamily)
                    .trigger('change');

                $('#fontWeight')
                    .val(template.fontWeight)
                    .trigger('change');

                $('#qrContent')
                    .val(template.qrContent);

                $('#barcodeContent')
                    .val(template.barcodeContent);

                generateQRCode(
                    template.qrContent
                );

                generateBarcode(
                    template.barcodeContent
                );

                restorePositions(
                    template.positions
                );

                $('#designerFrontCard,#designerBackCard')
                    .css({

                        width: template.width,
                        height: template.height

                    });

                alert('Template Loaded');

            });

            /* ==================================
               AUTO SAVE
            ================================== */

            setInterval(function() {

                let autoTemplate = {

                    positions: getPositions()

                };

                localStorage.setItem(
                    'library_card_autosave',
                    JSON.stringify(autoTemplate)
                );

            }, 5000);

            /* ==================================
               AUTO RESTORE
            ================================== */

            let autoRestore =
                localStorage.getItem(
                    'library_card_autosave'
                );

            if (autoRestore) {

                autoRestore =
                    JSON.parse(autoRestore);

                restorePositions(
                    autoRestore.positions
                );

            }

            /* ==================================
               MEMBER AJAX FETCH
            ================================== */

            function loadMembers() {

                $.ajax({

                    url: '/library/members/list',

                    type: 'GET',

                    success: function(response) {

                        let html =
                            '<option value="">Select Member</option>';

                        $.each(
                            response,
                            function(index, row) {

                                html +=
                                    `
                    <option
                        value="${row.id}"
                        data-name="${row.name}"
                        data-class="${row.class_name}"
                        data-photo="${row.photo}"
                        data-admission="${row.admission_no}"
                        data-barcode="${row.card_no}">
                        ${row.name}
                    </option>
                    `;
                            }
                        );

                        $('#memberSelector')
                            .html(html);

                    }

                });

            }

            /* ==================================
               MEMBER BIND
            ================================== */

            $('#memberSelector').change(function() {

                let option =
                    $(this).find('option:selected');

                $('#dragName').text(
                    option.data('name')
                );

                $('#dragClass').text(
                    option.data('class')
                );

                generateBarcode(
                    option.data('barcode')
                );

                generateQRCode(
                    option.data('admission')
                );

                let photo =
                    option.data('photo');

                if (photo) {

                    $('#previewPhoto')
                        .attr('src', photo);

                }

            });

            /* ==================================
               MEMBER DETAILS AJAX
            ================================== */

            function loadMemberDetails(id) {

                $.ajax({

                    url: '/library/member/details/' + id,

                    type: 'GET',

                    success: function(row) {

                        $('#dragName')
                            .text(row.name);

                        $('#dragClass')
                            .text(row.class_name);

                        $('#previewPhoto')
                            .attr('src', row.photo);

                        generateBarcode(
                            row.card_no
                        );

                        generateQRCode(
                            row.admission_no
                        );

                    }

                });

            }

            /* ==================================
               MEMBER CHANGE
            ================================== */

            $('#memberSelector').change(function() {

                let id = $(this).val();

                if (id) {

                    loadMemberDetails(id);

                }

            });

            /* ==================================
               INITIAL LOAD
            ================================== */

            loadMembers();


            /* ==================================
               PNG DOWNLOAD
            ================================== */

            $('#downloadPNG').click(async function() {

                let card =
                    currentSide === 'front' ?
                    document.getElementById('designerFrontCard') :
                    document.getElementById('designerBackCard');

                const canvas =
                    await html2canvas(card, {
                        scale: 3,
                        useCORS: true,
                        backgroundColor: null
                    });

                const link =
                    document.createElement('a');

                link.download =
                    'library-card.png';

                link.href =
                    canvas.toDataURL('image/png');

                link.click();

            });

            /* ==================================
               PDF DOWNLOAD
            ================================== */

            $('#downloadPDF').click(async function() {

                let card =
                    currentSide === 'front' ?
                    document.getElementById('designerFrontCard') :
                    document.getElementById('designerBackCard');

                const canvas =
                    await html2canvas(card, {
                        scale: 3,
                        useCORS: true
                    });

                const image =
                    canvas.toDataURL('image/png');

                const {
                    jsPDF
                } = window.jspdf;

                const pdf =
                    new jsPDF(
                        'portrait',
                        'mm',
                        'a4'
                    );

                pdf.addImage(
                    image,
                    'PNG',
                    10,
                    10,
                    54,
                    86
                );

                pdf.save(
                    'library-card.pdf'
                );

            });

            /* ==================================
               SINGLE CARD PRINT
            ================================== */

            function printSingleCard() {

                let card =
                    currentSide === 'front' ?
                    $('#designerFrontCard').prop('outerHTML') :
                    $('#designerBackCard').prop('outerHTML');

                let win =
                    window.open(
                        '',
                        '',
                        'width=900,height=900'
                    );

                win.document.write(`
        <html>
        <head>
            <title>Print Card</title>

            <style>

                body{
                    margin:0;
                    padding:20px;
                    display:flex;
                    justify-content:center;
                    align-items:center;
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

                    win.print();

                }, 500);

            }

            /* ==================================
               MULTIPLE PRINT BUTTON
            ================================== */

            $('#multiplePrintBtn').click(function() {

                let total =
                    prompt(
                        'How many copies?'
                    );

                total =
                    parseInt(total);

                if (!total || total <= 0) {
                    return;
                }

                batchPrint(total);

            });

            /* ==================================
               BATCH PRINT
            ================================== */

            function batchPrint(total) {

                let html = '';

                for (
                    let i = 0; i < total; i++
                ) {

                    html += `
        <div class="print-card">

            ${
                $('#designerFrontCard')
                .prop('outerHTML')
            }

        </div>
        `;
                }

                let win =
                    window.open(
                        '',
                        '',
                        'width=1200,height=1000'
                    );

                win.document.write(`

        <html>

        <head>

        <title>
            Batch Print
        </title>

        <style>

        body{
            margin:0;
            padding:10px;
        }

        .sheet{

            display:flex;
            flex-wrap:wrap;
            gap:10px;

        }

        .print-card{

            page-break-inside:avoid;

        }

        @media print{

            body{
                margin:0;
            }

        }

        </style>

        </head>

        <body>

            <div class="sheet">

                ${html}

            </div>

        </body>

        </html>

    `);

                win.document.close();

                setTimeout(function() {

                    win.print();

                }, 800);

            }

            /* ==================================
               PRINT FRONT + BACK
            ================================== */

            function printFrontBack() {

                let front =
                    $('#designerFrontCard')
                    .prop('outerHTML');

                let back =
                    $('#designerBackCard')
                    .prop('outerHTML');

                let win =
                    window.open(
                        '',
                        '',
                        'width=1200,height=1000'
                    );

                win.document.write(`

    <html>

    <head>

    <style>

        body{
            margin:0;
            padding:20px;
        }

        .page{
            page-break-after:always;
            display:flex;
            justify-content:center;
        }

    </style>

    </head>

    <body>

        <div class="page">

            ${front}

        </div>

        <div class="page">

            ${back}

        </div>

    </body>

    </html>

    `);

                win.document.close();

                setTimeout(function() {

                    win.print();

                }, 1000);

            }

            /* ==================================
               EXPORT TEMPLATE FILE
            ================================== */

            function exportTemplate() {

                let template = {

                    positions: getPositions(),

                    fontFamily: $('#fontFamily').val(),

                    fontWeight: $('#fontWeight').val(),

                    textColor: $('#cardTextColor').val(),

                    bgColor: $('#cardBgColor').val(),

                    qr: $('#qrContent').val(),

                    barcode: $('#barcodeContent').val()

                };

                let blob =
                    new Blob(
                        [
                            JSON.stringify(
                                template,
                                null,
                                4
                            )
                        ], {
                            type: 'application/json'
                        }
                    );

                let url =
                    URL.createObjectURL(blob);

                let link =
                    document.createElement('a');

                link.href = url;

                link.download =
                    'library-template.json';

                link.click();

            }

            /* ==================================
               IMPORT TEMPLATE FILE
            ================================== */

            function importTemplate(file) {

                let reader =
                    new FileReader();

                reader.onload =
                    function(e) {

                        let data =
                            JSON.parse(
                                e.target.result
                            );

                        restorePositions(
                            data.positions
                        );

                        $('#fontFamily')
                            .val(data.fontFamily)
                            .trigger('change');

                        $('#fontWeight')
                            .val(data.fontWeight)
                            .trigger('change');

                        $('#cardTextColor')
                            .val(data.textColor)
                            .trigger('change');

                        $('#cardBgColor')
                            .val(data.bgColor)
                            .trigger('change');

                        $('#qrContent')
                            .val(data.qr);

                        $('#barcodeContent')
                            .val(data.barcode);

                        generateQRCode(
                            data.qr
                        );

                        generateBarcode(
                            data.barcode
                        );

                    };

                reader.readAsText(file);

            }

            /* ==================================
               KEYBOARD SHORTCUTS
            ================================== */

            $(document).keydown(function(e) {

                if (
                    e.ctrlKey &&
                    e.key === 's'
                ) {

                    e.preventDefault();

                    $('#saveTemplateBtn')
                        .click();
                }

                if (
                    e.ctrlKey &&
                    e.key === 'p'
                ) {

                    e.preventDefault();

                    printSingleCard();
                }

            });

            /* ==================================
               FINAL INIT
            ================================== */

            generateBarcode(
                'LIB-000001'
            );

            generateQRCode(
                'LIB-000001'
            );

            console.log(
                'Advanced Library Membership Designer Loaded'
            );


        });
    </script>
@endpush
