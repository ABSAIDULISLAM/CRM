<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#addDesc").on('click', function(e) {
                const tableBody = $('#addSpecification tbody');
                const rowCount = tableBody.find('tr').length + 1;
                var addTableRow = `<tr>
                                            <td>
                                                <input name="icon[]" placeholder="Icon class name from fontawesome"
                                                    type="text" class="form-control @error('icon') is-invalid border border-danger @enderror">
                                                    @if ($errors->has('icon'))
                                                        <span class="error text-danger ms-5">{{ $errors->first('icon') }}</span>
                                                    @endif
                                                </td>
                                            <td>
                                                <input name="title[]" placeholder="Enter title" type="text" class="form-control @error('title') is-invalid border border-danger @enderror">
                                                @if ($errors->has('title'))
                                                    <span class="error text-danger ms-5">{{ $errors->first('title') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input name="description[]" placeholder="Enter description" type="text" class="form-control @error('description') is-invalid border border-danger @enderror">
                                                @if ($errors->has('description'))
                                                    <span class="error text-danger ms-5">{{ $errors->first('description') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-danger font-18 removebtn" title="Remove"
                                                    id="removebtn">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>`;
                tableBody.append(addTableRow);
                e.preventDefault();
            });
            $(document).on('click', '.removebtn', function() {
                $(this).closest('tr').remove();
            });
        });
        // =====
        // for button check
        $('button[type="submit"]').prop('disabled', true);

        $('.form-control').on('input', function () {
            var form = $(this).closest('form');
            var invalidFields = form.find('.form-control:invalid');

            $('button[type="submit"]').prop('disabled', invalidFields.length > 0);
        });

        // =====
        // for category to subcategory data fetch
        function fetchSubCatInfo() {
            let catId = $('#catId').val();
            if (catId) {
                $('#loadingSpinner').show();
                $.ajax({
                    url: '{{ route('fetch.sub-cat') }}?catId=' + catId,
                    type: 'GET',
                    success: function(res) {
                        $('#loadingSpinner').hide();
                        $('#subCategoryId').empty();
                        $('#subCategoryId').append('<option disabled selected>Select Sub-category</option>');
                        $.each(res, function(key, value) {
                            $('#subCategoryId').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }
        $('#catId').on('change', function() {
            fetchSubCatInfo();
        });


    </script>


    {{-- <script>
        $(document).ready(function(){
            $('#').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'), // Fix the quotes here
                    data: $(this).serialize(),
                    success: function(res) {
                        if (res.length > 0) {
                            $.each(res, function(key, value) {
                                $('#name').val(value.name);
                                $('#student_id').val(value.student_id);
                                $('#call').val(value.number);
                                $('#whatsApp').val(value.whats_app);
                                $('#country').val(value.country);
                                $('#gender').val(value.gender);
                                $('#id').val(value.id);
                            });
                        }else if ('message' in res) {
                            alert(res.message);
                        }
                    }
                });
            });
        });

    </script> --}}
