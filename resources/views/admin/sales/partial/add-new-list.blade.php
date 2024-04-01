<div class="modal fade" id="add-new-list">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New List View</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form class="forms-sample">
                    <div class="form-group row">
                        <label for="view-name" class="col-sm-4 col-form-label">New View Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="view-name" placeholder="New View Name" />
                        </div>
                    </div>
                    <div class="form-group row pt-4">
                        <label class="col-sm-4 col-form-label">Sharing Settings</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label"> <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value /> Just For Me <i class="input-helper"></i></label>
                                </div>
                                <br />
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked /> Share Filter with Everyone <i class="input-helper"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-gradient-primary me-2 btn-rounded">Submit</button>
                        <button class="btn btn-light cancel-button rounded">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
