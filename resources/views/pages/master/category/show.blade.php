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
                        {{ __('Detail Kategory Bagan Akun') }}
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

                <!--begin::Detail data-->
                <div class="card card-flush py-4 flex-row-fluid">
                  <!--begin::Card header-->
                  <div class="card-header">
                    <div class="card-title">
                      <h2>{{ $categoryCoa->name }}</h2>
                    </div>
                  </div>
                  <!--end::Card header-->
                  <!--begin::Card body-->
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                      <!--begin::Table-->
                      <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5">
                        <tbody class="fw-semibold text-gray-600">
                          <tr>
                            <td class="text-muted">{{ __("Status") }}</td>
                            <td class="fw-bold text-end">{{ $categoryCoa->status == 1 ? 'Active' : 'Non Active' }}</td>
                          </tr>
                        </tbody>
                      </table>
                      <!--end::Table-->
                    </div>
                  </div>
                  <!--end::Card body-->
                </div>
                <!--end::Detail data-->

            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</x-app-layout>
