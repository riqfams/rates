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
                        {{ __('Show Lender') }}
                    </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid" style="background-color: #f6f6f6;}">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid" style="padding-left: 0px!important; padding-right: 0px!important">
            <!--begin::Card-->
            <div class="card">
            <form id="kt_modal_add_lender_form" class="form" action="{{ route('lenders.update', $lender->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- begin::Lender --}}
                <div class="card-body py-4 my-5">

                    <div class="mb-7">
                        <label class="fw-bold fs-6 mb-2">Lender Name</label>
                        <div class="text-dark fw-semibold">{{ $lender->name }}</div>
                    </div>
                    
                    <div class="mb-7">
                        <label class="fw-bold fs-6 mb-2">Purpose</label>
                        <div class="text-dark fw-semibold">{{ $lender->purpose }}</div>
                    </div>
                    
                    <div class="mb-7">
                        <label class="fw-bold fs-6 mb-2">Product</label>
                        <div class="text-dark fw-semibold">{{ $lender->product }}</div>
                    </div>
                </div>

                {{-- begin::Rates --}}
                <div class="card-body py-4 my-5">
                    <h2 class="fs-4 fw-bold">Rates</h2 class="fs-4">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="ratesTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>RATE</th>
                                    <th>15DAY</th>
                                    <th>30DAY</th>
                                    <th>45DAY</th>
                                    <th>MARGIN</th>
                                    <th>TOTAL RATE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lender->rates as $rate)
                                    <tr>
                                        <td>{{ $rate->rate }}</td>
                                        <td>{{ $rate->days15 }}</td>
                                        <td>{{ $rate->days30 }}</td>
                                        <td>{{ $rate->days45 }}</td>
                                        <td>{{ $rate->margin }}</td>
                                        <td>{{ $rate->total_rate }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- begin::Credit & LTV --}}
                <div class="card-body py-4 my-5">
                    <h2 class="fs-4 fw-bold">Credit & LTV</h2 class="fs-4">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>CREDIT / LTV</th>
                                        <th>0-50</th>
                                        <th>50-55</th>
                                        <th>55-60</th>
                                        <th>60-65</th>
                                        <th>65-70</th>
                                        <th>70-75</th>
                                        <th>75-80</th>
                                        <th>80-85</th>
                                        <th>85-90</th>
                                        <th>90-95</th>
                                        <th>95-100</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lender->creditAndLtvs as $credit)
                                        <tr>
                                            <td>{{ str_replace('_', ' ', $credit->credit_range) }}</td>
                                            @for ($i = 0; $i < 11; $i++)
                                                <td>{{ $credit->{'ltv_' . ($i == 0 ? $i * 5 : $i * 5 + 45) . '_' . ($i * 5 + 50)} }}</td>
                                            @endfor
                                        </tr>
                                    @endforeach
                                </tbody>                    
                            </table>
                        </div>
            
                    </div>
                </div>

                {{-- begin::Loan Amount Adjustments --}}
                <div class="card-body py-4 my-5">
                    <h2 class="fs-4">Loan Amount Adjustmnets</h2 class="fs-4">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="loansTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Loan Amount Range Low</th>
                                    <th>Loan Amount Range High</th>
                                    <th>Adjustment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lender->loanAmountAdjustments as $loan)
                                    <tr>
                                        <td>{{ $loan->loan_amount_low }}</td>
                                        <td>{{ $loan->loan_amount_high }}</td>
                                        <td>{{ $loan->adjustment }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- begin::FICO --}}
                <div class="card-body py-4 my-5">
                    <h2 class="fs-4">FICO Adjustments</h2 class="fs-4">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="ficosTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Fico Range Low</th>
                                    <th>Fico Range High</th>
                                    <th>Adjustment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lender->ficoAdjustments as $fico)
                                    <tr>
                                        <td>{{ $fico->fico_range_low }}</td>
                                        <td>{{ $fico->fico_range_high }}</td>
                                        <td>{{ $fico->adjustment }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- begin::Additional Adjustment --}}
                <div class="card-body py-4 my-5">
                    <h2 class="fs-4">Additional Adjustment</h2 class="fs-4">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="additionalTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Options</th>
                                    <th>Operand</th>
                                    <th>Value</th>
                                    <th>Adjustment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lender->additionalAdjustments as $additional)
                                    <tr>
                                        <td>
                                            {{$additional->options}}
                                        </td>
                                        <td>
                                            {{$additional->operand}}
                                        </td>
                                        <td>{{ $additional->value }}</td>
                                        <td>{{ $additional->adjustment }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- begin:: Button --}}
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('lenders.index') }}">
                        <button type="button" class="btn btn-light me-3">Cancel</button>
                    </a>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
