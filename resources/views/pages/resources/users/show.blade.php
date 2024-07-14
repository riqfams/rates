<x-app-layout>
    @if ($errors->any())
        <div id="is_invalid__"></div>
    @endif
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2" style="background-color: #f6f6f6;}">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                        {{ __('Detail User') }}
                    </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid" style="background-color: #f6f6f6;}">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid" style="padding-left: 0px!important; padding-right: 0px!important">
            <!--begin::Card-->
            <div class="card table-responsive">
                <!--begin::Card header-->

                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Details container-->
                    <div class="container">
                        <!--begin::Details-->
                        <div class="">
                            <div class="col-lg-6">
                                <!--begin::Name-->
                                    <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                                    <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="false">
                                        <div class="image-input-wrapper w-125px h-125px">
                                            @if ($user->avatar)
                                                <img src="{{ asset('media/avatars/' . $user->avatar) }}" width="120px" height="120px" alt="Avatar" />
                                            @else
                                                <!-- Tampilkan placeholder avatar jika tidak ada avatar -->
                                                <img src="{{ asset('media/avatars/placeholder.jpg') }}" width="100px" height="120px" alt="Placeholder Avatar" />
                                            @endif
                                        </div>
                                        <!-- Tambahkan logika untuk mengubah avatar -->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                            <i class="ki-outline ki-pencil fs-7"></i>
                                            <input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                        </label>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki-outline ki-cross fs-2"></i>
                                        </span>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                            <i class="ki-outline ki-cross fs-2"></i>
                                        </span>
                                    </div>
                            </div>
                            <div class="col-lg-6">
                                <!--begin::Name-->
                                <div class="mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">{{ __("Full Name") }}</label>
                                    <div class="text-dark fw-bold">{{ $user->name }}</div>
                                </div>
                                <!--end::Name-->
                            </div>
                            <div class="col-lg-6">
                                <!--begin::Email-->
                                <div class="mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">{{ __("Email") }}</label>
                                    <div class="text-dark fw-bold">{{ $user->email }}</div>
                                </div>
                                <!--end::Email-->
                            </div>
                        </div>
                        <!--end::Details-->
                    </div>
                    <!--end::Details container-->

                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <a href="{{ route('resources.users.index') }}">
                            <button type="button" class="btn btn-light">{{ __("Back") }}</button>
                        </a>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</x-app-layout>
