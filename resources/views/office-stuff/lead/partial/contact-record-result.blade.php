<div class="modal custom-modal fade modal-padding" id="contactRecordResult" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
                <div class="modal-header header-border justify-content-between p-0">
                      <h5 class="modal-title">Contact Record Store</h5>
                      <button type="button" class="btn-close position-static" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">×</span>
                      </button>
                </div>
                <div class="modal-body p-0">
                    @if(isset($item))
                        <form action="{{route('Office.lead.contact.record.store')}}" method="POST">
                            @csrf
                            @includeIf('errors.error')
                                <div class="row">
                                    <div class="col-md-12 my-2">
                                            <div class="input-block mb-3">
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <label class="col-form-label"><h5>Contact Record <span
                                                    class="text-danger">*</span></h5></label>
                                                <div class="user-icon">
                                                        <textarea name="note" id="" class="form-control" cols="5" rows="3" placeholder="Enter Here Contact Record Note About This Lead"></textarea>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-lg-12 text-end form-wizard-button">
                                            <button class="button btn-lights reset-btn" type="reset"
                                                data-bs-dismiss="modal">Reset</button>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                        </form>
                    @endif
                </div>
          </div>
    </div>
</div>
