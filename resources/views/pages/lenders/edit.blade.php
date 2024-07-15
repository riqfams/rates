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
                        {{ __('Edit Lender') }}
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
                {{-- begin::Add Lender --}}
                <div class="card-body py-4 my-5">

                    <div class="mb-7">
                        <label class="required fw-semibold fs-6 mb-2">Lender Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control form-control-solid mb-3 mb-lg-0 {{ $errors->get("name") ? "is-invalid border border-1 border-danger" : "" }}" placeholder="Lender Name"
                            value="{{ $lender->name }}" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    
                    <div class="mb-7">
                        <label class="required fw-semibold fs-6 mb-2">Purpose</label>
                        <select name="purpose" id="purpose"
                            class="form-select form-select-solid mb-3 mb-lg-0 {{ $errors->get('purpose') ? 'is-invalid border border-1 border-danger' : '' }}">
                            <option value="">Select Purpose</option>
                            <option value="Purchase" {{ (old('purpose', $lender->purpose) == 'Purchase') ? 'selected' : '' }}>Puschase</option>
                            <option value="Rate/Term" {{ (old('purpose', $lender->purpose) == 'Rate/Term') ? 'selected' : '' }}>Rate/Term</option>
                            <option value="Cashout" {{ (old('purpose', $lender->purpose) == 'Cashout') ? 'selected' : '' }}>Cashout</option>
                            <option value="HELOC" {{ (old('purpose', $lender->purpose) == 'HELOC') ? 'selected' : '' }}>HELOC</option>
                            <option value="Second" {{ (old('purpose', $lender->purpose) == 'Second') ? 'selected' : '' }}>Second</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('purpose')" />
                    </div>
                    
                    <div class="mb-7">
                        <label class="required fw-semibold fs-6 mb-2">Product</label>
                        <select name="product" id="product"
                            class="form-select form-select-solid mb-3 mb-lg-0 {{ $errors->get('product') ? 'is-invalid border border-1 border-danger' : '' }}">
                            <option value="">Select Product</option>
                            <option value="Conventional" value="Purchase" {{ (old('product', $lender->product) == 'Conventional') ? 'selected' : '' }}>Conventional</option>
                            <option value="FHA" value="Purchase" {{ (old('product', $lender->product) == 'FHA') ? 'selected' : '' }}>FHA</option>
                            <option value="VA" value="Purchase" {{ (old('product', $lender->product) == 'VA') ? 'selected' : '' }}>VA</option>
                            <option value="HELOC" value="Purchase" {{ (old('product', $lender->product) == 'HELOC') ? 'selected' : '' }}>HELOC</option>
                            <option value="Second" value="Purchase" {{ (old('product', $lender->product) == 'Second') ? 'selected' : '' }}>Second</option>
                            <option value="Non-QM" value="Purchase" {{ (old('product', $lender->product) == 'Non-QM') ? 'selected' : '' }}>Non-QM</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('product')" />
                    </div>
                </div>

                {{-- begin::Add Rates --}}
                <div class="card-body py-4 my-5">
                    <h2 class="fs-4">Add Rates</h2 class="fs-4">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lender->rates as $rate)
                                    <tr>
                                        <td><input type="number" value="{{ $rate->rate }}" name="rates[]" class="form-control border border-white" step="0.01" required></td>
                                        <td><input type="number" value="{{ $rate->days15 }}" name="days15[]" class="form-control border border-white" step="0.01" required></td>
                                        <td><input type="number" value="{{ $rate->days30 }}" name="days30[]" class="form-control border border-white" step="0.01" required></td>
                                        <td><input type="number" value="{{ $rate->days45 }}" name="days45[]" class="form-control border border-white" step="0.01" required></td>
                                        <td><input type="number" value="{{ $rate->margin }}" name="margin[]" class="form-control border border-white" step="0.01" required></td>
                                        <td><input type="number" value="{{ $rate->total_rate }}" name="total_rate[]" class="form-control border border-white" step="0.01" required></td>
                                        <td><button type="button" class="btn btn-danger" onclick="deleteRowRates(this)">Delete</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addRowRates()">Add Row</button>
                </div>

                {{-- begin:: Add Credit & LTV --}}
                <div class="card-body py-4 my-5">
                    <h2 class="fs-4">Add Credit & LTV</h2 class="fs-4">
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
                                            <td>{{ $credit->credit_range }}</td>
                                            @for ($i = 0; $i < 11; $i++)
                                                <td><input type="number" name="credit_{{ $credit->credit_range }}[]" class="form-control border border-white" value="{{ $credit->{'ltv_' . ($i == 0 ? $i * 5 : $i * 5 + 45) . '_' . ($i * 5 + 50)} }}" step="0.01" required></td>
                                            @endfor
                                        </tr>
                                    @endforeach
                                </tbody>                    
                            </table>
                        </div>
            
                    </div>
                </div>

                {{-- begin::Add Loan Amount Adjustments --}}
                <div class="card-body py-4 my-5">
                    <h2 class="fs-4">Add Loan Amount Adjustmnets</h2 class="fs-4">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="loansTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Loan Amount Range Low</th>
                                    <th>Loan Amount Range High</th>
                                    <th>Adjustment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lender->loanAmountAdjustments as $loan)
                                    <tr>
                                        <td><input type="number" value="{{ $loan->loan_amount_low }}" name="low[]" class="form-control border border-white" step="1" required></td>
                                        <td><input type="number" value="{{ $loan->loan_amount_high }}" name="high[]" class="form-control border border-white" step="1" required></td>
                                        <td><input type="text" value="{{ $loan->adjustment }}" name="adjustment[]" class="form-control border border-white" required></td>
                                        <td><button type="button" class="btn btn-danger" onclick="deleteRowLoans(this)">Delete</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addRowLoans()">Add Row</button>
                </div>

                {{-- begin::Add FICO --}}
                <div class="card-body py-4 my-5">
                    <h2 class="fs-4">Add FICO Adjustments</h2 class="fs-4">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="ficosTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Fico Range Low</th>
                                    <th>Fico Range High</th>
                                    <th>Adjustment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lender->ficoAdjustments as $fico)
                                    <tr>
                                        <td><input type="number" value="{{ $fico->fico_range_low }}" name="fico_low[]" class="form-control border border-white" step="1" required></td>
                                        <td><input type="number" value="{{ $fico->fico_range_high }}" name="fico_high[]" class="form-control border border-white" step="1" required></td>
                                        <td><input type="text" value="{{ $fico->adjustment }}" name="fico_adjustment[]" class="form-control border border-white" required></td>
                                        <td><button type="button" class="btn btn-danger" onclick="deleteRowFicos(this)">Delete</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addRowFicos()">Add Row</button>
                </div>

                {{-- begin::Add Additional Adjustment --}}
                <div class="card-body py-4 my-5">
                    <h2 class="fs-4">Add Additional Adjustment</h2 class="fs-4">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="additionalTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Options</th>
                                    <th>Operand</th>
                                    <th>Value</th>
                                    <th>Adjustment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lender->additionalAdjustments as $additional)
                                    <tr>
                                        <td>
                                            <select name="option[]" id="option" class="form-control border border-white" required>
                                                <option value="LTV" {{ $additional->option == 'LTV' ? 'selected' : '' }}>LTV</option>
                                                <option value="DTI" {{ $additional->option == 'DTI' ? 'selected' : '' }}>DTI</option>
                                                <option value="Occupancy" {{ $additional->option == 'Occupancy' ? 'selected' : '' }}>Occupancy</option>
                                                <option value="Property Type" {{ $additional->option == 'Property Type' ? 'selected' : '' }}>Property Type</option>
                                                <option value="Term" {{ $additional->option == 'Term' ? 'selected' : '' }}>Term</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="operand[]" id="operand" class="form-control border border-white" required>
                                                <option value="Greater than" {{ $additional->operand == 'Greater than' ? 'selected' : '' }}>Greater than</option>
                                                <option value="Less than" {{ $additional->operand == 'Less than' ? 'selected' : '' }}>Less than</option>
                                                <option value="Equal to" {{ $additional->operand == 'Equal to' ? 'selected' : '' }}>Equal to</option>
                                            </select>
                                        </td>
                                        <td><input type="text" value="{{ $additional->value }}" name="value[]" class="form-control border border-white" required></td>
                                        <td><input type="text" value="{{ $additional->adjustment }}" name="additional_adjustment[]" class="form-control border border-white" required></td>
                                        <td><button type="button" class="btn btn-danger" onclick="deleteRowAdditional(this)">Delete</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>                    
                    <button type="button" class="btn btn-primary" onclick="addRowAdditional()">Add Row</button>
                </div>

                {{-- begin:: Button --}}
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('lenders.index') }}">
                        <button type="button" class="btn btn-light me-3">Cancel</button>
                    </a>
                    <button type="submit" class="btn btn-primary" name="save">
                        <span class="indicator-label" id="submit">Submit</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#product').select2();
            $('#purpose').select2();
            $('#option').select2();
            $('#operand').select2();
        });

        // add row rates
        function addRowRates() {
            var table = document.getElementById("ratesTable");
            var row = table.insertRow();
            row.innerHTML = `
                <td><input type="number" name="rates[]" class="form-control border border-white" step="0.01" required></td>
                <td><input type="number" name="days15[]" class="form-control border border-white" step="0.01" required></td>
                <td><input type="number" name="days30[]" class="form-control border border-white" step="0.01" required></td>
                <td><input type="number" name="days45[]" class="form-control border border-white" step="0.01" required></td>
                <td><input type="number" name="margin[]" class="form-control border border-white" step="0.01" required></td>
                <td><input type="number" name="total_rate[]" class="form-control border border-white" step="0.01" required></td>
                <td><button type="button" class="btn btn-danger" onclick="deleteRowRates(this)">Delete</button></td>
            `;
        }

        // delete row rates
        function deleteRowRates(button) {
            var table = document.getElementById("ratesTable");
            if (table.rows.length > 2) {
                var row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
            } else {
                alert("You must have at least one row");
            }
        }

        // add row loans
        function addRowLoans() {
            var table = document.getElementById("loansTable");
            var row = table.insertRow();
            row.innerHTML = `
                <td><input type="number" name="low[]" class="form-control border border-white" step="1" required></td>
                <td><input type="number" name="high[]" class="form-control border border-white" step="1" required></td>
                <td><input type="text" name="adjustment[]" class="form-control border border-white" required></td>
                <td><button type="button" class="btn btn-danger" onclick="deleteRowLoans(this)">Delete</button></td>
            `;
        }

        // delete row loans
        function deleteRowLoans(button) {
            var table = document.getElementById("loansTable");
            if (table.rows.length > 2) {
                var row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
            } else {
                alert("You must have at least one row");
            }
        }

        // add row ficos
        function addRowFicos() {
            var table = document.getElementById("ficosTable");
            var row = table.insertRow();
            row.innerHTML = `
                <td><input type="number" name="fico_low[]" class="form-control border border-white" step="1" required></td>
                <td><input type="number" name="fico_high[]" class="form-control border border-white" step="1" required></td>
                <td><input type="text" name="fico_adjustment[]" class="form-control border border-white" required></td>
                <td><button type="button" class="btn btn-danger" onclick="deleteRowFicos(this)">Delete</button></td>
            `;
        }

        // delete row ficos
        function deleteRowFicos(button) {
            var table = document.getElementById("ficosTable");
            if (table.rows.length > 2) {
                var row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
            } else {
                alert("You must have at least one row");
            }
        }

        // add row Additional
        function addRowAdditional() {
            var table = document.getElementById("additionalTable");
            var row = table.insertRow();
            row.innerHTML = `
                <td>
                    <select name="option[]" id="option" class="form-control border border-white" required>
                        <option value="LTV">LTV</option>
                        <option value="DTI">DTI</option>
                        <option value="Occupancy">Occupancy</option>
                        <option value="Property Type">Property Type</option>
                        <option value="Term">Term</option>
                    </select>
                </td>
                <td>
                    <select name="operand[]" id="operand" class="form-control border border-white" required>
                        <option value="Greater than">Greater than</option>
                        <option value="Less than">Less than</option>
                        <option value="Equal to">Equal to</option>
                    </select>
                </td>
                <td><input type="text" name="value[]" class="form-control border border-white" required></td>
                <td><input type="text" name="additional_adjustment[]" class="form-control border border-white" required></td>
                <td><button type="button" class="btn btn-danger" onclick="deleteRowAdditional(this)">Delete</button></td>
            `;
        }

        // delete row Additional
        function deleteRowAdditional(button) {
            var table = document.getElementById("additionalTable");
            if (table.rows.length > 2) {
                var row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
            } else {
                alert("You must have at least one row");
            }
        }
    </script>
</x-app-layout>
