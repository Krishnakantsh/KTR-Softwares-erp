@extends('Frontend.Normal.Layout.main')
@section('title', 'KTR ERP : Library Master')
@section('dynamic-content')

    <div class="dashboard-main-body py-12">
        <div class="card premium-card">

            <div class="row g-0 h-100">
                <!-- Left Sidebar Tabs -->
                <div class="col-lg-3 col-md-4 h-100">
                    <div class="vertical-tabs-sidebar">
                        <!-- Library Banner -->
                        <div class="student-reg-banner mb-3 text-center"
                            style="background: linear-gradient(135deg, #2b5876 0%, #4e4376 100%);">
                            <div class="banner-overlay"></div>
                            <div class="banner-content">
                                <i class="bi bi-book-half banner-icon"></i>
                                <h5>Library Master</h5>
                            </div>
                        </div>

                        <!-- Sidebar Navigation Links -->
                        <div class="nav flex-column nav-pills" id="libraryTabs" role="tablist" aria-orientation="vertical">
                            <!-- NEW: Search Tab -->
                            <button class="premium-nav-link active" data-bs-toggle="tab" data-bs-target="#addAuthor"
                                type="button">
                                <span class="nav-link-content">
                                    <i class="bi bi-person-plus-fill main-icon"></i> Add Author
                                </span>
                                <i class="bi bi-chevron-right arrow-icon"></i>
                            </button>




                            <!-- NEW: Add Publication Tab -->
                            <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#addPublication"
                                type="button">
                                <span class="nav-link-content">
                                    <i class="bi bi-journal-text main-icon"></i> Add Publication
                                </span>
                                <i class="bi bi-chevron-right arrow-icon"></i>
                            </button>

                            <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#addCategory"
                                type="button">
                                <span class="nav-link-content">
                                    <i class="bi bi-person-lines-fill main-icon"></i> Add Category
                                </span>
                                <i class="bi bi-chevron-right arrow-icon"></i>
                            </button>




                            <!-- NEW: Add Fine Tab -->
                            <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#addFineTab"
                                type="button">
                                <span class="nav-link-content">
                                    <i class="bi bi-calculator-fill main-icon"></i> Add / Collect Fine
                                </span>
                                <i class="bi bi-chevron-right arrow-icon"></i>
                            </button>
                            <!-- NEW: Add Fine Tab -->
                            <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#addSupplier"
                                type="button">
                                <span class="nav-link-content">
                                    <i class="bi bi-calculator-fill main-icon"></i> Add Supplier
                                </span>
                                <i class="bi bi-chevron-right arrow-icon"></i>
                            </button>
                            <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#addBook" type="button">
                                <span class="nav-link-content">
                                    <i class="bi bi-person-lines-fill main-icon"></i> Add Book
                                </span>
                                <i class="bi bi-chevron-right arrow-icon"></i>
                            </button>
                            <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#issueBook"
                                type="button">
                                <span class="nav-link-content">
                                    <i class="bi bi-journal-arrow-up main-icon"></i> Issue Book
                                </span>
                                <i class="bi bi-chevron-right arrow-icon"></i>
                            </button>
                            <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#returnBook"
                                type="button">
                                <span class="nav-link-content">
                                    <i class="bi bi-journal-arrow-down main-icon"></i> Return / Renew
                                </span>
                                <i class="bi bi-chevron-right arrow-icon"></i>
                            </button>
                            <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#bookCatalog"
                                type="button">
                                <span class="nav-link-content">
                                    <i class="bi bi-collection main-icon"></i> Book Catalog
                                </span>
                                <i class="bi bi-chevron-right arrow-icon"></i>
                            </button>


                            <button class="premium-nav-link" data-bs-toggle="tab" data-bs-target="#fineManagement"
                                type="button">
                                <span class="nav-link-content">
                                    <i class="bi bi-currency-dollar main-icon"></i> Fine Logs
                                </span>
                                <i class="bi bi-chevron-right arrow-icon"></i>
                            </button>

                            <hr class="my-2">

                            <!-- Configuration Modals / Links -->
                            <a href="javascript:void(0)" class="premium-nav-link premium-nav-config" data-bs-toggle="modal"
                                data-bs-target="#shelfModal">
                                <span class="nav-link-content">
                                    <div class="config-icon-wrapper">
                                        <i class="bi bi-layers-half config-main-icon"></i>
                                    </div>
                                    <span class="config-text-wrapper">Shelf & Racks</span>
                                </span>
                                <i class="bi bi-sliders arrow-icon-config"></i>
                            </a>
                            <a href="javascript:void(0)" class="premium-nav-link premium-nav-config" data-bs-toggle="modal"
                                data-bs-target="#categoryModal">
                                <span class="nav-link-content">
                                    <div class="config-icon-wrapper">
                                        <i class="bi bi-tags-fill config-main-icon"></i>
                                    </div>
                                    <span class="config-text-wrapper">Book Categories</span>
                                </span>
                                <i class="bi bi-sliders arrow-icon-config"></i>
                            </a>
                            <a href="javascript:void(0)" class="premium-nav-link premium-nav-config"
                                data-bs-toggle="modal" data-bs-target="#rulesModal">
                                <span class="nav-link-content">
                                    <div class="config-icon-wrapper">
                                        <i class="bi bi-shield-exclamation config-main-icon"></i>
                                    </div>
                                    <span class="config-text-wrapper">Library Rules</span>
                                </span>
                                <i class="bi bi-sliders arrow-icon-config"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Content Pane -->
                <div class="col-lg-9 col-md-8 h-100">
                    <div class="content-pane-wrapper">
                        <!-- Action Bar with live book/member search -->
                        {{-- <div class="sticky-top-action-bar d-flex justify-content-between align-items-center z-20">
                                <div class="premium-search-wrapper">
                                    <i class="bi bi-search premium-search-icon"></i>
                                    <input type="hidden" name="selected_item_id" id="selected_item_id">
                                    <input type="text" class="form-control premium-search-input"
                                        id="libraryLiveSearch"
                                        placeholder="Quick Search: Book Title, Accession No, Member ID or ISBN...">
                                    <div class="search-results-dropdown" id="librarySearchResultsContainer"></div>
                                </div>
                             
                            </div> --}}

                        <!-- Tab Contents Container -->
                        <div class="w-100 flex-grow-1 form-components-holder">
                            <div class="tab-content" id="libraryTabsContent">

                                <!-- NEW: Add Author Content -->
                                <div class="tab-pane fade  show active" id="addAuthor">
                                    @include('Frontend/Normal/Pages/Library/LibraryMaster/Components/add_author')
                                </div>

                                <!-- NEW: Add Publication Content -->
                                <div class="tab-pane fade" id="addPublication">
                                    @include('Frontend/Normal/Pages/Library/LibraryMaster/Components/add_publication')


                                </div>

                                <div class="tab-pane fade" id="addCategory">
                                    @include('Frontend/Normal/Pages/Library/LibraryMaster/Components/add_category')

                                </div>


                                <div class="tab-pane fade" id="addFineTab">
                                    @include('Frontend/Normal/Pages/Library/LibraryMaster/Components/set_fine')

                                </div>

                                <div class="tab-pane fade" id="addBook">
                                    @include('Frontend/Normal/Pages/Library/LibraryMaster/Components/add_book')

                                </div>

                                <div class="tab-pane fade" id="addSupplier">
                                    @include('Frontend/Normal/Pages/Library/LibraryMaster/Components/add_supplier')

                                </div>

                                <div class="tab-pane fade" id="issueBook">
                                    @include('Frontend/Normal/Pages/Library/LibraryMaster/Components/issue_book')

                                </div>


                                <div class="tab-pane fade" id="returnBook">
                                    @include('Frontend/Normal/Pages/Library/LibraryMaster/Components/renew_return')
                                </div>
                                {{-- <div class="tab-pane fade" id="bookCatalog">
                                        @include('Frontend.Normal.Pages.Library.components.catalog')
                                    </div> --}}



                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Dropdown control for Search Box
            $('#libraryLiveSearch').on('input', function() {
                let value = $(this).val().trim();
                if (value.length > 1) {
                    $('#librarySearchResultsContainer').fadeIn(200);
                } else {
                    $('#librarySearchResultsContainer').fadeOut(150);
                }
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.premium-search-wrapper').length) {
                    $('#librarySearchResultsContainer').fadeOut(150);
                }
            });

            // AJAX Data Loading Mock/Implementation
            let libraryData = [];
            loadLibraryData();

            function loadLibraryData() {
                $.ajax({
                    url: "#",
                    type: "GET",
                    success: function(response) {
                        libraryData = response;
                    }
                });
            }

            // Real-time Filtering logic
            $('#libraryLiveSearch').on('keyup', function() {
                let keyword = $(this).val().toLowerCase().trim();
                let html = '';

                if (keyword.length > 2) {
                    let filtered = libraryData.filter(item =>
                        (item.search_query || '').toLowerCase().includes(keyword)
                    );

                    if (filtered.length > 0) {
                        filtered.forEach(item => {
                            html += `
                                <a href="javascript:void(0)" class="student-item-premium library-item" data-id="${item.id}" data-type="${item.type}">
                                    <div class="student-photo">
                                        <i class="bi ${item.type === 'book' ? 'bi-book' : 'bi-person-badge'} text-secondary fs-4"></i>
                                    </div>
                                    <div class="student-details">
                                        <div class="student-name">${item.title_or_name}</div>
                                        <div class="student-meta">
                                            <span><b>Code/No:</b> ${item.code}</span>
                                            <span><b>Type:</b> <span class="badge bg-secondary text-capitalize">${item.type}</span></span>
                                        </div>
                                    </div>
                                </a>`;
                        });
                    } else {
                        html = `<div class="no-result">No matching Books or Members found</div>`;
                    }
                    $('#librarySearchResultsContainer').html(html).fadeIn(200);
                } else {
                    $('#librarySearchResultsContainer').hide();
                }
            });

            // Item selection handling
            $(document).on('click', '.library-item', function() {
                let itemId = $(this).data('id');
                let itemType = $(this).data('type');
                $('#selected_item_id').val(itemId);

                $('#librarySearchResultsContainer').hide();
                $('#libraryLiveSearch').val($(this).find('.student-name').text().trim());

                if (itemType === 'book') {
                    loadBookDetails(itemId);
                } else {
                    loadMemberDetails(itemId);
                }
            });

            function loadBookDetails(id) {
                /* Custom implementation */
            }

            function loadMemberDetails(id) {
                /* Custom implementation */
            }


            $(document).ready(function() {

                let tab = new URLSearchParams(window.location.search).get('tab');

                if (tab) {

                    let trigger = document.querySelector(
                        `[data-bs-target="#${tab}"]`
                    );

                    if (trigger) {

                        let bsTab = new bootstrap.Tab(trigger);
                        bsTab.show();

                    }
                }

            });
        });
    </script>
@endpush
