@extends('admin.layout.app')

@section('title', 'Create-Estimate')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/dataTables.bootstrap4.min.css') }}" />
@endpush
@section('content')

    <div class="crms-title row bg-white">
        <div class="col p-0">
            <h3 class="page-title m-0">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="feather-grid"></i>
                </span>
                Create Estimate
            </h3>
        </div>
        <div class="col p-0 text-end">
            <a href="{{ route('Estimate.index') }}" class="btn btn-primary">back</a>
        </div>
    </div>

    <div class="page-header pt-3 mb-0">
        <div class="row">

        </div>
    </div>
    @includeIf('errors.error')
    <div class="row">
        <div class="col-sm-12">
            <form method="POST" action="{{ route('Estimate.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 my-2">
                        <div class="input-block mb-3">
                            <label class="col-form-label" for="name">
                                <h5>Lead name<span class="text-danger">*</span></h5>
                            </label>
                            <div class="user-icon">
                                <select name="lead_id" id="" required
                                    class="form-control @error('lead_id') is-invalid border border-danger @enderror"
                                    required>
                                    <option selected disabled>Select Lead</option>
                                    @forelse ($leads as $item)
                                        <option value="{{ $item->id }}">{{ $item->company_name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @if ($errors->has('lead_id'))
                                    <span class="error text-danger ms-5">{{ $errors->first('lead_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @php
                        $latesinvoice = App\Models\InvoiceSummary::latest()->first();
                        $invoiceId = $latesinvoice ? $latesinvoice->inv_id + 1 : 100001;
                    @endphp

                    <div class="col-md-6 my-2">
                        <div class="input-block mb-3">
                            <label class="col-form-label" for="name">
                                <h5>Estimate Id<span class="text-danger">*</span></h5>
                            </label>
                            <div class="user-icon">
                                <input type="text" name="inv_id" id="inv_id" placeholder="Lead Owner Id"
                                    value="{{ $invoiceId }}" readonly
                                    class="form-control @error('inv_id') is-invalid border border-danger @enderror"
                                    required>
                                @if ($errors->has('inv_id'))
                                    <span class="error text-danger ms-5">{{ $errors->first('inv_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @php
                        $date = now()->format('Y-m-d');
                    @endphp
                    <div class="col-sm-6 col-md-6">
                        <div class="input-block mb-3">
                            <label class="col-form-label">
                                <h5>Estimate Date <span class="text-danger">*</span></h5>
                            </label>
                            <div class="cal-icn">
                                <input type="date" name="estimate_date" value="{{ $date }}" required
                                    class="form-control  @error('estimate_date') is-invalid border border-danger @enderror">
                                @if ($errors->has('estimate_date'))
                                    <span class="error text-danger ms-5">{{ $errors->first('estimate_date') }}</span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="input-block mb-3">
                            <label class="col-form-label">
                                <h5>Expiry Date<span class="text-danger">*</span></h5>
                            </label>
                            <div class="cal-ico">
                                <input type="date" name="expiry_date" value="{{ $date }}" required
                                    class="form-control  @error('expiry_date') is-invalid border border-danger @enderror">
                                @if ($errors->has('expiry_date'))
                                    <span class="error text-danger ms-5">{{ $errors->first('expiry_date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="input-block mb-3">
                            <label class="col-form-label">
                                <h5>Client Address <span class="text-danger">*</span></h5>
                            </label>
                            <textarea id="client_address" required name="client_address"
                                class="form-control @error('client_address') is-invalid border border-danger @enderror" rows="3"></textarea>
                            @if ($errors->has('client_address'))
                                <span class="error text-danger ms-5">{{ $errors->first('client_address') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="input-block mb-3">
                            <label class="col-form-label">
                                <h5>Billing Address <span class="text-danger">*</span></h5>
                            </label>
                            <textarea id="billing_address" required name="billing_address"
                                class="form-control @error('billing_address') is-invalid border border-danger @enderror" rows="3"></textarea>
                            @if ($errors->has('billing_address'))
                                <span class="error text-danger ms-5">{{ $errors->first('billing_address') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <input type="checkbox" id="same_as_client" name="same_as_client">
                        <label for="same_as_client">Billing Address Same As Client Address?</label>
                    </div>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#same_as_client').change(function() {
                                if ($(this).is(':checked')) {
                                    $('#billing_address').val($('#client_address').val());
                                } else {
                                    $('#billing_address').val('');
                                }
                            });
                        });
                    </script>

                    <div class="row">

                        <div class="col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-white" id="addSpecification">
                                    <thead>
                                        <div class="p-2" style="background-color: rgba(252, 162, 167, 0.2)">Product
                                            Estimating Details </div>
                                        <tr>
                                            <th class="col-sm-2">Product</th>
                                            <th class="col-md-4">Description</th>
                                            <th class="col-md-2">Price</th>
                                            <th class="col-md-2">Qty</th>
                                            <th class="col-md-2">Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbodyoneSpecifi">
                                        <tr>
                                            <td>
                                                <select name="product_id[]" id="productId" required
                                                    class="form-control product-select @error('product_id') is-invalid border border-danger @enderror">
                                                    <option value="">select Product</option>
                                                    @forelse ($products as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                @if ($errors->has('product_id'))
                                                    <span
                                                        class="error text-danger ms-5">{{ $errors->first('product_id') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input
                                                    class="form-control desc @error('desc') is-invalid border border-danger @enderror"
                                                    name="desc[]" type="text">
                                                @if ($errors->has('desc'))
                                                    <span
                                                        class="error text-danger ms-5">{{ $errors->first('desc') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input required id="price"
                                                    class="form-control price @error('price') is-invalid border border-danger @enderror"
                                                    name="price[]" type="text">
                                                @if ($errors->has('price'))
                                                    <span
                                                        class="error text-danger ms-5">{{ $errors->first('price') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input required
                                                    class="form-control qty @error('qty') is-invalid border border-danger @enderror"
                                                    name="qty[]" type="number">
                                                @if ($errors->has('qty'))
                                                    <span
                                                        class="error text-danger ms-5">{{ $errors->first('qty') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input class="form-control total" name="total[]" readonly type="number">
                                                @if ($errors->has('total'))
                                                    <span
                                                        class="error text-danger ms-5">{{ $errors->first('total') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-success font-18" title="Add"
                                                    id="addDesc">
                                                    <i class="fa-solid fa-plus"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-white">
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-end">Sub Total</td>
                                            <td class="text-end pe-4">
                                                <input required name="subTotal" class="form-control text-end subtotal"
                                                    type="number" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-end">Discount</td>
                                            <td class="text-end pe-4">
                                                <input name="discount" value="0"
                                                    class="form-control text-end discount @error('discount') is-invalid border border-danger @enderror"
                                                    type="number">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-end pe-4"><b>Grand Total</b></td>
                                            <td class="text-end tdata-width pe-4">
                                                <input name="grand_total"
                                                    class="form-control text-end grand-total @error('grand_total') is-invalid border border-danger @enderror"
                                                    type="number" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-4 ms-5">
                                    <label class="col-form-label">
                                        <h5>Renew Type<span class="text-danger">*</span></h5>
                                    </label>
                                    <div class="d-flex mb-3">
                                        <div class="m-2">
                                            <input type="radio" id="monthlyRadio" name="renewType" value="monthly">
                                            <label for="monthlyRadio">Monthly</label>
                                        </div>
                                        <div class="m-2">
                                            <input type="radio" id="yearlyRadio" name="renewType" value="yearly"
                                                checked>
                                            <label for="yearlyRadio">Yearly</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div id="inputField">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">
                                                <h5>Renew Fee / Service Charge <span class="text-danger">*</span></h5>
                                            </label>
                                            <div class="cal-ico">
                                                <input name="service_fee"
                                                    class="form-control @error('service_fee') is-invalid border border-danger @enderror"
                                                    type="text">
                                                @if ($errors->has('service_fee'))
                                                    <span
                                                        class="error text-danger ms-5">{{ $errors->first('service_fee') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">
                                            <h5>Other Info <span class="text-danger">*</span></h5>
                                        </label>
                                        <textarea name="other_info" class="form-control @error('other_info') is-invalid border border-danger @enderror"
                                            rows="4"></textarea>
                                        @if ($errors->has('other_info'))
                                            <span class="error text-danger ms-5">{{ $errors->first('other_info') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section my-4">
                        <button class="btn btn-primary submit-btn m-r-10">Save & Send</button>
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
            </form>
        </div>
    </div>



@endsection
@push('js')
    <script src="{{ asset('backend/assets/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/js/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
@endpush

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        function updateTotal() {
            var total = 0;
            $('.tbodyoneSpecifi tr').each(function() {
                var price = parseFloat($(this).find('.price').val()) || 0;
                var qty = parseFloat($(this).find('.qty').val()) || 0;
                var subtotal = price * qty;
                $(this).find('.total').val(subtotal.toFixed(2));
                total += subtotal;
            });
            $('.subtotal').val(total.toFixed(2));

            var discount = parseFloat($('.discount').val()) || 0;
            var grandTotal = total - discount;
            $('.grand-total').val(grandTotal.toFixed(2));
        }


        $(document).on('input', '.price, .qty, .discount', function() {
            updateTotal();
        });
        //-------------//

        // Function to fetch product price
        function fetchProductPrice(selectElement) {
            var productId = selectElement.val();
            var priceField = selectElement.closest('tr').find('.price');

            if (productId) {
                $.ajax({
                    url: '{{ route('fetch.product.info') }}',
                    type: 'GET',
                    data: {
                        productId: productId
                    },
                    success: function(response) {
                        console.log(response);
                        if (response && response.length > 0 && 'price' in response[0]) {
                            priceField.val(response[0]
                            .price); // Set the price value in the price field
                        } else {
                            alert("Price not found for the selected product");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log any errors
                        alert("Failed to fetch product information. Please try again.");
                    }
                });
            } else {
                priceField.val(''); // Clear the price field if no product is selected
            }
        }

        // Add row event handler
        $(document).on('click', '#addDesc', function(e) {
            e.preventDefault();
            var addTableRow = `<tr>
                                        <td>
                                            <select name="product_id[]" class="form-control product-select">
                                                <option value="">select Product</option>
                                                @forelse ($products as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @if ($errors->has('product_id'))
                                                <span class="error text-danger ms-5">{{ $errors->first('product_id') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input class="form-control desc" name="desc[]" type="text">
                                            @if ($errors->has('desc'))
                                                <span class="error text-danger ms-5">{{ $errors->first('desc') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input class="form-control price" name="price[]" type="number">
                                            @if ($errors->has('price'))
                                                <span class="error text-danger ms-5">{{ $errors->first('price') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input class="form-control qty" name="qty[]" type="number">
                                            @if ($errors->has('qty'))
                                                <span class="error text-danger ms-5">{{ $errors->first('qty') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input class="form-control total" name="total[]" readonly type="number">
                                            @if ($errors->has('total'))
                                                <span class="error text-danger ms-5">{{ $errors->first('total') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="text-danger font-18 removebtn" title="Remove">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>`;
            $('.tbodyoneSpecifi').append(addTableRow);
        });

        // Remove row event handler
        $(document).on('click', '.removebtn', function() {
            $(this).closest('tr').remove();
            updateTotal();
        });

        // Change event handler for dynamically added product select boxes
        $(document).on('change', '.product-select', function() {
            fetchProductPrice($(this));
            updateTotal();
        });

    });
</script>
