<div class="modal custom-modal fade custom-modal-two modal-padding" id="add_company" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
                <div class="modal-header header-border justify-content-between p-0">
                      <h5 class="modal-title">Add New Company</h5>
                      <button type="button" class="btn-close position-static" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">×</span>
                      </button>
                </div>
                <div class="modal-body p-0">
                      <div class="add-details-wizard">
                            <ul id="progressbar" class="progress-bar-wizard">
                                  <li class="active">
                                        <span><i class="la la-user-tie"></i></span>
                                        <div class="multi-step-info">
                                              <h6>Basic Info</h6>
                                        </div>
                                  </li>
                                  <li>
                                        <span><i class="la la-map-marker"></i></span>
                                        <div class="multi-step-info">
                                              <h6>Address</h6>
                                        </div>
                                  </li>
                                  <li>
                                        <div class="multi-step-icon">
                                              <span><i class="la la-icons"></i></span>
                                        </div>
                                        <div class="multi-step-info">
                                              <h6>Social Profiles</h6>
                                        </div>
                                  </li>
                                  <li>
                                        <div class="multi-step-icon">
                                              <span><i class="la la-images"></i></span>
                                        </div>
                                        <div class="multi-step-info">
                                              <h6>Access</h6>
                                        </div>
                                  </li>
                            </ul>
                      </div>
                      <div class="add-info-fieldset">
                            <fieldset id="first-field">
                                  <form
                                        action="https://smarthr.dreamstechnologies.com/html/template/companies.html">
                                        <div class="form-upload-profile">
                                              <h6 class>Profile Image <span> *</span></h6>
                                              <div class="profile-pic-upload">
                                                    <div class="profile-pic">
                                                          <span><img src="assets/img/icons/profile-upload-img.svg"
                                                                      alt="Img"></span>
                                                    </div>
                                                    <div class="employee-field">
                                                          <div class="mb-0">
                                                                <div class="image-upload mb-0">
                                                                      <input type="file">
                                                                      <div class="image-uploads">
                                                                            <h4>Upload</h4>
                                                                      </div>
                                                                </div>
                                                          </div>
                                                          <div class="img-reset-btn">
                                                                <a href="#">Reset</a>
                                                          </div>
                                                    </div>
                                              </div>
                                        </div>
                                        <div class="contact-input-set">
                                              <div class="row">
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Company Name <span
                                                                            class="text-danger">*</span></label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <div
                                                                      class="d-flex justify-content-between align-items-center">
                                                                      <label class="col-form-label">Email <span
                                                                                  class="text-danger">
                                                                                  *</span></label>
                                                                      <div
                                                                            class="status-toggle small-toggle-btn d-flex align-items-center">
                                                                            <span
                                                                                  class="me-2 label-text">Option</span>
                                                                            <input type="checkbox" id="user2"
                                                                                  class="check" checked>
                                                                            <label for="user2"
                                                                                  class="checktoggle"></label>
                                                                      </div>
                                                                </div>
                                                                <input class="form-control" type="email">
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Phone Number
                                                                      1<span class="text-danger">
                                                                            *</span></label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Phone Number 2
                                                                      <span class="text-danger">
                                                                            *</span></label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Fax <span
                                                                            class="text-danger">
                                                                            *</span></label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Website</label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Reviews <span
                                                                            class="text-danger">*</span></label>
                                                                <select class="select">
                                                                      <option>Select</option>
                                                                      <option>Lowest</option>
                                                                      <option>Highest</option>
                                                                </select>
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Owner <span
                                                                            class="text-danger">*</span></label>
                                                                <select class="select">
                                                                      <option>Select</option>
                                                                      <option>Hendry</option>
                                                                      <option>Guillory</option>
                                                                      <option>Jami</option>
                                                                </select>
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Tags <span
                                                                            class="text-danger">*</span></label>
                                                                <input class="input-tags form-control"
                                                                      id="inputBox" type="text"
                                                                      data-role="tagsinput" name="Label"
                                                                      value="Promotion, Rated">
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <div
                                                                      class="d-flex justify-content-between align-items-center">
                                                                      <label class="col-form-label">Deals <span
                                                                                  class="text-danger">*</span></label>
                                                                      <a href="#" class="add-new"><i
                                                                                  class="la la-plus-circle me-2"></i>Add
                                                                            New</a>
                                                                </div>
                                                                <select class="select">
                                                                      <option>Select</option>
                                                                      <option>Collins</option>
                                                                      <option>Konopelski</option>
                                                                      <option>Adams</option>
                                                                </select>
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Industry <span
                                                                            class="text-danger">*</span></label>
                                                                <select class="select">
                                                                      <option>Select</option>
                                                                      <option>Barry Cuda</option>
                                                                      <option>Tressa Wexler</option>
                                                                </select>
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Source <span
                                                                            class="text-danger">*</span></label>
                                                                <select class="select">
                                                                      <option>Select</option>
                                                                      <option>Barry Cuda</option>
                                                                      <option>Tressa Wexler</option>
                                                                </select>
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Contact <span
                                                                            class="text-danger">*</span></label>
                                                                <select class="select">
                                                                      <option>Select</option>
                                                                      <option>Email</option>
                                                                      <option>Call</option>
                                                                      <option>Skype</option>
                                                                </select>
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Currency <span
                                                                            class="text-danger">*</span></label>
                                                                <select class="select">
                                                                      <option>Select</option>
                                                                      <option>$</option>
                                                                      <option>€</option>
                                                                </select>
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Language <span
                                                                            class="text-danger">*</span></label>
                                                                <select class="select">
                                                                      <option>Select</option>
                                                                      <option>English</option>
                                                                      <option>French</option>
                                                                </select>
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">About Company<span
                                                                            class="text-danger">*</span></label>
                                                                <textarea class="form-control"
                                                                      rows="5"></textarea>
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-12 text-end form-wizard-button">
                                                          <button class="button btn-lights reset-btn"
                                                                type="reset">Reset</button>
                                                          <button class="btn btn-primary wizard-next-btn"
                                                                type="button">Save & Next</button>
                                                    </div>
                                              </div>
                                        </div>
                                  </form>
                            </fieldset>
                            <fieldset>
                                  <form
                                        action="https://smarthr.dreamstechnologies.com/html/template/companies.html">
                                        <div class="contact-input-set">
                                              <div class="row">
                                                    <div class="col-lg-12">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Street
                                                                      Address<span class="text-danger">
                                                                            *</span></label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">City <span
                                                                            class="text-danger">
                                                                            *</span></label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">State / Province
                                                                      <span class="text-danger">
                                                                            *</span></label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Country <span
                                                                            class="text-danger">*</span></label>
                                                                <select class="select">
                                                                      <option>Select</option>
                                                                      <option>Germany</option>
                                                                      <option>USA</option>
                                                                </select>
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Zipcode <span
                                                                            class="text-danger">
                                                                            *</span></label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-12 text-end form-wizard-button">
                                                          <button class="button btn-lights reset-btn"
                                                                type="reset">Reset</button>
                                                          <button class="btn btn-primary wizard-next-btn"
                                                                type="button">Save & Next</button>
                                                    </div>
                                              </div>
                                        </div>
                                  </form>
                            </fieldset>
                            <fieldset>
                                  <form
                                        action="https://smarthr.dreamstechnologies.com/html/template/companies.html">
                                        <div class="contact-input-set">
                                              <div class="row">
                                                    <div class="col-lg-12">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Facebook</label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Twitter</label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Linkedin</label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Skype</label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Whatsapp</label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                          <div class="input-block mb-3">
                                                                <label class="col-form-label">Instagram</label>
                                                                <input class="form-control" type="text">
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                          <div class="input-block mb-3">
                                                                <a href="#" class="add-new"><i
                                                                            class="la la-plus-circle me-2"></i>Add
                                                                      New</a>
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-12 text-end form-wizard-button">
                                                          <button class="button btn-lights reset-btn"
                                                                type="reset">Reset</button>
                                                          <button class="btn btn-primary wizard-next-btn"
                                                                type="button">Save & Next</button>
                                                    </div>
                                              </div>
                                        </div>
                                  </form>
                            </fieldset>
                            <fieldset>
                                  <form
                                        action="https://smarthr.dreamstechnologies.com/html/template/companies.html">
                                        <div class="contact-input-set">
                                              <div class="input-blocks add-products">
                                                    <label class="mb-3">Visibility</label>
                                                    <div class="access-info-tab">
                                                          <ul class="nav nav-pills" id="pills-tab1"
                                                                role="tablist">
                                                                <li class="nav-item" role="presentation">
                                                                      <span class="custom_radio mb-0"
                                                                            id="pills-public-tab"
                                                                            data-bs-toggle="pill"
                                                                            data-bs-target="#pills-public"
                                                                            role="tab"
                                                                            aria-controls="pills-public"
                                                                            aria-selected="true">
                                                                            <input type="radio"
                                                                                  class="form-control"
                                                                                  name="public" checked>
                                                                            <span class="checkmark"></span>
                                                                            Public</span>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                      <span class="custom_radio mb-0"
                                                                            id="pills-private-tab"
                                                                            data-bs-toggle="pill"
                                                                            data-bs-target="#pills-private"
                                                                            role="tab"
                                                                            aria-controls="pills-private"
                                                                            aria-selected="false">
                                                                            <input type="radio"
                                                                                  class="form-control"
                                                                                  name="private">
                                                                            <span class="checkmark"></span>
                                                                            Private</span>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                      <span class="custom_radio mb-0 active"
                                                                            id="pills-select-people-tab"
                                                                            data-bs-toggle="pill"
                                                                            data-bs-target="#pills-select-people"
                                                                            role="tab"
                                                                            aria-controls="pills-select-people"
                                                                            aria-selected="false">
                                                                            <input type="radio"
                                                                                  class="form-control"
                                                                                  name="select-people">
                                                                            <span class="checkmark"></span>
                                                                            Select People</span>
                                                                </li>
                                                          </ul>
                                                    </div>
                                              </div>
                                              <div class="tab-content" id="pills-tabContent">
                                                    <div class="tab-pane fade" id="pills-public" role="tabpanel"
                                                          aria-labelledby="pills-public-tab">
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-private"
                                                          role="tabpanel" aria-labelledby="pills-private-tab">
                                                    </div>
                                                    <div class="tab-pane fade show active"
                                                          id="pills-select-people" role="tabpanel"
                                                          aria-labelledby="pills-select-people-tab">
                                                          <div class="people-select-tab">
                                                                <h3>Select People</h3>
                                                                <div class="select-people-checkbox">
                                                                      <label class="custom_check">
                                                                            <input type="checkbox">
                                                                            <span class="checkmark"></span>
                                                                            <span class="people-profile">
                                                                                  <img src="assets/img/avatar/avatar-19.jpg"
                                                                                        alt="Img">
                                                                                  <a href="#">Darlee
                                                                                        Robertson</a>
                                                                            </span>
                                                                      </label>
                                                                </div>
                                                                <div class="select-people-checkbox">
                                                                      <label class="custom_check">
                                                                            <input type="checkbox">
                                                                            <span class="checkmark"></span>
                                                                            <span class="people-profile">
                                                                                  <img src="assets/img/avatar/avatar-20.jpg"
                                                                                        alt="Img">
                                                                                  <a href="#">Sharon Roy</a>
                                                                            </span>
                                                                      </label>
                                                                </div>
                                                                <div class="select-people-checkbox">
                                                                      <label class="custom_check">
                                                                            <input type="checkbox">
                                                                            <span class="checkmark"></span>
                                                                            <span class="people-profile">
                                                                                  <img src="assets/img/avatar/avatar-21.jpg"
                                                                                        alt="Img">
                                                                                  <a href="#">Vaughan</a>
                                                                            </span>
                                                                      </label>
                                                                </div>
                                                                <div class="select-people-checkbox">
                                                                      <label class="custom_check">
                                                                            <input type="checkbox">
                                                                            <span class="checkmark"></span>
                                                                            <span class="people-profile">
                                                                                  <img src="assets/img/avatar/avatar-1.jpg"
                                                                                        alt="Img">
                                                                                  <a href="#">Jessica</a>
                                                                            </span>
                                                                      </label>
                                                                </div>
                                                                <div class="select-confirm-btn">
                                                                      <a href="#"
                                                                            class="btn danger-btn">Confirm</a>
                                                                </div>
                                                          </div>
                                                    </div>
                                              </div>
                                              <h5 class="mb-3">Status</h5>
                                              <div class="status-radio-btns d-flex mb-3">
                                                    <div class="people-status-radio">
                                                          <input type="radio" class="status-radio" id="test1"
                                                                name="radio-group" checked>
                                                          <label for="test1">Active</label>
                                                    </div>
                                                    <div class="people-status-radio">
                                                          <input type="radio" class="status-radio" id="test2"
                                                                name="radio-group">
                                                          <label for="test2">Private</label>
                                                    </div>
                                                    <div class="people-status-radio">
                                                          <input type="radio" class="status-radio" id="test3"
                                                                name="radio-group">
                                                          <label for="test3">Inactive</label>
                                                    </div>
                                              </div>
                                              <div class="col-lg-12 text-end form-wizard-button">
                                                    <button class="button btn-lights reset-btn"
                                                          type="reset">Reset</button>
                                                    <button class="btn btn-primary" type="button"
                                                          data-bs-toggle="modal"
                                                          data-bs-target="#success_msg">Save & Next</button>
                                              </div>
                                        </div>
                                  </form>
                            </fieldset>
                      </div>
                </div>
          </div>
    </div>
</div>
