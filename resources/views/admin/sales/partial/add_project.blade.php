<div class="modal right fade" id="add_project" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Add Product</h4>
                <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form>
                            <h4>Project Details</h4>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label">Product Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" />
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">Status</label>
                                    <select class="form-control">
                                        <option>In progress</option>
                                        <option>Deferred</option>
                                        <option>Cancelled</option>
                                        <option>Abandoned</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label">Category</label>
                                    <select class="form-control" id="assigned-to" name="category">
                                        <option>Email</option>
                                        <option>Follow up</option>
                                        <option>Get Started</option>
                                        <option>Meeting</option>
                                        <option>Phone call</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">User Responsible</label>
                                    <select class="form-control">
                                        <option>Nothing selected</option>
                                        <option>ohn Doe</option>
                                    </select>
                                </div>
                            </div>
                            <h4>Pipeline and Stage</h4>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="col-form-label">Pipeline</label>
                                    <select class="form-control">
                                        <option>Nothing selected </option>
                                        <option>Project Pipeline </option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-form-label">Stage</label>
                                    <select class="form-control">
                                        <option>Nothing selected </option>
                                    </select>
                                </div>
                            </div>
                            <h4>Description Information</h4>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Description </label>
                                    <textarea class="form-control" rows="3" id="description" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <h4>Tag Information</h4>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Tag List</label>
                                    <input type="text" class="form-control" name="tag-name" placeholder="Tag List" />
                                </div>
                            </div>
                            <h4>Permissions</h4>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="col-form-label">Visibility</label>
                                    <select class="form-control">
                                        <option>Everyone</option>
                                        <option>Select a team</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center py-3">
                                <button type="button" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Save</button>&nbsp;&nbsp;
                                <button type="button" class="btn btn-secondary btn-rounded">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
