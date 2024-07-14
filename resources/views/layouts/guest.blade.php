<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', '') }}</title>
		<meta charset="utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="og:locale" content="en_ID" />
		<meta property="og:type" content="" />
		<meta property="og:title" content="" />
		<meta property="og:url" content="" />
		<meta property="og:site_name" content="" />

        <link rel="canonical" href="" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}" />
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

    </head>
    <body id="kt_body" class="app-blank">
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
						<div class="w-lg-500px p-10">
                            {{ $slot }}
						</div>
					</div>
					<div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
						<!-- <div class="me-10">
							<button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
								<img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="{{asset('assets/media/flags/united-states.svg')}}" alt="" />
								<span data-kt-element="current-lang-name" class="me-1">English</span>
								<i class="ki-outline ki-down fs-5 text-muted rotate-180 m-0"></i>
							</button>
							<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
								<div class="menu-item px-3">
									<a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
										<span class="symbol symbol-20px me-4">
											<img data-kt-element="lang-flag" class="rounded-1" src="{{asset('assets/media/flags/united-states.svg')}}" alt="" />
										</span>
										<span data-kt-element="lang-name">English</span>
									</a>
								</div>
								<div class="menu-item px-3">
									<a href="#" class="menu-link d-flex px-5" data-kt-lang="Spanish">
										<span class="symbol symbol-20px me-4">
											<img data-kt-element="lang-flag" class="rounded-1" src="{{asset('assets/media/flags/spain.svg')}}" alt="" />
										</span>
										<span data-kt-element="lang-name">Spanish</span>
									</a>
								</div>
								<div class="menu-item px-3">
									<a href="#" class="menu-link d-flex px-5" data-kt-lang="German">
										<span class="symbol symbol-20px me-4">
											<img data-kt-element="lang-flag" class="rounded-1" src="{{asset('assets/media/flags/germany.svg')}}" alt="" />
										</span>
										<span data-kt-element="lang-name">German</span>
									</a>
								</div>
								<div class="menu-item px-3">
									<a href="#" class="menu-link d-flex px-5" data-kt-lang="Japanese">
										<span class="symbol symbol-20px me-4">
											<img data-kt-element="lang-flag" class="rounded-1" src="{{asset('assets/media/flags/japan.svg')}}" alt="" />
										</span>
										<span data-kt-element="lang-name">Japanese</span>
									</a>
								</div>
								<div class="menu-item px-3">
									<a href="#" class="menu-link d-flex px-5" data-kt-lang="French">
										<span class="symbol symbol-20px me-4">
											<img data-kt-element="lang-flag" class="rounded-1" src="{{asset('assets/media/flags/france.svg')}}" alt="" />
										</span>
										<span data-kt-element="lang-name">French</span>
									</a>
								</div>
							</div>
						</div> -->
						<!-- <div class="d-flex fw-semibold text-primary fs-base gap-5">
							<a href="#" target="_blank">Terms</a>
							<a href="#" target="_blank">Plans</a>
							<a href="#" target="_blank">Contact Us</a>
						</div> -->
					</div>
				</div>
				<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ asset('assets/media/misc/auth-bg.png') }})">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center py-15 py-lg-15 px-5 px-md-15 w-100">
						<!--begin::Logo-->
						<a href="{{route('login')}}" class="mb-0 mb-lg-12">
							<img alt="Logo" src="{{asset('assets/media/logos/logo.png') }}" class="h-60px h-lg-75px" />
						</a>
						<!--end::Logo-->
						<!--begin::Image-->
						<img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" style="max-width: 30rem" src="{{asset('assets/media/misc/image.gif')}}" alt="" />
						<!--end::Image-->
						<!--begin::Title-->
						<h1 class="d-none d-lg-block text-black fs-2qx fw-bolder text-center mb-7">Smart Website System</h1>
						<!--end::Title-->
						<!--begin::Text-->
            <div class="d-none d-lg-block text-black fs-base text-center">sistem smart akuntansi
						<a href="#" class="opacity-75-hover text-danger fw-bold me-1">yang terintegrasi</a>
						<br />dengan operasional bisnis anda</div>
						<!--end::Text-->
					</div>
					<!--end::Content-->
				</div>
			</div>
		</div>

		<script src="{{asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
		<script src="{{asset('assets/js/custom/authentication/sign-in/general.js')}}"></script>

	</body>

</html>
