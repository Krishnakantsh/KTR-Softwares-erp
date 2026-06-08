{{-- ================================
    HOUSES MODAL
================================ --}}

<div class="modal fade" id="housesModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 rounded-4 overflow-hidden">

            <div class="modal-header border-0 bg-primary bg-gradient px-4 py-3">

                <div class="px-16">

                    <h5 class="modal-title fw-bold text-white mb-1">
                        Houses Management
                    </h5>

                    <p class="text-white-50 small mb-0">
                        Create and manage houses
                    </p>

                </div>

                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>

            </div>

            <form id="houseForm" class="ajaxForm p-16" enctype="multipart/form-data"
                data-url="{{ route('school.house.save') }}" data-refresh="getHouseList" data-method="POST">

                @csrf

                <input type="hidden" name="id" id="house_id">

                <div class="modal-body p-4">

                    <div class="row g-4">

                        <div class="col-md-12">

                            <label class="form-label fw-semibold">
                                House Name
                            </label>

                            <input type="text" name="name" id="house_name" class="form-control premium-input"
                                placeholder="Enter house name">

                        </div>


                        <div class="col-md-12">

                            <label class="form-label fw-semibold">
                                Status
                            </label>

                            <select class="form-select premium-input" name="status" id="house_status">

                                <option value="1">
                                    Active
                                </option>

                                <option value="0">
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                <div class="modal-footer border-0">

                    <button type="button" class="btn btn-light rounded-pill px-16" data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit" class="btn btn-primary rounded-pill px-16">

                        <i class="ri-save-line me-1"></i>

                        Save House

                    </button>

                </div>

            </form>

            {{-- LIST --}}

            <div class="border-top p-16">

                <h6 class="fw-bold mb-3">
                    Houses List
                </h6>

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Name</th>

                                <th>Status</th>

                                <th width="80">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody id="houseTableBody">

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- ================================
    STREAM MODAL
================================ --}}

<div class="modal fade" id="streamModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 rounded-4 overflow-hidden">

            <div class="modal-header border-0 bg-success bg-gradient px-4 py-3">

                <div class="px-16">

                    <h5 class="modal-title fw-bold text-white mb-1">
                        Stream Management
                    </h5>

                    <p class="text-white-50 small mb-0">
                        Create and manage streams
                    </p>

                </div>

                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>

            </div>

            <form id="streamForm" class="ajaxForm p-16 px-md-16" data-url="{{ route('school.stream.master.save') }}"
                data-refresh="getStreamList" data-method="POST">

                @csrf

                <input type="hidden" name="stream_id" id="stream_id">

                <div class="modal-body p-4">

                    <div class="row g-4">

                        <div class="col-md-12">

                            <label class="form-label fw-semibold">
                                Stream Name
                            </label>

                            <input type="text" name="name" id="stream_name" class="form-control premium-input"
                                placeholder="Enter stream name">

                        </div>


                    </div>

                </div>

                <div class="modal-footer border-0">

                    <button type="submit" class="btn btn-success rounded-pill px-16">

                        Save Stream

                    </button>

                </div>

            </form>

            <div class="border-top p-16">

                <h6 class="fw-bold mb-3">
                    Stream List
                </h6>

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Name</th>

                                <th>Status</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody id="streamTableBody">

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- ================================
    CONCESSION BY MODAL
================================ --}}

<div class="modal fade" id="concessionByModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 rounded-4 overflow-hidden">

            <div class="modal-header border-0 bg-warning bg-gradient px-4 py-3">

                <div class="px-16">

                    <h5 class="modal-title fw-bold text-dark mb-1">
                        Concession By
                    </h5>

                </div>

                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>

            </div>

            <form id="concessionByForm" class="ajaxForm p-16" data-url="{{ route('school.concession.by.save') }}"
                data-refresh="getConcessionByList" data-method="POST">

                @csrf

                <input type="hidden" name="id" id="concession_by_id">

                <div class="modal-body p-4">

                    <div class="row g-4">

                        <div class="col-md-12">

                            <label class="form-label fw-semibold">
                                Name
                            </label>

                            <input type="text" name="name" id="concession_by_name"
                                class="form-control premium-input" placeholder="Concession By ">

                        </div>

                    </div>

                </div>

                <div class="modal-footer border-0">

                    <button type="submit" class="btn btn-warning rounded-pill px-16">

                        Save

                    </button>

                </div>

            </form>

            <div class="border-top p-16">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Name</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody id="concessionByTableBody">

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

{{-- ================================
    CONCESSION TYPE MODAL
================================ --}}

