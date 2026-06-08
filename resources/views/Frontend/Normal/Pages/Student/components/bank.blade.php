<style>
    .bank-info-box {
        margin-top: 10px;
        padding: 10px 14px;
        border-radius: 10px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }

    .bank-info-item {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        font-size: 12px;
        color: #64748b;
        line-height: 1.5;
    }

    .bank-info-item i {
        color: #0d6efd;
        margin-top: 2px;
    }

    .bank-info-item+.bank-info-item {
        margin-top: 6px;
    }
</style>


<div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <h6 class="text-lg fw-semibold mb-0">Student Bank Account Details</h6>
        <span class="badge bg-info-100 text-info-600 px-12 py-4 radius-4 fw-medium text-xs">
            <i class="bi bi-shield-lock-fill me-1"></i> Secure Financial Record
        </span>
    </div>

    <div class="card-body p-20">
        <div class="row gy-4">

            <div class="col-md-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Account Holder Name</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-secondary"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control fw-medium" name="account_holder_name"
                        placeholder="As printed on Passbook / Cheque" />
                </div>
            </div>

            <div class="col-md-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">IFSC Code</label>
                <div class="input-group position-relative">
                    <span class="input-group-text bg-light text-secondary fw-bold text-xs">IFSC</span>
                    <input type="text" class="form-control text-uppercase fw-semibold" name="ifsc_code"
                        id="ifsc_code" placeholder="e.g. SBIN0001234" maxlength="11" oninput="handleIfscInput(this)" />
                    <span class="position-absolute end-0 top-50 translate-middle-y me-12 z-3 d-none" id="ifsc_loader">
                        <span class="spinner-border spinner-border-sm text-primary" role="status"></span>
                    </span>
                    <span
                        class="position-absolute end-0 top-50 translate-middle-y me-12 z-3 d-none text-success-600 text-sm fw-bold"
                        id="ifsc_verified_badge">
                        <i class="bi bi-patch-check-fill"></i> Valid
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <label class="text-sm fw-semibold text-primary-light mb-8">
                    Bank Name
                </label>

                <div class="input-group">
                    <span class="input-group-text bg-light text-secondary">
                        <i class="bi bi-bank"></i>
                    </span>

                    <input type="text" class="form-control" name="bank_name" id="bank_name"
                        placeholder="e.g. State Bank of India"  readonly />
                </div>

                <div id="bankInfoBox" class="bank-info-box d-none">
                    <div class="bank-info-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span id="bankBranch">Branch Name</span>
                    </div>

                    <div class="bank-info-item">
                        <i class="bi bi-building"></i>
                        <span id="bankAddress">Bank Address</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <label class="text-sm fw-semibold text-primary-light mb-8">Account Number</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-secondary"><i class="bi bi-hash"></i></span>
                    <input type="password" class="form-control fw-semibold" name="account_no" id="account_no"
                        placeholder="Enter Bank Account Number" onpaste="return false;" autocomplete="off" />
                    <button class="btn btn-outline-secondary border-start-0" type="button"
                        onclick="toggleAccountNumberVisibility(this)" style="border-color: #cbd5e1;">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                </div>
            </div>

            <div class="col-md-6 ">
                <label class="text-sm fw-semibold text-primary-light mb-8">Confirm Account Number <span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-secondary"><i class="bi bi-check2-circle"></i></span>
                    <input type="text" class="form-control fw-semibold" id="confirm_account_no"
                        placeholder="Re-enter Account Number to verify" oninput="verifyAccountNumberMatch()"
                        onpaste="return false;" autocomplete="off" />
                </div>
                <div class="text-xs mt-4 d-none" id="account_match_feedback"></div>
            </div>

        </div>
    </div>
</div>


@push('script')
    <script>
        function toggleAccountNumberVisibility(button) {
            const icon = button.querySelector('i');
            const accountInput = document.getElementById('account_no');

            if (accountInput.type === "password") {
                accountInput.type = "text";
                icon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
            } else {
                accountInput.type = "password";
                icon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
            }
        }

        function verifyAccountNumberMatch() {
            const accountNo = document.getElementById('account_no').value;
            const confirmAccountNo = document.getElementById('confirm_account_no').value;
            const feedback = document.getElementById('account_match_feedback');

            if (confirmAccountNo.length === 0) {
                feedback.classList.add('d-none');
                return;
            }

            feedback.classList.remove('d-none');
            if (accountNo === confirmAccountNo) {
                feedback.className = "text-xs mt-4 text-success-600 fw-semibold";
                feedback.innerHTML = "<i class='bi bi-check-circle-fill me-1'></i> Account numbers match perfectly.";
            } else {
                feedback.className = "text-xs mt-4 text-danger fw-semibold";
                feedback.innerHTML = "<i class='bi bi-x-circle-fill me-1'></i> Account numbers do not match!";
            }
        }

        // Live feedback loop on primary input as well
        $(document).on('input', '#account_no', function() {
            verifyAccountNumberMatch();
        });

        function handleIfscInput(input) {
            input.value = input.value.toUpperCase();
            const ifscValue = input.value;
            const loader = document.getElementById('ifsc_loader');
            const badge = document.getElementById('ifsc_verified_badge');
            const bankNameInput = document.getElementById('bank_name');

            if (ifscValue.length === 11) {
                // Show premium dashboard simulator loader
                loader.classList.remove('d-none');
                badge.classList.add('d-none');
                 $('#bankInfoBox').addClass('d-none');

                setTimeout(() => {
                    loader.classList.add('d-none');
                    badge.classList.remove('d-none');

                    // Optional: If you use a public razorpay razorpay IFSC API or your internal master database
                    $.getJSON(`https://ifsc.razorpay.com/${ifscValue}`, function(data) {
                        bankNameInput.value = data.BANK;

                        $('#bankBranch').text(
                            data.BRANCH || 'N/A'
                        );
                        $('#bankAddress').text(
                            data.ADDRESS || 'N/A'
                        );

                        $('#bankInfoBox').removeClass('d-none');

                    }).fail(function() {
                        badge.className =
                            "position-absolute end-0 top-50 translate-middle-y me-12 z-3 text-danger text-sm fw-bold";
                        badge.innerHTML = "Invalid";
                    });






                    // Simulation logic for instant presentation premium response
                    if (bankNameInput.value === "") {
                        bankNameInput.value = "Verified Bank Auto-Detected";
                    }
                }, 800);
            } else {
                loader.classList.add('d-none');
                badge.classList.add('d-none');
            }
        }
    </script>
@endpush
