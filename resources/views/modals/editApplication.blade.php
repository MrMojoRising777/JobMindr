<div class="modal" id="applicationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('applications.update', ['application' => $application]) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="application_id" value="{{ $application->id }}" required>

                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit Application</h1>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <select class="form-control" name="status">
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" @if($application->status == $status) selected @endif>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                       <div class="col-12">
                           <label>Note</label>
                           <div id="quillContent">
                               {!! $application->notes !!}
                           </div>
                           <input type="hidden" name="notes" id="quillInput">
                       </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-pen"></i>
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