<div class="modal fade" id="concessionTypeModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 rounded-4 overflow-hidden">

            <div class="modal-header border-0 bg-danger bg-gradient px-4 py-3">
                <div class="px-16">
                    <h5 class="modal-title fw-bold text-white mb-1">
                        Concession Type
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none"
                    data-bs-dismiss="modal"></button>
            </div>

            <form id="concessionTypeForm" class="ajaxForm px-16"
                data-url="{{ route('school.concession.type.save') }}" data-refresh="getConcessionTypeList"
                data-method="POST">
                @csrf
                <input type="hidden" name="id" id="concession_type_id">
                <div class="modal-body p-4">
                    <div class="row g-4 align-items-end mb-3">
                        <!-- Name -->
                        <div class="col-md-12">
                            <label class="form-label fw-semibold text-dark mb-2">
                                Concession Type
                            </label>

                            <input type="text" name="name" id="concession_type_name"
                                placeholder="Enter concession type" class="form-control premium-input">

                        </div>

                        <!-- Status -->

                        <div class="col-md-8">

                            <label class="form-label fw-semibold text-dark mb-2">
                                Status
                            </label>

                            <select class="form-select premium-input" name="status" id="house_status">

                                <option value="1">
                                    Active
                                </option>

                                <option value="0">
                                    Inactive
                                </option>

                            </select>

                        </div>

                        <!-- Button -->

                        <div class="col-md-4">

                            <button type="submit"
                                class="btn btn-danger w-100 h-100 rounded-3 fw-semibold d-flex align-items-center justify-content-center gap-2">

                                <i class="ri-save-line"></i>

                                Save

                            </button>

                        </div>

                    </div>

                </div>
            </form>

            <div class="border-top p-16">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Name</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody id="concessionTypeTableBody">

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

{{-- ================================
    STYLE
================================ --}}

<style>
    .premium-input {
        height: 52px;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: none !important;
    }

    .premium-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, .08) !important;
    }
</style>










