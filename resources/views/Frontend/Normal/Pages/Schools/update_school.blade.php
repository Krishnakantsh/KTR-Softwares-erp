@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Full School Profile')

@section('dynamic-content')
<div class="dashboard-main-body">
    <form id="schoolForm" action="{{ route('school.save.details')}}" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $details->id ?? '' }}">
        <div class="row gy-4">

            <!-- 1. GENERAL & ACADEMIC INFO -->
            <div class="col-lg-12">
                <div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <h6 class="text-lg fw-semibold mb-0">General & Academic Information</h6>
                    </div>
                    <div class="card-body p-20">
                        <div class="row gy-3">
                            <div class="col-xxl-6 col-xl-6">
                                <label class="text-sm fw-semibold text-primary-light mb-8">School Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $details->name ?? '' }}" placeholder="Enter full school name" />
                            </div>
                            <div class="col-xxl-3 col-xl-3 col-sm-6">
                                <label class="text-sm fw-semibold text-primary-light mb-8">School Code</label>
                                <input type="text" class="form-control" name="school_code" value="{{ $details->school_code ?? '' }}" placeholder="e.g. SCH123" />
                            </div>
                            <div class="col-xxl-3 col-xl-3 col-sm-6">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Medium</label>
                                <input type="text" class="form-control" name="medium" value="{{ $details->medium ?? '' }}" placeholder="e.g. English/Hindi" />
                            </div>
                            <div class="col-xxl-3 col-sm-6">
                                <label class="text-sm fw-semibold text-primary-light mb-8">UDIES No</label>
                                <input type="text" class="form-control" name="udies_no" value="{{ $details->udies_no ?? '' }}" />
                            </div>
                            <div class="col-xxl-3 col-sm-6">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Affiliation No</label>
                                <input type="text" class="form-control" name="affli_no"  value="{{ $details->affli_no ?? '' }}"/>
                            </div>
                          
                                 <div class="col-xxl-3 col-sm-6">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Board</label>
                                  <select name="type" class="form-control form-select">
                                  
                                    <option value="CBSE" {{ ($details->board ?? '') == 'CBSE' ? 'selected' : '' }}>CBSE</option>
                                    <option value="ICSE" {{ ($details->board ?? '') == 'ICSE' ? 'selected' : '' }}>ICSE</option>
                                    <option value="State Board" {{ ($details->board ?? '') == 'State Board' ? 'selected' : '' }}>State Board</option>
                                  
                                </select>
                            </div>
                            <div class="col-xxl-3 col-sm-6">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Category</label>
                                <select name="category" class="form-control form-select">
                               
                                    <option value="Private" {{ ($details->category ?? '') == 'Private' ? 'selected' : '' }}>Private</option>
                                    <option value="Government" {{ ($details->category ?? '') == 'Government' ? 'selected' : '' }}>Government</option>
                                    <option value="Minority" {{ ($details->category ?? '') == 'Minority' ? 'selected' : '' }}>Minority</option>
                                    <option value="Independant" {{ ($details->category ?? '') == 'Independant' ? 'selected' : '' }}>Independant</option>
                                </select>
                            </div>
                            <div class="col-xxl-3 col-sm-6">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Type</label>
                                <select name="type" class="form-control form-select">
                                 
                                    <option value="Primary" {{ ($details->type ?? '') == 'Primary' ? 'selected' : '' }} >Primary</option>
                                    <option value="Upper Primary"  {{ ($details->type ?? '') == 'Upper Primary' ? 'selected' : '' }}  >Upper Primary</option>
                                    <option value="Secondary" {{ ($details->type ?? '') == 'Secondary' ? 'selected' : '' }}>Secondary</option>
                                    <option value="Senior Secondary" {{ ($details->type ?? '') == 'Senior Secondary' ? 'selected' : '' }}>Senior Secondary</option>
                                    <option value="Higher Secondary" {{ ($details->type ?? '') == 'Higher Secondary' ? 'selected' : '' }}>Higher Secondary</option>
                                    <option value="Women" {{ ($details->type ?? '') == 'Women' ? 'selected' : '' }} >Women</option>
                                </select>
                           
                                
                            </div>

       
                            <div class="col-xxl-3 col-sm-6">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Admission Start</label>
                                <input type="datetime-local" class="form-control" name="adm_start"  value="{{ $details->adm_start ?? '' }}" />
                            </div>
                            <div class="col-xxl-3 col-sm-6">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Admission End</label>
                                <input type="datetime-local" class="form-control" name="adm_end"   value="{{ $details->adm_end ?? '' }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. ADDRESS, CONTACT & LOCATION -->
            <div class="col-lg-12">
                <div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <h6 class="text-lg fw-semibold mb-0">Location & Contact Details</h6>
                    </div>
                    <div class="card-body p-20">
                        <div class="row gy-3">
                            <div class="col-md-4">
                                <label class="text-sm fw-semibold text-primary-light mb-8" >Phone</label>
                                <input type="text" class="form-control" name="phone"  value="{{ $details->phone ?? '' }}"/>
                            </div>
                            <div class="col-md-4">
                                <label class="text-sm fw-semibold text-primary-light mb-8"  >Email</label>
                                <input type="email" class="form-control" name="email"  value="{{ $details->email ?? '' }}"/>
                            </div>
                            <div class="col-md-4">
                                <label class="text-sm fw-semibold text-primary-light mb-8"  >Website</label>
                                <input type="text" class="form-control" name="website" value="{{ $details->website ?? '' }}" />
                            </div>
                            <div class="col-12">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Full Address</label>
                               <textarea name="address" class="form-control">{{ $details->address ?? '' }}</textarea>
                            </div>
                            <div class="col-md-3">
                                <label class="text-sm fw-semibold text-primary-light mb-8">City</label>
                                <input type="text" class="form-control" name="city"  value="{{ $details->city ?? '' }}"/>
                            </div>
                            <div class="col-md-3">
                                <label class="text-sm fw-semibold text-primary-light mb-8">State</label>
                                <input type="text" class="form-control" name="state"  value="{{ $details->state ?? '' }}" />
                            </div>
                            <div class="col-md-2">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Pincode</label>
                                <input type="text" class="form-control" name="pincode"  value="{{ $details->pincode ?? '' }}" />
                            </div>
                            <div class="col-md-2">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Latitude</label>
                                <input type="text" class="form-control" name="latitude"   value="{{ $details->latitude ?? '' }}"/>
                            </div>
                            <div class="col-md-2">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Longitude</label>
                                <input type="text" class="form-control" name="longitude"  value="{{ $details->longitude ?? '' }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. BRANDING, TITLES & TAGLINES -->
            <div class="col-lg-12">
                <div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <h6 class="text-lg fw-semibold mb-0">Branding & Print Settings</h6>
                    </div>
                    <div class="card-body p-20">
                        <div class="row gy-3">
                            <div class="col-md-4">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Principal Name</label>
                                <input type="text" class="form-control" name="principal_name"   value="{{ $details->principal_name ?? '' }}" />
                            </div>
                            <div class="col-md-4">
                                <label class="text-sm fw-semibold text-primary-light mb-8">TC Title</label>
                                <input type="text" class="form-control" name="tc_title"  value="{{ $details->tc_title ?? '' }}"  placeholder="e.g. Transfer Certificate" />
                            </div>
                            <div class="col-md-4">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Fee Receipt Note</label>
                                <input type="text" class="form-control" name="fee_receipt_note"   value="{{ $details->fee_receipt_note ?? '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Tagline 1</label>
                                <input type="text" class="form-control" name="tagline1"  value="{{ $details->tagline1 ?? '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Tagline 2</label>
                                <input type="text" class="form-control" name="tagline2"  value="{{ $details->tagline2 ?? '' }}"  />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. PREMIUM ASSETS UPLOAD (LOGOS & SIGNS) -->
            <div class="col-lg-12">
                <div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
                    <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
                        <h6 class="text-lg fw-semibold mb-0">Assets & Digital Signatures</h6>
                   
                    </div>
                    <div class="card-body p-20">
                        <div class="row gy-4">
                            @php
                                $fileFields = [
                                    ['n' => 'logo', 'l' => 'Main Logo', 'img'=> $details->logo ?? 'assets/custom_images/file_uploads.png' ],
                                    ['n' => 'small_logo', 'l' => 'Small Logo','img'=> $details->small_logo ?? 'assets/custom_images/file_uploads.png'],
                                    ['n' => 'long_logo', 'l' => 'Long Logo','img'=> $details->long_logo ?? 'assets/custom_images/file_uploads.png'],
                                    ['n' => 'favicon', 'l' => 'Favicon','img'=> $details->favicon ?? 'assets/custom_images/file_uploads.png'],
                                    ['n' => 'board_logo', 'l' => 'Board Logo', 'img'=> $details->board_logo ?? 'assets/custom_images/file_uploads.png'],
                                    ['n' => 'header_image', 'l' => 'Header Image', 'img'=> $details->header_image ?? 'assets/custom_images/file_uploads.png'],
                                    ['n' => 'report_card_header_mage', 'l' => 'Report Card Header', 'img'=> $details->report_card_header_mage ?? 'assets/custom_images/file_uploads.png'],
                                    ['n' => 'school_stamp', 'l' => 'School Stamp', 'img'=> $details->school_stamp ?? 'assets/custom_images/file_uploads.png'],
                                    ['n' => 'principal_sign', 'l' => 'Principal Sign', 'img'=> $details->principal_sign ?? 'assets/custom_images/file_uploads.png'],
                                    ['n' => 'manager_sign', 'l' => 'Manager Sign', 'img'=> $details->manager_sign ?? 'assets/custom_images/file_uploads.png'],
                                    ['n' => 'vice_president_sign', 'l' => 'Vice President Sign', 'img'=> $details->vice_president_sign ?? 'assets/custom_images/file_uploads.png'],
                                    ['n' => 'head_mistress', 'l' => 'Head Mistress Sign', 'img'=> $details->head_mistress ?? 'assets/custom_images/file_uploads.png'],
                                    ['n' => 'exam_incharge_sign', 'l' => 'Exam Incharge Sign', 'img'=> $details->exam_incharge_sign ?? 'assets/custom_images/file_uploads.png'],
                                    ['n' => 'fees_qr_code', 'l' => 'Fees QR Code', 'img'=> $details->fees_qr_code ?? 'assets/custom_images/file_uploads.png'],
                                ];
                          
                            @endphp

                            @foreach($fileFields as $field)
                            <div class="col-xxl-3 col-xl-4 col-md-6">
                                <div class="upload-card radius-12 border bg-base p-16 text-center h-100 shadow-sm transition-hover">
                                    <label class="text-xs fw-bold text-uppercase text-secondary-light mb-12 d-block">{{ $field['l'] }}</label>
                                    
                                    <!-- Image Preview Area -->
                                    <div class="preview-box mb-12" style="height: 160px; background: #f1f5f9; border-radius: 10px; border: 2px dashed #cbd5e1; display: flex; align-items: center; justify-content: center;">
                                        <img id="preview-{{ $field['n'] }}" src="{{ asset($field['img']) }}" 
                                             style="height:100%; max-width: 90%; object-fit: contain;" alt="preview">
                                    </div>

                                    <!-- Custom File Button -->
                                    <div class="upload-btn-wrapper position-relative">
                                        <input type="file" name="{{ $field['n'] }}" id="{{ $field['n'] }}" 
                                               class="form-control opacity-0 position-absolute w-100 h-100 top-0 start-0" 
                                               style="cursor: pointer; z-index: 5;"
                                               onchange="previewFile(this, 'preview-{{ $field['n'] }}')">
                                        <button type="button" class="btn btn-sm btn-primary-50 text-primary-600 fw-semibold w-100 radius-8 border-primary-100">
                                            <i class="ri-image-add-line"></i> Upload {{ $field['l'] }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. SOCIAL & APP LINKS -->
            <div class="col-lg-12">
                <div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <h6 class="text-lg fw-semibold mb-0">Social Media & App Integration</h6>
                    </div>
                    <div class="card-body p-20">
                        <div class="row gy-3">
                            <div class="col-md-3">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Facebook</label>
                                <input type="text" class="form-control" name="facebook" value="{{ $details->facebook ?? '' }}"/>
                            </div>
                            <div class="col-md-3">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Instagram</label>
                                <input type="text" class="form-control" name="instagram" value="{{ $details->instagram ?? '' }}"/>
                            </div>
                            <div class="col-md-3">
                                <label class="text-sm fw-semibold text-primary-light mb-8">YouTube</label>
                                <input type="text" class="form-control" name="youtube" value="{{ $details->youtube ?? '' }}"/>
                            </div>
                            <div class="col-md-3">
                                <label class="text-sm fw-semibold text-primary-light mb-8">Android App URL</label>
                                <input type="text" class="form-control" name="app_android_url" value="{{ $details->app_android_url ?? '' }}"/>
                            </div>
                            <div class="col-md-3">
                                <label class="text-sm fw-semibold text-primary-light mb-8">iOS App URL</label>
                                <input type="text" class="form-control" name="app_ios_url" value="{{ $details->app_ios_url ?? '' }}"/>
                            </div>
                            <div class="col-md-3">
                                <label class="text-sm fw-semibold text-primary-light mb-8">App Fee URL</label>
                                <input type="text" class="form-control" name="app_fee_url" value="{{ $details->app_fee_url ?? '' }}"/>
                            </div>
                            <div class="col-md-3">
                                <label class="text-sm fw-semibold text-primary-light mb-8">App Window URL</label>
                                <input type="text" class="form-control" name="app_window_url"  value="{{ $details->app_window_url ?? '' }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUBMIT BUTTON -->
            <div class="col-12 text-center mb-40">
                <button type="submit" class="btn btn-primary-600 px-40 py-12 radius-8 fw-bold">
                    <i class="ri-save-line me-8"></i> UPDATE CONFIGURATION
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    .transition-hover:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
        border-color: #4834d4 !important;
    }
    .preview-box img {
        transition: transform 0.3s ease;
    }
    .preview-box:hover img {
        transform: scale(1.1);
    }
</style>

<script>
    function previewFile(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection