<div class="modal custom-modal fade" id="delete_company" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
                <div class="modal-body">
                      <div class="success-message text-center">
                            <div class="success-popup-icon bg-danger">
                                  <i class="la la-trash-restore"></i>
                            </div>
                            <h3>Are you sure, You want to delete</h3>
                            <p>Company ”NovaWaveLLC” from your Account</p>
                            <div class="col-lg-12 text-center form-wizard-button">
                                  <a href="#" class="button btn-lights" data-bs-dismiss="modal">Not Now</a>
                                  <a href="{{route('Marketing.lead.delete', [Crypt::encrypt($item->id), 'name'=> 'saidul'])}}" class="btn btn-primary">Okay</a>
                            </div>
                      </div>
                </div>
          </div>
    </div>
</div>
