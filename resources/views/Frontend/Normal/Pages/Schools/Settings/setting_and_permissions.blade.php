@extends('Frontend.Normal.Layout.main')

@section('title', 'KTR ERP : Setting & Permissions')

@section('dynamic-content')

    <div class="dashboard-main-body">

        <div class="card">

            <!-- Tabs Header -->

            <div class="card-header border-bottom bg-white">

                <ul class="nav nav-tabs card-header-tabs" id="settingTabs" role="tablist">

                    <!-- Tab 1 -->

                    <li class="nav-item" role="presentation">

                        <button class="nav-link active" id="general-setting-tab" data-bs-toggle="tab"
                            data-bs-target="#general-setting" type="button" role="tab">

                            General Setting

                        </button>

                    </li>

                    <!-- Tab 2 -->

                    <li class="nav-item" role="presentation">

                        <button class="nav-link" id="role-permission-tab" data-bs-toggle="tab"
                            data-bs-target="#role-permission" type="button" role="tab">

                            Add Templetes

                        </button>

                    </li>

                    <!-- Tab 3 -->

                    <li class="nav-item" role="presentation">

                        <button class="nav-link" id="module-setting-tab" data-bs-toggle="tab"
                            data-bs-target="#module-setting" type="button" role="tab">

                            Transport Setting

                        </button>

                    </li>

                    <!-- Tab 4 -->

                    <li class="nav-item" role="presentation">

                        <button class="nav-link" id="system-config-tab" data-bs-toggle="tab" data-bs-target="#system-config"
                            type="button" role="tab">

                            Student App Config

                        </button>

                    </li>

                </ul>

            </div>

            <!-- Tabs Body -->

            <div class="card-body">

                <div class="tab-content" id="settingTabsContent">

                    <!-- General Setting -->

                    <div class="tab-pane fade show active" id="general-setting" role="tabpanel">

                        @include('Frontend/Normal/Pages/Schools/Settings/Components/general-setting')

                    </div>

                    <!-- Role Permission -->

                    <div class="tab-pane fade" id="role-permission" role="tabpanel">

                        @include('Frontend/Normal/Pages/Schools/Settings/Components/add-templates')

                    </div>

                    <!-- Module Setting -->

                    <div class="tab-pane fade" id="module-setting" role="tabpanel">

                        @include('Frontend/Normal/Pages/Schools/Settings/Components/transport-setting')

                    </div>

                    <!-- System Config -->

                    <div class="tab-pane fade" id="system-config" role="tabpanel">

                        @include('Frontend/Normal/Pages/Schools/Settings/Components/student-app-setting')

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
