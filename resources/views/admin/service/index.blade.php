@extends('admin.layout.app')
@section('title', 'Service')
@section('content')
    @push('css')
        <link rel="stylesheet" href="{{asset('backend/assets/plugins/daterangepicker/daterangepicker.css')}}">
        <link rel="stylesheet" href="{{asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
        <link rel="stylesheet" href="{{asset('backend/assets/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap-datetimepicker.min.css')}}">
        <link rel="stylesheet" href="{{asset('backend/assets/css/select2.min.css')}}">
    @endpush
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h3 class="page-title">Renew Service</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Service</li>
                    </ul>
                </div>
                <div class="col-md-8 float-end ms-auto">
                    <div class="d-flex title-head">
                        <div class="view-icons">

                            <a href="javascript:void(0);" class="list-view btn btn-link" id="filter_search"><i
                                    class="las la-filter"></i>Filter</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>


        <div class="filter-filelds" id="filter_inputs">
            <div class="row filter-row">
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Product Name</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Email</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Phone Number</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus focused">
                        <input type="text" class="form-control  date-range bookingrange">
                        <label class="focus-label">From - To Date</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus select-focus">
                        <select class="select floating">
                            <option>--Select--</option>
                            <option>Germany</option>
                            <option>USA</option>
                            <option>Canada</option>
                            <option>India</option>
                            <option>China</option>
                        </select>
                        <label class="focus-label">Location</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <a href="#" class="btn btn-success w-100"> Search </a>
                </div>
            </div>
        </div>
        <hr>

        <div class="filter-section">
            <ul>
                <li>
                    <div class="search-set">
                        <div class="search-input">
                            <a href="#" class="btn btn-searchset"><i class="las la-search"></i></a>
                            <div class="dataTables_filter">
                                <label> <input type="search" class="form-control form-control-sm"
                                        placeholder="Search"></label>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable contact-table">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl</th>
                                <th>Name</th>
                                <th>asdf</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>
                                    <div class="set-star star-select">
                                        <i class="fa fa-star"></i>
                                    </div>
                                </td>
                                
                                <td>test</td>
                                <td>test</td>
                                <td>
                                    <div class="dropdown action-label">
                                        <a href="#" class="btn btn-white btn-sm badge-outline-success">
                                            Active </a>
                                    </div>
                                </td>
                                <td class="text-end"><a href="{{route('Service.renew')}}" class="btn btn-primary">Renew</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





  <div class="modal custom-modal fade custom-modal-two modal-padding" id="edit_company" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                    <div class="modal-header header-border justify-content-between p-0">
                          <h5 class="modal-title">Edit Company</h5>
                          <button type="button" class="btn-close position-static" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                          </button>
                    </div>
                    <div class="modal-body p-0">
                          <div class="add-details-wizard">
                                <ul id="progressbar2" class="progress-bar-wizard">
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
                                <fieldset id="edit-first-field">
                                      <form
                                            action="https://smarthr.dreamstechnologies.com/html/template/companies.html">
                                            <div class="form-upload-profile">
                                                  <h6 class>Profile Image <span> *</span></h6>
                                                  <div class="profile-pic-upload">
                                                        <div class="profile-pic">
                                                              <span><img src="assets/img/icons/company-icon-01.svg"
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
                                                                    <input class="form-control" type="text"
                                                                          value="NovaWaveLLC">
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
                                                                                <input type="checkbox" id="user3"
                                                                                      class="check" checked>
                                                                                <label for="user3"
                                                                                      class="checktoggle"></label>
                                                                          </div>
                                                                    </div>
                                                                    <input class="form-control" type="email"
                                                                          value="Robertson@example.com">
                                                              </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                              <div class="input-block mb-3">
                                                                    <label class="col-form-label">Phone Number
                                                                          1<span class="text-danger">
                                                                                *</span></label>
                                                                    <input class="form-control" type="text"
                                                                          value="+1 875455453">
                                                              </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                              <div class="input-block mb-3">
                                                                    <label class="col-form-label">Phone Number 2
                                                                          <span class="text-danger">
                                                                                *</span></label>
                                                                    <input class="form-control" type="text"
                                                                          value="+1 895455450">
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
                                                                    <input class="form-control" type="text"
                                                                          value="Admin Website">
                                                              </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                              <div class="input-block mb-3">
                                                                    <label class="col-form-label">Reviews <span
                                                                                class="text-danger">*</span></label>
                                                                    <select class="select">
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
                                                                          id="inputBox2" type="text"
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
                                                                    <input class="form-control" type="text"
                                                                          value="38 Simpson Stree">
                                                              </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                              <div class="input-block mb-3">
                                                                    <label class="col-form-label">City <span
                                                                                class="text-danger">
                                                                                *</span></label>
                                                                    <input class="form-control" type="text"
                                                                          value="Rock Island">
                                                              </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                              <div class="input-block mb-3">
                                                                    <label class="col-form-label">State / Province
                                                                          <span class="text-danger">
                                                                                *</span></label>
                                                                    <input class="form-control" type="text"
                                                                          value="USA">
                                                              </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                              <div class="input-block mb-3">
                                                                    <label class="col-form-label">Country <span
                                                                                class="text-danger">*</span></label>
                                                                    <select class="select">
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
                                                                    <input class="form-control" type="text"
                                                                          value="65">
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
                                                                    <input class="form-control" type="text"
                                                                          value="Darlee Robertson">
                                                              </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                              <div class="input-block mb-3">
                                                                    <label class="col-form-label">Twitter</label>
                                                                    <input class="form-control" type="text"
                                                                          value="Darlee Robertson">
                                                              </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                              <div class="input-block mb-3">
                                                                    <label class="col-form-label">Linkedin</label>
                                                                    <input class="form-control" type="text"
                                                                          value="Darlee Robertson">
                                                              </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                              <div class="input-block mb-3">
                                                                    <label class="col-form-label">Skype</label>
                                                                    <input class="form-control" type="text"
                                                                          value="Darlee Robertson">
                                                              </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                              <div class="input-block mb-3">
                                                                    <label class="col-form-label">Whatsapp</label>
                                                                    <input class="form-control" type="text"
                                                                          value="Darlee Robertson">
                                                              </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                              <div class="input-block mb-3">
                                                                    <label class="col-form-label">Instagram</label>
                                                                    <input class="form-control" type="text"
                                                                          value="Darlee_Robertson">
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
                                                              <ul class="nav nav-pills" id="pills-tab2"
                                                                    role="tablist">
                                                                    <li class="nav-item" role="presentation">
                                                                          <span class="custom_radio mb-0"
                                                                                id="pills-public-tab2"
                                                                                data-bs-toggle="pill"
                                                                                data-bs-target="#pills-public2"
                                                                                role="tab"
                                                                                aria-controls="pills-public2"
                                                                                aria-selected="true">
                                                                                <input type="radio"
                                                                                      class="form-control"
                                                                                      name="public" checked>
                                                                                <span class="checkmark"></span>
                                                                                Public</span>
                                                                    </li>
                                                                    <li class="nav-item" role="presentation">
                                                                          <span class="custom_radio mb-0"
                                                                                id="pills-private-tab2"
                                                                                data-bs-toggle="pill"
                                                                                data-bs-target="#pills-private2"
                                                                                role="tab"
                                                                                aria-controls="pills-private2"
                                                                                aria-selected="false">
                                                                                <input type="radio"
                                                                                      class="form-control"
                                                                                      name="private">
                                                                                <span class="checkmark"></span>
                                                                                Private</span>
                                                                    </li>
                                                                    <li class="nav-item" role="presentation">
                                                                          <span class="custom_radio mb-0 active"
                                                                                id="pills-select-people-tab2"
                                                                                data-bs-toggle="pill"
                                                                                data-bs-target="#pills-select-people2"
                                                                                role="tab"
                                                                                aria-controls="pills-select-people2"
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
                                                  <div class="tab-content" id="pills-tabContent2">
                                                        <div class="tab-pane fade" id="pills-public2"
                                                              role="tabpanel" aria-labelledby="pills-public-tab2">
                                                        </div>
                                                        <div class="tab-pane fade" id="pills-private2"
                                                              role="tabpanel" aria-labelledby="pills-private-tab2">
                                                        </div>
                                                        <div class="tab-pane fade show active"
                                                              id="pills-select-people2" role="tabpanel"
                                                              aria-labelledby="pills-select-people-tab2">
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
                                                              <input type="radio" class="status-radio" id="test4"
                                                                    name="radio-group" checked>
                                                              <label for="test4">Active</label>
                                                        </div>
                                                        <div class="people-status-radio">
                                                              <input type="radio" class="status-radio" id="test5"
                                                                    name="radio-group">
                                                              <label for="test5">Private</label>
                                                        </div>
                                                        <div class="people-status-radio">
                                                              <input type="radio" class="status-radio" id="test6"
                                                                    name="radio-group">
                                                              <label for="test6">Inactive</label>
                                                        </div>
                                                  </div>
                                                  <div class="col-lg-12 text-end form-wizard-button">
                                                        <button class="button btn-lights reset-btn"
                                                              type="reset">Reset</button>
                                                        <button class="btn btn-primary"
                                                              type="submit">Submit</button>
                                                  </div>
                                            </div>
                                      </form>
                                </fieldset>
                          </div>
                    </div>
              </div>
        </div>
  </div>


  <div class="modal custom-modal fade" id="success_msg" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                    <div class="modal-body">
                          <div class="success-message text-center">
                                <div class="success-popup-icon">
                                      <i class="la la-building"></i>
                                </div>
                                <h3>Company Created Successfully!!!</h3>
                                <p>View the details of Company</p>
                                <div class="col-lg-12 text-center form-wizard-button">
                                      <a href="#" class="button btn-lights" data-bs-dismiss="modal">Close</a>
                                      <a href="company-details.html" class="btn btn-primary">View Details</a>
                                </div>
                          </div>
                    </div>
              </div>
        </div>
  </div>


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
                                      <a href="companies.html" class="btn btn-primary">Okay</a>
                                </div>
                          </div>
                    </div>
              </div>
        </div>
  </div>


  <div class="modal custom-modal fade modal-padding" id="add_notes" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                    <div class="modal-header header-border align-items-center justify-content-between p-0">
                          <h5 class="modal-title">Add Note</h5>
                          <button type="button" class="btn-close position-static" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                          </button>
                    </div>
                    <div class="modal-body p-0">
                          <form action="https://smarthr.dreamstechnologies.com/html/template/company-details.html">
                                <div class="input-block mb-3">
                                      <label class="col-form-label">Title <span class="text-danger">
                                                  *</span></label>
                                      <input class="form-control" type="text">
                                </div>
                                <div class="input-block mb-3">
                                      <label class="col-form-label">Note <span class="text-danger"> *</span></label>
                                      <textarea class="form-control" rows="4" placeholder="Add text"></textarea>
                                </div>
                                <div class="input-block mb-3">
                                      <label class="col-form-label">Attachment <span class="text-danger">
                                                  *</span></label>
                                      <div class="drag-upload">
                                            <input type="file">
                                            <div class="img-upload">
                                                  <i class="las la-file-import"></i>
                                                  <p>Drag & Drop your files</p>
                                            </div>
                                      </div>
                                </div>
                                <div class="input-block mb-3">
                                      <label class="col-form-label">Uploaded Files</label>
                                      <div class="upload-file">
                                            <h6>Projectneonals teyys.xls</h6>
                                            <p>4.25 MB</p>
                                            <div class="progress">
                                                  <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                            </div>
                                            <p>45%</p>
                                      </div>
                                      <div class="upload-file upload-list">
                                            <div>
                                                  <h6>Projectneonals teyys.xls</h6>
                                                  <p>4.25 MB</p>
                                            </div>
                                            <a href="javascript:void(0);" class="text-danger"><i
                                                        class="las la-trash"></i></a>
                                      </div>
                                </div>
                                <div class="col-lg-12 text-end form-wizard-button">
                                      <button class="button btn-lights reset-btn" type="reset">Reset</button>
                                      <button class="btn btn-primary" type="submit">Save Notes</button>
                                </div>
                          </form>
                    </div>
              </div>
        </div>
  </div>


  <div class="modal custom-modal fade modal-padding" id="export" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                    <div class="modal-header header-border justify-content-between p-0">
                          <h5 class="modal-title">Export</h5>
                          <button type="button" class="btn-close position-static" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                          </button>
                    </div>
                    <div class="modal-body p-0">
                          <form action="https://smarthr.dreamstechnologies.com/html/template/companies.html">
                                <div class="row">
                                      <div class="col-md-12">
                                            <div class="input-block mb-3">
                                                  <h5 class="mb-3">Export</h5>
                                                  <div class="status-radio-btns d-flex">
                                                        <div class="people-status-radio">
                                                              <input type="radio" class="status-radio" id="pdf"
                                                                    name="export-type" checked>
                                                              <label for="pdf">Person</label>
                                                        </div>
                                                        <div class="people-status-radio">
                                                              <input type="radio" class="status-radio" id="excel"
                                                                    name="export-type">
                                                              <label for="excel">Organization</label>
                                                        </div>
                                                  </div>
                                            </div>
                                      </div>
                                      <div class="col-md-12">
                                            <h4 class="mb-3">Filters</h4>
                                            <div class="input-block mb-3">
                                                  <label class="col-form-label">Fields <span
                                                              class="text-danger">*</span></label>
                                                  <select class="select">
                                                        <option>All Fields</option>
                                                        <option>contact</option>
                                                        <option>Company</option>
                                                  </select>
                                            </div>
                                      </div>
                                      <div class="col-md-6">
                                            <div class="input-block mb-3">
                                                  <label class="col-form-label">From Date <span
                                                              class="text-danger">*</span></label>
                                                  <div class="cal-icon">
                                                        <input class="form-control floating datetimepicker"
                                                              type="text">
                                                  </div>
                                            </div>
                                      </div>
                                      <div class="col-md-6">
                                            <div class="input-block mb-3">
                                                  <label class="col-form-label">To Date <span
                                                              class="text-danger">*</span></label>
                                                  <div class="cal-icon">
                                                        <input class="form-control floating datetimepicker"
                                                              type="text">
                                                  </div>
                                            </div>
                                      </div>
                                      <div class="col-lg-12 text-end form-wizard-button">
                                            <button class="button btn-lights reset-btn" type="reset"
                                                  data-bs-dismiss="modal">Reset</button>
                                            <button class="btn btn-primary" type="submit">Export Now</button>
                                      </div>
                                </div>
                          </form>
                    </div>
              </div>
        </div>
  </div>




    @includeIf('admin.product.partial.add_project')


@push('js')
    {{-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}

    <script src="{{asset('backend/assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/js/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"
        type="text/javascript"></script>
    <script src="{{asset('backend/assets/js/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/plugins/daterangepicker/daterangepicker.js')}}"
        type="text/javascript"></script>
    <script src="{{asset('backend/assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/js/theme-settings.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/js/greedynav.js')}}" type="text/javascript"></script>
    {{-- <script src="../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
    data-cf-settings="" defer></script> --}}
@endpush

@endsection
