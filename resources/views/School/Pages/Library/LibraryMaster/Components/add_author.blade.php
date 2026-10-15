<!-- SECTION 1: TOP PANEL - AUTHOR CREATION CONSOLE -->
<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card mb-24 ">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="brand-pulse-icon">
                <i class="ri-user-add-line text-xl text-white"></i>
            </div>
            <div>
                <h6 class="text-lg fw-bold mb-0 text-gradient-primary">Author Provisioning Engine</h6>
                <p class="text-xs text-muted mb-0">Register, catalog, and configure content creator metadata
                    seamlessly</p>
            </div>
        </div>
        <span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-12 py-6 fw-semibold radius-8">
            <i class="ri-radar-line me-1 ripple-effect"></i> Catalog Core Active
        </span>
    </div>

    <div class="card-body p-24">
        <form id="authorRegistrationForm" class="ajaxForm" data-url="{{ route('school.library.author.save') }}"
            data-refresh="fetchRegisteredAuthors" data-method="POST" autocomplete="off">

            @csrf

            <input type="hidden" name="author_id" id="author_id">

            <div class="row gy-4 align-items-end">


                <div class="col-xl-4 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                            Author Full Name <span class="text-danger">*</span>
                        </label>
                        <div class="inner-addon">
                            <i class="ri-user-settings-line addon-icon"></i>
                            <input type="text" name="author_name" id="author_name"
                                class="form-control custom-premium-input" placeholder="e.g. Prince" required>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-md-6">
                    <div class="premium-input-box">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-8 d-block">
                            Biography & Bibliographic Notes
                        </label>
                        <div class="inner-addon">
                            <i class="ri-file-text-line addon-icon"></i>
                            <input type="text" name="description" id="description"
                                class="form-control custom-premium-input"
                                placeholder="Provide short background or notable works summary...">
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-md-6">
                    <div class="premium-input-box h-100">
                        <label class="text-xs fw-bold text-uppercase tracking-wider text-primary-light mb-12 d-block">
                            Catalog Distribution Status <span class="text-danger">*</span>
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

            </div>


            <div class="d-flex justify-content-end align-items-center gap-3 backend-action-bar">
                <button type="button" id="resetAuthorForm" class="btn btn-premium-action-secondary">
                    <i class="ri-refresh-line me-2"></i> Clear Configuration
                </button>
                <button type="submit" class="btn btn-premium-action-primary">
                    <i class="ri-save-3-line me-2"></i> Commit Author Profile
                </button>
            </div>
        </form>
    </div>
</div>

<div class="shadow-1 radius-12 bg-base overflow-hidden premium-generator-card">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="text-md fw-bold mb-0 text-dark-main text-uppercase tracking-wider">Verified Author Registry
            </h6>
            <p class="text-xs text-muted mb-0">System indexing records and active profile state matrix</p>
        </div>


        <div class="d-flex gap-3 align-items-center">
            <x-datatable--toolbar tableId="AuthorDataTable" />
        </div>
    </div>

    <div class="card-body p-3">

        <div class="table-responsive scrollable-class-registry">


            <table class="table bordered-table mb-0 data-table" id="AuthorDataTable" data-page-length="10">
                <thead class="position-sticky top-0 bg-base z-3 border-bottom">
                    <tr>
                        <th scope="col" style="width: 80px;" class="text-center">S.No.</th>
                        <th scope="col" style="width: 250px;">Author Identity</th>

                        <th scope="col" class="text-center" style="width: 160px;">System Status</th>
                        <th scope="col" class="text-center" style="width: 140px;">Operations</th>
                    </tr>
                </thead>
                <tbody id="authorRegistryTableBody">

                </tbody>
            </table>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {

            fetchRegisteredAuthors();

            $(document).on("click", ".edit-author-trigger", function() {
                let id = $(this).data("id");
                let name = $(this).data("name");
                let desc = $(this).data("desc");
                let status = $(this).data("status");

                $("#author_id").val(id);
                $("#author_name").val(name);
                $("#description").val(desc);

                if (status == 1) {
                    $("#status_active").prop("checked", true);
                } else {
                    $("#status_inactive").prop("checked", true);
                }

                // $(".text-gradient-primary").text("Modify Author Infrastructure Configuration");
                $("html, body").animate({
                    scrollTop: 0
                }, "fast");
            });

            $("#resetAuthorForm").on("click", function() {
                $("#author_id").val("");
                $("#authorRegistrationForm")[0].reset();
                $("#status_active").prop("checked", true);
                $(".text-gradient-primary").text("Author Provisioning Engine");
            });
        });

        function fetchRegisteredAuthors() {

            fetchMasterData(
                "{{ route('school.library.author.fetch') }}",
                function(res) {

                    let html = '';

                    if (res.status && res.data.length > 0) {

                        $.each(res.data, function(index, row) {

                            let initials = row.author_name
                                .split(' ')
                                .map(word => word.charAt(0))
                                .join('')
                                .substring(0, 2)
                                .toUpperCase();

                            let statusBadge = row.status == 1 ?
                                `<span class="status-badge badge-completed">
                            <span class="pulse-dot-green"></span>
                            Active Catalog
                        </span>` :
                                `<span class="status-badge badge-cancelled">
                            Archived
                        </span>`;

                            html += `
                        <tr class="author-record-row">

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
                                            ${row.author_name}
                                        </span>

                                        <small class="text-muted text-xs">
                                            ID: ${row.id}
                                        </small>
                                    </div>

                                </div>
                            </td>

                            <td class="text-center">
                                ${statusBadge}
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-primary radius-6 py-4 px-8 edit-author-trigger"
                                        data-id="${row.id}"
                                        title="Edit">

                                        <i class="ri-edit-box-line"></i>

                                    </button>

                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-danger radius-6 py-4 px-8 delete-author-trigger deleteLibraryAuthor"
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
                        <td colspan="4" class="text-center py-4">
                            No Records Found
                        </td>
                    </tr>
                `;
                    }

                    if ($.fn.DataTable.isDataTable('#AuthorDataTable')) {
                        $('#AuthorDataTable')
                            .DataTable()
                            .destroy();
                    }
                    $("#authorRegistryTableBody").html(html);

                    $('#AuthorDataTable').DataTable({
                        pageLength: 10
                    });



                }
            );
        }


        $(document).on("click", ".edit-author-trigger", function() {

            let id = $(this).data("id");

            getDataById(
                "{{ route('school.library.author.get') }}",
                id,
                function(res) {

                    if (!res.status) {
                        return;
                    }

                    let row = res.data;

                    $("#author_id").val(row.id);
                    $("#author_name").val(row.author_name);
                    $("#description").val(row.description);

                    if (row.status == 1) {
                        $("#status_active").prop("checked", true);
                    } else {
                        $("#status_inactive").prop("checked", true);
                    }

                    // $(".text-gradient-primary")
                    //     .text("Modify Author Infrastructure Configuration");

                    $("html, body").animate({
                        scrollTop: 0
                    }, 300);
                }
            );

        });


        $("#resetAuthorForm").on("click", function() {

            $("#authorRegistrationForm")[0].reset();

            $("#author_id").val("");

            $("#status_active").prop("checked", true);

            $(".text-gradient-primary")
                .text("Author Provisioning Engine");
        });
    </script>
@endpush
