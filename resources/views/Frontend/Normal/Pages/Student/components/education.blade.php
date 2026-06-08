<div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <h6 class="text-lg fw-semibold mb-0">Student Academic / Education History</h6>
        <button type="button" class="btn btn-sm btn-primary-50 text-primary-600 fw-bold radius-8"
            onclick="addEducationRow()">
            <i class="bi bi-plus-lg me-1"></i> Add Educational Record
        </button>
    </div>

    <div class="card-body p-20">
        <div class="table-responsive">
            <table class="table table-borderless align-middle" id="education_details_table">
                <thead>
                    <tr class="border-bottom" style="background: #f8fafc;">
                        <th class="text-xs fw-bold text-uppercase text-secondary-light py-12 px-10" style="width: 25%;">
                            Course / Diploma / Degree</th>
                        <th class="text-xs fw-bold text-uppercase text-secondary-light py-12 px-10" style="width: 15%;">
                            Board / University</th>
                        <th class="text-xs fw-bold text-uppercase text-secondary-light py-12 px-10" style="width: 12%;">
                            Roll No.</th>
                        <th class="text-xs fw-bold text-uppercase text-secondary-light py-12 px-10" style="width: 12%;">
                            Passing Year</th>
                        <th class="text-xs fw-bold text-uppercase text-secondary-light py-12 px-10" style="width: 10%;">
                            Total Marks</th>
                        <th class="text-xs fw-bold text-uppercase text-secondary-light py-12 px-10" style="width: 10%;">
                            Obtained Marks</th>
                        <th class="text-xs fw-bold text-uppercase text-secondary-light py-12 px-10" style="width: 10%;">
                            Percentage (%)</th>
                        <th class="text-xs fw-bold text-uppercase text-secondary-light py-12 px-10 text-center"
                            style="width: 6%;">Action</th>
                    </tr>
                </thead>
                <tbody id="education_row_container">
                    <tr class="education-row border-bottom">
                        <input type="hidden"
                                    name="education[0][id]"
                                    value="">
                        <td class="p-10">
                            <input type="text" class="form-control" name="education[0][course]"
                                placeholder="e.g. 10th, Diploma, BCA"  />
                        </td>
                        <td class="p-10">
                            <input type="text" class="form-control" name="education[0][board_name]"
                                placeholder="e.g. CBSE, Tech Board" />
                        </td>
                        <td class="p-10">
                            <input type="text" class="form-control" name="education[0][roll_no]"
                                placeholder="Roll No." />
                        </td>
                        <td class="p-10">
                            <input type="text" class="form-control" name="education[0][passing_year]"
                                placeholder="YYYY" maxlength="4" />
                        </td>
                        <td class="p-10">
                            <input type="number" class="form-control total-marks" name="education[0][marks]"
                                placeholder="Total" oninput="calculatePercentage(this)" />
                        </td>
                        <td class="p-10">
                            <input type="number" class="form-control obtained-marks" name="education[0][obtain]"
                                placeholder="Obtained" oninput="calculatePercentage(this)" />
                        </td>
                        <td class="p-10">
                            <input type="text"
                                class="form-control percentage-field bg-light fw-semibold text-primary-600"
                                name="education[0][percentage]" placeholder="0.00%" readonly />
                        </td>
                        <td class="p-10 text-center">
                            <button type="button" class="btn btn-sm btn-outline-danger radius-8 p-8 opacity-50"
                                disabled style="cursor: not-allowed;">
                                <i class="bi bi-trash-fill d-block"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


@push('script')
    <script>
        let educationRowIdx = 1;

        function addEducationRow() {
         

            const container = document.getElementById('education_row_container');

            const newRow = document.createElement('tr');
            newRow.className = 'education-row border-bottom style="animation: fadeIn 0.3s ease-in-out;"';
            newRow.id = `edu_row_${educationRowIdx}`;

            newRow.innerHTML = `
            
                <input type="hidden"  name="education[${educationRowIdx}][id]"  value="">

                <td class="p-10">
                    <input type="text" class="form-control" name="education[${educationRowIdx}][course]" placeholder="e.g. 12th, Degree, Certificate" required />
                </td>
                <td class="p-10">
                    <input type="text" class="form-control" name="education[${educationRowIdx}][board_name]" placeholder="e.g. CBSE, University" />
                </td>
                <td class="p-10">
                    <input type="text" class="form-control" name="education[${educationRowIdx}][roll_no]" placeholder="Roll No." />
                </td>
                <td class="p-10">
                    <input type="text" class="form-control" name="education[${educationRowIdx}][passing_year]" placeholder="YYYY" maxlength="4" />
                </td>
                <td class="p-10">
                    <input type="number" class="form-control total-marks" name="education[${educationRowIdx}][marks]" placeholder="Total" oninput="calculatePercentage(this)" />
                </td>
                <td class="p-10">
                    <input type="number" class="form-control obtained-marks" name="education[${educationRowIdx}][obtain]" placeholder="Obtained" oninput="calculatePercentage(this)" />
                </td>
                <td class="p-10">
                    <input type="text" class="form-control percentage-field bg-light fw-semibold text-primary-600" name="education[${educationRowIdx}][percentage]" placeholder="0.00%" readonly />
                </td>
                <td class="p-10 text-center">
                    <button type="button" class="btn btn-sm btn-outline-danger radius-8 p-8" onclick="removeEducationRow(${educationRowIdx})">
                        <i class="bi bi-trash-fill d-block"></i>
                    </button>
                </td>
            `;

            container.appendChild(newRow);
            educationRowIdx++;
        }

        function removeEducationRow(idx) {
            const row = document.getElementById(`edu_row_${idx}`);
            if (row) {
                row.style.opacity = '0';
                setTimeout(() => {
                    row.remove();
                }, 200);
            }
        }

        function calculatePercentage(element) {
            const row = element.closest('.education-row');
            const totalMarksInput = row.querySelector('.total-marks');
            const obtainedMarksInput = row.querySelector('.obtained-marks');
            const percentageInput = row.querySelector('.percentage-field');

            const total = parseFloat(totalMarksInput.value);
            const obtained = parseFloat(obtainedMarksInput.value);

            if (total > 0 && obtained >= 0) {
                if (obtained > total) {
                    percentageInput.value = "Invalid";
                    percentageInput.classList.replace('text-primary-600', 'text-danger');
                } else {
                    const percentage = ((obtained / total) * 100).toFixed(2);
                    percentageInput.value = percentage + '%';
                    percentageInput.classList.replace('text-danger', 'text-primary-600');
                }
            } else {
                percentageInput.value = '';
            }
        }
    </script>
@endpush
