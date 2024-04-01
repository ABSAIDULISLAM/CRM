<div class="modal custom-modal fade modal-padding" id="export" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header header-border justify-content-between p-0">
                <h5 class="modal-title">Sub-category Add</h5>
                <button type="button" class="btn-close position-static" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <form action="{{route('Sub-category.store')}}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    @php
                                        toastr()->error($error);
                                    @endphp
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-block mb-3">
                                <label class="col-form-label"><h5>Category Name <span class="text-danger">*</span></h5></label>
                                <div class="user-icon">
                                    <select name="category_id" id=""
                                        class="form-control @error('category_id') is-invalid border border-danger @enderror">
                                        <option disabled selected>Select Category</option>
                                        @forelse ($cat as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="error text-danger ms-5">{{ $errors->first('category_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-block mb-3">
                                <label class="col-form-label"><h5>Sub-category Name <span class="text-danger">*</span></h5></label>
                                <div class="user-icon">
                                    <input class="form-control @error('name') is-invalid border border-danger @enderror"
                                        type="text" name="name">
                                    @if ($errors->has('name'))
                                        <span class="error text-danger ms-5">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-end form-wizard-button">
                            <button class="button btn-lights reset-btn" type="reset"
                                data-bs-dismiss="modal">Reset</button>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
