<x-app-layout>
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!-- TODO : Integrasi System -->
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2" style="background-color: #f6f6f6;}">
                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                            <h1
                                class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                                Profile Settings</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ route('dashboard') }}"
                                        class="text-muted text-hover-primary">Profile</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-3px h-3px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Settings</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="kt_app_content" class="app-content flex-column-fluid" style="background-color: #f6f6f6;}">
                <div id="kt_app_content_container" class="app-container container-fluid" style="padding-left: 0px!important; padding-right: 0px!important">
                    <div class="card mb-5 mb-xl-10">
                        <!-- <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                            data-bs-target="#kt_account_profile_details" aria-expanded="true"
                            aria-controls="kt_account_profile_details">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Profile Details</h3>
                            </div>
                        </div> -->
                        <div class="collapse show">
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <form class="form" method="post" action="{{ route('account.profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="card-body border-top p-9">
                                    <div class="row mb-6">
                                        <x-input-label class="col-lg-4 col-form-label required fw-semibold fs-6 for="
                                                :value="__('Avatar')" />

                                            <div class="col-lg-8 fv-row">
                                            @if ($user->avatar)
                                                <div class="avatar__ rounded-circle me-3 mb-2" style="width: 50px; height: 50px; overflow: hidden">
                                                    <img src="{{ asset('media/avatars/' . $user->avatar) }}" alt="User Avatar"
                                                        style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                            @else
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="#">
                                                    <div class="symbol-label fs-3 bg-light-danger text-danger">
                                                        {{ substr($user->name, 0, 1) }}</div>
                                                </a>
                                            </div>

                                            @endif
                                                <input type="file" name="avatar" id="avatar"
                                                    class="form-control form-control-solid mb-3 mb-lg-0 {{ $errors->get('avatar') ? 'is-invalid border border-1 border-danger' : '' }}"
                                                    value="{{ old('avatar') }}" />
                                                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                                            </div>
                                    </div>
                                    <div class="row mb-6">
                                        <x-input-label class="col-lg-4 col-form-label required fw-semibold fs-6 for="
                                            :value="__('Name')" />

                                        <div class="col-lg-8 fv-row">
                                                <input type="text" name="name" id="name"
                                                    class="form-control form-control-solid mb-3 mb-lg-0 {{ $errors->get("name") ? "is-invalid border border-1 border-danger" : "" }}" placeholder="Full name"
                                                    value="{{ $user->name }}" />
                                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                        </div>
                                    </div>
                                    <div class="row mb-6">

                                        <x-input-label class="col-lg-4 col-form-label required fw-semibold fs-6"
                                            for="email" :value="__('Email')" />

                                        <div class="col-lg-8 fv-row">
                                        <input type="email" name="email" id="email"
                                                class="form-control form-control-solid mb-3 mb-lg-0 {{ $errors->get("email") ? "is-invalid border border-1 border-danger" : "" }}" placeholder="example@domain.com"
                                                value="{{ $user->email }}" />
                                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                                <div>
                                                    <p class="text-sm mt-2 text-gray-800">
                                                        {{ __('Your email address is unverified.') }}

                                                        <button form="send-verification"
                                                            class="btn btn-link text-sm text-gray-600">
                                                            {{ __('Click here to re-send the verification email.') }}
                                                        </button>
                                                    </p>

                                                    @if (session('status') === 'verification-link-sent')
                                                        <p class="mt-2 font-medium text-sm text-success">
                                                            {{ __('A new verification link has been sent to your email address.') }}
                                                        </p>
                                                    @endif
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <button type="submit" class="btn btn-primary"
                                        id="kt_account_profile_details_submit">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
