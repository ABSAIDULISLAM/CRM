<div class="modal custom-modal fade modal-padding" id="export" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header header-border justify-content-between p-0">
                <h5 class="modal-title">Category Add</h5>
                <button type="button" class="btn-close position-static" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <form id="categoryForm" method="POST" action="{{route('Category.store')}}" enctype="multipart/form-data">
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
                        <div class="col-md-12 my-2">
                            <div class="input-block mb-3">
                                <label class="col-form-label"><h5>Category Name <span class="text-danger">*</span></h5></label>
                                <div class="user-icon">
                                    <input name="name" class="form-control @error('name') is-invalid border border-danger @enderror" type="text" required>
                                    @if ($errors->has('name'))
                                        <span class="error text-danger ms-5">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 my-2">
                            <div class="input-block">
                                <label class="col-form-label"><h5>Category Image <span class="text-secondary">(optional)</span></h5></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imageInput" name="image" accept="image/*">
                                    <label class="custom-file-label" for="imageInput">Choose file</label>
                                </div>
                                <div class="mt-2">
                                    <img src="" id="imagePreview" alt="Preview Image" style="display: none; max-width: 100px; max-height: 100px;">
                                    <button type="button" class="btn btn-danger btn-sm mt-2" id="removeImageButton" style="display: none;">X</button>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#imageInput').change(function() {
            const file = this.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result).show();
                $('#removeImageButton').show();
            };
            reader.readAsDataURL(file);
            $('.custom-file-label').text(file.name);
        });

        $('#removeImageButton').click(function() {
            $('#imagePreview').attr('src', '').hide();
            $('#imageInput').val('');
            $(this).hide();
            $('.custom-file-label').text('Choose file');
        });
    });
</script>
