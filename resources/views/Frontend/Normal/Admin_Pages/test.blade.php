@extends('Frontend.Normal.Layout.main')


@section('title', 'KTR ERP : Permissions Manage')

@section('dynamic-content')



    <div class="dashboard-main-body">

        <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <div class="">
                <h1 class="fw-semibold mb-4 h6 text-primary-light"> Manage Permissions </h1>

            </div>
            <a href="{{ route('manage_permissions') }}"
                class="my-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 ">
                <span class="d-flex text-md">
                    <i class="ri-add-large-line"></i>
                </span>
                Add Permission
            </a>
        </div>

        <form class="mt-24" id="totalForm">
            @csrf
            <div class="row gy-3">


                <div class="col-xl-12">
                    <div class="shadow-1 radius-12 bg-base h-100 ">
                        <div
                            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                            <h6 class="text-lg fw-semibold mb-0">Testing </h6>
                        </div>
                        <div class="card-body p-20">
                            <div class="row gy-3 align-items-end">
                                <div class="col-sm-4">
                                    <div class="">
                                        <label for="name"
                                            class="text-sm fw-semibold text-primary-light d-inline-block mb-8"> Name
                                            <span class="text-danger-600"> *</span>
                                        </label>

                                        <div class="position-relative">
                                            <input type="text" class="form-control mb-1" id="name" name="name"
                                                placeholder="Enter Name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="">
                                        <label for="phone"
                                            class="text-sm fw-semibold text-primary-light d-inline-block mb-8"> Phone
                                            <span class="text-danger-600">*</span>
                                        </label>

                                        <div class="position-relative">
                                            <input type="text" class="form-control mb-1" id="phone" name="phone"
                                                placeholder="Enter phone" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <button  type="submit"
                                        class="my-sidebar-btn btn btn-primary-600 d-flex align-items-center gap-6 ">
                                        <span class="d-flex text-md">
                                            <i class="ri-add-large-line"></i>
                                        </span>
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </form>
    </div>
@endsection

