<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24">

    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">

        <div class="d-flex align-items-center gap-3">

            <div class="brand-pulse-icon">
                <i class="ri-barcode-box-line text-xl text-white"></i>
            </div>

            <div>
                <h6 class="text-lg fw-bold mb-0 text-gradient-primary">
                    Barcode Generation Engine
                </h6>

                <p class="text-xs text-muted mb-0">
                    Generate premium CODE128 barcode sheets with print-ready cut marks
                </p>
            </div>

        </div>

        <span class="badge bg-success-50 text-success-700 border border-success-200 px-12 py-6 fw-semibold radius-8">
            <i class="ri-flashlight-line me-1"></i>
            Generator Active
        </span>

    </div>

    <div class="card-body p-24">

        <div class="row gy-4">

            <div class="col-lg-3">

                <div class="premium-input-box">

                    <label class="premium-label">
                        Starting Number
                    </label>

                    <input type="number" id="startNumber" class="form-control custom-premium-input" value="100001">

                </div>

            </div>

            <div class="col-lg-3">

                <div class="premium-input-box">

                    <label class="premium-label">
                        Prefix
                    </label>

                    <input type="text" id="prefix" class="form-control custom-premium-input" value="LIB">

                </div>

            </div>

            <div class="col-lg-3">

                <div class="premium-input-box">

                    <label class="premium-label">
                        Total Barcodes
                    </label>

                    <input type="number" id="totalBarcode" class="form-control custom-premium-input" value="40">

                </div>

            </div>

            <div class="col-lg-3">

                <div class="premium-input-box">

                    <label class="premium-label">
                        Barcode Height
                    </label>

                    <input type="number" id="barcodeHeight" class="form-control custom-premium-input" value="50">

                </div>

            </div>

        </div>

        <div class="mt-24 d-flex gap-3 justify-content-end">

            <button type="button" id="clearBarcodeBtn" class="btn btn-premium-action-secondary">

                <i class="ri-refresh-line me-2"></i>
                Clear

            </button>

            <button type="button" id="generateBarcodeBtn" class="btn btn-premium-action-primary">

                <i class="ri-barcode-box-line me-2"></i>
                Generate Sheet

            </button>

        </div>

    </div>

</div>

<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card">

    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center">

        <div>
            <h6 class="text-md fw-bold mb-1">
                Generated Barcode Sheet
            </h6>

            <p class="text-xs text-muted mb-0">
                Print ready barcode inventory with cut marks
            </p>
        </div>

        <button type="button" id="printBarcodeSheet" class="btn btn-success ms-auto">

            <i class="ri-printer-line me-2"></i>
            Print Sheet

        </button>

    </div>

    <div class="card-body p-24">

        <div id="barcodeSheet" class="barcode-sheet-container">

        </div>

    </div>

</div>


@push('styles')
    <style>
        .barcode-sheet-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
        }

        .barcode-item {
            position: relative;
            border: 1px dashed #cbd5e1;
            background: #fff;
            height: 90px;
            padding: 6px;
            text-align: center;
            overflow: hidden;
        }

        .barcode-svg {
            width: 100%;
            height: 42px;
        }

        .barcode-number {
            margin-top: 2px;
            font-weight: 700;
            font-size: 10px;
            letter-spacing: 1px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cut-top-left,
        .cut-top-right,
        .cut-bottom-left,
        .cut-bottom-right {
            position: absolute;
            width: 12px;
            height: 12px;
        }

        .cut-top-left {
            top: -1px;
            left: -1px;
            border-top: 1.5px solid #000;
            border-left: 1.5px solid #000;
        }

        .cut-top-right {
            top: -1px;
            right: -1px;
            border-top: 1.5px solid #000;
            border-right: 1.5px solid #000;
        }

        .cut-bottom-left {
            bottom: -1px;
            left: -1px;
            border-bottom: 1.5px solid #000;
            border-left: 1.5px solid #000;
        }

        .cut-bottom-right {
            bottom: -1px;
            right: -1px;
            border-bottom: 1.5px solid #000;
            border-right: 1.5px solid #000;
        }

        @media print {

            body * {
                visibility: hidden;
            }

            #barcodeSheet,
            #barcodeSheet * {
                visibility: visible;
            }

            #barcodeSheet {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }

            .barcode-sheet-container {
                grid-template-columns: repeat(4, 1fr);
                gap: 10px;
            }

            .barcode-item {
                break-inside: avoid;
                page-break-inside: avoid;
            }
        }
    </style>
@endpush

@push('script')
    <script type="text/template" id="barcodeTemplate">

            <div class="barcode-item">

                <span class="cut-top-left"></span>
                <span class="cut-top-right"></span>
                <span class="cut-bottom-left"></span>
                <span class="cut-bottom-right"></span>

                <svg class="barcode-svg"></svg>

                <div class="barcode-number"></div>

            </div>

    </script>

    <script>
        $(function() {

            $("#generateBarcodeBtn").on("click", function() {

                let startNumber = parseInt($("#startNumber").val());
                let prefix = $("#prefix").val();
                let total = parseInt($("#totalBarcode").val());
                let height = parseInt($("#barcodeHeight").val());

                let html = '';

                for (let i = 0; i < total; i++) {

                    let code = prefix + (startNumber + i);

                    html += `
                            <div class="barcode-item">

                                <span class="cut-top-left"></span>
                                <span class="cut-top-right"></span>
                                <span class="cut-bottom-left"></span>
                                <span class="cut-bottom-right"></span>

                                <svg id="barcode_${i}" class="barcode-svg"></svg>

                                <div class="barcode-number">
                                    ${code}
                                </div>

                            </div>
                        `;
                }

                $("#barcodeSheet").html(html);

                for (let i = 0; i < total; i++) {

                    let code = prefix + (startNumber + i);

                    JsBarcode(
                        "#barcode_" + i,
                        code, {
                            format: "CODE128",
                            displayValue: false,
                            height: 38,
                            width: 1.2,
                            margin: 0
                        }
                    );
                }

            });

            $("#clearBarcodeBtn").on("click", function() {

                $("#barcodeSheet").html('');

            });



            $("#printBarcodeSheet").on("click", function() {

                let barcodeSheet = $("#barcodeSheet").prop("outerHTML");

                let styles = '';

                $('link[rel="stylesheet"], style').each(function() {
                    styles += $(this).prop('outerHTML');
                });

                let win = window.open('', '_blank');

                win.document.write(`
                    <html>
                    <head>
                        <title>Barcode Sheet</title>

                        ${styles}
                    <style>

                        body{
                            margin:8mm;
                            background:#fff;
                        }

                        .barcode-sheet-container{
                            display:grid;
                            grid-template-columns:repeat(5,1fr);
                            gap:8px;
                        }

                        .barcode-item{
                            position:relative;
                            border:1px dashed #cbd5e1;
                            background:#fff;
                            height:90px;
                            padding:6px;
                            text-align:center;
                            overflow:hidden;
                            break-inside:avoid;
                            page-break-inside:avoid;
                        }

                        .barcode-svg{
                            width:100%;
                            height:42px;
                        }

                        .barcode-number{
                            margin-top:2px;
                            font-weight:700;
                            font-size:10px;
                            letter-spacing:1px;
                        }

                        .cut-top-left,
                        .cut-top-right,
                        .cut-bottom-left,
                        .cut-bottom-right{
                            position:absolute;
                            width:12px;
                            height:12px;
                        }

                        .cut-top-left{
                            top:-1px;
                            left:-1px;
                            border-top:1.5px solid #000;
                            border-left:1.5px solid #000;
                        }

                        .cut-top-right{
                            top:-1px;
                            right:-1px;
                            border-top:1.5px solid #000;
                            border-right:1.5px solid #000;
                        }

                        .cut-bottom-left{
                            bottom:-1px;
                            left:-1px;
                            border-bottom:1.5px solid #000;
                            border-left:1.5px solid #000;
                        }

                        .cut-bottom-right{
                            bottom:-1px;
                            right:-1px;
                            border-bottom:1.5px solid #000;
                            border-right:1.5px solid #000;
                        }

                        @page{
                            size:A4 portrait;
                            margin:8mm;
                        }

                    </style>

                    </head>

                    <body>

                        ${barcodeSheet}

                    </body>

                    </html>
                `);

                win.document.close();

                setTimeout(function() {

                    win.focus();
                    win.print();
                    win.close();

                }, 1000);

            });

        });
    </script>
@endpush
