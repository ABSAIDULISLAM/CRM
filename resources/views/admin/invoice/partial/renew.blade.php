<div class="modal custom-modal fade modal-padding" id="renew" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-border justify-content-between p-0">
                <h5 class="modal-title">Service Renew</h5>
                <button type="button" class="btn-close position-static" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <form id="renewForm" method="POST" action="{{route('Service.renew.store')}}" enctype="multipart/form-data">
                    @csrf
                    @includeIf('errors.error')
                    <div class="row">
                        <input type="hidden" name="id" id="renewId" >
                        <input type="hidden" name="inv_id" id="invId" >
                        <input type="hidden" name="user_id" id="userId" >
                        <div class="col-md-12 my-2">
                            <div class="input-block mb-3">
                                <label class="col-form-label"><h5>Renew Fee<span class="text-danger">*</span></h5></label>
                                <div class="user-icon">
                                    <input name="service_fee" id="service_fee" class="form-control @error('service_fee') is-invalid border border-danger @enderror" type="text" required>
                                    @if ($errors->has('service_fee'))
                                        <span class="error text-danger ms-5">{{ $errors->first('service_fee') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @php
                            $date = date('Y-m-d');
                        @endphp
                        <div class="col-md-12 my-2">
                            <div class="input-block mb-3">
                                <label class="col-form-label"><h5>Paid Date<span class="text-danger">*</span></h5></label>
                                <div class="user-icon">
                                    <input name="date" id="date" value="{{$date}}" class="form-control @error('date') is-invalid border border-danger @enderror" type="text" required>
                                    @if ($errors->has('date'))
                                        <span class="error text-danger ms-5">{{ $errors->first('date') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 my-2">
                            <label class="col-form-label">
                                <h5>Renew Type<span class="text-danger">*</span></h5>
                            </label>
                            <div class="d-flex mb-3">
                                <div class="m-2">
                                    <input type="radio" id="monthlyRadio" name="renewType" value="monthly">
                                    <label for="monthlyRadio">Monthly</label>
                                </div>
                                <div class="m-2">
                                    <input type="radio" id="yearlyRadio" name="renewType" value="yearly">
                                    <label for="yearlyRadio">Yearly</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 text-end form-wizard-button">
                            <button class="button btn-lights reset-btn" type="reset" data-bs-dismiss="modal">Reset</button>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
