<div class="modal" id="exampleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('excel.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Import applications</h5>
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Import an Excel file</label>
                                <input class="form-control" type="file" name="file">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-download"></i>
                        Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
