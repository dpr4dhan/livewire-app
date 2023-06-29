<!-- Modal -->
<div class="modal fade" id="postCreateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="" id="postCreateForm">
                <input type="hidden" name="post_id" id="post_id"value="0">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                                <span class="text-danger" id="titleError"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="short_description" class="form-label">Short Description</label>
                                <textarea class="form-control desc" name="short_description" id="short_description" cols="30" rows="4"></textarea>
                                <span class="text-danger" id="short_descriptionError"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control desc" name="description " id="description" cols="30" rows="7"></textarea>
                                <span class="text-danger" id="descriptionError"></span>
                            </div>
                        </div>
                        <div class="col-6">

                            <div class="mb-3 ">
                                <label for="published_at" class="form-label">Published At</label>
                                <input type="text" name="published_at" id="published_at" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#published_at">
                                <span class="text-danger" id="published_atError"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <h4>Add Photos: </h4>
                    <div class="row" id="edit_photo_div"></div>
                    <div class="row">
                        <div class="offset-10 col-2">
                            <button type="button" id="addPhotoBtn" class="btn btn-info">Add More</button>
                        </div>
                        <div class="col-6 photoRow_1">
                            <div class="mb-3">
                                <label for="caption1" class="form-label">Caption</label>
                                <input type="text" name="caption[1]" id="caption1" class="form-control" >
                                <span class="text-danger" id="caption1Error"></span>
                            </div>
                        </div>
                        <div class="col-5 photoRow_1">
                            <div class="mb-3">
                                <label for="photo1" class="form-label">Photo</label>
                                <input type="file" name="photo[1]" id="photo1" class="form-control" >
                                <span class="text-danger" id="photo1Error"></span>
                            </div>
                        </div>
                        <div class="col-1 photoRow_1">
                            <button data-row="1" class="btn btn-danger photoRemoveRow"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="row" id="add_photo_div"></div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closePostCreateModal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


