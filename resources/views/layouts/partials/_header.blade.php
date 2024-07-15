<div id="kt_app_header" class="app-header d-flex flex-column flex-stack">
    <div class="d-flex flex-stack flex-grow-1">
        <div class="app-header-logo d-flex align-items-center ps-lg-12" id="kt_app_header_logo">
            <!-- <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-sm btn-icon bg-body btn-color-gray-500 btn-active-color-primary w-30px h-30px ms-n2 me-4 d-none d-lg-flex" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                <i class="ki-outline ki-abstract-14 fs-3 mt-1"></i>
            </div> -->
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px ms-3 me-2 d-flex d-lg-none" id="kt_app_sidebar_mobile_toggle">
                <i class="ki-outline ki-abstract-14 fs-2"></i>
            </div>
            <a href="{{ route('dashboard') }}" class="app-sidebar-logo">
                {{-- <img alt="Logo" src="{{asset('assets/media/logos/logo.png') }}" class="h-35px theme-light-show" />
                <img alt="Logo" src="{{asset('assets/media/logos/logo.png') }}" class="h-35px theme-dark-show" /> --}}
            </a>
        </div>

        @include('layouts.partials._navbar')
    </div>
    <!-- <div class="app-header-separator"></div> -->
</div>