@push('script')
    <script>
        /*
                                        |--------------------------------------------------------------------------
                                        | HOUSE LIST
                                        |--------------------------------------------------------------------------
                                        */

        window.getHouseList = function() {

            $.ajax({

                url: "{{ route('school.house.fetch') }}",

                method: "GET",

                success: function(res) {

                    let rows = '';

                    $.each(res.data, function(index, d) {

                        rows += `

                        <tr>

                            <td>${index + 1}</td>

                            <td>${d.name ?? ''}</td>

                            <td>
                                ${d.status == 1
                                    ? '<span class="badge bg-success">Active</span>'
                                    : '<span class="badge bg-danger">Inactive</span>'
                                }
                            </td>

                            <td>

                            
                                   <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="editHouse  role">
                                    <i class="ri-edit-fill custom-btn-primary"></i>

                                </button>

                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="deleteHouse">

                                    <i class="ri-delete-bin-fill custom-btn-red"></i>

                                </button>

                            </td>

                        </tr>

                    `;

                    });

                    $('#houseTableBody').html(rows);

                }

            });

        }

        /*
        |--------------------------------------------------------------------------
        | STREAM LIST
        |--------------------------------------------------------------------------
        */

        window.getStreamList = function() {

            $.ajax({

                url: "{{ route('school.stream.master.fetch') }}",

                method: "GET",

                success: function(res) {

                    let rows = '';

                    $.each(res.data, function(index, d) {

                        rows += `

                        <tr>

                            <td>${index + 1}</td>

                            <td>${d.name ?? ''}</td>

                            <td>
                                ${d.status == 1
                                    ? '<span class="badge bg-success">Active</span>'
                                    : '<span class="badge bg-danger">Inactive</span>'
                                }
                            </td>

                            <td>


                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="editStream  role">
                                    <i class="ri-edit-fill custom-btn-primary"></i>

                                </button>

                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="deleteStream">

                                    <i class="ri-delete-bin-fill custom-btn-red"></i>

                                </button>

                            </td>

                        </tr>

                    `;

                    });

                    $('#streamTableBody').html(rows);

                }

            });

        }

        /*
        |--------------------------------------------------------------------------
        | CONCESSION BY LIST
        |--------------------------------------------------------------------------
        */

        window.getConcessionByList = function() {

            $.ajax({

                url: "{{ route('school.concession.by.fetch') }}",

                method: "GET",

                success: function(res) {

                    let rows = '';

                    $.each(res.data, function(index, d) {

                        rows += `

                        <tr>

                            <td>${index + 1}</td>

                            <td>${d.name ?? ''}</td>

                            <td>
                                ${d.status == 1
                                    ? '<span class="badge bg-success">Active</span>'
                                    : '<span class="badge bg-danger">Inactive</span>'
                                }
                            </td>

                            <td>

                              
                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="editConcessionBy  role">
                                    <i class="ri-edit-fill custom-btn-primary"></i>

                                </button>

                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="deleteConcessionBy">

                                    <i class="ri-delete-bin-fill custom-btn-red"></i>

                                </button>

                            </td>

                        </tr>

                    `;

                    });

                    $('#concessionByTableBody').html(rows);

                }

            });

        }

        /*
        |--------------------------------------------------------------------------
        | CONCESSION TYPE LIST
        |--------------------------------------------------------------------------
        */

        window.getConcessionTypeList = function() {

            $.ajax({

                url: "{{ route('school.concession.type.fetch') }}",

                method: "GET",

                success: function(res) {

                    let rows = '';

                    $.each(res.data, function(index, d) {

                        rows += `

                        <tr>

                            <td>${index + 1}</td>

                            <td>${d.name ?? ''}</td>

                            <td>
                                ${d.status == 1
                                    ? '<span class="badge bg-success">Active</span>'
                                    : '<span class="badge bg-danger">Inactive</span>'
                                }
                            </td>

                            <td>                                          
                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="editConcessionType  role">
                                    <i class="ri-edit-fill custom-btn-primary"></i>

                                </button>

                                <button
                                    type="button"
                                    data-id="${d.id}"
                                    class="deleteConcessionType">

                                    <i class="ri-delete-bin-fill custom-btn-red"></i>

                                </button>

                            </td>

                        </tr>

                    `;

                    });

                    $('#concessionTypeTableBody').html(rows);

                }

            });

        }

        /*
        |--------------------------------------------------------------------------
        | EDIT HOUSE
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.editHouse', function() {

            let id = $(this).data('id');

            $.ajax({

                url: "{{ route('school.house.get') }}",

                method: "GET",

                data: {
                    id: id
                },

                success: function(res) {

                    if (res.status) {

                        $('#house_id').val(res.data.id);

                        $('#house_name').val(res.data.name);

                        $('#house_slug').val(res.data.slug);

                        $('#house_status').val(res.data.status);

                        $('#housesModal').modal('show');

                    }

                }

            });

        });

        /*
        |--------------------------------------------------------------------------
        | EDIT STREAM
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.editStream', function() {

            let id = $(this).data('id');

            $.ajax({

                url: "{{ route('school.stream.master.get') }}",

                method: "GET",

                data: {
                    id: id
                },

                success: function(res) {

                    if (res.status) {

                        $('#stream_id').val(res.data.id);

                        $('#stream_name').val(res.data.name);

                        $('#streamModal').modal('show');

                    }

                }

            });

        });

        /*
        |--------------------------------------------------------------------------
        | EDIT CONCESSION BY
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.editConcessionBy', function() {

            let id = $(this).data('id');

            $.ajax({

                url: "{{ route('school.concession.by.get') }}",

                method: "GET",

                data: {
                    id: id
                },

                success: function(res) {

                    if (res.status) {

                        $('#concession_by_id').val(res.data.id);

                        $('#concession_by_name').val(res.data.name);

                        $('#concession_by_slug').val(res.data.slug);

                        $('#concessionByModal').modal('show');

                    }

                }

            });

        });

        /*
        |--------------------------------------------------------------------------
        | EDIT CONCESSION TYPE
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.editConcessionType', function() {

            let id = $(this).data('id');

            $.ajax({

                url: "{{ route('school.concession.type.get') }}",

                method: "GET",

                data: {
                    id: id
                },

                success: function(res) {

                    if (res.status) {

                        $('#concession_type_id').val(res.data.id);

                        $('#concession_type_name').val(res.data.name);

                        $('#concession_type_slug').val(res.data.slug);

                        $('#concessionTypeModal').modal('show');

                    }

                }

            });

        });

        /*
        |--------------------------------------------------------------------------
        | RESET FORM WHEN MODAL CLOSE
        |--------------------------------------------------------------------------
        */

        $('#housesModal').on('hidden.bs.modal', function() {

            $('#houseForm')[0].reset();

            $('#house_id').val('');

        });

        $('#streamModal').on('hidden.bs.modal', function() {

            $('#streamForm')[0].reset();

            $('#stream_id').val('');

        });

        $('#concessionByModal').on('hidden.bs.modal', function() {

            $('#concessionByForm')[0].reset();

            $('#concession_by_id').val('');

        });

        $('#concessionTypeModal').on('hidden.bs.modal', function() {

            $('#concessionTypeForm')[0].reset();

            $('#concession_type_id').val('');

        });

        /*
        |--------------------------------------------------------------------------
        | INITIAL LOAD
        |--------------------------------------------------------------------------
        */

        $(document).ready(function() {

            getHouseList();

            getStreamList();

            getConcessionByList();

            getConcessionTypeList();

        });
    </script>
@endpush
