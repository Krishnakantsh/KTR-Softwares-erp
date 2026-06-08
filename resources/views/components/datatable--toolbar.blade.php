<div class="datatable-toolbar" data-table="{{ $tableId }}">

    <div
        class="d-flex align-items-center justify-content-between flex-wrap gap-16 px-20 py-12 border-bottom border-neutral-200">

        <div class="d-flex flex-wrap align-items-center gap-16">

            <!-- Export -->
            <div class="dropdown">
                <button type="button"
                    class="px-12 py-5-px border border-neutral-300 radius-8 d-flex align-items-center gap-20"
                    data-bs-toggle="dropdown">

                    <span class="d-flex align-items-center gap-1 text-secondary-light text-sm">
                        <i class="ri-file-upload-line text-md line-height-1"></i> Export
                    </span>
                    <span class="">
                        <i class="ri-arrow-down-s-line"></i>
                    </span>
                </button>

                <ul class="dropdown-menu p-12 border bg-base shadow">
                    <li>

                        <button type="button"
                            class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10 export-pdf"
                            data-bs-toggle="modal" data-bs-target="#exampleModalView">
                            <i class="ri-file-3-line"></i>
                            PDF
                        </button>
                    </li>
                    <li>

                        <button type="button"
                            class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10 export-excel"
                            data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                            <i class="ri-file-excel-line"></i>
                            Excel
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Search -->
            {{-- <input type="text" class="dt-search-input form-control" placeholder="Search..."> --}}

            <form class="navbar-search dt-search m-0">
                <input type="text" class="dt-search-input bg-transparent radius-4" aria-controls="dataTable"
                    name="search" placeholder="Search...">
                <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
            </form>

        </div>

        <!-- Length -->
        <div class="d-flex align-items-center gap-8 text-secondary-light">
            <span class="">
                Rows per page:
            </span>
            <select class="dt-length form-control form-select" style="width:100px;">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        {{-- 
        <div class="d-flex align-items-center gap-8 text-secondary-light">
            <span class="">
                Rows per page:
            </span>
            <div class="dt-length">
                <select name="dataTable_length" aria-controls="dataTable" class="dt-input dt-length  form-control form-select">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div> --}}

    </div>
</div>
